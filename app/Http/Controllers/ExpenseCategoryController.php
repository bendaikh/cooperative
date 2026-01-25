<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $categories = ExpenseCategory::withCount('expenses')
            ->withSum('expenses', 'total_cost')
            ->orderBy('expenses_sum_total_cost', 'desc')
            ->get();
        
        return view('expense-categories.index', compact('categories'));
    }
    
    public function create()
    {
        $categories = ExpenseCategory::withCount('expenses')
            ->withSum('expenses', 'total_cost')
            ->orderBy('expenses_sum_total_cost', 'desc')
            ->get();
        
        return view('expense-categories.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:expense_categories',
            'description' => 'nullable|string',
            'color' => 'nullable|string|size:7',
            'is_salaire' => 'nullable|boolean',
        ]);
        $validated['is_salaire'] = $request->boolean('is_salaire');
        
        ExpenseCategory::create($validated);
        
        return redirect()->route('expense-categories.create')->with('success', 'Catégorie créée avec succès.');
    }
}
