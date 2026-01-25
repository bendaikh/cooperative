@extends('layouts.app')

@section('title', 'Modifier Employé - Co-op ERP')
@section('page-title', 'Modifier un Employé')

@section('content')
<div style="padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: -2rem -2rem 2rem; border-radius: 8px; color: white;">
    <h1 style="font-size: 1.75rem; margin: 0; font-weight: bold;">✏️ Modifier l'Employé</h1>
    <p style="margin-top: 0.5rem; opacity: 0.9;">{{ $employe->prenom }} {{ $employe->nom }}</p>
</div>

@if ($errors->any())
    <div style="background: #ef4444; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
        @foreach ($errors->all() as $error)
            <div>• {{ $error }}</div>
        @endforeach
    </div>
@endif

<div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 800px;">
    <form action="{{ route('employes.update', $employe) }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Nom <span style="color: #ef4444;">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $employe->nom) }}" required
                    style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                @error('nom')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Prénom <span style="color: #ef4444;">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $employe->prenom) }}" required
                    style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                @error('prenom')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Poste / fonction</label>
                <input type="text" name="poste" value="{{ old('poste', $employe->poste) }}"
                    style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                @error('poste')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Type de contrat</label>
                <select name="type_contrat" style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                    <option value="">— Sélectionnez —</option>
                    <option value="CDI" {{ old('type_contrat', $employe->type_contrat) === 'CDI' ? 'selected' : '' }}>CDI</option>
                    <option value="CDD" {{ old('type_contrat', $employe->type_contrat) === 'CDD' ? 'selected' : '' }}>CDD</option>
                    <option value="journalier" {{ old('type_contrat', $employe->type_contrat) === 'journalier' ? 'selected' : '' }}>Journalier</option>
                    <option value="interim" {{ old('type_contrat', $employe->type_contrat) === 'interim' ? 'selected' : '' }}>Intérim</option>
                    <option value="freelance" {{ old('type_contrat', $employe->type_contrat) === 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
                @error('type_contrat')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Salaire (DH)</label>
                <input type="number" name="salaire" value="{{ old('salaire', $employe->salaire) }}" step="0.01" min="0"
                    style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                @error('salaire')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Unité salaire</label>
                <select name="salaire_type" style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                    <option value="mensuel" {{ old('salaire_type', $employe->salaire_type) === 'mensuel' ? 'selected' : '' }}>Mensuel</option>
                    <option value="journalier" {{ old('salaire_type', $employe->salaire_type) === 'journalier' ? 'selected' : '' }}>Journalier</option>
                    <option value="horaire" {{ old('salaire_type', $employe->salaire_type) === 'horaire' ? 'selected' : '' }}>Horaire</option>
                </select>
                @error('salaire_type')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Date d'embauche</label>
            <input type="date" name="date_embauche" value="{{ old('date_embauche', $employe->date_embauche?->format('Y-m-d')) }}"
                style="width: 100%; max-width: 280px; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
            @error('date_embauche')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $employe->telephone) }}"
                    style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                @error('telephone')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Email</label>
                <input type="email" name="email" value="{{ old('email', $employe->email) }}"
                    style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
                @error('email')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Adresse</label>
            <textarea name="adresse" rows="3"
                style="width: 100%; padding: 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; resize: vertical;">{{ old('adresse', $employe->adresse) }}</textarea>
            @error('adresse')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
        </div>

        <div>
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Statut <span style="color: #ef4444;">*</span></label>
            <div style="display: flex; gap: 1.5rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="radio" name="statut" value="actif" {{ old('statut', $employe->statut) === 'actif' ? 'checked' : '' }}>
                    <span>Actif</span>
                </label>
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="radio" name="statut" value="inactif" {{ old('statut', $employe->statut) === 'inactif' ? 'checked' : '' }}>
                    <span>Inactif</span>
                </label>
            </div>
            @error('statut')<span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>@enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
            <button type="submit" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1rem 2rem; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">💾 Enregistrer</button>
            <a href="{{ route('employes.index') }}" style="background: #6b7280; color: white; padding: 1rem 2rem; border-radius: 6px; font-weight: 600; text-decoration: none;">Annuler</a>
        </div>
    </form>
</div>
@endsection
