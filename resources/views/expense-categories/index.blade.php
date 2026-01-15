@extends('layouts.app')

@section('title', 'Catégories de Dépense - Co-op ERP')
@section('page-title', 'Catégories de Dépense')

@section('content')
<div style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: -2rem -2rem 2rem; border-radius: 8px; color: white;">
    <h1 style="font-size: 1.75rem; margin: 0; font-weight: bold;">📂 Catégories de Dépense</h1>
    <p style="margin-top: 0.5rem; opacity: 0.9;">Gérer vos catégories de dépenses</p>
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

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <p style="margin: 0; color: #6b7280;">Total de {{ $categories->count() }} catégorie(s)</p>
    </div>
    <a href="{{ route('expense-categories.create') }}" style="background: #667eea; color: white; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600; transition: background 0.2s;">
        ➕ Créer Catégorie
    </a>
</div>

@if ($categories->count() > 0)
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
        @foreach ($categories as $category)
        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-left: 4px solid {{ $category->color ?? '#667eea' }};">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <h3 style="margin: 0; font-weight: 600; color: #111827; font-size: 1.125rem;">{{ $category->name }}</h3>
                    <p style="margin: 0.5rem 0 0; color: #6b7280; font-size: 0.875rem;">{{ $category->description ?? '—' }}</p>
                </div>
                <span style="background: {{ $category->color ?? '#667eea' }}; color: white; padding: 0.5rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">{{ $category->expenses_count }} dépenses</span>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); padding: 1rem; border-radius: 6px; text-align: center; margin-bottom: 1rem;">
                <p style="margin: 0; color: #111827; font-size: 1.5rem; font-weight: bold; color: {{ $category->color ?? '#667eea' }};">{{ number_format($category->expenses_sum_total_cost ?? 0, 2) }} DH</p>
                <p style="margin: 0.25rem 0 0; color: #6b7280; font-size: 0.75rem;">Total dépensé</p>
            </div>

            <div style="display: flex; gap: 0.5rem;">
                <a href="{{ route('expense-categories.create') }}" style="flex: 1; background: #f3f4f6; color: #374151; padding: 0.5rem; border-radius: 6px; text-decoration: none; text-align: center; font-size: 0.875rem; font-weight: 500; transition: background 0.2s;">
                    ✏️ Modifier
                </a>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div style="text-align: center; padding: 3rem; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <p style="font-size: 3rem; margin: 0;">📭</p>
        <p style="margin-top: 1rem; color: #9ca3af; font-size: 1rem;">Aucune catégorie créée</p>
        <a href="{{ route('expense-categories.create') }}" style="display: inline-block; margin-top: 1rem; background: #667eea; color: white; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600;">
            ➕ Créer votre première catégorie
        </a>
    </div>
@endif

@endsection
