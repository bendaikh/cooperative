@extends('layouts.app')

@section('title', 'Modifier Dépense - Co-op ERP')
@section('page-title', 'Modifier Dépense')

@section('content')
<div style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: -2rem -2rem 2rem; border-radius: 8px; color: white;">
    <h1 style="font-size: 1.75rem; margin: 0; font-weight: bold;">✏️ Modifier la Dépense</h1>
    <p style="margin-top: 0.5rem; opacity: 0.9;">Modifiez les informations de la dépense</p>
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

<!-- EDIT EXPENSE FORM -->
<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: bold; color: #111827;">✏️ Modifier la Dépense</h2>
    
    <form action="{{ route('expenses.update', $expense->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
        @csrf
        @method('PUT')
        
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
                <option value="{{ $category->id }}" {{ old('category_id', $expense->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                value="{{ old('amount', $expense->total_cost) }}"
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
                value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}"
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
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box; font-family: inherit; resize: vertical; transition: border-color 0.2s;">{{ old('notes', $expense->notes) }}</textarea>
            @error('notes')
                <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <button 
                type="submit"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; transition: transform 0.2s, box-shadow 0.2s; flex: 1;"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
            >
                💾 Enregistrer les modifications
            </button>
            <a 
                href="{{ route('expenses.index') }}"
                style="background: #6b7280; color: white; padding: 1rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; text-decoration: none; display: inline-block; transition: transform 0.2s; text-align: center;"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.background='#4b5563';"
                onmouseout="this.style.transform='translateY(0)'; this.style.background='#6b7280';"
            >
                ↩️ Annuler
            </a>
        </div>
    </form>
</div>
@endsection
