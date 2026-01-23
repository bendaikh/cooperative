@extends('layouts.app')

@section('title', 'Créer Dépense - Co-op ERP')
@section('page-title', 'Créer Dépense')

@section('content')
<div style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: -2rem -2rem 2rem; border-radius: 8px; color: white;">
    <h1 style="font-size: 1.75rem; margin: 0; font-weight: bold;">📊 Gestion des Dépenses</h1>
    <p style="margin-top: 0.5rem; opacity: 0.9;">Suivi complet de toutes les dépenses d'exploitation</p>
</div>

<!-- Flash Messages -->
@if ($message = Session::get('success'))
    <div style="background: #10b981; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
        <span style="font-size: 1.25rem;">✅</span>
        {{ $message }}
    </div>
@endif
@if ($errors->any())
    <div style="background: #ef4444; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
        <span style="font-size: 1.25rem;">⚠️</span>
        <div>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    </div>
@endif

<!-- Key Metrics -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Total Expenses -->
    <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-left: 4px solid #f59e0b;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="margin: 0; color: #6b7280; font-size: 0.875rem; font-weight: 500;">Dépenses Totales</p>
                <p style="margin: 0.5rem 0 0; font-size: 1.875rem; font-weight: bold; color: #111827;">{{ number_format($totalExpenses ?? 0, 2) }} DH</p>
            </div>
            <span style="font-size: 2rem;">💰</span>
        </div>
    </div>

    <!-- This Month -->
    <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-left: 4px solid #06b6d4;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="margin: 0; color: #6b7280; font-size: 0.875rem; font-weight: 500;">Dépenses ce mois</p>
                <p style="margin: 0.5rem 0 0; font-size: 1.875rem; font-weight: bold; color: #111827;">{{ number_format($thisMonthExpenses ?? 0, 2) }} DH</p>
            </div>
            <span style="font-size: 2rem;">📅</span>
        </div>
    </div>

    <!-- Growth -->
    <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-left: 4px solid {{ ($expenseGrowth ?? 0) > 0 ? '#ef4444' : '#10b981' }};">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="margin: 0; color: #6b7280; font-size: 0.875rem; font-weight: 500;">Croissance vs mois dernier</p>
                <p style="margin: 0.5rem 0 0; font-size: 1.875rem; font-weight: bold; color: {{ ($expenseGrowth ?? 0) > 0 ? '#ef4444' : '#10b981' }};">{{ number_format($expenseGrowth ?? 0, 1) }}%</p>
            </div>
            <span style="font-size: 2rem;">{{ ($expenseGrowth ?? 0) > 0 ? '📈' : '📉' }}</span>
        </div>
    </div>

    <!-- Top Category -->
    @if (isset($topExpenses) && $topExpenses->count() > 0)
    <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-left: 4px solid #8b5cf6;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <p style="margin: 0; color: #6b7280; font-size: 0.875rem; font-weight: 500;">Catégorie top (ce mois)</p>
                <p style="margin: 0.5rem 0 0; font-size: 1.125rem; font-weight: bold; color: #111827;">{{ $topExpenses[0]->category->name ?? 'N/A' }}</p>
                <p style="margin: 0.5rem 0 0; font-size: 0.875rem; color: #6b7280;">{{ number_format($topExpenses[0]->total ?? 0, 2) }} DH</p>
            </div>
            <span style="font-size: 2rem;">🏆</span>
        </div>
    </div>
    @endif
</div>

