@extends('layouts.app')

@section('title', 'Ajouter Stock Capsule - Co-op ERP')
@section('page-title', 'Ajouter Stock Capsule')

@section('content')
<div style="max-width: 800px;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Informations du stock capsule</h2>
        
        <form action="{{ route('stock-capsules.store') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 1.5rem;">
                <label for="carton" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Carton</label>
                <input type="text" name="carton" id="carton" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;" placeholder="ex: Carton A1" value="{{ old('carton') }}">
                @error('carton')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="quantity" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Nombre de cartons <span style="color: #dc2626;">*</span></label>
                <input type="number" name="quantity" id="quantity" required min="1" step="1" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;" placeholder="1" value="{{ old('quantity') }}">
                @error('quantity')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="carton_type_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Type de carton <span style="color: #dc2626;">*</span></label>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <select name="carton_type_id" id="carton_type_id" required style="flex: 1; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;" data-carton-prices="{{ json_encode($cartonTypes->pluck('purchase_price', 'id')) }}">
                        <option value="">Sélectionner un type</option>
                        @foreach($cartonTypes as $type)
                            <option value="{{ $type->id }}" {{ old('carton_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }} - {{ number_format($type->capacity, 0, ',', ' ') }} capsules {{ $type->purchase_price ? '(' . number_format($type->purchase_price, 2) . ' DH)' : '(Prix à définir)' }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('carton-types.create', ['from' => 'stock-capsules']) }}" style="background: #f0f9ff; color: #0369a1; padding: 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #0369a1; text-decoration: none; font-weight: 500; white-space: nowrap;">
                        + Nouveau type
                    </a>
                </div>
                @error('carton_type_id')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="carton_price" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Prix d'achat par carton (DH) <span style="color: #dc2626;">*</span></label>
                <input type="number" name="carton_price" id="carton_price" required min="0" step="0.01" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;" placeholder="0.00" value="{{ old('carton_price') }}">
                @error('carton_price')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="fornisseur_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Fournisseur</label>
                <select name="fornisseur_id" id="fornisseur_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; transition: border-color 0.2s;">
                    <option value="">Sélectionner un fournisseur (optionnel)</option>
                    @foreach($fornisseurs as $fornisseur)
                        <option value="{{ $fornisseur->id }}" {{ old('fornisseur_id') == $fornisseur->id ? 'selected' : '' }}>
                            {{ $fornisseur->name }}@if($fornisseur->ville) - {{ $fornisseur->ville }}@endif
                        </option>
                    @endforeach
                </select>
                @error('fornisseur_id')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="notes" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Notes (optionnel)</label>
                <textarea name="notes" id="notes" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; resize: vertical;">{{ old('notes') }}</textarea>
                @error('notes')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                <button type="submit" style="background: #2d7a52; color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; border: none; font-weight: 500; cursor: pointer;">
                    Enregistrer le stock
                </button>
                <a href="{{ route('stock-capsules.index') }}" style="background: white; color: #4b5563; padding: 0.75rem 2rem; border-radius: 0.5rem; border: 1px solid #d1d5db; text-decoration: none; font-weight: 500; text-align: center;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartonTypeSelect = document.getElementById('carton_type_id');
        const cartonPriceInput = document.getElementById('carton_price');
        const cartonPrices = JSON.parse(cartonTypeSelect.getAttribute('data-carton-prices'));

        // Auto-fill price when carton type is selected
        cartonTypeSelect.addEventListener('change', function() {
            const selectedId = this.value;
            if (selectedId && cartonPrices[selectedId]) {
                cartonPriceInput.value = cartonPrices[selectedId];
            } else {
                cartonPriceInput.value = '';
            }
        });

        // Trigger change event on page load if a type was previously selected
        if (cartonTypeSelect.value) {
            cartonTypeSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection

