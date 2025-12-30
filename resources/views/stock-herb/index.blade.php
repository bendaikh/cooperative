@extends('layouts.app')

@section('title', 'Stock Herb - Co-op ERP')
@section('page-title', 'Stock Herb')

@section('content')
<div style="background: white; border-radius: 0.5rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; font-weight: 600; color: #1f2937;">Stock des Herbs</h2>
        <a href="{{ route('stock-herb.create') }}" style="background: #2d7a52; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
            + Nouvelle entrée
        </a>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 1.5rem; display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; background: #f9fafb; padding: 1rem; border-radius: 0.5rem; border: 1px solid #e5e7eb;">
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem; text-transform: uppercase;">Nom de l'herbe</label>
            <select id="filter-nom" class="filter-select" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem; outline: none; background: white;">
                <option value="">Toutes les herbes</option>
                @foreach($herbs->pluck('name')->unique() as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem; text-transform: uppercase;">Source</label>
            <select id="filter-source" class="filter-select" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem; outline: none; background: white;">
                <option value="">Toutes les sources</option>
                @foreach($herbs->pluck('source')->unique() as $source)
                    <option value="{{ $source }}">{{ $source }}</option>
                @endforeach
            </select>
        </div>
        <div style="display: flex; align-items: flex-end;">
            <button onclick="resetFilters()" style="padding: 0.5rem 1rem; background: white; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem; color: #4b5563; cursor: pointer; transition: all 0.2s;">
                Réinitialiser
            </button>
        </div>
    </div>

    @if($herbs->count() > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                    <th style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151;">Nom</th>
                    <th style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151;">Source</th>
                    <th style="padding: 0.75rem; text-align: right; font-weight: 600; color: #374151;">Stock disponible</th>
                    <th style="padding: 0.75rem; text-align: right; font-weight: 600; color: #374151;">Actions</th>
                </tr>
            </thead>
            <tbody id="stockTableBody">
                @foreach($herbs as $herb)
                    @php
                        $stock = $herb->global_quantity;
                    @endphp
                    <tr class="stock-row" style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 0.75rem; color: #1f2937; font-weight: 500;">{{ $herb->name }}</td>
                        <td style="padding: 0.75rem; color: #6b7280;">{{ $herb->source }}</td>
                        <td style="padding: 0.75rem; text-align: right;">
                            <span style="background: {{ $stock > 0 ? '#ecfdf5' : '#fee2e2' }}; color: {{ $stock > 0 ? '#065f46' : '#991b1b' }}; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.875rem; font-weight: 600;">
                                {{ $stock }}
                            </span>
                        </td>
                        <td style="padding: 0.75rem; text-align: right;">
                            <a href="{{ route('stock-herb.show', $herb->id) }}" style="color: #2d7a52; text-decoration: none; font-size: 0.875rem;">Voir détails</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 3rem; color: #6b7280;">
            <p>Aucun herb enregistré pour le moment.</p>
            <p style="margin-top: 0.5rem; font-size: 0.875rem;">Veuillez d'abord créer des herbs dans la section "Gestion Herb".</p>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Filters functionality
    const filterSelects = document.querySelectorAll('.filter-select');
    
    filterSelects.forEach(select => {
        select.addEventListener('change', filterTable);
    });

    function filterTable() {
        const nomFilter = document.getElementById('filter-nom').value.toLowerCase();
        const sourceFilter = document.getElementById('filter-source').value.toLowerCase();
        
        const rows = document.querySelectorAll('.stock-row');
        
        rows.forEach(row => {
            const nom = row.querySelector('td:nth-child(1)').textContent.toLowerCase().trim();
            const source = row.querySelector('td:nth-child(2)').textContent.toLowerCase().trim();
            
            const matchNom = !nomFilter || nom === nomFilter;
            const matchSource = !sourceFilter || source === sourceFilter;
            
            row.style.display = (matchNom && matchSource) ? '' : 'none';
        });
    }

    function resetFilters() {
        filterSelects.forEach(select => {
            select.value = '';
        });
        filterTable();
    }
</script>
@endpush
@endsection

