@extends('layouts.app')

@section('title', 'Revenus - Co-op ERP')
@section('page-title', 'Revenus')

@section('content')
<style>
    .metric-card {
        border-radius: 0.75rem;
        padding: 0.75rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .metric-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .metric-card:hover {
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    
    .metric-card:hover:before {
        left: 100%;
    }

    .metric-icon {
        font-size: 1.25rem;
        margin-bottom: 0.3rem;
        display: inline-block;
    }

    .metric-label {
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.85;
        margin-bottom: 0.3rem;
    }

    .metric-value {
        font-size: 1.5rem;
        font-weight: 900;
        margin: 0;
        letter-spacing: -1px;
    }

    .metric-sublabel {
        font-size: 0.6rem;
        margin-top: 0.2rem;
        opacity: 0.8;
    }

    .monthly-card {
        background: white;
        border-radius: 0.65rem;
        padding: 0.65rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .monthly-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        border-color: currentColor;
    }

    .performer-card {
        border-radius: 1rem;
        padding: 1rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .performer-card:hover {
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 12px 36px rgba(0,0,0,0.15);
    }

    .performer-icon {
        position: absolute;
        top: -20px;
        right: -20px;
        font-size: 80px;
        opacity: 0.1;
        z-index: 1;
    }

    .table-container {
        background: white;
        border-radius: 1.5rem;
        padding: 3rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .table-header {
        background: linear-gradient(135deg, #f8f9ff 0%, #f3f4ff 100%);
        border-bottom: 3px solid #e5e7eb;
    }

    .table-row:hover {
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.03), transparent);
    }

    .btn-see {
        background: linear-gradient(135deg, #667eea 0%, #5568d3 100%);
        color: white;
        padding: 0.65rem 1.25rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        display: inline-block;
        border: none;
        cursor: pointer;
    }

    .btn-see:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
    }

    .hero-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 0.3rem 0.65rem;
        border-radius: 2rem;
        font-size: 0.6rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        backdrop-filter: blur(10px);
    }
</style>

<!-- Primary Metrics Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 0.65rem; margin-bottom: 1rem;">
    <!-- Total Revenue Card -->
    <div class="metric-card" style="background: linear-gradient(135deg, #667eea 0%, #5568d3 100%); color: white; padding: 0.75rem;">
        <div class="metric-icon" style="font-size: 1.25rem; margin-bottom: 0.3rem;">💵</div>
        <p class="metric-label" style="color: rgba(255,255,255,0.85); font-size: 0.5rem; margin-bottom: 0.2rem;">Revenu Total</p>
        <p class="metric-value" style="font-size: 1.5rem;">{{ number_format($totalRevenue, 0) }}</p>
        <p class="metric-sublabel" style="color: rgba(255,255,255,0.75); font-size: 0.6rem;">DH</p>
    </div>

    <!-- Total Cost Card -->
    <div class="metric-card" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: white; padding: 0.75rem;">
        <div class="metric-icon" style="font-size: 1.25rem; margin-bottom: 0.3rem;">📊</div>
        <p class="metric-label" style="color: rgba(255,255,255,0.85); font-size: 0.5rem; margin-bottom: 0.2rem;">Coût Total</p>
        <p class="metric-value" style="font-size: 1.5rem;">{{ number_format($totalCost, 0) }}</p>
        <p class="metric-sublabel" style="color: rgba(255,255,255,0.75); font-size: 0.6rem;">DH</p>
    </div>

    <!-- Total Profit Card -->
    <div class="metric-card" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); color: white; padding: 0.75rem;">
        <div class="metric-icon" style="font-size: 1.25rem; margin-bottom: 0.3rem;">🎯</div>
        <p class="metric-label" style="color: rgba(255,255,255,0.85); font-size: 0.5rem; margin-bottom: 0.2rem;">Profit Total</p>
        <p class="metric-value" style="font-size: 1.5rem;">{{ number_format($totalProfit, 0) }}</p>
        <p class="metric-sublabel" style="color: rgba(255,255,255,0.75); font-size: 0.6rem;">DH</p>
    </div>

    <!-- Average Margin Card -->
    <div class="metric-card" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: white; padding: 0.75rem;">
        <div class="metric-icon" style="font-size: 1.25rem; margin-bottom: 0.3rem;">📈</div>
        <p class="metric-label" style="color: rgba(255,255,255,0.85); font-size: 0.5rem; margin-bottom: 0.2rem;">Marge Moy.</p>
        <p class="metric-value" style="font-size: 1.5rem;">{{ number_format($averageMargin, 1) }}%</p>
        <p class="metric-sublabel" style="color: rgba(255,255,255,0.75); font-size: 0.6rem;">Rentabilité</p>
    </div>
</div>

<!-- Monthly Performance Row -->
<div style="margin-bottom: 1rem;">
    <h2 style="font-size: 0.8rem; font-weight: 800; margin: 0 0 0.65rem 0; color: #111827;">📅 Ce Mois</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 0.65rem;">
        <!-- This Month Revenue -->
        <div class="monthly-card" style="border-top: 2px solid #667eea; padding: 0.65rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                <p style="font-size: 0.5rem; color: #667eea; font-weight: 800; text-transform: uppercase; margin: 0;">Revenus</p>
                <span style="font-size: 0.9rem;">📅</span>
            </div>
            <p style="font-size: 1.1rem; font-weight: 900; color: #111827; margin: 0;">{{ number_format($thisMonthRevenue, 0) }}</p>
            <p style="font-size: 0.55rem; color: #6b7280; margin: 0.2rem 0 0 0;">DH</p>
        </div>

        <!-- This Month Profit -->
        <div class="monthly-card" style="border-top: 2px solid #059669; padding: 0.65rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                <p style="font-size: 0.5rem; color: #059669; font-weight: 800; text-transform: uppercase; margin: 0;">Profit</p>
                <span style="font-size: 0.9rem;">💚</span>
            </div>
            <p style="font-size: 1.1rem; font-weight: 900; color: #111827; margin: 0;">{{ number_format($thisMonthProfit, 0) }}</p>
            <p style="font-size: 0.55rem; color: #6b7280; margin: 0.2rem 0 0 0;">DH</p>
        </div>

        <!-- Growth Rate -->
        <div class="monthly-card" style="border-top: 2px solid #f97316; padding: 0.65rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                <p style="font-size: 0.5rem; color: #f97316; font-weight: 800; text-transform: uppercase; margin: 0;">Croissance</p>
                <span style="font-size: 0.9rem;">{{ $revenueGrowth >= 0 ? '📈' : '📉' }}</span>
            </div>
            <p style="font-size: 1.1rem; font-weight: 900; color: #111827; margin: 0;">{{ number_format(abs($revenueGrowth), 1) }}%</p>
            <p style="font-size: 0.55rem; color: #6b7280; margin: 0.2rem 0 0 0;">vs mois</p>
        </div>
    </div>
</div>

<!-- Best Performers Section -->
@if($bestSelling || $bestProfit)
<div style="margin-bottom: 1rem;">
    <h2 style="font-size: 0.8rem; font-weight: 800; margin: 0 0 0.65rem 0; color: #111827;">🏆 Top Performers</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 0.85rem;">
        @if($bestSelling)
        <div class="performer-card" style="background: linear-gradient(135deg, #667eea 0%, #5568d3 50%, #764ba2 100%); padding: 1rem;">
            <div class="performer-icon" style="font-size: 60px;">🏆</div>
            <div style="position: relative; z-index: 2;">
                <h3 style="font-size: 0.75rem; font-weight: 900; margin: 0 0 0.4rem 0;">🏆 Meilleure Vente</h3>
                <div style="background: rgba(255,255,255,0.12); border-radius: 0.5rem; padding: 0.5rem; margin-bottom: 0.6rem; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                    <p style="font-size: 0.5rem; color: rgba(255,255,255,0.85); font-weight: 700; text-transform: uppercase; margin: 0;">Client</p>
                    <p style="font-size: 0.85rem; font-weight: 900; color: white; margin: 0.2rem 0 0 0;">{{ $bestSelling->commande->client->name }}</p>
                </div>
                <div style="display: flex; align-items: baseline; gap: 0.2rem;">
                    <p style="font-size: 1.1rem; font-weight: 900; color: white; margin: 0;">{{ number_format($bestSelling->selling_price, 0) }}</p>
                    <p style="font-size: 0.6rem; color: rgba(255,255,255,0.85); margin: 0;">DH</p>
                </div>
            </div>
        </div>
        @endif

        @if($bestProfit)
        <div class="performer-card" style="background: linear-gradient(135deg, #059669 0%, #047857 50%, #065f46 100%); padding: 1rem;">
            <div class="performer-icon" style="font-size: 60px;">💎</div>
            <div style="position: relative; z-index: 2;">
                <h3 style="font-size: 0.75rem; font-weight: 900; margin: 0 0 0.4rem 0;">💎 Profit Max</h3>
                <div style="background: rgba(255,255,255,0.12); border-radius: 0.5rem; padding: 0.5rem; margin-bottom: 0.6rem; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                    <p style="font-size: 0.5rem; color: rgba(255,255,255,0.85); font-weight: 700; text-transform: uppercase; margin: 0;">Commande</p>
                    <p style="font-size: 0.85rem; font-weight: 900; color: white; margin: 0.2rem 0 0 0;">#{{ $bestProfit->commande_id }}</p>
                </div>
                <div style="display: flex; align-items: baseline; gap: 0.2rem;">
                    <p style="font-size: 1.1rem; font-weight: 900; color: white; margin: 0;">{{ number_format($bestProfit->selling_price - $bestProfit->cost, 0) }}</p>
                    <p style="font-size: 0.6rem; color: rgba(255,255,255,0.85); margin: 0;">DH</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endif

<!-- Revenues Table Section -->
<div class="table-container" style="padding: 3rem;">
    <h2 style="font-size: 1rem; font-weight: 800; margin: 0 0 1.25rem 0; color: #111827;">📋 Détail des Revenus</h2>
    
    @if($revenues->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 1rem;">
                <thead class="table-header">
                    <tr>
                        <th style="padding: 1rem; text-align: left; font-weight: 700; color: #667eea; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px;">Cmd</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 700; color: #667eea; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px;">Client</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 700; color: #667eea; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px;">Revenu</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 700; color: #667eea; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px;">Coût</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 700; color: #667eea; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px;">Profit</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 700; color: #667eea; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px;">Marge</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 700; color: #667eea; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px;">Date</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 700; color: #667eea; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.3px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($revenues as $revenue)
                    <tr class="table-row" style="border-bottom: 2px solid #f0f0f0; transition: all 0.2s;">
                        <td style="padding: 1rem; color: #111827; font-weight: 600; font-size: 0.95rem;">
                            <span style="display: inline-block; background: linear-gradient(135deg, #f0f4ff 0%, #e8edff 100%); color: #667eea; padding: 0.4rem 0.75rem; border-radius: 0.4rem; font-size: 0.85rem; font-weight: 700;">#{{ $revenue->commande_id }}</span>
                        </td>
                        <td style="padding: 1rem; color: #6b7280; font-size: 0.95rem; font-weight: 500;">{{ Str::limit($revenue->commande->client->name ?? 'N/A', 25) }}</td>
                        <td style="padding: 1rem; text-align: right; color: #059669; font-weight: 600; font-size: 0.95rem;">{{ number_format($revenue->selling_price, 0) }}</td>
                        <td style="padding: 1rem; text-align: right; color: #dc2626; font-weight: 600; font-size: 0.95rem;">{{ number_format($revenue->cost, 0) }}</td>
                        <td style="padding: 1rem; text-align: right; color: #111827; font-weight: 600; font-size: 0.95rem;">{{ number_format($revenue->selling_price - $revenue->cost, 0) }}</td>
                        <td style="padding: 1rem; text-align: center; font-size: 0.95rem;">
                            <span style="display: inline-block; background: {{ $revenue->margin_percentage >= 40 ? 'linear-gradient(135deg, #dcfce7 0%, #d1fae5 100%)' : ($revenue->margin_percentage >= 20 ? 'linear-gradient(135deg, #fef3c7 0%, #fde68a 100%)' : 'linear-gradient(135deg, #fee2e2 0%, #fecaca 100%)') }}; color: {{ $revenue->margin_percentage >= 40 ? '#166534' : ($revenue->margin_percentage >= 20 ? '#92400e' : '#991b1b') }}; padding: 0.4rem 0.75rem; border-radius: 0.4rem; font-weight: 700; font-size: 0.85rem;">{{ number_format($revenue->margin_percentage, 1) }}%</span>
                        </td>
                        <td style="padding: 1rem; text-align: center; color: #6b7280; font-size: 0.95rem;">{{ $revenue->revenue_date ? $revenue->revenue_date->format('d/m/Y') : 'N/A' }}</td>
                        <td style="padding: 1rem; text-align: center;">
                            <a href="{{ route('commandes.show', $revenue->commande_id) }}" class="btn-see">Voir</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($revenues->hasPages())
        <div style="display: flex; justify-content: center; padding-top: 1rem; border-top: 2px solid #f0f0f0;">
            {{ $revenues->links() }}
        </div>
        @endif
    @else
        <div style="text-align: center; padding: 2rem; background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%); border-radius: 1rem; border: 2px dashed #e5e7eb;">
            <p style="font-size: 1.5rem; margin: 0; opacity: 0.5;">📭</p>
            <p style="font-size: 0.9rem; font-weight: 700; margin: 0.5rem 0 0.25rem 0; color: #111827;">Aucune commande</p>
            <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">Les revenus apparaîtront ici.</p>
        </div>
    @endif
</div>

<style>
    .pagination {
        display: flex;
        gap: 0.3rem;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .pagination a, .pagination span {
        padding: 0.75rem 1.15rem;
        border-radius: 0.5rem;
        border: 2px solid #e5e7eb;
        color: #667eea;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .pagination a:hover {
        background: linear-gradient(135deg, #667eea 0%, #5568d3 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
    }
    
    .pagination .active span {
        background: linear-gradient(135deg, #667eea 0%, #5568d3 100%);
        color: white;
        border-color: transparent;
    }
    
    .pagination .disabled span {
        opacity: 0.4;
        cursor: not-allowed;
    }
</style>

@endsection
