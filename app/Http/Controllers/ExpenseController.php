<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        // Get all expenses with relationships
        $expenses = Expense::with(['category', 'herb', 'productStock', 'capsule', 'commande'])
            ->orderBy('expense_date', 'desc')
            ->paginate(15);
        
        // Get all categories
        $categories = ExpenseCategory::withCount('expenses')
            ->withSum('expenses', 'total_cost')
            ->orderBy('expenses_sum_total_cost', 'desc')
            ->get();
        
        // Calculate statistics
        $totalExpenses = Expense::sum('total_cost') ?? 0;
        $thisMonthExpenses = Expense::whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('total_cost') ?? 0;
        
        // Previous month for comparison
        $previousMonthExpenses = Expense::whereMonth('expense_date', now()->subMonth()->month)
            ->whereYear('expense_date', now()->subMonth()->year)
            ->sum('total_cost') ?? 0;
        
        $expenseGrowth = $previousMonthExpenses > 0 
            ? (($thisMonthExpenses - $previousMonthExpenses) / $previousMonthExpenses * 100) 
            : 0;
        
        // Top expense categories this month
        $topExpenses = Expense::whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->with('category')
            ->selectRaw('category_id, SUM(total_cost) as total')
            ->groupBy('category_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
        
        return view('expenses.index', compact(
            'expenses',
            'categories',
            'totalExpenses',
            'thisMonthExpenses',
            'expenseGrowth',
            'topExpenses'
        ));
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
}

