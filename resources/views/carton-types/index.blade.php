@extends('layouts.app')

@section('title', 'Gestion des Types de Carton - Co-op ERP')
@section('page-title', 'Gestion des Types de Carton')

@section('content')
<div style="padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">Gestion des Types de Carton</h1>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('stock-capsules.create') }}" style="background: #059669; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-weight: 600; display: inline-block;">
                ➕ Ajouter Stock
            </a>
            <a href="{{ route('carton-types.create') }}" style="background: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-weight: 600; display: inline-block;">
                + Ajouter Type
            </a>
        </div>
    </div>

    @if($errors->any())
        <div style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-left: 1.25rem;">
                @foreach($errors->all() as $error)
                    <li style="margin: 0.25rem 0;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="background: #dcfce7; border: 1px solid #bbf7d0; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
            {{ session('error') }}
        </div>
    @endif

    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <tr>
                    <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Nom</th>
                    <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Capacité</th>
                    <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Prix d'achat (DH)</th>
                    <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Description</th>
                    <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">En Utilisation</th>
                    <th style="padding: 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Statut</th>
                    <th style="padding: 1.25rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cartonTypes as $type)
                    <tr style="border-bottom: 1px solid #e5e7eb; transition: background-color 0.2s;">
                        <td style="padding: 1.25rem; font-size: 0.875rem; font-weight: 600; color: #1f2937;">
                            {{ $type->name }}
                        </td>
                        <td style="padding: 1.25rem; font-size: 0.875rem; color: #4b5563;">
                            {{ number_format($type->capacity, 0, ',', ' ') }} capsules
                        </td>
                        <td style="padding: 1.25rem; font-size: 0.875rem; color: #4b5563; font-weight: 500;">
                            {{ $type->purchase_price ? number_format($type->purchase_price, 2) : '-' }}
                        </td>
                        <td style="padding: 1.25rem; font-size: 0.875rem; color: #6b7280;">
                            {{ $type->description ?? '-' }}
                        </td>
                        <td style="padding: 1.25rem; font-size: 0.875rem; color: #4b5563;">
                            <span style="display: inline-block; background: #dbeafe; color: #1e40af; padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                {{ $type->capsules()->count() }}
                            </span>
                        </td>
                        <td style="padding: 1.25rem; font-size: 0.875rem;">
                            @if($type->is_active)
                                <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    Actif
                                </span>
                            @else
                                <span style="display: inline-block; background: #f3f4f6; color: #374151; padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    Inactif
                                </span>
                            @endif
                        </td>
                        <td style="padding: 1.25rem; font-size: 0.875rem; text-align: center;">
                            <div style="display: flex; gap: 0.75rem; justify-content: center;">
                                <a href="{{ route('carton-types.edit', $type) }}" style="color: #2563eb; text-decoration: none; font-weight: 600; transition: color 0.2s;">
                                    Éditer
                                </a>
                                
                                <form action="{{ route('carton-types.toggle', $type) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background: none; border: none; color: #f97316; text-decoration: none; font-weight: 600; cursor: pointer; transition: color 0.2s; padding: 0; font-size: 0.875rem;">
                                        {{ $type->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>

                                @if($type->capsules()->count() === 0)
                                    <form action="{{ route('carton-types.destroy', $type) }}" method="POST" style="display: inline;" onclick="return confirm('Êtes-vous sûr?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #dc2626; text-decoration: none; font-weight: 600; cursor: pointer; transition: color 0.2s; padding: 0; font-size: 0.875rem;">
                                            Supprimer
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 2rem; text-align: center; color: #6b7280;">
                            Aucun type de carton trouvé. <a href="{{ route('carton-types.create') }}" style="color: #2563eb; text-decoration: none; font-weight: 600;">Créer un type</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 2rem;">
        {{ $cartonTypes->links() }}
    </div>
</div>
@endsection
