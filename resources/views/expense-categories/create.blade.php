@extends('layouts.app')

@section('title', 'Créer Catégorie - Co-op ERP')
@section('page-title', 'Créer Catégorie')

@section('content')
<div style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: -2rem -2rem 2rem; border-radius: 8px; color: white;">
    <h1 style="font-size: 1.75rem; margin: 0; font-weight: bold;">📂 Créer Catégorie de Dépense</h1>
    <p style="margin-top: 0.5rem; opacity: 0.9;">Gérer les catégories de dépenses</p>
</div>

<!-- Flash Messages -->
@if ($message = Session::get('success'))
    <div style="background: #10b981; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
        <span style="font-size: 1.25rem;">✅</span>
        {{ $message }}
    </div>
@endif
@if ($errors->any())
    <div style="background: #ef4444; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
        <div style="font-weight: 600; margin-bottom: 0.5rem;">⚠️ Erreurs:</div>
        @foreach ($errors->all() as $error)
            <div>• {{ $error }}</div>
        @endforeach
    </div>
@endif

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
    <!-- EXISTING CATEGORIES -->
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: bold; color: #111827;">📋 Catégories Existantes</h2>
        
        @if ($categories->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach ($categories as $category)
                <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); padding: 1.25rem; border-radius: 8px; border-left: 4px solid {{ $category->color ?? '#667eea' }};">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                        <div>
                            <h3 style="margin: 0; font-weight: 600; color: #111827; font-size: 1.125rem;">{{ $category->name }}</h3>
                            <p style="margin: 0.5rem 0 0; color: #6b7280; font-size: 0.875rem;">{{ $category->description ?? '—' }}</p>
                        </div>
                        <span style="background: {{ $category->color ?? '#667eea' }}; color: white; padding: 0.5rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">{{ $category->expenses_count }} dépenses</span>
                    </div>
                    <div style="background: white; padding: 0.75rem; border-radius: 6px; text-align: center;">
                        <p style="margin: 0; color: #111827; font-size: 1.5rem; font-weight: bold; color: {{ $category->color ?? '#667eea' }};">{{ number_format($category->expenses_sum_total_cost ?? 0, 2) }} DH</p>
                        <p style="margin: 0.25rem 0 0; color: #6b7280; font-size: 0.75rem;">Total dépensé</p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 2rem; color: #9ca3af; background: #f9fafb; border-radius: 6px;">
                <p style="font-size: 2rem; margin: 0;">📭</p>
                <p style="margin-top: 0.5rem;">Aucune catégorie créée</p>
            </div>
        @endif
    </div>

    <!-- CREATE CATEGORY FORM -->
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: bold; color: #111827;">➕ Nouvelle Catégorie</h2>
        
        <form action="{{ route('expense-categories.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            
            <!-- Name -->
            <div>
                <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Nom <span style="color: #ef4444;">*</span></label>
                <input 
                    type="text" 
                    name="name"
                    placeholder="Ex: Maintenance, Transport..."
                    style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box; transition: border-color 0.2s;"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Description (optionnel)</label>
                <input 
                    type="text" 
                    name="description"
                    placeholder="Description..."
                    style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; box-sizing: border-box; transition: border-color 0.2s;"
                    value="{{ old('description') }}"
                >
                @error('description')
                    <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Color -->
            <div>
                <label style="display: block; margin-bottom: 0.75rem; font-weight: 600; color: #374151; font-size: 1rem;">Couleur</label>
                <div style="display: flex; gap: 0.75rem; align-items: center;">
                    <input 
                        type="color" 
                        name="color"
                        value="{{ old('color', '#667eea') }}"
                        style="width: 60px; height: 50px; border: 1px solid #d1d5db; border-radius: 6px; cursor: pointer;"
                    >
                    <input 
                        type="text" 
                        value="{{ old('color', '#667eea') }}"
                        style="flex: 1; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; box-sizing: border-box; font-family: monospace;"
                        readonly
                    >
                </div>
            </div>

            <!-- Salaire checkbox -->
            <div>
                <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                    <input 
                        type="checkbox" 
                        name="is_salaire"
                        value="1"
                        {{ old('is_salaire') ? 'checked' : '' }}
                        style="width: 1.25rem; height: 1.25rem; accent-color: #667eea;"
                    >
                    <span style="font-weight: 600; color: #374151; font-size: 1rem;">Catégorie Salaire</span>
                </label>
                <p style="margin: 0.5rem 0 0; color: #6b7280; font-size: 0.875rem;">Cochez pour créer une catégorie dédiée aux salaires (permettra de sélectionner un employé lors de la création d’une dépense).</p>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; transition: transform 0.2s, box-shadow 0.2s; margin-top: 1rem;"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
            >
                ✨ Créer Catégorie
            </button>
        </form>
    </div>
</div>

<script>
// Update color input when picker changes
document.querySelector('input[name="color"]').addEventListener('change', function() {
    document.querySelectorAll('input[name="color"]')[1].value = this.value;
});
</script>
@endsection
