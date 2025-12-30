@extends('layouts.app')

@section('title', 'Modifier Fournisseur - Co-op ERP')
@section('page-title', 'Modifier un Fournisseur')

@section('content')
<style>
    .multi-select-container {
        position: relative;
        width: 100%;
    }
    .multi-select-input {
        min-height: 45px;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        background: white;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        cursor: pointer;
        align-items: center;
    }
    .multi-select-badge {
        background: #2d7a52;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }
    .multi-select-remove {
        cursor: pointer;
        font-weight: bold;
        font-size: 1rem;
        line-height: 1;
    }
    .multi-select-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        margin-top: 0.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        z-index: 50;
        display: none;
    }
    .multi-select-dropdown.active {
        display: block;
    }
    .multi-select-option {
        padding: 0.75rem 1rem;
        cursor: pointer;
        font-size: 0.875rem;
        color: #4b5563;
        transition: background 0.2s;
    }
    .multi-select-option:hover {
        background: #f3f4f6;
        color: #1f2937;
    }
    .multi-select-option.selected {
        background: #f0fdf4;
        color: #2d7a52;
        font-weight: 600;
    }
    .multi-select-placeholder {
        color: #9ca3af;
        font-size: 0.875rem;
        padding-left: 0.25rem;
    }
</style>

<div style="max-width: 800px;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Modifier les informations du fournisseur</h2>
        
        <form action="{{ route('fornisseurs.update', $fornisseur->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 1.5rem;">
                <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Nom <span style="color: #dc2626;">*</span></label>
                <input type="text" name="name" id="name" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;" placeholder="ex: Fournisseur ABC" value="{{ old('name', $fornisseur->name) }}">
                @error('name')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="phone_number" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Numéro de téléphone</label>
                <input type="text" name="phone_number" id="phone_number" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;" placeholder="ex: +33 6 12 34 56 78" value="{{ old('phone_number', $fornisseur->phone_number) }}">
                @error('phone_number')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 2rem;">
                <label for="ville" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Ville</label>
                <input type="text" name="ville" id="ville" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;" placeholder="ex: Paris" value="{{ old('ville', $fornisseur->ville) }}">
                @error('ville')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Spécialités</label>
                
                <div class="multi-select-container">
                    <div class="multi-select-input" id="specialiteSelect">
                        <span class="multi-select-placeholder">Sélectionnez une ou plusieurs spécialités...</span>
                    </div>
                    
                    <div class="multi-select-dropdown" id="specialiteDropdown">
                        <div class="multi-select-option" data-value="embalage">Emballage</div>
                        <div class="multi-select-option" data-value="capsule">Capsule</div>
                        <div class="multi-select-option" data-value="herb">Herbe</div>
                    </div>

                    <!-- Hidden checkboxes for form submission -->
                    <div id="hiddenCheckboxes" style="display: none;">
                        @php
                            $selectedSpecialities = old('specialite', $fornisseur->specialite ?? []);
                            if (!is_array($selectedSpecialities)) {
                                $selectedSpecialities = [];
                            }
                        @endphp
                        <input type="checkbox" name="specialite[]" value="embalage" {{ in_array('embalage', $selectedSpecialities) ? 'checked' : '' }}>
                        <input type="checkbox" name="specialite[]" value="capsule" {{ in_array('capsule', $selectedSpecialities) ? 'checked' : '' }}>
                        <input type="checkbox" name="specialite[]" value="herb" {{ in_array('herb', $selectedSpecialities) ? 'checked' : '' }}>
                    </div>
                </div>

                @error('specialite')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                <button type="submit" style="background: #2d7a52; color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; border: none; font-weight: 500; cursor: pointer;">
                    Mettre à jour le fournisseur
                </button>
                <a href="{{ route('fornisseurs.index') }}" style="background: white; color: #4b5563; padding: 0.75rem 2rem; border-radius: 0.5rem; border: 1px solid #d1d5db; text-decoration: none; font-weight: 500; text-align: center;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectContainer = document.getElementById('specialiteSelect');
        const dropdown = document.getElementById('specialiteDropdown');
        const options = dropdown.querySelectorAll('.multi-select-option');
        const checkboxes = document.querySelectorAll('#hiddenCheckboxes input[type="checkbox"]');
        const placeholder = selectContainer.querySelector('.multi-select-placeholder');

        // Toggle dropdown
        selectContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('multi-select-remove')) return;
            dropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!selectContainer.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Update UI based on initial checkbox states
        updateSelectedUI();

        options.forEach(option => {
            option.addEventListener('click', function() {
                const val = this.dataset.value;
                const checkbox = document.querySelector(`#hiddenCheckboxes input[value="${val}"]`);
                
                checkbox.checked = !checkbox.checked;
                updateSelectedUI();
                dropdown.classList.remove('active');
            });
        });

        function updateSelectedUI() {
            // Clear current badges (except placeholder)
            const badges = selectContainer.querySelectorAll('.multi-select-badge');
            badges.forEach(b => b.remove());

            let hasSelected = false;

            checkboxes.forEach(cb => {
                const option = Array.from(options).find(opt => opt.dataset.value === cb.value);
                
                if (cb.checked) {
                    hasSelected = true;
                    option.classList.add('selected');

                    // Create badge
                    const badge = document.createElement('div');
                    badge.className = 'multi-select-badge';
                    badge.innerHTML = `
                        ${option.textContent}
                        <span class="multi-select-remove" data-value="${cb.value}">&times;</span>
                    `;
                    
                    badge.querySelector('.multi-select-remove').addEventListener('click', function(e) {
                        e.stopPropagation();
                        cb.checked = false;
                        updateSelectedUI();
                    });

                    selectContainer.appendChild(badge);
                } else {
                    option.classList.remove('selected');
                }
            });

            placeholder.style.display = hasSelected ? 'none' : 'block';
        }
    });
</script>
@endpush
@endsection

