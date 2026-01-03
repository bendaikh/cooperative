@extends('layouts.app')

@section('title', 'Nouvelle Commande - Co-op ERP')
@section('page-title', 'Créer une Commande (Gestion Emballage)')

@section('content')
<div style="max-width: 1000px;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <!-- Hidden indicator of errors for JavaScript detection -->
        @if($errors->any())
            <div id="hasErrors" style="display: none;">true</div>
        @endif
        
        @if($errors->any())
            <div style="background: #fee2e2; border: 3px solid #dc2626; color: #991b1b; padding: 2rem; border-radius: 0.75rem; margin-bottom: 2rem; font-size: 1.1rem; font-weight: 600;" id="errorMessages">
                <p style="margin-bottom: 1rem;">⚠️ ERREURS DE VALIDATION - Veuillez corriger les erreurs ci-dessous:</p>
                <ul style="margin: 0; padding-left: 2rem; list-style: disc;">
                    @foreach($errors->all() as $error)
                        <li style="margin-bottom: 0.75rem; font-size: 1rem;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
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

        <form id="commandeForm" action="{{ route('commandes.store') }}" method="POST">
            @csrf

            <!-- Step 1: Client Selection -->
            <div class="form-step" data-step="1" style="display: block;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 1: Sélectionner le client</h2>
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="client_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">Client <span style="color: #dc2626;">*</span></label>
                    <select name="client_id" id="client_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;">
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }} @if($client->email)- {{ $client->email }}@endif
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 2: Packaging Selection (PILULIER + BOUCHON) -->
            <div class="form-step" data-step="2" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 2: Sélectionner les emballages</h2>
                
                <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 1rem;">Sélectionnez le PILULIER et le BOUCHON pour cette commande.</p>

                <!-- PILULIER Selection -->
                <div style="margin-bottom: 2rem; padding: 1.5rem; background: #f9fafb; border-radius: 0.75rem; border: 2px solid #e5e7eb;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">🥛 PILULIER <span style="color: #dc2626;">*</span></label>
                    
                    <select name="pilulier_product_stock_id" id="pilulier_product_stock_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; margin-bottom: 0.5rem;">
                        <option value="">Sélectionner un PILULIER</option>
                        @foreach($piluliers as $pilulier)
                            @foreach($pilulier->stock as $stock)
                                <option value="{{ $stock->id }}" data-stock="{{ $stock->global_quantity }}" data-type="PILULIER" {{ old('pilulier_product_stock_id') == $stock->id ? 'selected' : '' }}>
                                    {{ $pilulier->name }} - Stock: {{ $stock->global_quantity }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                    <p id="pilulier-stock-info" style="color: #6b7280; font-size: 0.75rem;"></p>
                    @error('pilulier_product_stock_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- BOUCHON Selection -->
                <div style="margin-bottom: 1.5rem; padding: 1.5rem; background: #f9fafb; border-radius: 0.75rem; border: 2px solid #e5e7eb;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">🔗 BOUCHON <span style="color: #dc2626;">*</span></label>
                    
                    <select name="bouchon_product_stock_id" id="bouchon_product_stock_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; margin-bottom: 0.5rem;">
                        <option value="">Sélectionner un BOUCHON</option>
                        @foreach($bouchons as $bouchon)
                            @foreach($bouchon->stock as $stock)
                                <option value="{{ $stock->id }}" data-stock="{{ $stock->global_quantity }}" data-type="BOUCHON" {{ old('bouchon_product_stock_id') == $stock->id ? 'selected' : '' }}>
                                    {{ $bouchon->name }} - Stock: {{ $stock->global_quantity }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                    <p id="bouchon-stock-info" style="color: #6b7280; font-size: 0.75rem;"></p>
                    @error('bouchon_product_stock_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Joint de sécurité Checkbox -->
                <div style="margin-bottom: 1.5rem; padding: 1.5rem; background: #fef3c7; border-radius: 0.75rem; border: 2px solid #fbbf24;">
                    @if($jointSecurite && $jointSecurite->stock->count() > 0)
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="avec_joint_securite" id="avec_joint_securite" value="1" {{ old('avec_joint_securite') ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; cursor: pointer; margin-right: 0.75rem;">
                            <span style="font-size: 0.875rem; font-weight: 600; color: #1f2937;">🔒 Avec Joint de sécurité</span>
                        </label>
                        <p style="color: #78350f; font-size: 0.75rem; margin-top: 0.5rem; margin-left: 2rem;">
                            Si coché, la même quantité sera appliquée pour le Joint de sécurité.
                            Stock disponible: {{ $jointSecurite->stock->first()->global_quantity }}
                        </p>
                    @else
                        <p style="color: #92400e; font-size: 0.875rem; font-weight: 600;">🔒 Joint de sécurité</p>
                        <p style="color: #b45309; font-size: 0.75rem; margin-top: 0.5rem;">Non disponible - Créez d'abord un produit "Joint de sécurité" et son stock.</p>
                    @endif
                    @error('avec_joint_securite')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem; margin-left: 2rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ticket Checkbox -->
                <div style="margin-bottom: 1.5rem; padding: 1.5rem; background: linear-gradient(135deg, #f3e8ff 0%, #faf5ff 100%); border-radius: 0.75rem; border: 2px solid #d8b4fe;">
                    @if($tickets && $tickets->count() > 0)
                        <label style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0.75rem;">
                            <input type="checkbox" name="avec_ticket" id="avec_ticket" value="1" {{ old('avec_ticket') ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; cursor: pointer; margin-right: 0.75rem; accent-color: #a855f7;">
                            <span style="font-size: 0.95rem; font-weight: 600; color: #1f2937;">🎫 Avec Ticket</span>
                        </label>
                        <p style="color: #6b21a8; font-size: 0.75rem; margin-left: 2rem; margin-top: 0.25rem;">
                            Si coché, spécifiez le produit ticket, le nom de la marque et le numéro d'autorisation.
                        </p>
                        
                        <!-- Hidden ticket fields that show when checkbox is checked -->
                        <div id="ticket-fields" style="display: {{ old('avec_ticket') ? 'block' : 'none' }}; margin-top: 1.25rem; padding: 1.25rem; background: white; border: 2px solid #d8b4fe; border-radius: 0.5rem; box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                                <!-- Ticket Product Selection -->
                                <div>
                                    <label for="ticket_product_stock_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Produit Ticket <span style="color: #dc2626;">*</span></label>
                                    <select name="ticket_product_stock_id" id="ticket_product_stock_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                        <option value="">Sélectionner un ticket</option>
                                        @foreach($tickets as $ticket)
                                            @foreach($ticket->stock as $stock)
                                                <option value="{{ $stock->id }}" data-quantity="{{ $stock->quantity }}" {{ old('ticket_product_stock_id') == $stock->id ? 'selected' : '' }}>
                                                    {{ $ticket->name }} (Stock: {{ $stock->quantity }})
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <p id="ticket-stock-info" style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem; font-weight: 500;"></p>
                                </div>

                                <!-- Ticket Quantity -->
                                <div>
                                    <label for="ticket_quantity" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Quantité de Tickets <span style="color: #dc2626;">*</span></label>
                                    <input type="number" name="ticket_quantity" id="ticket_quantity" min="1" value="{{ old('ticket_quantity') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                    <p id="ticket-quantity-info" style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem; font-weight: 500;"></p>
                                </div>

                                <!-- Brand Name -->
                                <div>
                                    <label for="nom_marque" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Nom de la marque <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="nom_marque" id="nom_marque" value="{{ old('nom_marque') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                </div>

                                <!-- Authorization Number -->
                                <div>
                                    <label for="numero_autorisation" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Numéro d'autorisation <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="numero_autorisation" id="numero_autorisation" value="{{ old('numero_autorisation') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
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

            <!-- Step 3: Quantity Input (applies to BOTH packaging types) -->
            <div class="form-step" data-step="3" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 3: Quantité</h2>
                
                <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 1.5rem;"><strong>⚠️ Attention:</strong> Cette quantité s'applique aux DEUX emballages (PILULIER et BOUCHON).</p>

                <div style="margin-bottom: 1.5rem; padding: 1.5rem; background: #f0fdf4; border-radius: 0.75rem; border: 2px solid #86efac;">
                    <label for="quantity" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Quantité (pour PILULIER ET BOUCHON) <span style="color: #dc2626;">*</span></label>
                    <input type="number" name="quantity" id="quantity" required min="1" value="{{ old('quantity') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 1rem;">
                    <p id="quantity-info" style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;"></p>
                    @error('quantity')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
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
                            <option value="{{ $capsule->id }}" data-quantity="{{ $capsule->quantity }}" {{ old('filled_capsule_id') == $capsule->id ? 'selected' : '' }}>
                                {{ $capsule->herb->name ?? 'Herbe inconnue' }} - Stock: {{ round($capsule->quantity, 2) }} rangées
                            </option>
                        @endforeach
                    </select>
                    @error('filled_capsule_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                    <p id="capsule-info" style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;"></p>
                </div>

                <!-- Capsules Per Unit Selection -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Capsules par unité <span style="color: #dc2626;">*</span></label>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                        @foreach($capsulesPerUnitOptions as $option)
                            <label style="display: flex; align-items: center; padding: 1rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;">
                                <input type="radio" name="capsules_per_unit" value="{{ $option }}" required style="width: 1.25rem; height: 1.25rem; cursor: pointer;" @if(old('capsules_per_unit') == $option) checked @endif>
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
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">QUANTITÉ (×2 emballages)</p>
                            <p id="summary-quantity" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">PILULIER</p>
                            <p id="summary-pilulier" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">BOUCHON</p>
                            <p id="summary-bouchon" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
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
                    <textarea name="notes" id="notes" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; resize: vertical;">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
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
                    ✓ Créer la commande
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
// FIRST: Check for validation errors and jump to step 5 if they exist
// This must be done BEFORE any other DOM queries to avoid script stopping on null elements
const hasErrorsIndicator = document.getElementById('hasErrors');
const shouldJumpToStep5 = hasErrorsIndicator !== null;

if (shouldJumpToStep5) {
    // Validation errors detected - will jump to step 5
} else {
    // No validation errors - will start at step 1
}


// NOW initialize the rest
let currentStep = shouldJumpToStep5 ? 5 : 1;
const totalSteps = 5;

const form = document.getElementById('commandeForm');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');

// Elements for real-time info
const clientSelect = document.getElementById('client_id');
const quantityInput = document.getElementById('quantity');
const pilulierSelect = document.getElementById('pilulier_product_stock_id');
const bouchonSelect = document.getElementById('bouchon_product_stock_id');
const filledCapsuleSelect = document.getElementById('filled_capsule_id');
const capsulesPerUnitInputs = document.querySelectorAll('input[name="capsules_per_unit"]');
const ticketCheckbox = document.getElementById('avec_ticket');
const ticketFields = document.getElementById('ticket-fields');
const ticketProductSelect = document.getElementById('ticket_product_stock_id');
const ticketQuantityInput = document.getElementById('ticket_quantity');
const nomMarqueInput = document.getElementById('nom_marque');
const numeroAutorisationInput = document.getElementById('numero_autorisation');

// Field validation state
const validationState = {
    client: false,  // Client is required - start as false
    pilulier: true,
    bouchon: true,
    capsules: true,
    quantity: true,
    jointSecurite: true,
    tickets: true
};

function showStep(step) {
    // Hide all steps
    document.querySelectorAll('.form-step').forEach(el => el.style.display = 'none');
    
    // Show current step
    const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
    if (currentStepEl) {
        currentStepEl.style.display = 'block';
    }
    
    // Update button visibility
    prevBtn.style.display = step > 1 ? 'block' : 'none';
    nextBtn.style.display = step < totalSteps ? 'block' : 'none';
    submitBtn.style.display = step === totalSteps ? 'block' : 'none';
    
    // Update progress indicator
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
    
    window.scrollTo(0, 0);
}

function setFieldError(fieldId, errorMessage) {
    const field = document.getElementById(fieldId);
    if (!field) return;
    
    // Add error styling to field
    field.style.borderColor = '#dc2626';
    field.style.borderWidth = '2px';
    field.style.backgroundColor = '#fef2f2';
    
    // Create or update error message
    let errorElement = field.parentElement.querySelector('.field-error-message');
    if (!errorElement) {
        errorElement = document.createElement('p');
        errorElement.className = 'field-error-message';
        errorElement.style.color = '#dc2626';
        errorElement.style.fontSize = '0.75rem';
        errorElement.style.marginTop = '0.25rem';
        errorElement.style.fontWeight = '500';
        field.parentElement.appendChild(errorElement);
    }
    errorElement.textContent = errorMessage;
}

function clearFieldError(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) return;
    
    // Remove error styling
    field.style.borderColor = '#d1d5db';
    field.style.borderWidth = '1px';
    field.style.backgroundColor = 'white';
    
    // Remove error message
    const errorElement = field.parentElement.querySelector('.field-error-message');
    if (errorElement) {
        errorElement.remove();
    }
}

function validateStep2() {
    let isValid = true;
    
    // Get quantity from step 3 (will be 0 if not yet entered)
    const pilulierQty = quantityInput.value ? parseInt(quantityInput.value) : 0;
    
    // Validate Pilulier selection
    if (!pilulierSelect.value) {
        setFieldError('pilulier_product_stock_id', 'Veuillez sélectionner un PILULIER');
        validationState.pilulier = false;
        isValid = false;
    } else {
        const pilulierOption = pilulierSelect.options[pilulierSelect.selectedIndex];
        const pilulierStock = pilulierOption?.dataset?.stock ? parseInt(pilulierOption.dataset.stock) : 0;
        
        if (pilulierQty > 0 && pilulierQty > pilulierStock) {
            setFieldError('pilulier_product_stock_id', `Stock PILULIER insuffisant (disponible : ${pilulierStock})`);
            validationState.pilulier = false;
            isValid = false;
        } else {
            clearFieldError('pilulier_product_stock_id');
            validationState.pilulier = true;
        }
    }
    
    // Validate Bouchon selection
    if (!bouchonSelect.value) {
        setFieldError('bouchon_product_stock_id', 'Veuillez sélectionner un BOUCHON');
        validationState.bouchon = false;
        isValid = false;
    } else {
        const bouchonOption = bouchonSelect.options[bouchonSelect.selectedIndex];
        const bouchonStock = bouchonOption?.dataset?.stock ? parseInt(bouchonOption.dataset.stock) : 0;
        
        if (pilulierQty > 0 && pilulierQty > bouchonStock) {
            setFieldError('bouchon_product_stock_id', `Stock BOUCHON insuffisant (disponible : ${bouchonStock})`);
            validationState.bouchon = false;
            isValid = false;
        } else {
            clearFieldError('bouchon_product_stock_id');
            validationState.bouchon = true;
        }
    }
    
    updateNextButtonState();
    return isValid;
}

function validateStep3() {
    let isValid = true;
    
    // Validate Quantity
    const qty = quantityInput.value ? parseInt(quantityInput.value) : 0;
    if (!quantityInput.value || qty < 1) {
        setFieldError('quantity', 'Veuillez entrer une quantité valide (minimum 1)');
        validationState.quantity = false;
        isValid = false;
    } else {
        // Check stock against entered quantity
        const pilulierOption = pilulierSelect.options[pilulierSelect.selectedIndex];
        const pilulierStock = pilulierOption?.dataset?.stock ? parseInt(pilulierOption.dataset.stock) : 0;
        
        const bouchonOption = bouchonSelect.options[bouchonSelect.selectedIndex];
        const bouchonStock = bouchonOption?.dataset?.stock ? parseInt(bouchonOption.dataset.stock) : 0;
        
        // Check if quantity exceeds either PILULIER or BOUCHON stock
        if (qty > pilulierStock) {
            setFieldError('quantity', `Quantité dépasse stock PILULIER (disponible : ${pilulierStock})`);
            validationState.quantity = false;
            isValid = false;
        } else if (qty > bouchonStock) {
            setFieldError('quantity', `Quantité dépasse stock BOUCHON (disponible : ${bouchonStock})`);
            validationState.quantity = false;
            isValid = false;
        } else {
            clearFieldError('quantity');
            validationState.quantity = true;
        }
    }
    
    updateNextButtonState();
    return isValid;
}

function validateStep4() {
    let isValid = true;
    
    const qty = quantityInput.value ? parseInt(quantityInput.value) : 0;
    const capsulesPer = document.querySelector('input[name="capsules_per_unit"]:checked')?.value || 0;
    const totalCapsulesNeeded = qty * capsulesPer;
    
    // Validate Filled Capsules
    if (!filledCapsuleSelect.value) {
        setFieldError('filled_capsule_id', 'Veuillez sélectionner des capsules remplies');
        validationState.capsules = false;
        isValid = false;
    } else {
        const capsuleOption = filledCapsuleSelect.options[filledCapsuleSelect.selectedIndex];
        const availableCapsules = capsuleOption?.dataset?.quantity ? parseFloat(capsuleOption.dataset.quantity) * 420 : 0;
        
        if (totalCapsulesNeeded > 0 && totalCapsulesNeeded > availableCapsules) {
            const availableCapsuleCount = Math.floor(availableCapsules);
            setFieldError('filled_capsule_id', `Stock capsules insuffisant (disponible : ${availableCapsuleCount})`);
            validationState.capsules = false;
            isValid = false;
        } else {
            clearFieldError('filled_capsule_id');
            validationState.capsules = true;
        }
    }
    
    // Validate Capsules Per Unit is selected
    if (!document.querySelector('input[name="capsules_per_unit"]:checked')) {
        const firstRadio = document.querySelector('input[name="capsules_per_unit"]');
        if (firstRadio) {
            setFieldError('capsules_per_unit_container', 'Veuillez sélectionner le nombre de capsules par unité');
            isValid = false;
        }
    } else {
        clearFieldError('capsules_per_unit_container');
    }
    
    // Validate Tickets if enabled
    if (ticketCheckbox && ticketCheckbox.checked) {
        let ticketValid = true;
        
        if (!ticketProductSelect.value) {
            setFieldError('ticket_product_stock_id', 'Veuillez sélectionner un produit ticket');
            ticketValid = false;
        } else {
            const ticketOption = ticketProductSelect.options[ticketProductSelect.selectedIndex];
            const ticketStock = ticketOption?.dataset?.quantity ? parseInt(ticketOption.dataset.quantity) : 0;
            const ticketQty = ticketQuantityInput.value ? parseInt(ticketQuantityInput.value) : 0;
            
            if (ticketQty < 1) {
                setFieldError('ticket_quantity', 'Veuillez entrer une quantité de tickets valide (minimum 1)');
                ticketValid = false;
            } else if (ticketQty > ticketStock) {
                setFieldError('ticket_product_stock_id', `Stock tickets insuffisant (disponible : ${ticketStock})`);
                ticketValid = false;
            } else {
                clearFieldError('ticket_product_stock_id');
                clearFieldError('ticket_quantity');
            }
        }
        
        if (!nomMarqueInput.value || nomMarqueInput.value.trim() === '') {
            setFieldError('nom_marque', 'Le nom de la marque est requis');
            ticketValid = false;
        } else {
            clearFieldError('nom_marque');
        }
        
        if (!numeroAutorisationInput.value || numeroAutorisationInput.value.trim() === '') {
            setFieldError('numero_autorisation', 'Le numéro d\'autorisation est requis');
            ticketValid = false;
        } else {
            clearFieldError('numero_autorisation');
        }
        
        validationState.tickets = ticketValid;
        isValid = isValid && ticketValid;
    } else {
        clearFieldError('ticket_product_stock_id');
        clearFieldError('ticket_quantity');
        clearFieldError('nom_marque');
        clearFieldError('numero_autorisation');
        validationState.tickets = true;
    }
    
    updateNextButtonState();
    return isValid;
}

function updateNextButtonState() {
    const stepsValidation = {
        1: clientSelect.value !== '',
        2: validationState.pilulier && validationState.bouchon,
        3: validationState.quantity,
        4: validationState.capsules && validationState.tickets
    };
    
    const currentStepValid = stepsValidation[currentStep] !== undefined ? stepsValidation[currentStep] : true;
    
    if (currentStep < totalSteps) {
        if (currentStepValid) {
            nextBtn.disabled = false;
            nextBtn.style.opacity = '1';
            nextBtn.style.cursor = 'pointer';
            nextBtn.style.backgroundColor = '#2d7a52';
        } else {
            nextBtn.disabled = true;
            nextBtn.style.opacity = '0.5';
            nextBtn.style.cursor = 'not-allowed';
            nextBtn.style.backgroundColor = '#a0a0a0';
        }
    }
}

function validateStep(step) {
    if (step === 1) {
        if (!clientSelect.value) {
            setFieldError('client_id', 'Veuillez sélectionner un client');
            validationState.client = false;
            updateNextButtonState();
            return false;
        } else {
            clearFieldError('client_id');
            validationState.client = true;
            updateNextButtonState();
            return true;
        }
    } else if (step === 2) {
        const result = validateStep2();
        updateNextButtonState();
        return result;
    } else if (step === 3) {
        const result = validateStep3();
        updateNextButtonState();
        return result;
    } else if (step === 4) {
        const result = validateStep4();
        updateNextButtonState();
        return result;
    }
    updateNextButtonState();
    return true;
}

function updateSummary() {
    // Client
    const clientOption = clientSelect.options[clientSelect.selectedIndex];
    document.getElementById('summary-client').textContent = clientOption.text || '-';
    
    // Quantity
    document.getElementById('summary-quantity').textContent = quantityInput.value ? quantityInput.value + ' × 2 emballages' : '-';
    
    // Pilulier
    const pilulierOption = pilulierSelect.options[pilulierSelect.selectedIndex];
    document.getElementById('summary-pilulier').textContent = pilulierOption.text?.split(' - Stock')[0] || '-';
    
    // Bouchon
    const bouchonOption = bouchonSelect.options[bouchonSelect.selectedIndex];
    document.getElementById('summary-bouchon').textContent = bouchonOption.text?.split(' - Stock')[0] || '-';
    
    // Capsules
    const capsuleOption = filledCapsuleSelect.options[filledCapsuleSelect.selectedIndex];
    document.getElementById('summary-capsules').textContent = capsuleOption.text?.split(' - Stock')[0] || '-';
    
    // Total capsules needed
    const capsulesPer = document.querySelector('input[name="capsules_per_unit"]:checked')?.value || 0;
    const qty = quantityInput.value || 0;
    const totalCapsules = qty * capsulesPer;
    document.getElementById('summary-total-capsules').textContent = totalCapsules + ' capsules';
}

function updateStockInfo() {
    const pilulierOption = pilulierSelect.options[pilulierSelect.selectedIndex];
    const bouchonOption = bouchonSelect.options[bouchonSelect.selectedIndex];
    const capsuleOption = filledCapsuleSelect.options[filledCapsuleSelect.selectedIndex];
    const capsulesPer = document.querySelector('input[name="capsules_per_unit"]:checked')?.value || 30;
    const qty = quantityInput.value || 0;
    
    if (pilulierOption.dataset.stock) {
        document.getElementById('pilulier-stock-info').textContent = `Stock disponible: ${pilulierOption.dataset.stock} unités`;
    }
    
    if (bouchonOption.dataset.stock) {
        document.getElementById('bouchon-stock-info').textContent = `Stock disponible: ${bouchonOption.dataset.stock} unités`;
    }
    
    if (capsuleOption.dataset.quantity) {
        const totalNeeded = qty * capsulesPer;
        document.getElementById('capsule-info').textContent = `Stock: ${capsuleOption.dataset.quantity} rangées | Besoin: ${totalNeeded} capsules`;
    }
    
    if (qty > 0 && capsulesPer) {
        document.getElementById('quantity-info').textContent = `Total: ${qty} × ${capsulesPer} = ${qty * capsulesPer} capsules`;
    }
}

prevBtn.addEventListener('click', () => {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
});

nextBtn.addEventListener('click', () => {
    if (validateStep(currentStep)) {
        currentStep++;
        updateSummary();
        updateStockInfo();
        showStep(currentStep);
    }
});

// Handle form submission
form.addEventListener('submit', (e) => {
    // Validate step 4 before submit
    if (!validateStep(4)) {
        e.preventDefault();
    }
});

// Toggle ticket fields visibility and styling
if (ticketCheckbox) {
    ticketCheckbox.addEventListener('change', function() {
        if (this.checked) {
            ticketFields.style.display = 'block';
            ticketProductSelect.setAttribute('required', 'required');
            ticketQuantityInput.setAttribute('required', 'required');
            nomMarqueInput.setAttribute('required', 'required');
            numeroAutorisationInput.setAttribute('required', 'required');
        } else {
            ticketFields.style.display = 'none';
            ticketProductSelect.removeAttribute('required');
            ticketQuantityInput.removeAttribute('required');
            nomMarqueInput.removeAttribute('required');
            numeroAutorisationInput.removeAttribute('required');
            
            // Clear values and errors
            ticketProductSelect.value = '';
            ticketQuantityInput.value = '';
            nomMarqueInput.value = '';
            numeroAutorisationInput.value = '';
            clearFieldError('ticket_product_stock_id');
            clearFieldError('ticket_quantity');
            clearFieldError('nom_marque');
            clearFieldError('numero_autorisation');
        }
    });
}

// Real-time validation system - validates continuously on every change
function setupRealtimeValidation() {
    
    // ===== STEP 2 VALIDATORS =====
    // Quantity input affects both Pilulier and Bouchon stock validation
    if (quantityInput) {
        ['input', 'change'].forEach(event => {
            quantityInput.addEventListener(event, () => {
                validateStep2();
                updateStockInfo();
            });
        });
    }
    
    // Pilulier selection validator
    if (pilulierSelect) {
        ['change'].forEach(event => {
            pilulierSelect.addEventListener(event, () => {
                validateStep2();
                updateSummary();
                updateStockInfo();
            });
        });
    }
    
    // Bouchon selection validator
    if (bouchonSelect) {
        ['change'].forEach(event => {
            bouchonSelect.addEventListener(event, () => {
                validateStep2();
                updateSummary();
                updateStockInfo();
            });
        });
    }
    
    // ===== STEP 3 VALIDATORS =====
    // Quantity input validator for step 3
    if (quantityInput) {
        ['input', 'change', 'blur'].forEach(event => {
            quantityInput.addEventListener(event, () => {
                validateStep3();
                validateStep2();  // Also revalidate step 2 since quantity affects PILULIER/BOUCHON
                updateStockInfo();
            });
        });
    }
    
    // ===== STEP 4 VALIDATORS =====
    // Filled Capsules validator
    if (filledCapsuleSelect) {
        ['change'].forEach(event => {
            filledCapsuleSelect.addEventListener(event, () => {
                validateStep4();
                updateSummary();
                updateStockInfo();
            });
        });
    }
    
    // Capsules per unit radio buttons
    capsulesPerUnitInputs.forEach(radio => {
        ['change'].forEach(event => {
            radio.addEventListener(event, () => {
                validateStep4();
                updateSummary();
                updateStockInfo();
            });
        });
    });
    
    // Ticket checkbox toggle
    if (ticketCheckbox) {
        ticketCheckbox.addEventListener('change', function() {
            validateStep4();
            if (this.checked) {
                ticketFields.style.display = 'block';
                ticketProductSelect.setAttribute('required', 'required');
                ticketQuantityInput.setAttribute('required', 'required');
                nomMarqueInput.setAttribute('required', 'required');
                numeroAutorisationInput.setAttribute('required', 'required');
            } else {
                ticketFields.style.display = 'none';
                ticketProductSelect.removeAttribute('required');
                ticketQuantityInput.removeAttribute('required');
                nomMarqueInput.removeAttribute('required');
                numeroAutorisationInput.removeAttribute('required');
                ticketProductSelect.value = '';
                ticketQuantityInput.value = '';
                nomMarqueInput.value = '';
                numeroAutorisationInput.value = '';
                clearFieldError('ticket_product_stock_id');
                clearFieldError('ticket_quantity');
                clearFieldError('nom_marque');
                clearFieldError('numero_autorisation');
            }
            updateStockInfo();
        });
    }
    
    // Ticket product selector
    if (ticketProductSelect) {
        ['change'].forEach(event => {
            ticketProductSelect.addEventListener(event, () => {
                validateStep4();
                updateStockInfo();
            });
        });
    }
    
    // Ticket quantity input
    if (ticketQuantityInput) {
        ['input', 'change', 'blur'].forEach(event => {
            ticketQuantityInput.addEventListener(event, () => {
                validateStep4();
                updateStockInfo();
            });
        });
    }
    
    // Nom de marque input
    if (nomMarqueInput) {
        ['input', 'change', 'blur'].forEach(event => {
            nomMarqueInput.addEventListener(event, () => {
                validateStep4();
            });
        });
    }
    
    // Numéro d'autorisation input
    if (numeroAutorisationInput) {
        ['input', 'change', 'blur'].forEach(event => {
            numeroAutorisationInput.addEventListener(event, () => {
                validateStep4();
            });
        });
    }
    
    // ===== STEP 1 VALIDATORS =====
    if (clientSelect) {
        clientSelect.addEventListener('change', () => {
            if (clientSelect.value) {
                validationState.client = true;
                clearFieldError('client_id');
            } else {
                validationState.client = false;
                setFieldError('client_id', 'Veuillez sélectionner un client');
            }
            updateSummary();
            updateNextButtonState();
        });
    }
}

// Attach all validation listeners
setupRealtimeValidation();

// Initialize the form
showStep(currentStep);
updateNextButtonState();  // Initialize button state
if (shouldJumpToStep5) {
    window.scrollTo(0, 0);
    setTimeout(() => {
        updateSummary();
        updateStockInfo();
        updateNextButtonState();
    }, 100);
}
</script>
@endpush
@endsection
