@extends('layouts.app')

@section('title', 'Profil - Co-op ERP')
@section('page-title', 'Profil & Paramètres')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <!-- Profile Information -->
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">👤 Informations Profil</h2>
        
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nom</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 1rem;">
                @error('name')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 1rem;">
                @error('email')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" style="padding: 0.75rem 1.5rem; background: #3b82f6; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600;">
                Enregistrer
            </button>

            @if (session('status') === 'profile-updated')
                <p style="color: #10b981; margin-top: 1rem; font-weight: 500;">✓ Profil mis à jour avec succès!</p>
            @endif
        </form>
    </div>

    <!-- Update Password -->
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">🔐 Changer le Mot de Passe</h2>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Mot de Passe Actuel</label>
                <div style="position: relative;">
                    <input type="password" name="current_password" required class="password-field"
                        style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 1rem;">
                    <button type="button" class="toggle-password" onclick="togglePassword(this)"
                        style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #6b7280; font-size: 1.25rem; padding: 0;">
                        👁️
                    </button>
                </div>
                @error('current_password', 'updatePassword')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nouveau Mot de Passe</label>
                <div style="position: relative;">
                    <input type="password" name="password" required class="password-field"
                        style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 1rem;">
                    <button type="button" class="toggle-password" onclick="togglePassword(this)"
                        style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #6b7280; font-size: 1.25rem; padding: 0;">
                        👁️
                    </button>
                </div>
                <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.25rem;">Au moins 8 caractères, avec majuscules, minuscules et chiffres</p>
                @error('password', 'updatePassword')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Confirmer le Mot de Passe</label>
                <div style="position: relative;">
                    <input type="password" name="password_confirmation" required class="password-field"
                        style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 1rem;">
                    <button type="button" class="toggle-password" onclick="togglePassword(this)"
                        style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #6b7280; font-size: 1.25rem; padding: 0;">
                        👁️
                    </button>
                </div>
                @error('password_confirmation', 'updatePassword')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" style="padding: 0.75rem 1.5rem; background: #ef4444; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600;">
                Changer le Mot de Passe
            </button>

            @if (session('status') === 'password-updated')
                <p style="color: #10b981; margin-top: 1rem; font-weight: 500;">✓ Mot de passe mis à jour avec succès!</p>
            @endif
        </form>
    </div>
</div>

<script>
function togglePassword(button) {
    const input = button.parentElement.querySelector('.password-field');
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    button.textContent = isPassword ? '👁️‍🗨️' : '👁️';
}
</script>

@endsection
