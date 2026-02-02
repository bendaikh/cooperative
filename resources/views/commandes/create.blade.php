@extends('layouts.app')

@section('title', 'Nouvelle Commande - Co-op ERP')
@section('page-title', 'Créer une Commande (Emballage Unifié)')

@section('content')
<div style="max-width: 1000px;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        
        <!-- Error Display -->
        @if($errors->any())
            <div style="background: #fee2e2; border: 3px solid #dc2626; color: #991b1b; padding: 2rem; border-radius: 0.75rem; margin-bottom: 2rem; font-size: 1.1rem; font-weight: 600;" id="errorMessages">
                <p style="margin-bottom: 1rem;">⚠️ ERREURS DE VALIDATION</p>
                <ul style="margin: 0; padding-left: 2rem; list-style: disc;">
                    @foreach($errors->all() as $error)
                        <li style="margin-bottom: 0.75rem; font-size: 1rem;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Progress Steps -->
        <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; position: relative; overflow-x: auto;">
            <div style="position: absolute; top: 20px; left: 0; right: 0; height: 2px; background: #e5e7eb; z-index: 0;"></div>
            
            <div style="flex: 1; text-align: center; position: relative; z-index: 1; min-width: 80px;">
                <div class="step-circle" data-step="1" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #2d7a52; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">1</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Client</p>
            </div>
            <div style="flex: 1; text-align: center; position: relative; z-index: 1; min-width: 80px;">
                <div class="step-circle" data-step="2" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">2</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Type</p>
            </div>
            <div style="flex: 1; text-align: center; position: relative; z-index: 1; min-width: 80px;">
                <div class="step-circle" data-step="3" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">3</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Emballage</p>
            </div>
            <div style="flex: 1; text-align: center; position: relative; z-index: 1; min-width: 80px;">
                <div class="step-circle" data-step="4" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">4</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Quantité</p>
            </div>
            <div style="flex: 1; text-align: center; position: relative; z-index: 1; min-width: 80px;">
                <div class="step-circle" data-step="5" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">5</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Capsules</p>
            </div>
            <div style="flex: 1; text-align: center; position: relative; z-index: 1; min-width: 80px;">
                <div class="step-circle" data-step="6" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">6</div>
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

            <!-- Step 2: Type Selection (With or Without Packaging) -->
            <div class="form-step" data-step="2" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 2: Type de commande</h2>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Que souhaitez-vous commander ? <span style="color: #dc2626;">*</span></label>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <!-- Option 1: With Packaging -->
                        <label style="display: flex; flex-direction: column; align-items: center; padding: 2rem; border: 3px solid #e5e7eb; border-radius: 0.75rem; cursor: pointer; transition: all 0.3s; background: white;">
                            <input type="radio" name="commande_type" id="type_with_packaging" value="with_packaging" required style="width: 1.5rem; height: 1.5rem; cursor: pointer; margin-bottom: 0.75rem;" {{ old('commande_type') == 'with_packaging' || !old('commande_type') ? 'checked' : '' }}>
                            <span style="font-size: 1.5rem; margin-bottom: 0.5rem;">📦</span>
                            <span style="font-weight: 600; color: #1f2937; text-align: center;">Capsules + Emballage</span>
                            <span style="font-size: 0.75rem; color: #6b7280; text-align: center; margin-top: 0.5rem;">Capsules remplies avec emballage complet</span>
                        </label>

                        <!-- Option 2: Without Packaging -->
                        <label style="display: flex; flex-direction: column; align-items: center; padding: 2rem; border: 3px solid #e5e7eb; border-radius: 0.75rem; cursor: pointer; transition: all 0.3s; background: white;">
                            <input type="radio" name="commande_type" id="type_without_packaging" value="without_packaging" required style="width: 1.5rem; height: 1.5rem; cursor: pointer; margin-bottom: 0.75rem;" {{ old('commande_type') == 'without_packaging' ? 'checked' : '' }}>
                            <span style="font-size: 1.5rem; margin-bottom: 0.5rem;">💊</span>
                            <span style="font-weight: 600; color: #1f2937; text-align: center;">Capsules seules</span>
                            <span style="font-size: 0.75rem; color: #6b7280; text-align: center; margin-top: 0.5rem;">Uniquement capsules remplies sans emballage</span>
                        </label>
                    </div>
                    @error('commande_type')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 3: Emballage Selection (UNIFIED) - Only show if with_packaging -->
            <div class="form-step" data-step="3" style="display: none;" id="step-packaging">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 3: Sélectionner l'emballage</h2>
                
                <!-- Single Emballage Selection -->
                <div style="margin-bottom: 2rem; padding: 1.5rem; background: #f9fafb; border-radius: 0.75rem; border: 2px solid #e5e7eb;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">📦 Emballage <span style="color: #dc2626;">*</span></label>
                    
                    <select name="emballage_product_stock_id" id="emballage_product_stock_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; margin-bottom: 0.5rem;">
                        <option value="">Sélectionner un emballage</option>
                        @foreach($emballages as $emballage)
                            @foreach($emballage->stock as $stock)
                                <option value="{{ $stock->id }}" data-stock="{{ $stock->global_quantity }}" data-price="{{ $stock->purchase_price ?? 0 }}" {{ old('emballage_product_stock_id') == $stock->id ? 'selected' : '' }}>
                                    {{ $emballage->name }} - Stock: {{ $stock->global_quantity }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                    <p id="emballage-stock-info" style="color: #6b7280; font-size: 0.75rem;"></p>
                    @error('emballage_product_stock_id')
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
                    <label style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0.75rem;">
                        <input type="checkbox" name="avec_ticket" id="avec_ticket" value="1" {{ old('avec_ticket') ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; cursor: pointer; margin-right: 0.75rem; accent-color: #a855f7;">
                        <span style="font-size: 0.95rem; font-weight: 600; color: #1f2937;">🎫 Avec Ticket</span>
                    </label>
                    <p style="color: #6b21a8; font-size: 0.75rem; margin-left: 2rem; margin-top: 0.25rem;">
                        Si coché, spécifiez le type de ticket (PAPIER ou VINELLE), la quantité, le nom de la marque et le numéro d'autorisation.
                    </p>
                        
                        <!-- Hidden ticket fields that show when checkbox is checked -->
                        <div id="ticket-fields" style="display: {{ old('avec_ticket') ? 'block' : 'none' }}; margin-top: 1.25rem; padding: 1.25rem; background: white; border: 2px solid #d8b4fe; border-radius: 0.5rem; box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                                <div>
                                    <label for="ticket_product_stock_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Produit Ticket <span style="color: #dc2626;">*</span></label>
                                    <select name="ticket_product_stock_id" id="ticket_product_stock_id" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                        <option value="">Sélectionner un produit ticket</option>
                                        @foreach($tickets as $ticket)
                                            @foreach($ticket->stock as $ticketStock)
                                                <option value="{{ $ticketStock->id }}" {{ old('ticket_product_stock_id') == $ticketStock->id ? 'selected' : '' }}>
                                                    {{ $ticket->name }} - Stock: {{ $ticketStock->global_quantity }} unités
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('ticket_product_stock_id')
                                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="ticket_type" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Type de Ticket <span style="color: #dc2626;">*</span></label>
                                    <select name="ticket_type" id="ticket_type" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                        <option value="">Sélectionner un type</option>
                                        <option value="PAPIER" {{ old('ticket_type') == 'PAPIER' ? 'selected' : '' }}>Ticket PAPIER</option>
                                        <option value="VINELLE" {{ old('ticket_type') == 'VINELLE' ? 'selected' : '' }}>Ticket VINELLE</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="ticket_quantity" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Quantité de Tickets <span style="color: #dc2626;">*</span></label>
                                    <input type="number" name="ticket_quantity" id="ticket_quantity" min="0.001" step="0.001" value="{{ old('ticket_quantity') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                    @error('ticket_quantity')
                                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nom_marque" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Nom de la marque <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="nom_marque" id="nom_marque" value="{{ old('nom_marque') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                    @error('nom_marque')
                                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="numero_autorisation" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Numéro d'autorisation <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="numero_autorisation" id="numero_autorisation" value="{{ old('numero_autorisation') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                    @error('numero_autorisation')
                                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @error('avec_ticket')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem; margin-left: 2rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 4: Quantity Input -->
            <div class="form-step" data-step="4" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 4: Quantité</h2>
                
                <div style="margin-bottom: 1.5rem; padding: 1.5rem; background: #f0fdf4; border-radius: 0.75rem; border: 2px solid #86efac;">
                    <label for="quantity" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Quantité d'emballage <span style="color: #dc2626;">*</span></label>
                    <input type="number" name="quantity" id="quantity" min="0.001" step="0.001" value="{{ old('quantity') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 1rem;">
                    <p id="quantity-info" style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;"></p>
                    @error('quantity')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 5: Filled Capsules Selection -->
            <div class="form-step" data-step="5" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 5: Capsules remplies</h2>
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="filled_capsule_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Sélectionner les capsules remplies <span style="color: #dc2626;">*</span></label>
                    <select name="filled_capsule_id" id="filled_capsule_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;">
                        <option value="">Sélectionner des capsules remplies</option>
                        @foreach($filledCapsules as $capsule)
                            <option value="{{ $capsule->id }}" 
                                data-quantity="{{ $capsule->quantity }}" 
                                data-herb-quantity="{{ $capsule->herb_quantity ?? 0 }}" 
                                data-herb-price="{{ $capsule->herb->purchase_price ?? 0 }}" 
                                data-carton-price="{{ $capsule->capsule->cartonType->purchase_price ?? ($capsule->capsule->carton_price ?? 0) }}" 
                                data-carton-capacity="{{ $capsule->capsule->cartonType->capacity ?? 0 }}" 
                                {{ old('filled_capsule_id') == $capsule->id ? 'selected' : '' }}>
                                {{ $capsule->herb->name ?? 'Herbe inconnue' }} - Stock: {{ round($capsule->quantity, 2) }} rangées
                            </option>
                        @endforeach
                    </select>
                    @error('filled_capsule_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                    <p id="capsule-info" style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;"></p>
                </div>

                <!-- Capsules Per Unit Selection (for with_packaging) or Quantity Input (for without_packaging) -->
                <div id="capsules-per-unit-section" style="margin-bottom: 1.5rem;">
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

                <!-- Capsules Quantity Input (for without_packaging) -->
                <div id="capsules-quantity-section" style="margin-bottom: 1.5rem; display: none;">
                    <label for="capsules_quantity_input" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Quantité de capsules <span style="color: #dc2626;">*</span></label>
                    <input type="number" id="capsules_quantity_input" name="capsules_quantity_input" min="1" step="1" placeholder="Entrez la quantité de capsules" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;">
                    <p style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;">Entrez le nombre total de capsules que vous souhaitez commander.</p>
                </div>
            </div>

            <!-- Step 6: Summary -->
            <div class="form-step" data-step="6" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 6: Résumé de la commande</h2>
                
                <!-- Order Details Summary -->
                <div style="padding: 1.5rem; background: #f9fafb; border-radius: 0.75rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">📋 Détails de la commande</h3>
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
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">CAPSULES PAR UNITÉ</p>
                            <p id="summary-capsules-per-unit" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">TOTAL CAPSULES</p>
                            <p id="summary-total-capsules" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                    </div>
                </div>

                <!-- Cost Breakdown -->
                <div style="padding: 1.5rem; background: #f3f4f6; border-radius: 0.75rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">💰 Calcul du Coût</h3>
                    <div style="display: grid; gap: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Coût Emballage</span>
                            <span id="cost-emballage" style="font-weight: 500; color: #1f2937;">0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Coût Capsules (vides)</span>
                            <span id="cost-capsules" style="font-weight: 500; color: #1f2937;">0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Quantité Herbe Utilisée (g)</span>
                            <span id="herb-quantity-grams" style="font-weight: 500; color: #1f2937;">0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Coût Matière Herbale (kg × Prix)</span>
                            <span id="cost-herb-material" style="font-weight: 500; color: #1f2937;">0.00</span>
                        </div>
                        <div id="cost-joint-row" style="display: none; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Coût Joint de Sécurité</span>
                            <span id="cost-joint" style="font-weight: 500; color: #1f2937;">0.00</span>
                        </div>
                        <div id="cost-ticket-row" style="display: none; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Coût Ticket</span>
                            <span id="cost-ticket" style="font-weight: 500; color: #1f2937;">0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 1rem 0; font-weight: 600; font-size: 1.125rem; color: #2d7a52;">
                            <span>Coût Total</span>
                            <span id="total-cost">0.00 DH</span>
                        </div>
                    </div>
                </div>

                <!-- Selling Price & Profit -->
                <div style="padding: 1.5rem; background: #fef3c7; border: 2px solid #fbbf24; border-radius: 0.75rem; margin-bottom: 1.5rem;">
                    <h3 style="margin-top: 0; color: #92400e; font-size: 1rem; font-weight: 600; margin-bottom: 1rem;">💵 Prix de Vente & Profit</h3>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="selling_price" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Prix de Vente (DH) <span style="color: #dc2626;">*</span></label>
                        <input 
                            type="number" 
                            id="selling_price" 
                            name="selling_price" 
                            required 
                            min="0" 
                            step="0.01"
                            placeholder="0.00"
                            style="width: 100%; padding: 0.75rem; border: 2px solid #fbbf24; border-radius: 0.5rem; outline: none; font-size: 1rem; font-weight: 500;"
                            oninput="calculateProfit()"
                            value="{{ old('selling_price') }}"
                        >
                    </div>

                    <div style="background: white; border-radius: 0.5rem; padding: 1rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                            <div>
                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0 0 0.25rem 0;">Profit</p>
                                <p id="profit-display" style="color: #2d7a52; font-size: 1.25rem; font-weight: 600; margin: 0;">0.00 DH</p>
                            </div>
                            <div>
                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0 0 0.25rem 0;">Marge (%)</p>
                                <p id="margin-display" style="color: #2d7a52; font-size: 1.125rem; font-weight: 600; margin: 0;">0.00%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="notes" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Notes (optionnel)</label>
                    <textarea name="notes" id="notes" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; resize: vertical;">{{ old('notes') }}</textarea>
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
// Define prices from controller
const JOINT_SECURITE_PRICE = {{ $jointSecuritePrice ?? 0 }}; // DH per unit
const TICKET_PRICES = {
    'PAPIER': {{ $ticketPrices['PAPIER'] ?? 0 }},
    'VINELLE': {{ $ticketPrices['VINELLE'] ?? 0 }}
}; // DH per unit per type

let currentStep = 1;
const totalSteps = 6;

const form = document.getElementById('commandeForm');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');

const clientSelect = document.getElementById('client_id');
const commandeTypeRadios = document.querySelectorAll('input[name="commande_type"]');
const quantityInput = document.getElementById('quantity');
const emballageSelect = document.getElementById('emballage_product_stock_id');
const filledCapsuleSelect = document.getElementById('filled_capsule_id');
const capsulesPerUnitInputs = document.querySelectorAll('input[name="capsules_per_unit"]');
const ticketCheckbox = document.getElementById('avec_ticket');
const ticketFields = document.getElementById('ticket-fields');

const validationState = {
    client: false,
    emballage: true,
    quantity: true,
    capsules: true,
    tickets: true
};

// Format number as currency (2 decimal places)
function formatCurrency(value) {
    const num = parseFloat(value) || 0;
    return num.toFixed(2);
}

// Calculate and display costs when entering Step 5
function calculateCosts() {
    // Get form values
    const commandeType = document.querySelector('input[name="commande_type"]:checked')?.value;
    const filledCapsuleId = filledCapsuleSelect.value;
    const capsulesPerUnit = parseFloat(document.querySelector('input[name="capsules_per_unit"]:checked')?.value) || 0;
    
    let quantity = 0;
    let totalCapsules = 0;
    
    if (commandeType === 'with_packaging') {
        // With packaging: quantity is emballage packages, total capsules = quantity * capsules_per_unit
        quantity = parseFloat(quantityInput.value) || 0;
        totalCapsules = quantity * capsulesPerUnit;
    } else {
        // Without packaging: get quantity from the capsule quantity input field
        quantity = 0; // No packaging
        const capsuleQuantityInput = document.getElementById('capsules_quantity_input');
        totalCapsules = parseFloat(capsuleQuantityInput.value) || 0; // The input value IS the total capsules wanted
    }
    
    const hasJointSecurite = (commandeType === 'with_packaging') && (document.getElementById('avec_joint_securite')?.checked || false);
    const hasTicket = document.getElementById('avec_ticket')?.checked || false;

    // Get emballage price from data attribute (set in the option) - only if with_packaging
    let emballagePrice = 0;
    if (commandeType === 'with_packaging') {
        const emballageOption = emballageSelect.options[emballageSelect.selectedIndex];
        emballagePrice = parseFloat(emballageOption.dataset?.price) || 0;
    }

    // Get filled capsule carton price, herb price, and quantity from data attribute
    const filledCapsuleOption = filledCapsuleSelect.options[filledCapsuleSelect.selectedIndex];
    const cartonPrice = parseFloat(filledCapsuleOption.dataset?.cartonPrice) || 0; // price per carton
    const cartonCapacity = parseFloat(filledCapsuleOption.dataset?.cartonCapacity) || 0; // total capsules in carton
    const herbPrice = parseFloat(filledCapsuleOption.dataset?.herbPrice) || 0; // price per kg
    const herbQuantity = parseFloat(filledCapsuleOption.dataset?.herbQuantity) || 0; // TOTAL kg for entire batch (NOT per rangée)
    const filledCapsuleQuantity = parseFloat(filledCapsuleOption.dataset?.quantity) || 0; // quantity in rangées in the batch

    // Calculate emballage cost (only if with_packaging)
    const costEmballage = (commandeType === 'with_packaging') ? emballagePrice * quantity : 0;
    document.getElementById('cost-emballage').textContent = formatCurrency(costEmballage);

    // Calculate filled capsule cost (capsule + herb material) - SEPARATE
    // CAPSULES: Price per Capsule = cartonPrice / cartonCapacity (fixed unit cost based on carton structure)
    // HERB: Price per Rangée = herbPrice (DH/kg) × herbQuantity (kg per rangée)
    //       Price per Capsule = herbPricePerRangée / 420
    
    let costCapsulePerUnit = 0;
    let costHerbPerUnit = 0;
    
    // Capsule cost uses carton capacity (total structure)
    if (cartonCapacity > 0) {
        costCapsulePerUnit = cartonPrice / cartonCapacity; // cost per empty capsule (true unit cost)
    }
    
    // Herb cost: PROPORTIONAL to capsules ordered
    let herbQuantityGrams = 0; // quantity in grams for display
    
    if (filledCapsuleQuantity > 0) {
        // Calculate herb cost per capsule
        // herbQuantity = total kg for entire batch
        // filledCapsuleQuantity = total rangées in batch
        const totalCapsulesInBatch = filledCapsuleQuantity * 420; // 1 rangée = 420 capsules
        
        // Herb quantity used for this order (proportional)
        herbQuantityGrams = (totalCapsules / totalCapsulesInBatch) * herbQuantity * 1000; // convert kg to grams
        
        const herbCostPerCapsule = (herbQuantity * herbPrice) / totalCapsulesInBatch;
        costHerbPerUnit = herbCostPerCapsule; // cost per capsule
    }
    
    // Calculate totals for all capsules used
    const costCapsules = costCapsulePerUnit * totalCapsules; // total capsule cost
    const costHerbMaterial = costHerbPerUnit * totalCapsules; // total herb material cost
    
    // Display separately
    document.getElementById('cost-capsules').textContent = formatCurrency(costCapsules);
    document.getElementById('herb-quantity-grams').textContent = herbQuantityGrams.toFixed(2) + ' g';
    document.getElementById('cost-herb-material').textContent = formatCurrency(costHerbMaterial);

    // Handle conditional costs
    let costJoint = 0;
    let costTicket = 0;

    if (hasJointSecurite) {
        document.getElementById('cost-joint-row').style.display = 'flex';
        // Use actual price from database
        costJoint = JOINT_SECURITE_PRICE * quantity;
        document.getElementById('cost-joint').textContent = formatCurrency(costJoint);
    } else {
        document.getElementById('cost-joint-row').style.display = 'none';
    }

    if (hasTicket) {
        document.getElementById('cost-ticket-row').style.display = 'flex';
        // Use actual price from database based on ticket type
        const ticketQuantity = parseFloat(document.getElementById('ticket_quantity')?.value) || 0;
        const ticketType = document.getElementById('ticket_type')?.value || 'PAPIER';
        const ticketPrice = TICKET_PRICES[ticketType] || 0;
        costTicket = ticketPrice * ticketQuantity;
        document.getElementById('cost-ticket').textContent = formatCurrency(costTicket);
    } else {
        document.getElementById('cost-ticket-row').style.display = 'none';
    }

    // Calculate and store total cost
    const totalCost = costEmballage + costCapsules + costHerbMaterial + costJoint + costTicket;
    document.getElementById('total-cost').textContent = formatCurrency(totalCost) + ' DH';
    
    // Store total cost in data attribute for profit calculation
    document.getElementById('commandeForm').dataset.totalCost = totalCost;
}

// Calculate profit and margin percentage
function calculateProfit() {
    const sellingPrice = parseFloat(document.getElementById('selling_price').value) || 0;
    const totalCost = parseFloat(document.getElementById('commandeForm').dataset.totalCost) || 0;

    const profit = sellingPrice - totalCost;
    const marginPercentage = totalCost > 0 ? (profit / totalCost) * 100 : 0;

    document.getElementById('profit-display').textContent = formatCurrency(profit) + ' DH';
    document.getElementById('margin-display').textContent = formatCurrency(marginPercentage) + '%';
}

function showStep(step) {
    document.querySelectorAll('.form-step').forEach(el => el.style.display = 'none');
    
    const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
    if (currentStepEl) {
        currentStepEl.style.display = 'block';
    }

    // Hide packaging step if without_packaging is selected
    const commandeType = document.querySelector('input[name="commande_type"]:checked')?.value;
    const stepPackaging = document.getElementById('step-packaging');
    if (stepPackaging && commandeType === 'without_packaging') {
        stepPackaging.style.display = 'none';
    }

    // Calculate costs when entering Step 6
    if (step === 6) {
        calculateCosts();
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
    const commandeType = document.querySelector('input[name="commande_type"]:checked')?.value;
    
    const clientOption = clientSelect.options[clientSelect.selectedIndex];
    document.getElementById('summary-client').textContent = clientOption.text || '-';
    
    // Different logic for with_packaging vs without_packaging
    if (commandeType === 'with_packaging') {
        document.getElementById('summary-quantity').textContent = quantityInput.value || '-';
        const emballageOption = emballageSelect.options[emballageSelect.selectedIndex];
        document.getElementById('summary-emballage').textContent = emballageOption.text || '-';
        
        const qty = parseFloat(quantityInput.value) || 0;
        const cpuVal = document.querySelector('input[name="capsules_per_unit"]:checked')?.value || 0;
        const totalCapsules = qty * cpuVal;
        document.getElementById('summary-capsules-per-unit').textContent = cpuVal > 0 ? cpuVal : '-';
        document.getElementById('summary-total-capsules').textContent = totalCapsules > 0 ? totalCapsules : '-';
    } else {
        // Without packaging
        document.getElementById('summary-quantity').textContent = 'N/A - Sans emballage';
        document.getElementById('summary-emballage').textContent = 'N/A - Sans emballage';
        
        // For without_packaging: the capsules_per_unit selection IS the total number of capsules
        const cpuVal = document.querySelector('input[name="capsules_per_unit"]:checked')?.value || 0;
        document.getElementById('summary-capsules-per-unit').textContent = cpuVal > 0 ? cpuVal + ' unités' : '-';
        document.getElementById('summary-total-capsules').textContent = cpuVal > 0 ? cpuVal : '-';
    }
    
    const capsuleOption = filledCapsuleSelect.options[filledCapsuleSelect.selectedIndex];
    document.getElementById('summary-capsules').textContent = capsuleOption.text || '-';
}

function canAdvanceToNextStep() {
    const commandeType = document.querySelector('input[name="commande_type"]:checked')?.value;
    
    if (currentStep === 1) {
        return clientSelect.value !== '';
    } else if (currentStep === 2) {
        return document.querySelector('input[name="commande_type"]:checked') !== null;
    } else if (currentStep === 3) {
        // Step 3 is emballage - only required if with_packaging
        if (commandeType === 'without_packaging') {
            return true; // Skip emballage step
        }
        return emballageSelect.value !== '';
    } else if (currentStep === 4) {
        // Step 4 is quantity - only required if with_packaging
        if (commandeType === 'without_packaging') {
            return true; // Skip quantity step, it's set to 0
        }
        return quantityInput.value && parseFloat(quantityInput.value) >= 0.001;
    } else if (currentStep === 5) {
        // Step 5: Filled capsules selection
        // Must have filled capsule selected
        if (filledCapsuleSelect.value === '') {
            return false;
        }
        
        // Check capsule quantity based on commande type
        if (commandeType === 'with_packaging') {
            // Must have capsules_per_unit selected
            return document.querySelector('input[name="capsules_per_unit"]:checked') !== null;
        } else {
            // Must have capsules_quantity_input filled
            const capsulesQuantityInput = document.getElementById('capsules_quantity_input');
            return capsulesQuantityInput && capsulesQuantityInput.value && parseFloat(capsulesQuantityInput.value) >= 1;
        }
    } else if (currentStep === 6) {
        // Step 6 is the final step - validate selling_price is filled
        const sellingPrice = parseFloat(document.getElementById('selling_price').value) || 0;
        return sellingPrice > 0;
    }
    return true;
}

nextBtn.addEventListener('click', () => {
    if (!canAdvanceToNextStep()) {
        if (currentStep === 6) {
            alert('Veuillez entrer un prix de vente supérieur à 0.');
        } else {
            alert('Veuillez remplir tous les champs requis de cette étape.');
        }
        return;
    }
    
    if (currentStep < totalSteps) {
        currentStep++;
        
        // Skip step 3 (emballage) if without_packaging is selected
        const commandeType = document.querySelector('input[name="commande_type"]:checked')?.value;
        if (currentStep === 3 && commandeType === 'without_packaging') {
            currentStep++; // Skip to step 4
        }
        
        // Skip step 4 (quantity for emballage) if without_packaging is selected
        if (currentStep === 4 && commandeType === 'without_packaging') {
            currentStep++; // Skip to step 5
        }
        
        showStep(currentStep);
    }
});

prevBtn.addEventListener('click', () => {
    if (currentStep > 1) {
        currentStep--;
        
        // Skip steps when going backwards if without_packaging
        const commandeType = document.querySelector('input[name="commande_type"]:checked')?.value;
        if (currentStep === 4 && commandeType === 'without_packaging') {
            currentStep--; // Skip step 4
        }
        if (currentStep === 3 && commandeType === 'without_packaging') {
            currentStep--; // Skip step 3
        }
        
        showStep(currentStep);
    }
});

// Handle submit button click
submitBtn.addEventListener('click', (e) => {
    e.preventDefault();
    
    // Check if selling price is filled
    const sellingPrice = parseFloat(document.getElementById('selling_price').value) || 0;
    if (sellingPrice <= 0) {
        alert('Veuillez entrer un prix de vente supérieur à 0.');
        return;
    }
    
    // Submit the form
    form.submit();
});

ticketCheckbox.addEventListener('change', () => {
    ticketFields.style.display = ticketCheckbox.checked ? 'block' : 'none';
});

// Handle commande type change
commandeTypeRadios.forEach(radio => {
    radio.addEventListener('change', () => {
        const commandeType = radio.value;
        const stepPackaging = document.getElementById('step-packaging');
        const capsulesPerUnitSection = document.getElementById('capsules-per-unit-section');
        const capsulesQuantitySection = document.getElementById('capsules-quantity-section');
        
        if (commandeType === 'without_packaging') {
            // Make emballage and quantity not required and set placeholder values
            emballageSelect.removeAttribute('required');
            quantityInput.removeAttribute('required');
            emballageSelect.value = ''; // Clear emballage selection
            quantityInput.value = '0'; // Set quantity to 0 (no packaging)
            if (stepPackaging) stepPackaging.style.display = 'none';
            
            // Show capsule quantity input, hide radio buttons
            if (capsulesPerUnitSection) capsulesPerUnitSection.style.display = 'none';
            if (capsulesQuantitySection) capsulesQuantitySection.style.display = 'block';
            
            // Remove required from radio buttons, add to quantity input
            capsulesPerUnitInputs.forEach(input => input.removeAttribute('required'));
            document.getElementById('capsules_quantity_input').setAttribute('required', 'required');
        } else {
            // Make emballage and quantity required
            emballageSelect.setAttribute('required', 'required');
            quantityInput.setAttribute('required', 'required');
            quantityInput.value = ''; // Clear quantity to force user input
            if (stepPackaging) stepPackaging.style.display = 'block';
            
            // Show radio buttons, hide quantity input
            if (capsulesPerUnitSection) capsulesPerUnitSection.style.display = 'block';
            if (capsulesQuantitySection) capsulesQuantitySection.style.display = 'none';
            
            // Add required to radio buttons, remove from quantity input
            capsulesPerUnitInputs.forEach(input => input.setAttribute('required', 'required'));
            const quantityInput = document.getElementById('capsules_quantity_input');
            if (quantityInput) quantityInput.removeAttribute('required');
        }
        updateSummary();
    });
});

[clientSelect, emballageSelect, quantityInput, filledCapsuleSelect, ...capsulesPerUnitInputs].forEach(el => {
    el.addEventListener('change', updateSummary);
    el.addEventListener('input', updateSummary);
});

// Add event listener for capsule quantity input (without_packaging)
const capsulesQuantityInput = document.getElementById('capsules_quantity_input');
if (capsulesQuantityInput) {
    capsulesQuantityInput.addEventListener('change', updateSummary);
    capsulesQuantityInput.addEventListener('input', updateSummary);
}

// Update summary when ticket type or quantity changes
const ticketTypeSelect = document.getElementById('ticket_type');
const ticketQuantityInput = document.getElementById('ticket_quantity');
if (ticketTypeSelect) ticketTypeSelect.addEventListener('change', updateSummary);
if (ticketQuantityInput) ticketQuantityInput.addEventListener('input', updateSummary);

showStep(currentStep);
</script>
@endpush

@endsection
