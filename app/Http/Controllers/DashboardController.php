<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Revenue;
use App\Models\Expense;
use App\Models\ProductStock;
use App\Models\HerbStockMovement;
use App\Models\CapsuleStockMovement;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get KPI Statistics
        $stats = [
            'totalStock' => $this->getTotalStockUnits(),
            'activeClients' => Client::count(),
            'totalRevenue' => $this->getTotalRevenue(),
            'totalExpenses' => $this->getTotalExpenses(),
            'stockChange' => $this->getStockChange(),
            'clientChange' => $this->getClientChange(),
            'revenueChange' => $this->getRevenueChange(),
            'expenseChange' => $this->getExpenseChange(),
        ];

        // Get chart data
        $chartData = [
            'financialData' => $this->getFinancialChartData(),
            'stockMovements' => $this->getStockMovementChartData(),
            'topProducts' => $this->getTopProductsChartData(),
            'categoryDistribution' => $this->getCategoryDistributionChartData(),
            'monthlyOrders' => $this->getMonthlyOrdersChartData(),
            'stockLevels' => $this->getStockLevelsByProduct(),
        ];

        // Recent activities
        $activities = $this->getRecentActivities();

        return view('dashboard', [
            'stats' => $stats,
            'chartData' => $chartData,
            'activities' => $activities,
        ]);
    }

    private function getTotalStockUnits()
    {
        return ProductStock::sum('quantity') ?? 0;
    }

    private function getActiveClients()
    {
        return Client::count();
    }

    private function getTotalRevenue()
    {
        // Total revenue from confirmed revenues (selling prices from commandes)
        return Revenue::where('status', 'confirmed')->sum('selling_price') ?? 0;
    }

    private function getTotalExpenses()
    {
        // Total expenses from the expenses table
        return Expense::sum('total_cost') ?? 0;
    }

    private function getStockChange()
    {
        $thisMonth = ProductStock::whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->sum('quantity') ?? 0;
        
        $lastMonth = ProductStock::whereMonth('updated_at', now()->subMonth()->month)
            ->whereYear('updated_at', now()->subMonth()->year)
            ->sum('quantity') ?? 0;

        return $lastMonth > 0 ? (($thisMonth - $lastMonth) / $lastMonth) * 100 : 0;
    }

    private function getClientChange()
    {
        $thisMonth = Client::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        $lastMonth = Client::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        return $lastMonth > 0 ? (($thisMonth - $lastMonth) / $lastMonth) * 100 : 0;
    }

    private function getRevenueChange()
    {
        $thisMonth = Commande::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count() * 1000; // Placeholder calculation
        
        $lastMonth = Commande::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count() * 1000; // Placeholder calculation

        return $lastMonth > 0 ? (($thisMonth - $lastMonth) / $lastMonth) * 100 : 0;
    }

    private function getExpenseChange()
    {
        $now = now();
        
        // Get expenses this month from the expenses table
        $thisMonth = Expense::whereMonth('expense_date', $now->month)
            ->whereYear('expense_date', $now->year)
            ->sum('total_cost') ?? 0;
        
        // Get expenses from last month
        $lastMonth = Expense::whereMonth('expense_date', $now->subMonth()->month)
            ->whereYear('expense_date', $now->subMonth()->year)
            ->sum('total_cost') ?? 0;

        return $lastMonth > 0 ? (($thisMonth - $lastMonth) / $lastMonth) * 100 : 0;
    }

    private function getFinancialChartData()
    {
        $months = [];
        $revenue = [];
        $expenses = [];
        $profit = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');

            // Get actual revenue data from confirmed revenues
            $monthRevenue = Revenue::where('status', 'confirmed')
                ->whereMonth('revenue_date', $date->month)
                ->whereYear('revenue_date', $date->year)
                ->sum('selling_price') ?? 0;
            
            // Get actual expenses from the expenses table
            $monthExpense = Expense::whereMonth('expense_date', $date->month)
                ->whereYear('expense_date', $date->year)
                ->sum('total_cost') ?? 0;
            
            $monthProfit = $monthRevenue - $monthExpense;

            $revenue[] = round($monthRevenue, 2);
            $expenses[] = round($monthExpense, 2);
            $profit[] = round($monthProfit, 2);
        }

        return [
            'labels' => $months,
            'revenue' => $revenue,
            'expenses' => $expenses,
            'profit' => $profit,
        ];
    }

    private function getStockMovementChartData()
    {
        $movements = [
            'inbound' => CapsuleStockMovement::where('type', 'inbound')->sum('quantity') ?? 0,
            'outbound' => CapsuleStockMovement::where('type', 'outbound')->sum('quantity') ?? 0,
            'adjusted' => CapsuleStockMovement::where('type', 'adjustment')->sum('quantity') ?? 0,
        ];

        return [
            'labels' => ['Inbound', 'Outbound', 'Adjustments'],
            'data' => [
                $movements['inbound'],
                $movements['outbound'],
                $movements['adjusted'],
            ],
            'total' => array_sum($movements),
        ];
    }

    private function getTopProductsChartData()
    {
        $topProducts = Product::with(['stock'])
            ->select('products.id', 'products.name')
            ->join('product_stock', 'products.id', '=', 'product_stock.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByRaw('SUM(product_stock.quantity) DESC')
            ->limit(5)
            ->get();

        $labels = [];
        $data = [];

        foreach ($topProducts as $product) {
            $labels[] = $product->name;
            $totalStock = $product->stock->sum('quantity');
            $data[] = $totalStock;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    private function getCategoryDistributionChartData()
    {
        // Get distribution by category if available
        $categories = DB::table('product_stock')
            ->join('products', 'product_stock.product_id', '=', 'products.id')
            ->select('products.name as category', DB::raw('SUM(product_stock.quantity) as total'))
            ->groupBy('products.id', 'products.name')
            ->orderBy('total', 'DESC')
            ->limit(6)
            ->get();

        $labels = [];
        $data = [];

        foreach ($categories as $cat) {
            $labels[] = $cat->category;
            $data[] = $cat->total;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    private function getMonthlyOrdersChartData()
    {
        $months = [];
        $orders = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');
            $count = Commande::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $orders[] = $count;
        }

        return [
            'labels' => $months,
            'data' => $orders,
        ];
    }

    private function getStockLevelsByProduct()
    {
        $products = Product::with('stock')
            ->has('stock')
            ->limit(8)
            ->get();

        $labels = [];
        $data = [];

        foreach ($products as $product) {
            $labels[] = substr($product->name, 0, 15);
            $data[] = $product->stock->sum('quantity') ?? 0;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    private function getRecentActivities()
    {
        $activities = [];

        // Recent stock movements
        $stockMovements = HerbStockMovement::latest()
            ->take(3)
            ->get();

        foreach ($stockMovements as $movement) {
            $activities[] = [
                'type' => 'stock',
                'type_fr' => 'Stock',
                'description' => 'Mouvement de stock enregistré',
                'detail' => 'Quantité: ' . $movement->quantity,
                'time' => $movement->created_at->diffForHumans(),
                'icon' => '📦',
            ];
        }

        // Recent orders
        $orders = Commande::latest()
            ->take(3)
            ->get();

        foreach ($orders as $order) {
            $activities[] = [
                'type' => 'order',
                'type_fr' => 'Commande',
                'description' => 'Nouvelle commande créée',
                'detail' => 'Commande #' . $order->id,
                'time' => $order->created_at->diffForHumans(),
                'icon' => '🛒',
            ];
        }

        // Recent client additions
        $clients = Client::latest()
            ->take(2)
            ->get();

        foreach ($clients as $client) {
            $activities[] = [
                'type' => 'client',
                'type_fr' => 'Client',
                'description' => 'Nouveau client ajouté',
                'detail' => $client->nom ?? 'Nouveau Membre',
                'time' => $client->created_at->diffForHumans(),
                'icon' => '👤',
            ];
        }

        // Sort by most recent
        usort($activities, function ($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 6);
    }
}