<!-- CREATE EXPENSE FORM -->
<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: bold; color: #111827;">➕ Créer une Dépense</h2>
    
    <form action="{{ route('expenses.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
        @csrf
        
        <!-- Category Selection -->
        <div>
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Catégorie <span style="color: #ef4444;">*</span></label>
            <select 
                name="category_id"
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box; transition: border-color 0.2s;"
                required
            >
                <option value="">-- Sélectionnez une catégorie --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Amount -->
        <div>
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Montant (DH) <span style="color: #ef4444;">*</span></label>
            <input 
                type="number" 
                name="amount" 
                step="0.01"
                placeholder="0.00"
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box; transition: border-color 0.2s;"
                value="{{ old('amount') }}"
                required
            >
            @error('amount')
                <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Date -->
        <div>
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Date de dépense <span style="color: #ef4444;">*</span></label>
            <input 
                type="date" 
                name="expense_date"
                value="{{ old('expense_date', date('Y-m-d')) }}"
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box; transition: border-color 0.2s;"
                required
            >
            @error('expense_date')
                <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Notes -->
        <div>
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Notes (optionnel)</label>
            <textarea 
                name="notes"
                rows="4"
                placeholder="Détails supplémentaires..."
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box; font-family: inherit; resize: vertical; transition: border-color 0.2s;">{{ old('notes') }}</textarea>
            @error('notes')
                <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; transition: transform 0.2s, box-shadow 0.2s; margin-top: 1rem;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
        >
            💾 Enregistrer la dépense
        </button>
    </form>
</div>

<!-- SECTION: RECENT EXPENSES TABLE -->
<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-top: 2rem;">
    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: bold; color: #111827;">📋 Dépenses Récentes</h2>
    
    <!-- FILTER SECTION -->
    <div style="background: #f9fafb; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #e5e7eb;">
        <form method="GET" action="{{ route('expenses.create') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
            <!-- Date From Filter -->
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Date de début</label>
                <input 
                    type="date" 
                    name="date_from"
                    value="{{ request('date_from') }}"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;"
                >
            </div>
            
            <!-- Date To Filter -->
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Date de fin</label>
                <input 
                    type="date" 
                    name="date_to"
                    value="{{ request('date_to') }}"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;"
                >
            </div>
            
            <!-- Category Filter -->
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Catégorie</label>
                <select 
                    name="category_id"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;"
                >
                    <option value="">-- Toutes les catégories --</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Filter Buttons -->
            <div style="display: flex; gap: 0.5rem;">
                <button 
                    type="submit"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.875rem; transition: transform 0.2s; flex: 1;"
                    onmouseover="this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.transform='translateY(0)';"
                >
                    🔍 Filtrer
                </button>
                <a 
                    href="{{ route('expenses.create') }}"
                    style="background: #6b7280; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.875rem; text-decoration: none; display: inline-block; transition: transform 0.2s;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.background='#4b5563';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.background='#6b7280';"
                >
                    🔄 Réinitialiser
                </a>
            </div>
        </form>
    </div>
    
    @if ($expenses->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f3f4f6; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Catégorie</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Montant</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Date</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                    <tr style="border-bottom: 1px solid #e5e7eb; transition: background 0.2s;"
                        onmouseover="this.style.background='#f9fafb';"
                        onmouseout="this.style.background='white';">
                        <td style="padding: 1rem; border: 1px solid #e5e7eb;">
                            <span style="display: inline-block; background: {{ $expense->category->color ?? '#667eea' }}15; padding: 0.5rem 0.875rem; border-radius: 6px; font-weight: 600; color: {{ $expense->category->color ?? '#667eea' }};">{{ $expense->category->name ?? 'N/A' }}</span>
                        </td>
                        <td style="padding: 1rem; text-align: right; border: 1px solid #e5e7eb; font-weight: 600; color: #ef4444;">{{ number_format($expense->total_cost, 2) }} DH</td>
                        <td style="padding: 1rem; text-align: center; border: 1px solid #e5e7eb; color: #6b7280;">{{ $expense->expense_date->format('d/m/Y') }}</td>
                        <td style="padding: 1rem; border: 1px solid #e5e7eb; color: #6b7280; font-size: 0.875rem;">{{ $expense->notes ?? '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="margin-top: 1.5rem;">
            {{ $expenses->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem; color: #9ca3af;">
            <p style="font-size: 3rem; margin: 0;">📭</p>
            <p style="margin-top: 0.5rem;">Aucune dépense enregistrée pour le moment</p>
        </div>
    @endif
</div>
@endsection
