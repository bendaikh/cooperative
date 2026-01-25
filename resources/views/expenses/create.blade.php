@extends('layouts.app')

@section('title', 'Créer Dépense - Co-op ERP')
@section('page-title', 'Créer Dépense')

@section('content')
<div style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: -2rem -2rem 2rem; border-radius: 8px; color: white; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin: 0; font-weight: bold;">➕ Créer une Dépense</h1>
        <p style="margin-top: 0.5rem; opacity: 0.9;">Enregistrer une nouvelle dépense</p>
    </div>
    <a href="{{ route('expenses.index') }}" style="background: rgba(255,255,255,0.25); color: white; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600; border: 1px solid rgba(255,255,255,0.4); white-space: nowrap;">
        📋 Voir la liste des dépenses
    </a>
</div>

@if ($message = Session::get('success'))
    <div style="background: #10b981; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
        ✅ {{ $message }}
    </div>
@endif
@if ($errors->any())
    <div style="background: #ef4444; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
        @foreach ($errors->all() as $error)
            <div>• {{ $error }}</div>
        @endforeach
    </div>
@endif

<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 600px;">
    <form action="{{ route('expenses.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
        @csrf

        <div>
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Catégorie <span style="color: #ef4444;">*</span></label>
            <select id="expense-category-id" name="category_id" required
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                <option value="">-- Sélectionnez une catégorie --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" data-is-salaire="{{ $category->is_salaire ? '1' : '0' }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}{{ $category->is_salaire ? ' (Salaire)' : '' }}</option>
                @endforeach
            </select>
            @error('category_id')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div id="employee-select-wrapper" style="display: none;">
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Employé <span style="color: #ef4444;">*</span></label>
            <select id="expense-employee-id" name="employee_id"
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                <option value="">-- Sélectionnez un employé --</option>
                @foreach ($employes as $emp)
                <option value="{{ $emp->id }}" {{ old('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->prenom }} {{ $emp->nom }}{{ $emp->poste ? ' — ' . $emp->poste : '' }}</option>
                @endforeach
            </select>
            @error('employee_id')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div>
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Montant (DH) <span style="color: #ef4444;">*</span></label>
            <input type="number" name="amount" step="0.01" placeholder="0.00" value="{{ old('amount') }}" required
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            @error('amount')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div>
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Date de dépense <span style="color: #ef4444;">*</span></label>
            <input type="date" name="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" required
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            @error('expense_date')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div>
            <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Notes (optionnel)</label>
            <textarea name="notes" rows="4" placeholder="Détails supplémentaires..."
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box; font-family: inherit; resize: vertical;">{{ old('notes') }}</textarea>
            @error('notes')<span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>@enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
            <button type="submit" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1rem 2rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">💾 Enregistrer la dépense</button>
            <a href="{{ route('expenses.index') }}" style="background: #6b7280; color: white; padding: 1rem 2rem; border-radius: 6px; font-weight: 600; text-decoration: none;">Annuler</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
(function() {
    var sel = document.getElementById('expense-category-id');
    var wrap = document.getElementById('employee-select-wrapper');
    var empSel = document.getElementById('expense-employee-id');
    function toggle() {
        var opt = sel && sel.options[sel.selectedIndex];
        var isSalaire = opt && opt.getAttribute('data-is-salaire') === '1';
        if (wrap) wrap.style.display = isSalaire ? 'block' : 'none';
        if (empSel) { empSel.required = isSalaire; if (!isSalaire) empSel.value = ''; }
    }
    if (sel) sel.addEventListener('change', toggle);
    toggle();
})();
</script>
@endpush
@endsection
