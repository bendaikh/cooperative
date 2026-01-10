<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use App\Models\CapsuleStockMovement;
use App\Models\FilledCapsule;
use App\Models\Fornisseur;
use App\Models\Herb;
use App\Models\HerbStockMovement;
use App\Models\Expense;
use Illuminate\Http\Request;

class StockCapsuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capsules = Capsule::with('movements', 'cartonType')->get();
        $herbs = Herb::all();
        $fornisseurs = Fornisseur::whereHas('specialites', function ($query) {
            $query->where('specialite', 'capsule');
        })->get();
        return view('stock-capsules.index', compact('capsules', 'herbs', 'fornisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fornisseurs = Fornisseur::all();
        $herbs = Herb::all();
        $cartonTypes = \App\Models\CartonType::active();
        return view('stock-capsules.create', compact('fornisseurs', 'herbs', 'cartonTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'carton' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'carton_type_id' => 'required|exists:carton_types,id',
            'carton_price' => 'required|numeric|min:0',
            'fornisseur_id' => 'nullable|exists:fornisseurs,id',
            'notes' => 'nullable|string',
        ]);

        // Get carton type and calculate capsules
        $cartonType = \App\Models\CartonType::findOrFail($request->carton_type_id);
        $nombreCapsules = $request->quantity * $cartonType->capacity;

        // Update the carton type's purchase price
        $cartonType->update([
            'purchase_price' => $request->carton_price,
        ]);

        // Create capsule with quantity, carton type, and price
        $capsule = Capsule::create([
            'carton' => $request->carton,
            'quantity' => $request->quantity,
            'carton_type_id' => $request->carton_type_id,
            'carton_price' => $request->carton_price,
            'nombre_capsules' => $nombreCapsules,
            'notes' => $request->notes,
        ]);

        // Create initial movement if quantity > 0
        if ($request->quantity > 0) {
            CapsuleStockMovement::create([
                'capsule_id' => $capsule->id,
                'fornisseur_id' => $request->fornisseur_id,
                'type' => 'restock',
                'quantity' => $request->quantity,
                'movement_date' => now(),
                'notes' => 'Stock initial',
            ]);
        }

        return redirect()->route('stock-capsules.index')->with('success', 'Stock capsule créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $capsule = Capsule::with([
            'cartonType',
            'movements' => function($query) {
                $query->with(['herb', 'fornisseur'])->orderBy('movement_date', 'desc')->orderBy('created_at', 'desc');
            }
        ])->findOrFail($id);
        return view('stock-capsules.show', compact('capsule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $capsule = Capsule::with('cartonType')->findOrFail($id);
        $cartonTypes = \App\Models\CartonType::active();
        return view('stock-capsules.edit', compact('capsule', 'cartonTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $capsule = Capsule::with('cartonType')->findOrFail($id);
        
        $request->validate([
            'carton' => 'required|string|max:255',
            'carton_type_id' => 'required|exists:carton_types,id',
            'carton_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Update carton, carton type, price and notes
        $cartonType = \App\Models\CartonType::findOrFail($request->carton_type_id);
        $nombreCapsules = $capsule->quantity * $cartonType->capacity;

        // Update the carton type's purchase price
        $cartonType->update([
            'purchase_price' => $request->carton_price,
        ]);

        $capsule->update([
            'carton' => $request->carton,
            'carton_type_id' => $request->carton_type_id,
            'carton_price' => $request->carton_price,
            'nombre_capsules' => $nombreCapsules,
            'notes' => $request->notes,
        ]);

        return redirect()->route('stock-capsules.index')->with('success', 'Stock capsule mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $capsule = Capsule::with('cartonType')->findOrFail($id);
        $capsule->delete();

        return redirect()->route('stock-capsules.index')->with('success', 'Stock capsule supprimé avec succès.');
    }

    /**
     * Restock a capsule
     */
    public function restock(Request $request, string $id)
    {
        $capsule = Capsule::with('cartonType')->findOrFail($id);
        
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'carton_price' => 'required|numeric|min:0',
            'fornisseur_id' => 'nullable|exists:fornisseurs,id',
            'movement_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Calculate capsules based on carton type capacity
        $capsulesPerCarton = $capsule->getCapsulesPerCarton();
        $capsulesAdded = $request->quantity * $capsulesPerCarton;

        // Add cartons to stock and update nombre_capsules
        $capsule->quantity += $request->quantity;
        $capsule->carton_price = $request->carton_price; // Update price
        $capsule->nombre_capsules += $capsulesAdded;
        $capsule->save();

        // Create restock movement record
        CapsuleStockMovement::create([
            'capsule_id' => $capsule->id,
            'fornisseur_id' => $request->fornisseur_id,
            'type' => 'restock',
            'quantity' => $request->quantity,
            'movement_date' => $request->movement_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('stock-capsules.index')->with('success', 'Stock réapprovisionné avec succès.');
    }

    /**
     * Record capsule usage
     */
    public function usage(Request $request, string $id)
    {
        $capsule = Capsule::with('cartonType')->findOrFail($id);
        
        // LOG: Check initial state
        \Log::info('Usage START - Capsule ID: ' . $id . ', nombre_capsules: ' . $capsule->nombre_capsules . ', carton_type_id: ' . $capsule->carton_type_id);
        
        $request->validate([
            'quantity' => 'required|numeric|min:0.001',
            'herb_id' => 'required|exists:herbs,id',
            'herb_quantity' => 'required|numeric|min:0.01',
            'movement_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // quantity is now in RANGES (1 range = 420 capsules)
        $rangeCount = $request->quantity;
        $capsulesUsed = $rangeCount * 420;
        
        // LOG: Check calculation
        \Log::info('Usage CALC - rangeCount: ' . $rangeCount . ', capsulesUsed: ' . $capsulesUsed);

        // Check if there's enough capsule stock
        if ($capsule->nombre_capsules < $capsulesUsed) {
            return back()->withErrors(['quantity' => 'Quantité insuffisante en stock. Capsules disponibles: ' . $capsule->nombre_capsules . ' (' . floor($capsule->nombre_capsules / 420) . ' rangées)'])->withInput();
        }

        // Check if there's enough herb stock
        $herb = Herb::findOrFail($request->herb_id);
        $herbGlobalQuantity = $herb->global_quantity;
        if ($request->herb_quantity > $herbGlobalQuantity) {
            return back()->withErrors(['herb_quantity' => 'Quantité d\'herbe insuffisante en stock. Stock disponible: ' . $herbGlobalQuantity])->withInput();
        }

        // Decrease nombre_capsules based on used ranges
        $capsule->nombre_capsules -= $capsulesUsed;
        
        // LOG: After subtraction
        \Log::info('Usage AFTER SUBTRACTION - nombre_capsules: ' . $capsule->nombre_capsules);
        
        // Recalculate remaining cartons based on carton type capacity
        $capsulesPerCarton = $capsule->getCapsulesPerCarton();
        $capsule->quantity = intval(floor($capsule->nombre_capsules / $capsulesPerCarton));
        
        // LOG: Before save
        \Log::info('Usage BEFORE SAVE - nombre_capsules: ' . $capsule->nombre_capsules . ', quantity: ' . $capsule->quantity . ', capacity: ' . $capsulesPerCarton);
        
        $capsule->save();
        
        // LOG: After save - reload to verify
        $capsule = Capsule::with('cartonType')->find($id);
        \Log::info('Usage AFTER SAVE - nombre_capsules: ' . $capsule->nombre_capsules . ', quantity: ' . $capsule->quantity);

        // Create capsule stock movement
        $capsuleMovement = CapsuleStockMovement::create([
            'capsule_id' => $capsule->id,
            'herb_id' => $request->herb_id,
            'herb_quantity' => $request->herb_quantity,
            'type' => 'usage',
            'quantity' => $rangeCount, // Store as ranges
            'movement_date' => $request->movement_date,
            'notes' => $request->notes,
        ]);

        // Automatically create herb stock movement to deduct from herb stock
        HerbStockMovement::create([
            'herb_id' => $request->herb_id,
            'type' => 'usage',
            'quantity' => $request->herb_quantity,
            'movement_date' => $request->movement_date,
            'notes' => 'Utilisation via capsules: ' . $capsule->carton . ' (' . $rangeCount . ' rangées = ' . $capsulesUsed . ' capsules)',
        ]);

        // Check if a filled capsule record already exists for this capsule and herb
        $filledCapsule = FilledCapsule::where('capsule_id', $capsule->id)
            ->where('herb_id', $request->herb_id)
            ->first();

        if ($filledCapsule) {
            // Update existing filled capsule record
            $filledCapsule->update([
                'quantity' => $filledCapsule->quantity + $rangeCount, // Increment ranges
                'herb_quantity' => $filledCapsule->herb_quantity + $request->herb_quantity, // Increment herb quantity
                'filled_date' => $request->movement_date, // Update to latest date
                'capsule_movement_id' => $capsuleMovement->id, // Update to latest movement
                'notes' => $request->notes,
            ]);
        } else {
            // Create new filled capsule record
            FilledCapsule::create([
                'capsule_id' => $capsule->id,
                'herb_id' => $request->herb_id,
                'quantity' => $rangeCount, // Store as ranges
                'herb_quantity' => $request->herb_quantity,
                'filled_date' => $request->movement_date,
                'capsule_movement_id' => $capsuleMovement->id,
                'notes' => $request->notes,
            ]);
        }

        // Record expenses for herb usage (no commande yet, just tracking cost)
        Expense::recordExpense(
            'herbs',
            $request->herb_quantity,
            $herb->purchase_price ?? 0,
            null,
            $herb,
            null,
            null,
            'Herb usage from capsules: ' . $capsule->carton
        );

        // Record expenses for capsule usage (calculated per range)
        $costPerRange = ($capsule->carton_price ?? 0) / $capsule->getCapsulesPerCarton() * 420;
        Expense::recordExpense(
            'capsules',
            $rangeCount,
            $costPerRange,
            null,
            null,
            null,
            $capsule,
            'Capsule usage: ' . $rangeCount . ' ranges (' . $capsulesUsed . ' capsules)'
        );

        return redirect()->route('stock-capsules.index')->with('success', 'Utilisation enregistrée avec succès. Stock d\'herbe déduit automatiquement. Capsules remplies ajoutées au stock rempli.');
    }
}
