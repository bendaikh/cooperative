<?php

namespace App\Http\Controllers;

use App\Models\FilledCapsule;
use Illuminate\Http\Request;

class StockCapsuleRemplieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all filled capsules grouped by capsule_id and herb_id to avoid duplicates
        $filledCapsules = FilledCapsule::with(['capsule', 'herb'])
            ->orderBy('filled_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique(function ($item) {
                // Group by capsule_id and herb_id combination
                return $item->capsule_id . '_' . $item->herb_id;
            })
            ->values(); // Re-index array
        
        return view('stock-capsules-remplie.index', compact('filledCapsules'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $filledCapsule = FilledCapsule::with(['capsule', 'herb', 'capsuleMovement'])->findOrFail($id);
        return view('stock-capsules-remplie.show', compact('filledCapsule'));
    }
}
