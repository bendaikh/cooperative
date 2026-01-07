@extends('layouts.app')

@section('title', 'Modifier Commande - Co-op ERP')
@section('page-title', 'Modifier une Commande (Emballage Unifié)')

@section('content')
<div style="max-width: 1000px;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        
        <!-- Progress Steps -->
        <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; position: relative;">
            <div style="position: absolute; top: 20px; left: 0; right: 0; height: 2px; background: #e5e7eb; z-index: 0;"></div>
            
            <div style="flex: 1; text-align: center; position: relative; z-index: 1;">
                <div class="step-circle" data-step="1" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #2d7a52; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">1</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Client</p>
            </div>
            
            <div style="flex: 1; text-align: center; position: relative; z-index: 1;">
                <div class="step-circle" data-step="2" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">2</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Emballage</p>
            </div>
            
            <div style="flex: 1; text-align: center; position: relative; z-index: 1;">
                <div class="step-circle" data-step="3" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">3</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Quantité</p>
            </div>
            
            <div style="flex: 1; text-align: center; position: relative; z-index: 1;">
                <div class="step-circle" data-step="4" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">4</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Capsules</p>
            </div>
            
            <div style="flex: 1; text-align: center; position: relative; z-index: 1;">
                <div class="step-circle" data-step="5" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">5</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Résumé</p>
            </div>
        </div>

        <form id="commandeForm" action="{{ route('commandes.update', $commande->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Error Messages Display -->
            @if($errors->any())
                <div style="background: #fee2e2; border: 3px solid #dc2626; padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem;">
                    <p style="margin-bottom: 1rem; font-size: 1rem; font-weight: 600; color: #991b1b;">⚠️ ERREURS DE VALIDATION</p>
                    <ul style="margin: 0; padding-left: 2rem; list-style: disc;">
                        @foreach($errors->all() as $error)
                            <li style="margin-bottom: 0.5rem; color: #991b1b;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Step 1: Client Selection -->
            <div class="form-step" data-step="1" style="display: block;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 1: Sélectionner le client</h2>
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="client_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Client <span style="color: #dc2626;">*</span></label>
                    <select name="client_id" id="client_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;">
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $commande->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }} @if($client->email)- {{ $client->email }}@endif
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 2: Emballage Selection (UNIFIED) -->
            <div class="form-step" data-step="2" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 2: Sélectionner l'emballage</h2>
                
                <!-- Single Emballage Selection -->
                <div style="margin-bottom: 2rem; padding: 1.5rem; background: #f9fafb; border-radius: 0.75rem; border: 2px solid #e5e7eb;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">📦 Emballage <span style="color: #dc2626;">*</span></label>
                    
                    <select name="emballage_product_stock_id" id="emballage_product_stock_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; margin-bottom: 0.5rem;">
                        <option value="">Sélectionner un emballage</option>
                        @foreach($emballages as $emballage)
                            @foreach($emballage->stock as $stock)
                                <option value="{{ $stock->id }}" data-stock="{{ $stock->global_quantity }}" {{ $currentEmballage && $currentEmballage->product_stock_id == $stock->id ? 'selected' : '' }}>
                                    {{ $emballage->name }} - Stock: {{ $stock->global_quantity }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                    @error('emballage_product_stock_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Joint de sécurité Checkbox -->
                <div style="margin-bottom: 1.5rem; padding: 1.5rem; background: #fef3c7; border-radius: 0.75rem; border: 2px solid #fbbf24;">
                    @if($jointSecurite && $jointSecurite->stock->count() > 0)
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="avec_joint_securite" id="avec_joint_securite" value="1" {{ $commande->avec_joint_securite ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; cursor: pointer; margin-right: 0.75rem;">
                            <span style="font-size: 0.875rem; font-weight: 600; color: #1f2937;">🔒 Avec Joint de sécurité</span>
                        </label>
                        <p style="color: #78350f; font-size: 0.75rem; margin-top: 0.5rem; margin-left: 2rem;">
                            Si coché, la même quantité sera appliquée pour le Joint de sécurité.
                        </p>
                    @else
                        <p style="color: #92400e; font-size: 0.875rem; font-weight: 600;">🔒 Joint de sécurité</p>
                        <p style="color: #b45309; font-size: 0.75rem; margin-top: 0.5rem;">Non disponible</p>
                    @endif
                    @error('avec_joint_securite')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem; margin-left: 2rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ticket Checkbox -->
                <div style="margin-bottom: 1.5rem; padding: 1.5rem; background: linear-gradient(135deg, #f3e8ff 0%, #faf5ff 100%); border-radius: 0.75rem; border: 2px solid #d8b4fe;">
                    @if($tickets && $tickets->count() > 0)
                        <label style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0.75rem;">
                            <input type="checkbox" name="avec_ticket" id="avec_ticket" value="1" {{ $commande->tickets()->exists() ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; cursor: pointer; margin-right: 0.75rem; accent-color: #a855f7;">
                            <span style="font-size: 0.95rem; font-weight: 600; color: #1f2937;">🎫 Avec Ticket</span>
                        </label>
                        <p style="color: #6b21a8; font-size: 0.75rem; margin-left: 2rem; margin-top: 0.25rem;">
                            Si coché, spécifiez le produit ticket, le nom de la marque et le numéro d'autorisation.
                        </p>
                        
                        <!-- Hidden ticket fields that show when checkbox is checked -->
                        <div id="ticket-fields" style="display: {{ $commande->tickets()->exists() ? 'block' : 'none' }}; margin-top: 1.25rem; padding: 1.25rem; background: white; border: 2px solid #d8b4fe; border-radius: 0.5rem; box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                                <div>
                                    <label for="ticket_product_stock_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Produit Ticket <span style="color: #dc2626;">*</span></label>
                                    <select name="ticket_product_stock_id" id="ticket_product_stock_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                        <option value="">Sélectionner un ticket</option>
                                        @foreach($tickets as $ticket)
                                            @foreach($ticket->stock as $stock)
                                                <option value="{{ $stock->id }}" data-quantity="{{ $stock->quantity }}" {{ $commande->tickets()->first()?->product_stock_id == $stock->id ? 'selected' : '' }}>
                                                    {{ $ticket->name }} (Stock: {{ $stock->quantity }})
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="ticket_quantity" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Quantité de Tickets <span style="color: #dc2626;">*</span></label>
                                    <input type="number" name="ticket_quantity" id="ticket_quantity" min="0.001" step="0.001" value="{{ $commande->tickets()->first()?->quantity ?? '' }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                </div>

                                <div>
                                    <label for="nom_marque" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Nom de la marque <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="nom_marque" id="nom_marque" value="{{ $commande->tickets()->first()?->nom_marque ?? '' }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                </div>

                                <div>
                                    <label for="numero_autorisation" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Numéro d'autorisation <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="numero_autorisation" id="numero_autorisation" value="{{ $commande->tickets()->first()?->numero_autorisation ?? '' }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                </div>
                            </div>
                        </div>
                    @else
                        <p style="color: #7e22ce; font-size: 0.875rem; font-weight: 600;">🎫 Ticket</p>
                        <p style="color: #a855f7; font-size: 0.75rem; margin-top: 0.5rem;">Non disponible - Créez d'abord un produit "Ticket" et son stock.</p>
                    @endif
                    @error('avec_ticket')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem; margin-left: 2rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 3: Quantity Input -->
            <div class="form-step" data-step="3" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 3: Quantité</h2>
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="quantity" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Quantité d'emballage <span style="color: #dc2626;">*</span></label>
                    <input type="number" name="quantity" id="quantity" required min="0.001" step="0.001" value="{{ old('quantity', $commande->quantity) }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 1rem;">
                    <p id="quantity-info" style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;"></p>
                    @error('quantity')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem; font-weight: 600;">❌ {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 4: Filled Capsules Selection -->
            <div class="form-step" data-step="4" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 4: Capsules remplies</h2>
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="filled_capsule_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Sélectionner les capsules remplies <span style="color: #dc2626;">*</span></label>
                    <select name="filled_capsule_id" id="filled_capsule_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;">
                        <option value="">Sélectionner des capsules remplies</option>
                        @foreach($filledCapsules as $capsule)
                            <option value="{{ $capsule->id }}" data-quantity="{{ $capsule->quantity }}" {{ $commande->filledCapsules()->first()?->filled_capsule_id == $capsule->id ? 'selected' : '' }}>
                                {{ $capsule->herb->name ?? 'Herbe inconnue' }} - Stock: {{ round($capsule->quantity, 2) }} rangées
                            </option>
                        @endforeach
                    </select>
                    @error('filled_capsule_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capsules Per Unit Selection -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Capsules par unité <span style="color: #dc2626;">*</span></label>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                        @foreach($capsulesPerUnitOptions as $option)
                            <label style="display: flex; align-items: center; padding: 1rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;">
                                <input type="radio" name="capsules_per_unit" value="{{ $option }}" required style="width: 1.25rem; height: 1.25rem; cursor: pointer;" @if($commande->capsules_per_unit == $option) checked @endif>
                                <span style="margin-left: 0.75rem; font-weight: 500; color: #1f2937;">{{ $option }} capsules</span>
                            </label>
                        @endforeach
                    </div>
                    @error('capsules_per_unit')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 5: Summary -->
            <div class="form-step" data-step="5" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 5: Résumé de la commande</h2>
                
                <div style="padding: 1.5rem; background: #f9fafb; border-radius: 0.75rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">CLIENT</p>
                            <p id="summary-client" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">QUANTITÉ EMBALLAGE</p>
                            <p id="summary-quantity" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">EMBALLAGE</p>
                            <p id="summary-emballage" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">CAPSULES REMPLIES</p>
                            <p id="summary-capsules" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">TOTAL CAPSULES NEEDED</p>
                            <p id="summary-total-capsules" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="notes" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Notes (optionnel)</label>
                    <textarea name="notes" id="notes" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; resize: vertical;">{{ $commande->notes }}</textarea>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div style="display: flex; gap: 1rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                <button type="button" id="prevBtn" style="background: white; color: #4b5563; padding: 0.75rem 2rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-weight: 500; cursor: pointer; display: none;">
                    ← Précédent
                </button>
                
                <button type="button" id="nextBtn" style="background: #2d7a52; color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; border: none; font-weight: 500; cursor: pointer; margin-left: auto;">
                    Suivant →
                </button>
                
                <button type="submit" id="submitBtn" style="background: #059669; color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; border: none; font-weight: 500; cursor: pointer; display: none;">
                    ✓ Mettre à jour
                </button>
                
                <a href="{{ route('commandes.index') }}" style="background: white; color: #4b5563; padding: 0.75rem 2rem; border-radius: 0.5rem; border: 1px solid #d1d5db; text-decoration: none; font-weight: 500; text-align: center;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let currentStep = 1;
const totalSteps = 5;

const form = document.getElementById('commandeForm');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');

const clientSelect = document.getElementById('client_id');
const quantityInput = document.getElementById('quantity');
const emballageSelect = document.getElementById('emballage_product_stock_id');
const filledCapsuleSelect = document.getElementById('filled_capsule_id');
const capsulesPerUnitInputs = document.querySelectorAll('input[name="capsules_per_unit"]');

function showStep(step) {
    document.querySelectorAll('.form-step').forEach(el => el.style.display = 'none');
    
    const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
    if (currentStepEl) {
        currentStepEl.style.display = 'block';
    }
    
    prevBtn.style.display = step > 1 ? 'block' : 'none';
    nextBtn.style.display = step < totalSteps ? 'block' : 'none';
    submitBtn.style.display = step === totalSteps ? 'block' : 'none';
    
    document.querySelectorAll('.step-circle').forEach((circle) => {
        const stepNum = parseInt(circle.dataset.step);
        if (stepNum <= step) {
            circle.style.background = '#2d7a52';
            circle.style.color = 'white';
        } else {
            circle.style.background = '#e5e7eb';
            circle.style.color = '#4b5563';
        }
    });
    
    updateSummary();
    window.scrollTo(0, 0);
}

function updateSummary() {
    const clientOption = clientSelect.options[clientSelect.selectedIndex];
    document.getElementById('summary-client').textContent = clientOption.text || '-';
    
    document.getElementById('summary-quantity').textContent = quantityInput.value || '-';
    
    const emballageOption = emballageSelect.options[emballageSelect.selectedIndex];
    document.getElementById('summary-emballage').textContent = emballageOption.text || '-';
    
    const capsuleOption = filledCapsuleSelect.options[filledCapsuleSelect.selectedIndex];
    document.getElementById('summary-capsules').textContent = capsuleOption.text || '-';
    
    const qty = parseInt(quantityInput.value) || 0;
    const cpuVal = document.querySelector('input[name="capsules_per_unit"]:checked')?.value || 0;
    const totalCapsules = qty * cpuVal;
    document.getElementById('summary-total-capsules').textContent = totalCapsules > 0 ? totalCapsules : '-';
}

function canAdvanceToNextStep() {
    if (currentStep === 1) {
        return clientSelect.value !== '';
    } else if (currentStep === 2) {
        return emballageSelect.value !== '';
    } else if (currentStep === 3) {
        return quantityInput.value && parseInt(quantityInput.value) >= 1;
    } else if (currentStep === 4) {
        return filledCapsuleSelect.value !== '' && document.querySelector('input[name="capsules_per_unit"]:checked') !== null;
    }
    return true;
}

nextBtn.addEventListener('click', () => {
    if (!canAdvanceToNextStep()) {
        alert('Veuillez remplir tous les champs requis de cette étape.');
        return;
    }
    
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
});

prevBtn.addEventListener('click', () => {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
});

[clientSelect, emballageSelect, quantityInput, filledCapsuleSelect, ...capsulesPerUnitInputs].forEach(el => {
    el.addEventListener('change', updateSummary);
    el.addEventListener('input', updateSummary);
});

// Handle ticket checkbox visibility
const avecTicketCheckbox = document.getElementById('avec_ticket');
const ticketFields = document.getElementById('ticket-fields');
if (avecTicketCheckbox) {
    avecTicketCheckbox.addEventListener('change', () => {
        if (ticketFields) {
            ticketFields.style.display = avecTicketCheckbox.checked ? 'block' : 'none';
        }
    });
}

// Update quantity info when emballage changes
emballageSelect.addEventListener('change', () => {
    const selectedOption = emballageSelect.options[emballageSelect.selectedIndex];
    const stockQty = selectedOption.dataset.stock;
    const quantityInfoEl = document.getElementById('quantity-info');
    if (stockQty) {
        quantityInfoEl.textContent = `Stock disponible: ${stockQty}`;
    } else {
        quantityInfoEl.textContent = '';
    }
});

showStep(currentStep);
</script>
@endpush

@endsection
