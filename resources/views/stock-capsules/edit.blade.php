@extends('layouts.app')

@section('title', 'Modifier Stock Capsule - Co-op ERP')
@section('page-title', 'Modifier Stock Capsule')

@section('content')
<div style="max-width: 800px;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Informations du stock capsule</h2>
        
        <form action="{{ route('stock-capsules.update', $capsule->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 1.5rem;">
                <label for="carton" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Carton</label>
                <input type="text" name="carton" id="carton" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;" placeholder="ex: Carton A1" value="{{ old('carton', $capsule->carton) }}">
                @error('carton')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Type de carton</label>
                    <div style="padding: 0.75rem; background: #f3f4f6; border-radius: 0.5rem; color: #1f2937; font-weight: 500;">
                        {{ $capsule->cartonType->name ?? 'Type A' }} ({{ number_format($capsule->getCapsulesPerCarton(), 0, ',', ' ') }} capsules)
                    </div>
                </div>
                <div>
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Prix d'achat par carton</label>
                    <div style="padding: 0.75rem; background: #f3f4f6; border-radius: 0.5rem; color: #1f2937; font-weight: 500;">
                        {{ number_format($capsule->carton_price ?? 0, 2) }} DH
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="notes" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Notes (optionnel)</label>
                <textarea name="notes" id="notes" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; resize: vertical;">{{ old('notes', $capsule->notes) }}</textarea>
                @error('notes')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem;">
                <p style="font-size: 0.875rem; color: #6b7280;">
                    <strong>Note:</strong> Pour modifier la quantité, utilisez les boutons "Réapprovisionner" ou "Utiliser" dans la liste des stocks.
                </p>
            </div>

            <div style="display: flex; gap: 1rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                <button type="submit" style="background: #2d7a52; color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; border: none; font-weight: 500; cursor: pointer;">
                    Mettre à jour le stock
                </button>
                <a href="{{ route('stock-capsules.index') }}" style="background: white; color: #4b5563; padding: 0.75rem 2rem; border-radius: 0.5rem; border: 1px solid #d1d5db; text-decoration: none; font-weight: 500; text-align: center;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

