<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCreateController extends Controller
{
    public function create()
    {
        $categories = ExpenseCategory::all();
        $employes = Employe::where('statut', 'actif')->orderBy('nom')->orderBy('prenom')->get();

        return view('expenses.create', compact('categories', 'employes'));
    }
    
    public function store(Request $request)
    {
        $category = ExpenseCategory::find($request->category_id);
        $rules = [
            'category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string',
            'employee_id' => 'nullable|exists:employes,id',
        ];
        if ($category && $category->is_salaire) {
            $rules['employee_id'] = 'required|exists:employes,id';
        }
        $validated = $request->validate($rules);

        Expense::create([
            'category_id' => $validated['category_id'],
            'employee_id' => $validated['employee_id'] ?? null,
            'total_cost' => $validated['amount'],
            'unit_price' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'notes' => $validated['notes'] ?? null,
            'type' => 'manual',
            'quantity' => 1,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Dépense enregistrée avec succès.');
    }
}
