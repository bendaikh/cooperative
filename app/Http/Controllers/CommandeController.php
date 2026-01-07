<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeEmballage;
use App\Models\CommandeFilledCapsule;
use App\Models\CommandeTicket;
use App\Models\Client;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\FilledCapsule;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::with([
                'client',
                'emballages.productStock.product',
                'filledCapsules.filledCapsule'
            ])
            ->latest()
            ->get();
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        
        // Get EMBALLAGE products (unified - no pilulier/bouchon separation)
        $emballages = Product::whereNotNull('type_emballage')
            ->where('type_emballage', '!=', '')
            ->with('stock.movements')
            ->get();
        
        // Get Joint de sécurité stock with movements
        $jointSecurite = Product::where('name', 'Joint de sécurité')
            ->with('stock.movements')
            ->first();
        
        // Get Ticket products with their stock and movements
        $tickets = Product::where('name', 'Ticket')
            ->with('stock.movements')
            ->get();
        
        // Get filled capsules for selection
        $filledCapsules = FilledCapsule::with(['herb', 'capsule'])->get();
        
        // Capsules per unit options
        $capsulesPerUnitOptions = [30, 60, 90, 120];
        
        return view('commandes.create', compact(
            'clients',
            'emballages',
            'jointSecurite',
            'tickets',
            'filledCapsules',
            'capsulesPerUnitOptions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * UNIFIED EMBALLAGE - No pilulier/bouchon separation
     */
    public function store(Request $request)
    {
        \Log::info('COMMANDE STORE: Request received', $request->all());
        
        // Validation - Single emballage field
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quantity' => 'required|numeric|min:0.001',
            'capsules_per_unit' => 'required|integer|in:30,60,90,120',
            'emballage_product_stock_id' => 'required|exists:product_stock,id',
            'filled_capsule_id' => 'required|exists:filled_capsules,id',
            'avec_joint_securite' => 'nullable|boolean',
            'avec_ticket' => 'nullable|boolean',
            'ticket_quantity' => 'nullable|numeric|min:0.001',
            'nom_marque' => 'nullable|string|max:255',
            'numero_autorisation' => 'nullable|string|max:255',
            'ticket_product_stock_id' => 'nullable|exists:product_stock,id',
            'notes' => 'nullable|string',
        ]);
        
        \Log::info('COMMANDE STORE: Validation passed', $validated);

        try {
            DB::beginTransaction();
            \Log::info('COMMANDE STORE: Transaction started');

            $quantity = (float) $request->quantity;
            $capsulesPerUnit = $request->capsules_per_unit;
            $totalCapsulesNeeded = $quantity * $capsulesPerUnit;
            
            \Log::info('COMMANDE STORE: Variables set', [
                'quantity' => $quantity,
                'capsules_per_unit' => $capsulesPerUnit,
                'total_capsules_needed' => $totalCapsulesNeeded
            ]);

            // Get emballage stock
            $emballageStock = ProductStock::findOrFail($request->emballage_product_stock_id);
            $filledCapsule = FilledCapsule::findOrFail($request->filled_capsule_id);
            \Log::info('COMMANDE STORE: Stock records found');

            // Check stock availability
            $validator = Validator::make([], []);
            
            if ($quantity > $emballageStock->quantity) {
                \Log::warning('COMMANDE STORE: Emballage stock insufficient');
                $validator->errors()->add('emballage_product_stock_id', 'Stock emballage insuffisant. Disponible: ' . $emballageStock->quantity);
            }
            
            // Convert filled_capsule quantity (in rangées) to capsules for comparison
            $availableCapsules = $filledCapsule->quantity * 420; // 1 rangée = 420 capsules
            if ($totalCapsulesNeeded > $availableCapsules) {
                \Log::warning('COMMANDE STORE: Capsules insufficient');
                $capsuleAvailable = round($filledCapsule->quantity * 420);
                $validator->errors()->add('filled_capsule_id', 'Quantité de capsules insuffisante. Disponible: ' . $capsuleAvailable . ' capsules');
            }
            
            // Check Joint de sécurité stock if requested
            $jointSecuriteStock = null;
            if ($request->avec_joint_securite) {
                $jointSecuriteProduct = Product::where('name', 'Joint de sécurité')->first();
                if (!$jointSecuriteProduct) {
                    $validator->errors()->add('avec_joint_securite', 'Le produit "Joint de sécurité" n\'existe pas dans la base de données.');
                }
                else {
                    $jointSecuriteStock = $jointSecuriteProduct->stock()->first();
                    if (!$jointSecuriteStock) {
                        $validator->errors()->add('avec_joint_securite', 'Aucun stock trouvé pour "Joint de sécurité".');
                    } elseif ($quantity > $jointSecuriteStock->quantity) {
                        $validator->errors()->add('avec_joint_securite', 'Stock Joint de sécurité insuffisant. Disponible: ' . $jointSecuriteStock->quantity);
                    }
                }
            }
            
            // Check ticket stock if requested
            $ticketStock = null;
            if ($request->avec_ticket) {
                if (!$request->ticket_quantity || $request->ticket_quantity < 1) {
                    $validator->errors()->add('ticket_quantity', 'Veuillez entrer une quantité de tickets valide.');
                }
                if (!$request->ticket_product_stock_id) {
                    $validator->errors()->add('ticket_product_stock_id', 'Veuillez sélectionner un produit ticket.');
                } else {
                    $ticketStock = ProductStock::find($request->ticket_product_stock_id);
                    if (!$ticketStock) {
                        $validator->errors()->add('ticket_product_stock_id', 'Le produit ticket sélectionné n\'existe pas.');
                    } elseif ($request->ticket_quantity > $ticketStock->quantity) {
                        $validator->errors()->add('ticket_product_stock_id', 'Stock ticket insuffisant. Disponible: ' . $ticketStock->quantity . ', Demandé: ' . $request->ticket_quantity);
                    }
                }
                
                // Validate brand name and authorization number are provided if ticket is selected
                if (!$request->nom_marque || trim($request->nom_marque) === '') {
                    $validator->errors()->add('nom_marque', 'Le nom de la marque est requis si vous avez sélectionné avec ticket.');
                }
                if (!$request->numero_autorisation || trim($request->numero_autorisation) === '') {
                    $validator->errors()->add('numero_autorisation', 'Le numéro d\'autorisation est requis si vous avez sélectionné avec ticket.');
                }
            }
            
            // If there are validation errors, throw them
            if ($validator->errors()->any()) {
                throw new ValidationException($validator);
            }
            
            \Log::info('COMMANDE STORE: Stock availability verified');

            // Create commande
            \Log::info('COMMANDE STORE: About to create commande', [
                'client_id' => $request->client_id,
                'product_stock_id' => $request->emballage_product_stock_id,
                'quantity' => $quantity,
                'capsules_per_unit' => $capsulesPerUnit,
                'status' => 'Confirmé',
                'notes' => $request->notes,
            ]);
            
            $commande = Commande::create([
                'client_id' => $request->client_id,
                'product_stock_id' => $request->emballage_product_stock_id,
                'quantity' => $quantity,
                'capsules_per_unit' => $capsulesPerUnit,
                'status' => 'Confirmé',
                'avec_joint_securite' => $request->avec_joint_securite ?? false,
                'avec_ticket' => $request->avec_ticket ?? false,
                'nom_marque' => $request->nom_marque,
                'numero_autorisation' => $request->numero_autorisation,
                'ticket_product_stock_id' => $request->ticket_product_stock_id,
                'ticket_quantity' => $request->ticket_quantity,
                'notes' => $request->notes,
            ]);
            
            \Log::info('COMMANDE STORE: Commande created', ['id' => $commande->id, 'client_id' => $commande->client_id]);

            // Create unified emballage record
            \Log::info('COMMANDE STORE: Creating emballage', [
                'quantity' => $quantity,
            ]);
            
            CommandeEmballage::create([
                'commande_id' => $commande->id,
                'product_stock_id' => $request->emballage_product_stock_id,
                'quantity' => $quantity,
            ]);
            
            \Log::info('COMMANDE STORE: Emballage created');

            // Create filled capsules record
            $filledCapsuleRecord = CommandeFilledCapsule::create([
                'commande_id' => $commande->id,
                'filled_capsule_id' => $request->filled_capsule_id,
                'quantity' => $totalCapsulesNeeded,
            ]);
            
            \Log::info('COMMANDE STORE: Filled capsule record created', ['capsules' => $totalCapsulesNeeded]);

            // Add Joint de sécurité if checked
            if ($request->avec_joint_securite) {
                $jointSecuriteProduct = Product::where('name', 'Joint de sécurité')->first();
                if ($jointSecuriteProduct) {
                    $jointSecuriteStock = $jointSecuriteProduct->stock()->first();
                    if ($jointSecuriteStock) {
                        CommandeEmballage::create([
                            'commande_id' => $commande->id,
                            'product_stock_id' => $jointSecuriteStock->id,
                            'quantity' => $quantity,
                        ]);
                        \Log::info('COMMANDE STORE: Joint de sécurité emballage created');
                    }
                }
            }

            // Add Ticket record if checked
            if ($request->avec_ticket && $request->ticket_product_stock_id && $request->ticket_quantity) {
                CommandeTicket::create([
                    'commande_id' => $commande->id,
                    'product_stock_id' => $request->ticket_product_stock_id,
                    'quantity' => $request->ticket_quantity,
                ]);
                \Log::info('COMMANDE STORE: Ticket record created');
            }

            DB::commit();
            \Log::info('COMMANDE STORE: Transaction committed successfully', ['commande_id' => $commande->id]);

            return redirect()->route('commandes.index')
                ->with('success', 'Commande créée avec succès.');

        } catch (ValidationException $e) {
            DB::rollBack();
            \Log::warning('COMMANDE STORE: Validation exception', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('COMMANDE STORE: Exception', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Erreur lors de la création: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        $commande->load([
            'client',
            'emballages.productStock.product',
            'filledCapsules.filledCapsule.herb',
            'ticketStock.product'
        ]);
        return view('commandes.show', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     * UNIFIED EMBALLAGE - Single emballage field
     */
    public function edit(Commande $commande)
    {
        $commande->load([
            'client',
            'emballages.productStock.product',
            'filledCapsules.filledCapsule'
        ]);
        
        $clients = Client::orderBy('name')->get();
        
        // Get EMBALLAGE products (unified - no pilulier/bouchon separation)
        $emballages = Product::whereNotNull('type_emballage')
            ->where('type_emballage', '!=', '')
            ->with('stock.movements')
            ->get();
        
        // Get Joint de sécurité stock with movements
        $jointSecurite = Product::where('name', 'Joint de sécurité')
            ->with('stock.movements')
            ->first();
        
        // Get Tickets
        $tickets = Product::where('name', 'Ticket')
            ->with('stock')
            ->get();
        
        // Get filled capsules for selection
        $filledCapsules = FilledCapsule::with(['herb', 'capsule'])->get();
        
        // Capsules per unit options
        $capsulesPerUnitOptions = [30, 60, 90, 120];
        
        // Get current emballage (excluding joint de sécurité and tickets)
        $currentEmballage = $commande->emballages()
            ->with('productStock.product')
            ->whereHas('productStock.product', function($query) {
                $query->where('name', '!=', 'Joint de sécurité');
            })
            ->first();
        
        return view('commandes.edit', compact(
            'commande',
            'clients',
            'emballages',
            'jointSecurite',
            'tickets',
            'filledCapsules',
            'capsulesPerUnitOptions',
            'currentEmballage'
        ));
    }

    /**
     * Update the specified resource in storage.
     * UNIFIED EMBALLAGE - Single emballage field
     */
    public function update(Request $request, Commande $commande)
    {
        $rules = [
            'client_id' => 'required|exists:clients,id',
            'quantity' => 'required|numeric|min:0.001',
            'capsules_per_unit' => 'required|integer|in:30,60,90,120',
            'emballage_product_stock_id' => 'required|exists:product_stock,id',
            'filled_capsule_id' => 'required|exists:filled_capsules,id',
            'avec_joint_securite' => 'nullable|boolean',
            'avec_ticket' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ];

        // Add ticket validation if avec_ticket is checked
        if ($request->avec_ticket) {
            $rules['ticket_product_stock_id'] = 'required|exists:product_stock,id';
            $rules['ticket_quantity'] = 'required|numeric|min:0.001';
            $rules['nom_marque'] = 'required|string';
            $rules['numero_autorisation'] = 'required|string';
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            $oldQuantity = $commande->quantity;
            $oldCapsulesPerUnit = $commande->capsules_per_unit;
            $oldTotalCapsules = $oldQuantity * $oldCapsulesPerUnit;

            $newQuantity = $request->quantity;
            $newCapsulesPerUnit = $request->capsules_per_unit;
            $newTotalCapsules = $newQuantity * $newCapsulesPerUnit;

            // Get new stock for validation
            $newEmballageStock = ProductStock::findOrFail($request->emballage_product_stock_id);
            $newFilledCapsule = FilledCapsule::findOrFail($request->filled_capsule_id);

            // Only restore/deduct stock if status is "En cours d'emballage" or "Sortie"
            $hasStockBeenDeducted = in_array($commande->status, ['En cours d\'emballage', 'Sortie']);

            if ($hasStockBeenDeducted) {
                // Get old emballage (main one, not joint or tickets)
                $oldEmballage = $commande->emballages()
                    ->with('productStock')
                    ->whereHas('productStock.product', function($query) {
                        $query->where('name', '!=', 'Joint de sécurité');
                    })
                    ->first();
                $oldEmballageStock = $oldEmballage ? $oldEmballage->productStock : null;

                // Get old filled capsule
                $oldFilledCapsuleRecord = $commande->filledCapsules()->first();
                $oldFilledCapsule = $oldFilledCapsuleRecord ? $oldFilledCapsuleRecord->filledCapsule : null;

                // Restore old emballage stock
                if ($oldEmballageStock) {
                    $oldEmballageStock->increment('quantity', $oldQuantity);
                    StockMovement::create([
                        'product_stock_id' => $oldEmballageStock->id,
                        'type' => 'restock',
                        'quantity' => $oldQuantity,
                        'movement_date' => now(),
                        'notes' => 'Commande #' . $commande->id . ' mise à jour - Emballage',
                    ]);
                }

                if ($oldFilledCapsule) {
                    $oldFilledCapsule->increment('quantity', $oldTotalCapsules / 420); // Convert back to rangées
                }

                // Check new stock availability
                $availableEmballageStock = $newEmballageStock->quantity;
                $availableCapsules = $newFilledCapsule->quantity * 420;

                if ($newQuantity > $availableEmballageStock) {
                    throw new \Exception('Stock emballage insuffisant. Disponible: ' . $availableEmballageStock . ', Demandé: ' . $newQuantity);
                }
                if ($newTotalCapsules > $availableCapsules) {
                    throw new \Exception('Quantité de capsules insuffisante. Disponible: ' . $availableCapsules . ' capsules, Demandé: ' . $newTotalCapsules);
                }

                // Decrement new emballage stock
                $newEmballageStock->decrement('quantity', $newQuantity);
                StockMovement::create([
                    'product_stock_id' => $request->emballage_product_stock_id,
                    'type' => 'usage',
                    'quantity' => $newQuantity,
                    'movement_date' => now(),
                    'notes' => 'Commande #' . $commande->id . ' - Emballage - ' . ($request->notes ?? ''),
                ]);

                $newFilledCapsule->decrement('quantity', $newTotalCapsules / 420); // Convert to rangées
            } else {
                // Status is "Confirmé" - validate stock availability but don't deduct yet
                $availableEmballageStock = $newEmballageStock->quantity;
                $availableCapsules = $newFilledCapsule->quantity * 420;

                if ($newQuantity > $availableEmballageStock) {
                    throw new \Exception('Stock emballage insuffisant. Disponible: ' . $availableEmballageStock . ', Demandé: ' . $newQuantity);
                }
                if ($newTotalCapsules > $availableCapsules) {
                    throw new \Exception('Quantité de capsules insuffisante. Disponible: ' . $availableCapsules . ' capsules, Demandé: ' . $newTotalCapsules);
                }
            }

            // Update commande
            $commande->update([
                'client_id' => $request->client_id,
                'product_stock_id' => $request->emballage_product_stock_id,
                'quantity' => $newQuantity,
                'capsules_per_unit' => $newCapsulesPerUnit,
                'avec_joint_securite' => $request->avec_joint_securite ?? false,
                'notes' => $request->notes,
            ]);

            // Update emballages - DELETE ALL FIRST then recreate
            // This ensures only ONE main emballage + optionally joint
            $commande->emballages()->delete();

            // Create ONLY ONE main emballage
            CommandeEmballage::create([
                'commande_id' => $commande->id,
                'product_stock_id' => $request->emballage_product_stock_id,
                'quantity' => $newQuantity,
            ]);
            
            // Add Joint de sécurité if checked
            if ($request->avec_joint_securite) {
                $jointSecuriteProduct = Product::where('name', 'Joint de sécurité')->first();
                if ($jointSecuriteProduct) {
                    $jointSecuriteStock = $jointSecuriteProduct->stock()->first();
                    if ($jointSecuriteStock) {
                        CommandeEmballage::create([
                            'commande_id' => $commande->id,
                            'product_stock_id' => $jointSecuriteStock->id,
                            'quantity' => $newQuantity,
                        ]);
                    }
                }
            }

            // Update filled capsules
            $commande->filledCapsules()->delete();
            CommandeFilledCapsule::create([
                'commande_id' => $commande->id,
                'filled_capsule_id' => $request->filled_capsule_id,
                'quantity' => $newTotalCapsules,
            ]);

            // Handle tickets if provided
            $commande->tickets()->delete();
            if ($request->avec_ticket && $request->ticket_product_stock_id) {
                CommandeTicket::create([
                    'commande_id' => $commande->id,
                    'product_stock_id' => $request->ticket_product_stock_id,
                    'quantity' => $request->ticket_quantity ?? 0,
                    'nom_marque' => $request->nom_marque,
                    'numero_autorisation' => $request->numero_autorisation,
                ]);
            }

            DB::commit();

            return redirect()->route('commandes.index')
                ->with('success', 'Commande mise à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['quantity' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        try {
            DB::beginTransaction();

            /**
             * DELETION LOGIC WITH STOCK GUARD
             * 
             * The stock_applied flag determines if stock changes should be applied:
             * - If stock_applied = false: Stock was never deducted, don't change anything on delete
             * - If stock_applied = true: Stock was deducted, apply reductions on delete
             * 
             * Status mapping:
             * - "Confirmé": stock_applied is always false → no stock change
             * - "En cours d'emballage": stock_applied is true → apply reductions
             * - "Livrée"/"Sortie": stock_applied is true → apply reductions
             */

            if ($commande->status === 'Confirmé') {
                // Status: CONFIRMÉ
                // stock_applied must be false
                // Action: Do nothing to stock
                // Reason: No stock movements have been applied for this confirmed order
                
                \Log::info('COMMANDE DELETE: Status=Confirmé, no stock changes', [
                    'commande_id' => $commande->id,
                    'status' => $commande->status,
                    'stock_applied' => $commande->stock_applied
                ]);
                
            } elseif (in_array($commande->status, ['En cours d\'emballage', 'Livrée', 'Sortie'])) {
                // Status: EN COURS D'EMBALLAGE, LIVRÉE, or SORTIE
                // Check stock_applied flag before reducing
                
                if ($commande->stock_applied === false) {
                    // Stock was never applied, apply reductions now
                    \Log::info('COMMANDE DELETE: Applying stock reductions (stock_applied=false)', [
                        'commande_id' => $commande->id,
                        'status' => $commande->status,
                        'stock_applied' => false
                    ]);

                    // Reduce emballage stock (PILULIER, BOUCHON, and optionally Joint de sécurité)
                    $emballages = $commande->emballages()->with('productStock.product')->get();
                    
                    foreach ($emballages as $emballage) {
                        // Decrement the stock quantity
                        $emballage->productStock->decrement('quantity', $emballage->quantity);
                        
                        // Record the stock movement as a USAGE (consumption)
                        StockMovement::create([
                            'product_stock_id' => $emballage->product_stock_id,
                            'type' => 'usage',
                            'quantity' => $emballage->quantity,
                            'movement_date' => now(),
                            'notes' => 'Commande #' . $commande->id . ' supprimée - ' . $emballage->productStock->product->name,
                        ]);
                    }

                    // Reduce filled capsules stock
                    $filledCapsuleRecords = $commande->filledCapsules()->with('filledCapsule')->get();
                    foreach ($filledCapsuleRecords as $record) {
                        // Convert capsules to rangées (1 rangée = 420 capsules)
                        $rangeesNeeded = $record->quantity / 420;
                        $record->filledCapsule->decrement('quantity', $rangeesNeeded);
                    }

                    // Reduce ticket stock if with ticket
                    if ($commande->avec_ticket && $commande->ticketStock && $commande->ticket_quantity) {
                        $commande->ticketStock->decrement('quantity', $commande->ticket_quantity);
                        
                        StockMovement::create([
                            'product_stock_id' => $commande->ticket_product_stock_id,
                            'type' => 'usage',
                            'quantity' => $commande->ticket_quantity,
                            'movement_date' => now(),
                            'notes' => 'Ticket Commande #' . $commande->id . ' supprimée - ' . $commande->nom_marque,
                        ]);
                    }

                } else {
                    // stock_applied is true, stock was already deducted
                    // Do nothing - stock reduction already happened when status changed
                    \Log::info('COMMANDE DELETE: Stock already applied, no additional changes', [
                        'commande_id' => $commande->id,
                        'status' => $commande->status,
                        'stock_applied' => true
                    ]);
                }
            }

            $commande->delete();
            
            DB::commit();

            return redirect()->route('commandes.index')
                ->with('success', 'Commande supprimée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('COMMANDE DELETE ERROR', [
                'commande_id' => $commande->id ?? null,
                'status' => $commande->status ?? null,
                'stock_applied' => $commande->stock_applied ?? null,
                'error' => $e->getMessage()
            ]);
            return back()->withErrors(['error' => 'Erreur lors de la suppression: ' . $e->getMessage()]);
        }
    }

    /**
     * Update commande status via AJAX
     * 
     * STOCK GUARD LOGIC:
     * - Uses stock_applied flag to prevent double-decrement
     * - Stock only decremented ONCE when transitioning to "En cours d'emballage"
     * - Flag prevents re-execution on status updates
     */
    public function updateStatus(Request $request, Commande $commande)
    {
        try {
            $validStatuses = ['Confirmé', 'En cours d\'emballage', 'Sortie'];
            $request->validate([
                'status' => ['required', Rule::in($validStatuses)],
            ]);

            $oldStatus = $commande->status;
            $newStatus = $request->status;

            // Cannot go to Sortie backwards (only forward progression allowed to Sortie)
            if ($oldStatus === 'Sortie') {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossible de modifier une commande déjà sortie.'
                ], 400);
            }

            /**
             * GUARD: Only apply stock changes when transitioning to "En cours d'emballage"
             * AND stock_applied flag is still false (prevents double-decrement)
             */
            if ($newStatus === 'En cours d\'emballage' && !$commande->stock_applied) {
                DB::beginTransaction();
                
                try {
                    $commande->load('emballages.productStock', 'filledCapsules.filledCapsule');
                    
                    // Validate we have emballages to process
                    if ($commande->emballages->isEmpty()) {
                        DB::rollBack();
                        return response()->json([
                            'success' => false,
                            'message' => 'Aucun emballage trouvé pour cette commande'
                        ], 400);
                    }
                    
                    // Check stock availability for emballages
                    foreach ($commande->emballages as $emballage) {
                        if ($emballage->quantity > $emballage->productStock->quantity) {
                            DB::rollBack();
                            return response()->json([
                                'success' => false,
                                'message' => 'Stock insuffisant pour ' . $emballage->productStock->product->name
                            ], 400);
                        }
                    }

                    // Check stock availability for filled capsules (convert capsules to rangées for comparison)
                    foreach ($commande->filledCapsules as $record) {
                        $availableCapsules = $record->filledCapsule->quantity * 420; // Convert rangées to capsules
                        if ($record->quantity > $availableCapsules) {
                            DB::rollBack();
                            return response()->json([
                                'success' => false,
                                'message' => 'Stock de capsules remplies insuffisant'
                            ], 400);
                        }
                    }

                    // ✅ DECREMENT STOCK EXACTLY ONCE
                    \Log::info('COMMANDE UPDATE STATUS: Applying stock deductions', [
                        'commande_id' => $commande->id,
                        'stock_applied' => false,
                        'new_status' => $newStatus,
                        'quantity' => $commande->quantity,
                        'emballages_count' => $commande->emballages->count(),
                    ]);

                    // Track decremented products to prevent duplicates
                    $decrementedProducts = [];
                    
                    // Apply stock deductions for emballages (PILULIER, BOUCHON, and optionally Joint de sécurité)
                    foreach ($commande->emballages as $emballage) {
                        // Prevent duplicate decrements for the same product stock
                        if (isset($decrementedProducts[$emballage->product_stock_id])) {
                            \Log::warning('COMMANDE UPDATE STATUS: Skipping duplicate decrement', [
                                'commande_id' => $commande->id,
                                'product_stock_id' => $emballage->product_stock_id,
                                'product_name' => $emballage->productStock->product->name,
                            ]);
                            continue;
                        }
                        
                        \Log::info('COMMANDE UPDATE STATUS: Decrementing emballage', [
                            'commande_id' => $commande->id,
                            'product_name' => $emballage->productStock->product->name,
                            'emballage_quantity' => $emballage->quantity,
                            'product_stock_current_qty' => $emballage->productStock->quantity,
                        ]);
                        
                        $emballage->productStock->decrement('quantity', $emballage->quantity);
                        $decrementedProducts[$emballage->product_stock_id] = true;
                        
                        \Log::info('COMMANDE UPDATE STATUS: Stock movement created', [
                            'product_stock_id' => $emballage->product_stock_id,
                            'type' => 'usage',
                            'quantity' => $emballage->quantity,
                        ]);
                        
                        StockMovement::create([
                            'product_stock_id' => $emballage->product_stock_id,
                            'type' => 'usage',
                            'quantity' => $emballage->quantity,
                            'movement_date' => now(),
                            'notes' => 'Commande #' . $commande->id . ' - ' . $emballage->productStock->product->name,
                        ]);
                    }

                    // Decrement filled capsules stock
                    foreach ($commande->filledCapsules as $record) {
                        // Convert capsules to rangées (1 rangée = 420 capsules)
                        $rangeesNeeded = $record->quantity / 420;
                        $record->filledCapsule->decrement('quantity', $rangeesNeeded);
                    }

                    // Decrement ticket stock if with ticket
                    if ($commande->avec_ticket && $commande->ticketStock && $commande->ticket_quantity) {
                        \Log::info('COMMANDE UPDATE STATUS: Decrementing ticket stock', [
                            'commande_id' => $commande->id,
                            'ticket_quantity' => $commande->ticket_quantity,
                            'product_stock_current_qty' => $commande->ticketStock->quantity,
                        ]);
                        
                        $commande->ticketStock->decrement('quantity', $commande->ticket_quantity);
                        
                        StockMovement::create([
                            'product_stock_id' => $commande->ticket_product_stock_id,
                            'type' => 'usage',
                            'quantity' => $commande->ticket_quantity,
                            'movement_date' => now(),
                            'notes' => 'Ticket Commande #' . $commande->id . ' - ' . $commande->nom_marque,
                        ]);
                    }

                    // ✅ SET GUARD FLAG to prevent re-execution
                    $commande->update([
                        'status' => $newStatus,
                        'stock_applied' => true
                    ]);

                    DB::commit();

                } catch (\Exception $e) {
                    DB::rollBack();
                    \Log::error('COMMANDE UPDATE STATUS ERROR', [
                        'commande_id' => $commande->id,
                        'error' => $e->getMessage()
                    ]);
                    throw $e;
                }
            } else {
                // No stock changes for "Confirmé" or when stock_applied is already true
                if ($newStatus === 'En cours d\'emballage' && $commande->stock_applied) {
                    \Log::info('COMMANDE UPDATE STATUS: Stock already applied, skipping', [
                        'commande_id' => $commande->id,
                        'stock_applied' => true
                    ]);
                }
                $commande->update(['status' => $newStatus]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès.',
                'status' => $newStatus
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }
}

