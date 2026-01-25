<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with(['category', 'employe', 'herb', 'productStock', 'capsule', 'commande'])
            ->whereNotNull('category_id')
            ->orderBy('created_at', 'desc');

        if ($request->filled('date_from')) {
            $query->whereDate('expense_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('expense_date', '<=', $request->date_to);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $expenses = $query->paginate(15)->withQueryString();

        $categories = ExpenseCategory::orderBy('name')->get();

        return view('expenses.index', compact('expenses', 'categories'));
    }
    
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:expense_categories',
            'description' => 'nullable|string',
            'color' => 'nullable|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
        ]);
        
        ExpenseCategory::create($validated);
        
        return back()->with('success', 'Catégorie créée avec succès.');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
        
        Expense::create([
            'category_id' => $validated['category_id'],
            'total_cost' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'notes' => $validated['notes'] ?? null,
            'quantity' => 1, // Default quantity
        ]);
        
        return back()->with('success', 'Dépense enregistrée avec succès.');
    }
    
    public function edit($id)
    {
        $expense = Expense::with('category', 'employe')->findOrFail($id);
        $categories = ExpenseCategory::all();
        $employes = Employe::where('statut', 'actif')->orderBy('nom')->orderBy('prenom')->get();

        return view('expenses.edit', compact('expense', 'categories', 'employes'));
    }
    
    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);
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

        $expense->update([
            'category_id' => $validated['category_id'],
            'employee_id' => $validated['employee_id'] ?? null,
            'total_cost' => $validated['amount'],
            'unit_price' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Dépense mise à jour avec succès.');
    }
    
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        
        return back()->with('success', 'Dépense supprimée avec succès.');
    }
}

