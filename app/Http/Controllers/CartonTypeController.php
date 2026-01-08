<?php

namespace App\Http\Controllers;

use App\Models\CartonType;
use Illuminate\Http\Request;

class CartonTypeController extends Controller
{
    /**
     * Display a listing of carton types
     */
    public function index()
    {
        $cartonTypes = CartonType::paginate(15);
        return view('carton-types.index', compact('cartonTypes'));
    }

    /**
     * Show the form for creating a new carton type
     */
    public function create()
    {
        return view('carton-types.create');
    }

    /**
     * Store a newly created carton type
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:carton_types,name',
            'capacity' => 'required|integer|min:1000|max:1000000',
            'description' => 'nullable|string|max:500',
            'purchase_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        CartonType::create($validated);

        return redirect()->route('carton-types.index')
            ->with('success', "Type de carton '{$validated['name']}' créé avec succès!");
    }

    /**
     * Show the form for editing a carton type
     */
    public function edit(CartonType $cartonType)
    {
        return view('carton-types.edit', compact('cartonType'));
    }

    /**
     * Update the carton type
     */
    public function update(Request $request, CartonType $cartonType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:carton_types,name,' . $cartonType->id,
            'capacity' => 'required|integer|min:1000|max:1000000',
            'description' => 'nullable|string|max:500',
            'purchase_price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $cartonType->update($validated);

        return redirect()->route('carton-types.index')
            ->with('success', "Type de carton mise à jour avec succès!");
    }

    /**
     * Delete (soft-delete via is_active flag) a carton type
     */
    public function destroy(CartonType $cartonType)
    {
        // Check if any capsules are using this type
        if ($cartonType->capsules()->count() > 0) {
            return redirect()->route('carton-types.index')
                ->with('error', "Impossible de supprimer ce type de carton. Il est utilisé par " . $cartonType->capsules()->count() . " carton(s).");
        }

        $cartonType->delete();

        return redirect()->route('carton-types.index')
            ->with('success', "Type de carton supprimé avec succès!");
    }

    /**
     * Toggle activation status of a carton type
     */
    public function toggleActive(CartonType $cartonType)
    {
        $cartonType->update(['is_active' => !$cartonType->is_active]);

        $status = $cartonType->is_active ? 'activé' : 'désactivé';
        return redirect()->route('carton-types.index')
            ->with('success', "Type de carton {$status} avec succès!");
    }
}
