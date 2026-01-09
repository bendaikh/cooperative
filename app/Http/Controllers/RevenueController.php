<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        // Get all revenues with their commandes
        $revenues = Revenue::with('commande.client')
            ->orderBy('revenue_date', 'desc')
            ->paginate(15);
        
        // Calculate statistics
        $totalRevenue = Revenue::sum('selling_price') ?? 0;
        $totalCost = Revenue::sum('cost') ?? 0;
        $totalProfit = $totalRevenue - $totalCost;
        $totalOrders = Revenue::count();
        
        // This month statistics
        $thisMonthRevenue = Revenue::whereMonth('revenue_date', now()->month)
            ->whereYear('revenue_date', now()->year)
            ->sum('selling_price') ?? 0;
        
        $thisMonthProfit = Revenue::whereMonth('revenue_date', now()->month)
            ->whereYear('revenue_date', now()->year)
            ->selectRaw('SUM(selling_price - cost) as profit')
            ->first()
            ->profit ?? 0;
        
        $thisMonthOrders = Revenue::whereMonth('revenue_date', now()->month)
            ->whereYear('revenue_date', now()->year)
            ->count();
        
        // Previous month for comparison
        $previousMonthRevenue = Revenue::whereMonth('revenue_date', now()->subMonth()->month)
            ->whereYear('revenue_date', now()->subMonth()->year)
            ->sum('selling_price') ?? 0;
        
        $revenueGrowth = $previousMonthRevenue > 0 
            ? (($thisMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue * 100) 
            : 0;
        
        // Average margin
        $averageMargin = Revenue::where('margin_percentage', '>', 0)
            ->avg('margin_percentage') ?? 0;
        
        // Best and worst selling commandes
        $bestSelling = Revenue::orderBy('selling_price', 'desc')
            ->with('commande.client')
            ->first();
        
        $bestProfit = Revenue::orderBy('margin', 'desc')
            ->with('commande.client')
            ->first();
        
        $worstMargin = Revenue::orderBy('margin_percentage', 'asc')
            ->with('commande.client')
            ->first();
        
        // Top clients by revenue
        $topClients = Revenue::with('commande.client')
            ->selectRaw('commande_id, COUNT(*) as order_count, SUM(selling_price) as total_revenue, SUM(selling_price - cost) as total_profit')
            ->groupBy('commande_id')
            ->orderBy('total_revenue', 'desc')
            ->limit(5)
            ->get();
        
        // Revenue trend (last 7 days)
        $weekTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayRevenue = Revenue::whereDate('revenue_date', $date->toDateString())
                ->sum('selling_price') ?? 0;
            $weekTrend[($i)] = [
                'date' => $date->format('d/m'),
                'revenue' => $dayRevenue
            ];
        }
        
        return view('revenue.index', compact(
            'revenues',
            'totalRevenue',
            'totalCost',
            'totalProfit',
            'totalOrders',
            'thisMonthRevenue',
            'thisMonthProfit',
            'thisMonthOrders',
            'revenueGrowth',
            'averageMargin',
            'bestSelling',
            'bestProfit',
            'worstMargin',
            'weekTrend'
        ));
    }
}

