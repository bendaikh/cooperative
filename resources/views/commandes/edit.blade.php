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
            
            @if($commande->commande_type === 'with_packaging')
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
            @else
            <div style="flex: 1; text-align: center; position: relative; z-index: 1;">
                <div class="step-circle" data-step="2" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">2</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Capsules</p>
            </div>
            
            <div style="flex: 1; text-align: center; position: relative; z-index: 1;">
                <div class="step-circle" data-step="3" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; border-radius: 50%; background: #e5e7eb; color: #4b5563; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem;">3</div>
                <p style="font-size: 0.75rem; color: #4b5563; font-weight: 500;">Résumé</p>
            </div>
            @endif
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
                
                <!-- Show Current Commande Type as Info -->
                <div style="margin-bottom: 1.5rem; padding: 1rem; background: #f0fdf4; border-radius: 0.75rem; border-left: 4px solid #22c55e;">
                    <div style="font-size: 0.875rem; font-weight: 600; color: #166534; margin-bottom: 0.25rem;">ℹ️ Type de commande</div>
                    <div style="font-size: 0.9375rem; color: #166534;">
                        @if($commande->commande_type === 'with_packaging')
                            📦 Capsules + Emballage
                        @else
                            💊 Capsules seules
                        @endif
                    </div>
                </div>
                
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

            <!-- Step 2: Filled Capsules & Quantity - Only for without_packaging -->
            @if($commande->commande_type === 'without_packaging')
            <div class="form-step" data-step="2" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 2: Capsules et Quantité</h2>
                
                <!-- Filled Capsules Selection -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="filled_capsule_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Sélectionner les capsules remplies <span style="color: #dc2626;">*</span></label>
                    <select name="filled_capsule_id" id="filled_capsule_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none;">
                        <option value="">Sélectionner des capsules remplies</option>
                        @foreach($filledCapsules as $capsule)
                            <option value="{{ $capsule->id }}" 
                                data-quantity="{{ $capsule->quantity }}" 
                                data-herb-quantity="{{ $capsule->herb_quantity ?? 0 }}" 
                                data-herb-price="{{ $capsule->herb->purchase_price ?? 0 }}" 
                                data-carton-price="{{ ($capsule->capsule->cartonType->purchase_price ?? 0) != 0 ? $capsule->capsule->cartonType->purchase_price : ($capsule->capsule->carton_price ?? 0) }}" 
                                data-carton-capacity="{{ $capsule->capsule->cartonType->capacity ?? 0 }}" 
                                {{ $commande->filledCapsules()->first()?->filled_capsule_id == $capsule->id ? 'selected' : '' }}>
                                {{ $capsule->herb->name ?? 'Herbe inconnue' }} - Stock: {{ round($capsule->quantity, 2) }} rangées
                            </option>
                        @endforeach
                    </select>
                    @error('filled_capsule_id')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capsule Quantity Input for without_packaging -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="capsules_quantity_input" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Quantité de capsules <span style="color: #dc2626;">*</span></label>
                    <input type="number" name="capsules_quantity_input" id="capsules_quantity_input" required min="1" value="{{ old('capsules_quantity_input', $commande->filledCapsules()->first()?->quantity ?? '') }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 1rem;">
                    <p id="capsules-qty-info" style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;"></p>
                    @error('capsules_quantity_input')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem; font-weight: 600;">❌ {{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif

            <!-- Step 2: Emballage Selection (UNIFIED) - Only for with_packaging -->
            @if($commande->commande_type === 'with_packaging')
            <div class="form-step" data-step="2" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">Étape 2: Sélectionner l'emballage</h2>
                
                <!-- Single Emballage Selection -->
                <div style="margin-bottom: 2rem; padding: 1.5rem; background: #f9fafb; border-radius: 0.75rem; border: 2px solid #e5e7eb;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">📦 Emballage <span style="color: #dc2626;">*</span></label>
                    
                    <select name="emballage_product_stock_id" id="emballage_product_stock_id" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; margin-bottom: 0.5rem;">
                        <option value="">Sélectionner un emballage</option>
                        @foreach($emballages as $emballage)
                            @foreach($emballage->stock as $stock)
                                <option value="{{ $stock->id }}" data-stock="{{ $stock->global_quantity }}" data-price="{{ $stock->purchase_price ?? 0 }}" {{ $currentEmballage && $currentEmballage->product_stock_id == $stock->id ? 'selected' : '' }}>
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
                                        <option value="">Sélectionner un produit ticket</option>
                                        @foreach($tickets as $ticket)
                                            @foreach($ticket->stock as $ticketStock)
                                                <option value="{{ $ticketStock->id }}" {{ $commande->ticket_product_stock_id == $ticketStock->id ? 'selected' : '' }}>
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
                                        <option value="PAPIER" {{ $commande->tickets()->first()?->ticket_type == 'PAPIER' ? 'selected' : '' }}>Ticket PAPIER</option>
                                        <option value="VINELLE" {{ $commande->tickets()->first()?->ticket_type == 'VINELLE' ? 'selected' : '' }}>Ticket VINELLE</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="ticket_quantity" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Quantité de Tickets <span style="color: #dc2626;">*</span></label>
                                    <input type="number" name="ticket_quantity" id="ticket_quantity" min="0.001" step="0.001" value="{{ $commande->tickets()->first()?->quantity ?? '' }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                    @error('ticket_quantity')
                                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nom_marque" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Nom de la marque <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="nom_marque" id="nom_marque" value="{{ $commande->tickets()->first()?->nom_marque ?? '' }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                    @error('nom_marque')
                                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="numero_autorisation" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Numéro d'autorisation <span style="color: #dc2626;">*</span></label>
                                    <input type="text" name="numero_autorisation" id="numero_autorisation" value="{{ $commande->tickets()->first()?->numero_autorisation ?? '' }}" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-size: 0.875rem;">
                                    @error('numero_autorisation')
                                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                                    @enderror
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
            @endif

            <!-- Step 3: Quantity Input - Only for with_packaging -->
            @if($commande->commande_type === 'with_packaging')
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
                            <option value="{{ $capsule->id }}" 
                                data-quantity="{{ $capsule->quantity }}" 
                                data-herb-quantity="{{ $capsule->herb_quantity ?? 0 }}" 
                                data-herb-price="{{ $capsule->herb->purchase_price ?? 0 }}" 
                                data-carton-price="{{ ($capsule->capsule->cartonType->purchase_price ?? 0) != 0 ? $capsule->capsule->cartonType->purchase_price : ($capsule->capsule->carton_price ?? 0) }}" 
                                data-carton-capacity="{{ $capsule->capsule->cartonType->capacity ?? 0 }}" 
                                {{ $commande->filledCapsules()->first()?->filled_capsule_id == $capsule->id ? 'selected' : '' }}>
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
            @endif

            <!-- Step 5/3: Summary -->
            <div class="form-step" data-step="{{ $commande->commande_type === 'with_packaging' ? '5' : '3' }}" style="display: none;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; color: #1f2937;">{{ $commande->commande_type === 'with_packaging' ? 'Étape 5: Résumé de la commande' : 'Étape 3: Résumé de la commande' }}</h2>
                
                <div style="padding: 1.5rem; background: #f9fafb; border-radius: 0.75rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">CLIENT</p>
                            <p id="summary-client" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        @if($commande->commande_type === 'with_packaging')
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">QUANTITÉ EMBALLAGE</p>
                            <p id="summary-quantity" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">EMBALLAGE</p>
                            <p id="summary-emballage" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        @endif
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">CAPSULES REMPLIES</p>
                            <p id="summary-capsules" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; color: #6b7280; font-weight: 500; margin-bottom: 0.25rem;">TOTAL CAPSULES {{ $commande->commande_type === 'with_packaging' ? 'NEEDED' : '' }}</p>
                            <p id="summary-total-capsules" style="font-size: 1rem; color: #1f2937; font-weight: 600;">-</p>
                        </div>
                    </div>
                </div>

                <!-- Cost Breakdown -->
                <div style="padding: 1.5rem; background: #f3f4f6; border-radius: 0.75rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">💰 Calcul du Coût</h3>
                    <div style="display: grid; gap: 0.75rem;">
                        @if($commande->commande_type === 'with_packaging')
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Coût Emballage</span>
                            <span id="cost-emballage" style="font-weight: 500; color: #1f2937;">0.00</span>
                        </div>
                        @endif
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Coût Capsules (vides)</span>
                            <span id="cost-capsules" style="font-weight: 500; color: #1f2937;">0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                            <span style="color: #6b7280;">Coût Matière Herbale</span>
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
                        
                        <!-- Initialize current costs from PHP -->
                        <script>
                            const CURRENT_COSTS = {
                                emballage: {{ $currentCosts['emballage'] ?? 0 }},
                                capsules: {{ $currentCosts['capsules'] ?? 0 }},
                                herb: {{ $currentCosts['herb'] ?? 0 }},
                                joint: {{ $currentCosts['joint'] ?? 0 }},
                                ticket: {{ $currentCosts['ticket'] ?? 0 }},
                            };
                        </script>
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
                            value="{{ $commande->revenue ? $commande->revenue->selling_price : '' }}"
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
// Define prices from controller
console.log('Edit form script loaded');
const JOINT_SECURITE_PRICE = {{ $jointSecuritePrice ?? 0 }}; // DH per unit
const TICKET_PRICES = {
    'PAPIER': {{ $ticketPrices['PAPIER'] ?? 0 }},
    'VINELLE': {{ $ticketPrices['VINELLE'] ?? 0 }}
}; // DH per unit per type

let currentStep = 1;
const commandeType = '{{ $commande->commande_type }}';
const totalSteps = commandeType === 'with_packaging' ? 5 : 3;

const form = document.getElementById('commandeForm');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');

const clientSelect = document.getElementById('client_id');
const quantityInput = document.getElementById('quantity');
const emballageSelect = document.getElementById('emballage_product_stock_id');
const filledCapsuleSelect = document.getElementById('filled_capsule_id');
const capsulesPerUnitInputs = document.querySelectorAll('input[name="capsules_per_unit"]');;

function showStep(step) {
    document.querySelectorAll('.form-step').forEach(el => el.style.display = 'none');
    
    const currentStepEl = document.querySelector(`.form-step[data-step="${step}"]`);
    if (currentStepEl) {
        currentStepEl.style.display = 'block';
    }

    // Calculate costs when entering Step 5
    if (step === 5 || (commandeType === 'without_packaging' && step === 3)) {
        calculateCosts();
    }
    
    prevBtn.style.display = step > 1 ? 'block' : 'none';
    nextBtn.style.display = step < totalSteps ? 'block' : 'none';
    submitBtn.style.display = step === totalSteps ? 'block' : 'none';
    
    document.querySelectorAll('.step-circle').forEach((circle) => {
        const stepNum = parseInt(circle.dataset.step);
        if (commandeType === 'with_packaging') {
            if (stepNum <= step) {
                circle.style.background = '#2d7a52';
                circle.style.color = 'white';
            } else {
                circle.style.background = '#e5e7eb';
                circle.style.color = '#4b5563';
            }
        } else {
            // For without_packaging, highlight based on current step
            if ((stepNum === 1 && step >= 1) || (stepNum === 2 && step >= 2) || (stepNum === 3 && step >= 3)) {
                circle.style.background = '#2d7a52';
                circle.style.color = 'white';
            } else {
                circle.style.background = '#e5e7eb';
                circle.style.color = '#4b5563';
            }
        }
    });
    
    updateSummary();
    window.scrollTo(0, 0);
}

function updateSummary() {
    const clientOption = clientSelect.options[clientSelect.selectedIndex];
    document.getElementById('summary-client').textContent = clientOption.text || '-';
    
    if (commandeType === 'with_packaging') {
        document.getElementById('summary-quantity').textContent = quantityInput.value || '-';
        
        const emballageOption = emballageSelect.options[emballageSelect.selectedIndex];
        document.getElementById('summary-emballage').textContent = emballageOption.text || '-';
        
        const qty = parseInt(quantityInput.value) || 0;
        const cpuVal = document.querySelector('input[name="capsules_per_unit"]:checked')?.value || 0;
        const totalCapsules = qty * cpuVal;
        document.getElementById('summary-total-capsules').textContent = totalCapsules > 0 ? totalCapsules : '-';
    } else {
        // without_packaging
        const capsulesQty = document.getElementById('capsules_quantity_input')?.value || 0;
        document.getElementById('summary-total-capsules').textContent = capsulesQty > 0 ? capsulesQty : '-';
    }
    
    const capsuleOption = filledCapsuleSelect.options[filledCapsuleSelect.selectedIndex];
    document.getElementById('summary-capsules').textContent = capsuleOption.text || '-';
}

function canAdvanceToNextStep() {
    if (commandeType === 'without_packaging') {
        // For without_packaging, validate accordingly
        if (currentStep === 1) {
            return clientSelect.value !== '';
        } else if (currentStep === 2) {
            const filledCapsuleId = document.getElementById('filled_capsule_id')?.value;
            const capsulesQty = document.getElementById('capsules_quantity_input')?.value;
            return filledCapsuleId !== '' && filledCapsuleId !== undefined && capsulesQty && parseInt(capsulesQty) >= 1;
        }
        return true;
    } else {
        // For with_packaging, validate all steps
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
}

nextBtn.addEventListener('click', () => {
    console.log('Next button clicked!');
    const canAdvance = canAdvanceToNextStep();
    console.log('Can advance?', canAdvance, 'Current step:', currentStep, 'Total steps:', totalSteps);
    
    if (!canAdvance) {
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

[clientSelect, emballageSelect, quantityInput, filledCapsuleSelect, ...capsulesPerUnitInputs].filter(el => el !== null && el !== undefined).forEach(el => {
    el.addEventListener('change', () => {
        updateSummary();
        calculateCosts();
        calculateProfit();
    });
    el.addEventListener('input', () => {
        updateSummary();
        calculateCosts();
        calculateProfit();
    });
});

// Handle joint securite checkbox
const avecJointCheckbox = document.getElementById('avec_joint_securite');
if (avecJointCheckbox) {
    avecJointCheckbox.addEventListener('change', () => {
        calculateCosts();
        calculateProfit();
    });
}

// Handle ticket checkbox visibility
const avecTicketCheckbox = document.getElementById('avec_ticket');
const ticketFields = document.getElementById('ticket-fields');
if (avecTicketCheckbox) {
    avecTicketCheckbox.addEventListener('change', () => {
        if (ticketFields) {
            ticketFields.style.display = avecTicketCheckbox.checked ? 'block' : 'none';
        }
        calculateCosts();
        calculateProfit();
    });
}

// Handle ticket type and quantity changes
const ticketTypeSelect = document.getElementById('ticket_type');
const ticketQuantityInput = document.getElementById('ticket_quantity');

if (ticketTypeSelect) {
    ticketTypeSelect.addEventListener('change', () => {
        calculateCosts();
        calculateProfit();
    });
}

if (ticketQuantityInput) {
    ticketQuantityInput.addEventListener('input', () => {
        calculateCosts();
        calculateProfit();
    });
}

if (avecJointSecuriteCheckbox) {
    avecJointSecuriteCheckbox.addEventListener('change', () => {
        calculateCosts();
        calculateProfit();
    });
}

if (avecTicketCheckbox) {
    avecTicketCheckbox.addEventListener('change', () => {
        calculateCosts();
        calculateProfit();
    });
}

// Update quantity info when emballage changes
if (emballageSelect) {
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
}

showStep(currentStep);

// Format number as currency (2 decimal places)
function formatCurrency(value) {
    const num = parseFloat(value) || 0;
    return num.toFixed(2);
}

// Calculate and display costs when entering Step 5
function calculateCosts() {
    // For without_packaging, use CURRENT_COSTS from PHP (already calculated from commande data)
    if (commandeType === 'without_packaging') {
        if (typeof CURRENT_COSTS !== 'undefined') {
            document.getElementById('cost-capsules').textContent = formatCurrency(CURRENT_COSTS.capsules);
            document.getElementById('cost-herb-material').textContent = formatCurrency(CURRENT_COSTS.herb);
            
            // Show joint and ticket rows if they have costs
            if (CURRENT_COSTS.joint > 0) {
                document.getElementById('cost-joint-row').style.display = 'flex';
                document.getElementById('cost-joint').textContent = formatCurrency(CURRENT_COSTS.joint);
            } else {
                document.getElementById('cost-joint-row').style.display = 'none';
            }
            if (CURRENT_COSTS.ticket > 0) {
                document.getElementById('cost-ticket-row').style.display = 'flex';
                document.getElementById('cost-ticket').textContent = formatCurrency(CURRENT_COSTS.ticket);
            } else {
                document.getElementById('cost-ticket-row').style.display = 'none';
            }
            
            // Display total cost
            const totalCost = CURRENT_COSTS.emballage + CURRENT_COSTS.capsules + CURRENT_COSTS.herb + CURRENT_COSTS.joint + CURRENT_COSTS.ticket;
            document.getElementById('total-cost').textContent = formatCurrency(totalCost) + ' DH';
            return;
        }
    }

    // Get form values
    const quantity = parseFloat(quantityInput.value) || 0;
    const capsulesPerUnit = parseFloat(document.querySelector('input[name="capsules_per_unit"]:checked')?.value) || 0;
    const hasJointSecurite = document.getElementById('avec_joint_securite')?.checked || false;
    const hasTicket = document.getElementById('avec_ticket')?.checked || false;

    // Get emballage price from data attribute
    const emballageOption = emballageSelect.options[emballageSelect.selectedIndex];
    const emballagePrice = parseFloat(emballageOption.dataset?.price) || 0;

    // Get filled capsule carton price, herb price, and quantity from data attribute
    const filledCapsuleOption = filledCapsuleSelect.options[filledCapsuleSelect.selectedIndex];
    const cartonPrice = parseFloat(filledCapsuleOption.dataset?.cartonPrice) || 0;
    const cartonCapacity = parseFloat(filledCapsuleOption.dataset?.cartonCapacity) || 0;
    const herbPrice = parseFloat(filledCapsuleOption.dataset?.herbPrice) || 0;
    const herbQuantity = parseFloat(filledCapsuleOption.dataset?.herbQuantity) || 0; // Total herb for all rangées
    const filledCapsuleQuantityRangees = parseFloat(filledCapsuleOption.dataset?.quantity) || 0; // Number of rangées

    // Calculate total capsules
    const totalCapsules = quantity * capsulesPerUnit;

    // Calculate emballage cost
    const costEmballage = emballagePrice * quantity;
    document.getElementById('cost-emballage').textContent = formatCurrency(costEmballage);

    // Calculate filled capsule cost (capsule + herb material) - SEPARATE
    // CAPSULES: Price per Capsule = cartonPrice / cartonCapacity (fixed unit cost based on carton structure)
    // HERB: Price per Rangée = herbPrice (DH/kg) × (herbQuantity / quantity of rangées in FilledCapsule)
    //       Price per Capsule = herbPricePerRangée / 420
    
    let costCapsulePerUnit = 0;
    let costHerbPerUnit = 0;
    
    // Capsule cost uses carton capacity (total structure)
    if (cartonCapacity > 0) {
        costCapsulePerUnit = cartonPrice / cartonCapacity; // cost per empty capsule (true unit cost)
    }
    
    // Herb cost: calculate herb quantity per rangée, then per capsule
    if (herbQuantity > 0 && filledCapsuleQuantityRangees > 0) {
        const herbQuantityPerRangee = herbQuantity / filledCapsuleQuantityRangees; // kg per rangée
        const pricePerRangeeForHerb = herbPrice * herbQuantityPerRangee; // price per rangée
        costHerbPerUnit = pricePerRangeeForHerb / 420; // cost of herb per capsule
    }
    
    const costCapsules = costCapsulePerUnit * totalCapsules;
    const costHerbMaterial = costHerbPerUnit * totalCapsules; // total herb material cost
    
    document.getElementById('cost-capsules').textContent = formatCurrency(costCapsules);
    document.getElementById('cost-herb-material').textContent = formatCurrency(costHerbMaterial);

    // Handle conditional costs
    let costJoint = 0;
    let costTicket = 0;

    if (hasJointSecurite) {
        document.getElementById('cost-joint-row').style.display = 'flex';
        costJoint = JOINT_SECURITE_PRICE * quantity;
        document.getElementById('cost-joint').textContent = formatCurrency(costJoint);
    } else {
        document.getElementById('cost-joint-row').style.display = 'none';
    }

    if (hasTicket) {
        document.getElementById('cost-ticket-row').style.display = 'flex';
        const ticketType = document.getElementById('ticket_type')?.value || 'PAPIER';
        const ticketQuantity = parseFloat(document.getElementById('ticket_quantity')?.value) || 0;
        const ticketUnitPrice = TICKET_PRICES[ticketType] || 0;
        costTicket = ticketUnitPrice * ticketQuantity;
        document.getElementById('cost-ticket').textContent = formatCurrency(costTicket);
    } else {
        document.getElementById('cost-ticket-row').style.display = 'none';
    }

    // Calculate and store total cost
    const totalCost = costEmballage + costCapsules + costHerbMaterial + costJoint + costTicket;
    document.getElementById('total-cost').textContent = formatCurrency(totalCost) + ' DH';
}

// Calculate and display profit and margin
function calculateProfit() {
    const totalCostText = document.getElementById('total-cost').textContent;
    const totalCost = parseFloat(totalCostText.replace(' DH', '')) || 0;
    const sellingPrice = parseFloat(document.getElementById('selling_price').value) || 0;
    
    const profit = sellingPrice - totalCost;
    const margin = totalCost > 0 ? ((profit / totalCost) * 100) : 0;
    
    document.getElementById('profit-display').textContent = formatCurrency(profit) + ' DH';
    document.getElementById('margin-display').textContent = formatCurrency(margin) + '%';
}

// Call calculateCosts when form loads (for edit view to show current costs)
document.addEventListener('DOMContentLoaded', () => {
    // Give a small delay to ensure all DOM elements are fully rendered
    setTimeout(() => {
        // Display current costs from PHP
        if (typeof CURRENT_COSTS !== 'undefined') {
            document.getElementById('cost-emballage').textContent = formatCurrency(CURRENT_COSTS.emballage);
            document.getElementById('cost-capsules').textContent = formatCurrency(CURRENT_COSTS.capsules);
            document.getElementById('cost-herb-material').textContent = formatCurrency(CURRENT_COSTS.herb);
            
            // Show joint and ticket rows if they have costs
            if (CURRENT_COSTS.joint > 0) {
                document.getElementById('cost-joint-row').style.display = 'flex';
                document.getElementById('cost-joint').textContent = formatCurrency(CURRENT_COSTS.joint);
            }
            if (CURRENT_COSTS.ticket > 0) {
                document.getElementById('cost-ticket-row').style.display = 'flex';
                document.getElementById('cost-ticket').textContent = formatCurrency(CURRENT_COSTS.ticket);
            }
            
            // Display total cost
            const totalCost = CURRENT_COSTS.emballage + CURRENT_COSTS.capsules + CURRENT_COSTS.herb + CURRENT_COSTS.joint + CURRENT_COSTS.ticket;
            document.getElementById('total-cost').textContent = formatCurrency(totalCost) + ' DH';
            
            // Calculate profit if we have a selling price
            calculateProfit();
        }
        
        // Update summary with current values
        updateSummary();
    }, 100);
});
</script>
@endpush

@endsection
