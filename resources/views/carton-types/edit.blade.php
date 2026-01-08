@extends('layouts.app')

@section('title', 'Éditer Type de Carton - Co-op ERP')
@section('page-title', 'Éditer Type de Carton')

@section('content')
<div style="max-width: 700px; margin: 2rem auto;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="margin-bottom: 1.5rem;">
            <a href="{{ route('carton-types.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 500;">← Retour à la liste</a>
        </div>

        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Éditer: <span style="color: #2563eb;">{{ $cartonType->name }}</span></h2>

        @if($errors->any())
            <div style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach($errors->all() as $error)
                        <li style="margin: 0.25rem 0;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('carton-types.update', $cartonType) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 1.5rem;">
                <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Nom du Type <span style="color: #dc2626;">*</span></label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $cartonType->name) }}"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 1rem; font-family: inherit;"
                    required
                >
                @error('name')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="capacity" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Capacité (nombre de capsules) <span style="color: #dc2626;">*</span></label>
                <input 
                    type="number" 
                    id="capacity" 
                    name="capacity" 
                    value="{{ old('capacity', $cartonType->capacity) }}"
                    min="1000"
                    max="1000000"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 1rem; font-family: inherit;"
                    required
                >
                <p style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem;">Nombre de capsules que contient ce carton</p>
                @error('capacity')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="description" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Description (optionnel)</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 1rem; font-family: inherit; resize: vertical;"
                >{{ old('description', $cartonType->description) }}</textarea>
                @error('description')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="purchase_price" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Prix d'achat par carton (DH)</label>
                <input 
                    type="number" 
                    id="purchase_price" 
                    name="purchase_price" 
                    value="{{ old('purchase_price', $cartonType->purchase_price) }}"
                    placeholder="0.00"
                    min="0"
                    step="0.01"
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 1rem; font-family: inherit;"
                >
                <p style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem;">Le coût d'achat de ce type de carton en Dirhams</p>
                @error('purchase_price')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem; background: #eff6ff; border: 1px solid #bfdbfe; padding: 1rem; border-radius: 0.5rem;">
                <label for="is_active" style="display: flex; align-items: center; cursor: pointer;">
                    <input 
                        type="checkbox" 
                        id="is_active" 
                        name="is_active" 
                        value="1"
                        {{ old('is_active', $cartonType->is_active) ? 'checked' : '' }}
                        style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem; cursor: pointer;"
                    >
                    <span style="font-size: 0.875rem; color: #1f2937;">Type actif (disponible pour la sélection)</span>
                </label>
            </div>

            <div style="background: #fef3c7; border: 1px solid #fde68a; color: #92400e; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <p style="margin: 0; font-size: 0.875rem;">
                    <strong>ℹ️ Information:</strong> Ce type est actuellement utilisé par <strong>{{ $cartonType->capsules()->count() }} carton(s)</strong>
                </p>
            </div>

            <div style="display: flex; gap: 1rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                <button 
                    type="submit" 
                    style="background: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; border: none; font-weight: 500; cursor: pointer; font-size: 1rem;"
                >
                    Mettre à Jour
                </button>
                <a 
                    href="{{ route('carton-types.index') }}" 
                    style="background: #9ca3af; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; border: none; text-decoration: none; font-weight: 500; text-align: center; font-size: 1rem; cursor: pointer;"
                >
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
