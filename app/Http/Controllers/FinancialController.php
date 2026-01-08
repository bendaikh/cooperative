<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Revenue;
use App\Models\Expense;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    /**
     * Show financial overview
     */
    public function index()
    {
        $totalExpenses = Expense::sum('total_cost');
        $totalRevenues = Revenue::where('status', '!=', 'draft')->sum('selling_price');
        $totalMargin = Revenue::where('status', '!=', 'draft')->sum('margin');

        $expenses = Expense::with(['herb', 'productStock', 'capsule', 'commande'])
            ->orderBy('expense_date', 'desc')
            ->paginate(20);

        $revenues = Revenue::with('commande')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('financial.index', compact('totalExpenses', 'totalRevenues', 'totalMargin', 'expenses', 'revenues'));
    }

    /**
     * Show commande revenue form
     */
    public function showCommandeRevenue($commandeId)
    {
        $commande = Commande::with('expenses', 'revenue')->findOrFail($commandeId);
        $revenue = $commande->revenue ?? new Revenue(['commande_id' => $commandeId]);

        // Calculate total expenses for this commande
        $totalCost = Expense::where('commande_id', $commandeId)->sum('total_cost');

        return view('financial.commande-revenue', compact('commande', 'revenue', 'totalCost'));
    }

    /**
     * Store/update revenue for a commande
     */
    public function storeCommandeRevenue(Request $request, $commandeId)
    {
        $commande = Commande::findOrFail($commandeId);
        $revenue = $commande->revenue ?? new Revenue(['commande_id' => $commandeId]);

        $request->validate([
            'selling_price' => 'required|numeric|min:0',
            'revenue_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $revenue->fill([
            'selling_price' => $request->selling_price,
            'revenue_date' => $request->revenue_date,
            'notes' => $request->notes,
        ]);

        $revenue->calculateMargin();
        $revenue->save();

        return redirect()->back()->with('success', 'Revenu mis à jour avec succès.');
    }

    /**
     * Lock revenue when commande reaches production status
     */
    public function confirmRevenue($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);
        
        if (!$commande->isInProductionStatus()) {
            return redirect()->back()->with('error', 'La commande doit être en cours d\'emballage.');
        }

        $revenue = Revenue::where('commande_id', $commandeId)->firstOrFail();
        $revenue->status = 'confirmed';
        $revenue->save();

        return redirect()->back()->with('success', 'Revenu confirmé.');
    }
}
