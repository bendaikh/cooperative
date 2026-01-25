@extends('layouts.app')

@section('title', 'Gestion des Employés - Co-op ERP')
@section('page-title', 'Gestion des Employés')

@section('content')
<div style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: -2rem -2rem 2rem; border-radius: 8px; color: white;">
    <h1 style="font-size: 1.75rem; margin: 0; font-weight: bold;">👥 Gestion des Employés</h1>
    <p style="margin-top: 0.5rem; opacity: 0.9;">Liste, recherche et filtre des employés</p>
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

<!-- Filters -->
<div style="background: #f9fafb; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #e5e7eb;">
    <form method="GET" action="{{ route('employes.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; align-items: end;">
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Recherche</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, prénom, email, poste..."
                style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;">
        </div>
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Statut</label>
            <select name="statut" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;">
                <option value="">Tous</option>
                <option value="actif" {{ request('statut') === 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ request('statut') === 'inactif' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>
        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; font-size: 0.875rem;">Type de contrat</label>
            <select name="type_contrat" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem; box-sizing: border-box;">
                <option value="">Tous</option>
                <option value="CDI" {{ request('type_contrat') === 'CDI' ? 'selected' : '' }}>CDI</option>
                <option value="CDD" {{ request('type_contrat') === 'CDD' ? 'selected' : '' }}>CDD</option>
                <option value="journalier" {{ request('type_contrat') === 'journalier' ? 'selected' : '' }}>Journalier</option>
                <option value="interim" {{ request('type_contrat') === 'interim' ? 'selected' : '' }}>Intérim</option>
                <option value="freelance" {{ request('type_contrat') === 'freelance' ? 'selected' : '' }}>Freelance</option>
            </select>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <button type="submit" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.875rem;">🔍 Filtrer</button>
            <a href="{{ route('employes.index') }}" style="background: #6b7280; color: white; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 600; font-size: 0.875rem; text-decoration: none;">🔄 Réinitialiser</a>
        </div>
    </form>
</div>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <p style="margin: 0; color: #6b7280;">{{ $employes->total() }} employé(s)</p>
    <a href="{{ route('employes.create') }}" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600;">➕ Ajouter un employé</a>
</div>

<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    @if ($employes->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f3f4f6; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151;">Nom / Prénom</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151;">Poste</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151;">Type contrat</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #374151;">Salaire</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151;">Date embauche</th>
                        <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151;">Tél / Email</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151;">Statut</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employes as $e)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 1rem;">
                            <strong>{{ $e->prenom }} {{ $e->nom }}</strong>
                        </td>
                        <td style="padding: 1rem; color: #4b5563;">{{ $e->poste ?? '—' }}</td>
                        <td style="padding: 1rem; color: #4b5563;">{{ $e->type_contrat ?? '—' }}</td>
                        <td style="padding: 1rem; text-align: right;">
                            @if($e->salaire)
                                {{ number_format($e->salaire, 2) }} DH <span style="font-size: 0.75rem; color: #6b7280;">/ {{ $e->salaire_type }}</span>
                            @else
                                —
                            @endif
                        </td>
                        <td style="padding: 1rem; text-align: center;">{{ $e->date_embauche ? $e->date_embauche->format('d/m/Y') : '—' }}</td>
                        <td style="padding: 1rem; font-size: 0.875rem;">
                            {{ $e->telephone ?? '—' }}<br>
                            <span style="color: #6b7280;">{{ $e->email ?? '—' }}</span>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <span style="display: inline-block; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.875rem; font-weight: 500; background: {{ $e->statut === 'actif' ? '#d1fae5' : '#fee2e2' }}; color: {{ $e->statut === 'actif' ? '#065f46' : '#991b1b' }};">
                                {{ $e->statut === 'actif' ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                <a href="{{ route('employes.edit', $e) }}" style="background: #3b82f6; color: white; padding: 0.5rem 0.75rem; border-radius: 6px; text-decoration: none; font-size: 0.875rem;">✏️ Modifier</a>
                                <form action="{{ route('employes.destroy', $e) }}" method="POST" style="display: inline;" onsubmit="return confirm('Supprimer cet employé ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #ef4444; color: white; padding: 0.5rem 0.75rem; border: none; border-radius: 6px; font-size: 0.875rem; cursor: pointer;">🗑️ Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 1.5rem;">{{ $employes->links() }}</div>
    @else
        <div style="text-align: center; padding: 3rem; color: #9ca3af;">
            <p style="font-size: 3rem; margin: 0;">👥</p>
            <p style="margin-top: 0.5rem;">Aucun employé trouvé</p>
            <a href="{{ route('employes.create') }}" style="display: inline-block; margin-top: 1rem; background: #667eea; color: white; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600;">➕ Ajouter un employé</a>
        </div>
    @endif
</div>
@endsection
