@extends('layouts.app')

@section('title', 'Tableau de Bord - Co-op ERP')
@section('page-title', 'Aperçu du Tableau de Bord')

@section('content')
<style>
    /* Dashboard Container */
    .dashboard-container {
        padding: 2rem 0;
    }

    /* KPI Grid */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .kpi-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 1rem;
        padding: 1.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: -30px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.12);
    }

    .kpi-card.blue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .kpi-card.green {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .kpi-card.purple {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .kpi-card.orange {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .kpi-icon {
        width: 56px;
        height: 56px;
        border-radius: 0.875rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
    }

    .kpi-card.blue .kpi-icon,
    .kpi-card.green .kpi-icon,
    .kpi-card.purple .kpi-icon,
    .kpi-card.orange .kpi-icon {
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .kpi-icon svg {
        width: 28px;
        height: 28px;
    }

    .kpi-content {
        flex: 1;
        color: white;
        position: relative;
        z-index: 1;
    }

    .kpi-label {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .kpi-value {
        font-size: 2.25rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.75rem;
        line-height: 1;
    }

    .kpi-change {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.2);
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        width: fit-content;
    }

    .kpi-change.positive {
        color: #10b981;
        background: rgba(16, 185, 129, 0.2);
    }

    .kpi-change.negative {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.2);
    }

    /* Charts Grid */
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .charts-grid-full {
        grid-template-columns: 1fr;
    }

    .chart-card {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .chart-card:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.12);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .chart-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
    }

    .chart-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }

    .chart-meta {
        text-align: right;
    }

    .chart-value {
        font-size: 1.875rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 1rem;
    }

    .chart-legend {
        display: flex;
        gap: 2rem;
        margin-top: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
        font-size: 0.875rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    /* Activity Section */
    .activity-card {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .activity-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
    }

    .view-all-link {
        color: #667eea;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .view-all-link:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        transition: all 0.3s ease;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background: #f9fafb;
        border-radius: 0.5rem;
    }

    .activity-icon {
        font-size: 1.75rem;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        border-radius: 0.75rem;
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-description {
        font-size: 0.95rem;
        color: #1f2937;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    .activity-detail {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .activity-time {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 0.25rem;
    }

    .activity-badge {
        padding: 0.4rem 0.875rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .badge-stock {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-order {
        background: #fecaca;
        color: #991b1b;
    }

    .badge-client {
        background: #d1fae5;
        color: #065f46;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }

        .kpi-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }

    @media (max-width: 640px) {
        .kpi-grid {
            grid-template-columns: 1fr;
        }

        .kpi-value {
            font-size: 1.75rem;
        }

        .chart-container {
            height: 250px;
        }

        .activity-item {
            flex-wrap: wrap;
        }
    }
</style>

<div class="dashboard-container">
    <!-- KPI Cards -->
    <div class="kpi-grid">
        <!-- Total Stock Card -->
        <div class="kpi-card blue">
            <div class="kpi-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">📦 Stock Total</div>
                <div class="kpi-value">{{ number_format($stats['totalStock']) }}</div>
                <div class="kpi-change {{ $stats['stockChange'] >= 0 ? 'positive' : 'negative' }}">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 5a1 1 0 01.707.293l2.828 2.829a1 1 0 11-1.414 1.414L13 7.414V13a1 1 0 11-2 0V7.414l-1.121 1.121a1 1 0 01-1.414-1.414l2.828-2.829A1 1 0 0112 5z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ abs($stats['stockChange']) > 0 ? number_format(abs($stats['stockChange']), 1) . '%' : 'Stable' }}</span>
                </div>
            </div>
        </div>

        <!-- Active Clients Card -->
        <div class="kpi-card green">
            <div class="kpi-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m4 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">👥 Clients Actifs</div>
                <div class="kpi-value">{{ $stats['activeClients'] }}</div>
                <div class="kpi-change {{ $stats['clientChange'] >= 0 ? 'positive' : 'negative' }}">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 5a1 1 0 01.707.293l2.828 2.829a1 1 0 11-1.414 1.414L13 7.414V13a1 1 0 11-2 0V7.414l-1.121 1.121a1 1 0 01-1.414-1.414l2.828-2.829A1 1 0 0112 5z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ abs($stats['clientChange']) > 0 ? number_format(abs($stats['clientChange']), 1) . '%' : 'Nouveau' }}</span>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="kpi-card purple">
            <div class="kpi-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">💰 Revenu Total</div>
                <div class="kpi-value">${{ number_format($stats['totalRevenue'], 0) }}</div>
                <div class="kpi-change {{ $stats['revenueChange'] >= 0 ? 'positive' : 'negative' }}">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 5a1 1 0 01.707.293l2.828 2.829a1 1 0 11-1.414 1.414L13 7.414V13a1 1 0 11-2 0V7.414l-1.121 1.121a1 1 0 01-1.414-1.414l2.828-2.829A1 1 0 0112 5z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ abs($stats['revenueChange']) > 0 ? number_format(abs($stats['revenueChange']), 1) . '%' : 'Stable' }}</span>
                </div>
            </div>
        </div>

        <!-- Total Expenses Card -->
        <div class="kpi-card orange">
            <div class="kpi-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">💳 Dépenses Totales</div>
                <div class="kpi-value">${{ number_format($stats['totalExpenses'], 0) }}</div>
                <div class="kpi-change {{ $stats['expenseChange'] >= 0 ? 'negative' : 'positive' }}">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 5a1 1 0 01.707.293l2.828 2.829a1 1 0 11-1.414 1.414L13 7.414V13a1 1 0 11-2 0V7.414l-1.121 1.121a1 1 0 01-1.414-1.414l2.828-2.829A1 1 0 0112 5z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ abs($stats['expenseChange']) > 0 ? number_format(abs($stats['expenseChange']), 1) . '%' : 'Stable' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-grid">
        <!-- Financial Overview Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">📈 Aperçu Financier</div>
                    <div class="chart-subtitle">Tendance des Revenus et Dépenses sur 12 mois</div>
                </div>
                <div class="chart-meta">
                    <div class="chart-value">${{ number_format($stats['totalRevenue'], 0) }}</div>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="financialChart"></canvas>
            </div>
            <div class="chart-legend">
                <div class="legend-item">
                    <div class="legend-dot" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                    <span>Revenu</span>
                </div>
                <div class="legend-item">
                    <div class="legend-dot" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);"></div>
                    <span>Dépenses</span>
                </div>
            </div>
        </div>

        <!-- Monthly Orders Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">🛒 Commandes Mensuelles</div>
                    <div class="chart-subtitle">Tendance du Nombre de Commandes</div>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Second Row Charts -->
    <div class="charts-grid">
        <!-- Top Products Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">⭐ Meilleurs Produits</div>
                    <div class="chart-subtitle">Par Quantité de Stock</div>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>

        <!-- Category Distribution Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">📊 Distribution des Catégories</div>
                    <div class="chart-subtitle">Stock par Catégorie de Produit</div>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Stock Levels Chart (Full Width) -->
    <div class="chart-card">
        <div class="chart-header">
            <div>
                <div class="chart-title">📦 Niveaux de Stock par Produit</div>
                <div class="chart-subtitle">Aperçu de l'inventaire actuel</div>
            </div>
        </div>
        <div class="chart-container" style="height: 350px;">
            <canvas id="stockLevelsChart"></canvas>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="activity-card" style="margin-top: 2rem;">
        <div class="activity-header">
            <h2 class="activity-title">🕐 Activité Récente</h2>
            <a href="#" class="view-all-link">Voir Toute l'Historique</a>
        </div>

        <div class="activity-list">
            @forelse($activities as $activity)
                <div class="activity-item">
                    <div class="activity-icon">{{ $activity['icon'] }}</div>
                    <div class="activity-content">
                        <div class="activity-description">{{ $activity['description'] }}</div>
                        <div class="activity-detail">{{ $activity['detail'] }}</div>
                        <div class="activity-time">{{ $activity['time'] }}</div>
                    </div>
                    <span class="activity-badge badge-{{ $activity['type'] }}">{{ ucfirst($activity['type_fr']) }}</span>
                </div>
            @empty
                <div style="padding: 2rem; text-align: center; color: #9ca3af;">
                    Aucune activité récente pour le moment
                </div>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
    // Chart colors
    const colors = {
        primary: '#667eea',
        secondary: '#764ba2',
        success: '#10b981',
        danger: '#ef4444',
        warning: '#f59e0b',
        info: '#3b82f6',
    };

    // Financial Overview Chart
    @if($chartData['financialData'])
    const financialCtx = document.getElementById('financialChart').getContext('2d');
    new Chart(financialCtx, {
        type: 'line',
        data: {
            labels: @json($chartData['financialData']['labels']),
            datasets: [
                {
                    label: 'Revenue',
                    data: @json($chartData['financialData']['revenue']),
                    borderColor: colors.primary,
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: colors.primary,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                },
                {
                    label: 'Expenses',
                    data: @json($chartData['financialData']['expenses']),
                    borderColor: colors.danger,
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: colors.danger,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6',
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false,
                    }
                }
            }
        }
    });
    @endif

    // Monthly Orders Chart
    @if($chartData['monthlyOrders'])
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ordersCtx, {
        type: 'bar',
        data: {
            labels: @json($chartData['monthlyOrders']['labels']),
            datasets: [{
                label: 'Orders',
                data: @json($chartData['monthlyOrders']['data']),
                backgroundColor: [
                    '#667eea', '#764ba2', '#6366f1', '#667eea',
                    '#764ba2', '#6366f1', '#667eea', '#764ba2',
                    '#6366f1', '#667eea', '#764ba2', '#6366f1'
                ],
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6',
                    }
                },
                x: {
                    grid: {
                        display: false,
                    }
                }
            }
        }
    });
    @endif

    // Top Products Chart
    @if($chartData['topProducts'])
    const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
    new Chart(topProductsCtx, {
        type: 'doughnut',
        data: {
            labels: @json($chartData['topProducts']['labels']),
            datasets: [{
                data: @json($chartData['topProducts']['data']),
                backgroundColor: [
                    '#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe'
                ],
                borderColor: '#fff',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12,
                        }
                    }
                },
            }
        }
    });
    @endif

    // Category Distribution Chart
    @if($chartData['categoryDistribution'])
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'polarArea',
        data: {
            labels: @json($chartData['categoryDistribution']['labels']),
            datasets: [{
                data: @json($chartData['categoryDistribution']['data']),
                backgroundColor: [
                    'rgba(102, 126, 234, 0.6)',
                    'rgba(118, 75, 162, 0.6)',
                    'rgba(240, 147, 251, 0.6)',
                    'rgba(245, 87, 108, 0.6)',
                    'rgba(79, 172, 254, 0.6)',
                    'rgba(250, 112, 154, 0.6)',
                ],
                borderColor: [
                    '#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe', '#fa709a'
                ],
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12,
                        }
                    }
                },
            }
        }
    });
    @endif

    // Stock Levels Chart
    @if($chartData['stockLevels'])
    const stockLevelsCtx = document.getElementById('stockLevelsChart').getContext('2d');
    new Chart(stockLevelsCtx, {
        type: 'bar',
        data: {
            labels: @json($chartData['stockLevels']['labels']),
            datasets: [{
                label: 'Stock Quantity',
                data: @json($chartData['stockLevels']['data']),
                backgroundColor: [
                    '#667eea', '#764ba2', '#f093fb', '#f5576c',
                    '#4facfe', '#00f2fe', '#fa709a', '#fee140'
                ],
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6',
                    }
                },
                y: {
                    grid: {
                        display: false,
                    }
                }
            }
        }
    });
    @endif
</script>
@endsection
