<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExpenseCreateController extends Controller
{
    public function create(Request $request)
    {
        $categories = ExpenseCategory::all();
        
        // Get current month and year
        $now = Carbon::now();
        $currentMonth = $now->month;
        $currentYear = $now->year;
        $lastMonth = $now->subMonth();
        $lastMonthDate = $lastMonth->month;
        $lastMonthYear = $lastMonth->year;
        
        // Calculate total expenses (all time)
        $totalExpenses = Expense::sum('total_cost') ?? 0;
        
        // Calculate this month's expenses
        $thisMonthExpenses = Expense::whereMonth('expense_date', $currentMonth)
            ->whereYear('expense_date', $currentYear)
            ->sum('total_cost') ?? 0;
        
        // Calculate last month's expenses
        $lastMonthExpenses = Expense::whereMonth('expense_date', $lastMonthDate)
            ->whereYear('expense_date', $lastMonthYear)
            ->sum('total_cost') ?? 0;
        
        // Calculate growth percentage (handling division by zero)
        $expenseGrowth = 0;
        if ($lastMonthExpenses > 0) {
            $expenseGrowth = (($thisMonthExpenses - $lastMonthExpenses) / $lastMonthExpenses) * 100;
        } elseif ($thisMonthExpenses > 0) {
            // If last month was 0 but this month has expenses, show 100% growth
            $expenseGrowth = 100;
        }
        
        // Get top expense category for this month
        $topExpenses = Expense::with('category')
            ->whereMonth('expense_date', $currentMonth)
            ->whereYear('expense_date', $currentYear)
            ->whereNotNull('category_id')
            ->selectRaw('category_id, SUM(total_cost) as total')
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->limit(1)
            ->get()
            ->map(function ($expense) {
                $expense->total = (float) $expense->total;
                return $expense;
            });
        
        // Get recent expenses with pagination (latest first)
        $expensesQuery = Expense::with('category')
            ->whereNotNull('category_id');
        
        // Apply date filter if provided
        if ($request->has('date_from') && $request->date_from) {
            $expensesQuery->whereDate('expense_date', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $expensesQuery->whereDate('expense_date', '<=', $request->date_to);
        }
        
        // Apply category filter if provided
        if ($request->has('category_id') && $request->category_id) {
            $expensesQuery->where('category_id', $request->category_id);
        }
        
        $expenses = $expensesQuery->orderByDesc('expense_date')
            ->paginate(10)
            ->withQueryString(); // Preserve query parameters in pagination links
        
        return view('expenses.create', compact(
            'categories',
            'totalExpenses',
            'thisMonthExpenses',
            'expenseGrowth',
            'topExpenses',
            'expenses'
        ));
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
            'unit_price' => $validated['amount'], // Same as total cost when quantity is 1
            'expense_date' => $validated['expense_date'],
            'notes' => $validated['notes'] ?? null,
            'type' => 'manual', // Type of expense entry
            'quantity' => 1, // Default quantity
        ]);
        
        return redirect()->route('expenses.create')->with('success', 'Dépense enregistrée avec succès.');
    }
}
