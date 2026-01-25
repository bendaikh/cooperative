@extends('layouts.app')

@section('title', 'Liste des Dépenses - Co-op ERP')
@section('page-title', 'Liste des Dépenses')

@section('content')
<div style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: -2rem -2rem 2rem; border-radius: 8px; color: white; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin: 0; font-weight: bold;">📋 Liste des Dépenses</h1>
        <p style="margin-top: 0.5rem; opacity: 0.9;">Consulter et filtrer toutes les dépenses</p>
    </div>
    <a href="{{ route('expenses.create') }}" style="background: rgba(255,255,255,0.25); color: white; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600; border: 1px solid rgba(255,255,255,0.4); white-space: nowrap;">
        ➕ Créer une dépense
    </a>
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

<!-- FILTERS -->
<div style="background: #f9fafb; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #e5e7eb;">
    <form method="GET" action="{{ route('expenses.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Date de début</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;">
        </div>
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Date de fin</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;">
        </div>
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Catégorie</label>
            <select name="category_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;">
                <option value="">— Toutes —</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <button type="submit" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">🔍 Filtrer</button>
            <a href="{{ route('expenses.index') }}" style="background: #6b7280; color: white; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">🔄 Réinitialiser</a>
        </div>
    </form>
</div>

<!-- EXPENSES TABLE -->
<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: bold; color: #111827;">📋 Dépenses</h2>
    
    @if ($expenses->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f3f4f6; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Catégorie</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Employé</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Montant</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Date</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Notes</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151; border: 1px solid #e5e7eb;">Actions</th>
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
                        <td style="padding: 1rem; border: 1px solid #e5e7eb; color: #6b7280;">{{ $expense->employe ? $expense->employe->prenom . ' ' . $expense->employe->nom : '—' }}</td>
                        <td style="padding: 1rem; text-align: right; border: 1px solid #e5e7eb; font-weight: 600; color: #ef4444;">{{ number_format($expense->total_cost, 2) }} DH</td>
                        <td style="padding: 1rem; text-align: center; border: 1px solid #e5e7eb; color: #6b7280;">{{ $expense->expense_date->format('d/m/Y') }}</td>
                        <td style="padding: 1rem; border: 1px solid #e5e7eb; color: #6b7280; font-size: 0.875rem;">{{ $expense->notes ?? '—' }}</td>
                        <td style="padding: 1rem; text-align: center; border: 1px solid #e5e7eb;">
                            <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                <a 
                                    href="{{ route('expenses.edit', $expense->id) }}"
                                    style="background: #3b82f6; color: white; padding: 0.5rem 0.75rem; border-radius: 6px; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: background 0.2s; display: inline-flex; align-items: center; gap: 0.25rem;"
                                    onmouseover="this.style.background='#2563eb';"
                                    onmouseout="this.style.background='#3b82f6';"
                                    title="Modifier"
                                >
                                    ✏️ Modifier
                                </a>
                                <form 
                                    action="{{ route('expenses.destroy', $expense->id) }}" 
                                    method="POST" 
                                    style="display: inline;"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit"
                                        style="background: #ef4444; color: white; padding: 0.5rem 0.75rem; border: none; border-radius: 6px; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: background 0.2s; display: inline-flex; align-items: center; gap: 0.25rem;"
                                        onmouseover="this.style.background='#dc2626';"
                                        onmouseout="this.style.background='#ef4444';"
                                        title="Supprimer"
                                    >
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
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
            <a href="{{ route('expenses.create') }}" style="display: inline-block; margin-top: 1rem; background: #667eea; color: white; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600;">➕ Créer une dépense</a>
        </div>
    @endif
</div>
@endsection

