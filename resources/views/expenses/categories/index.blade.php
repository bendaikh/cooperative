<!-- SECTION 1: MANAGE CATEGORIES -->
<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: bold; color: #111827;">📂 Catégories de Dépenses</h2>
    
    @if ($categories->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem;">
            @foreach ($categories as $category)
            <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); padding: 1rem; border-radius: 8px; border-left: 4px solid {{ $category->color ?? '#667eea' }};">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <h3 style="margin: 0; font-weight: 600; color: #111827;">{{ $category->name }}</h3>
                    <span style="background: {{ $category->color ?? '#667eea' }}; color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">{{ $category->expenses_count }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <p style="margin: 0; color: #6b7280; font-size: 0.875rem;">{{ $category->description ?? '—' }}</p>
                    <p style="margin: 0; font-size: 1rem; font-weight: bold; color: {{ $category->color ?? '#667eea' }};">{{ number_format($category->expenses_sum_total_cost ?? 0, 2) }} DH</p>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 1.5rem; color: #9ca3af; background: #f9fafb; border-radius: 6px; margin-bottom: 1.5rem;">
            <p style="font-size: 2rem; margin: 0;">📭</p>
            <p style="margin-top: 0.5rem;">Aucune catégorie créée</p>
        </div>
    @endif

    <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 1.5rem 0;">

    <!-- Add Category Form -->
    <form action="{{ route('expense-categories.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
        @csrf
        <h3 style="margin: 0; font-size: 1rem; font-weight: 600; color: #111827;">➕ Nouvelle Catégorie</h3>
        
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Nom</label>
            <input 
                type="text" 
                name="name"
                placeholder="Ex: Maintenance, Transport..."
                style="width: 100%; padding: 0.65rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; box-sizing: border-box; transition: border-color 0.2s;"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <span style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Description (optionnel)</label>
            <input 
                type="text" 
                name="description"
                placeholder="Description..."
                style="width: 100%; padding: 0.65rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; box-sizing: border-box; transition: border-color 0.2s;"
                value="{{ old('description') }}"
            >
            @error('description')
                <span style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Couleur</label>
            <input 
                type="color" 
                name="color"
                value="{{ old('color', '#667eea') }}"
                style="width: 100%; height: 40px; border: 1px solid #d1d5db; border-radius: 6px; cursor: pointer;"
            >
        </div>

        <div>
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" name="is_salaire" value="1" {{ old('is_salaire') ? 'checked' : '' }} style="width: 1rem; height: 1rem; accent-color: #667eea;">
                <span style="font-weight: 600; color: #374151; font-size: 0.875rem;">Catégorie Salaire</span>
            </label>
            <p style="margin: 0.25rem 0 0; color: #6b7280; font-size: 0.75rem;">Cochez pour une catégorie salaire (sélection employé dans les dépenses).</p>
        </div>

        <button 
            type="submit"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.7rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.9rem; transition: transform 0.2s, box-shadow 0.2s;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
        >
            ✨ Créer Catégorie
        </button>
    </form>
</div>
