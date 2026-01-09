@extends('layouts.app')

@section('title', 'Aperçu Commande - Co-op ERP')
@section('page-title', 'Aperçu de la Commande')

@section('content')
<div style="max-width: 900px;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 2rem; color: #1f2937;">Aperçu de la Commande</h2>

        <!-- Client Info -->
        <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem; border-left: 4px solid #2d7a52;">
            <h3 style="margin-top: 0; color: #1f2937; font-size: 1rem; font-weight: 600;">Client</h3>
            <p style="color: #4b5563; margin: 0.5rem 0;"><strong>{{ $client->name }}</strong></p>
        </div>

        <!-- Order Details -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #1f2937; font-size: 1rem; font-weight: 600; margin-bottom: 1rem;">Détails de la Commande</h3>
            
            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 1rem; color: #6b7280; font-weight: 500; width: 50%;">Emballage</td>
                            <td style="padding: 1rem; color: #1f2937; font-weight: 500;">{{ $emballageStock->product->name }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 1rem; color: #6b7280; font-weight: 500;">Quantité Emballage</td>
                            <td style="padding: 1rem; color: #1f2937; font-weight: 500;">{{ $quantity }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 1rem; color: #6b7280; font-weight: 500;">Herb / Capsule Remplie</td>
                            <td style="padding: 1rem; color: #1f2937; font-weight: 500;">{{ $filledCapsule->herb->name }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 1rem; color: #6b7280; font-weight: 500;">Capsules par Unité</td>
                            <td style="padding: 1rem; color: #1f2937; font-weight: 500;">{{ $capsules_per_unit }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; color: #6b7280; font-weight: 500;">Total Capsules</td>
                            <td style="padding: 1rem; color: #1f2937; font-weight: 500;">{{ $totalCapsules }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cost Breakdown -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #1f2937; font-size: 1rem; font-weight: 600; margin-bottom: 1rem;">Calcul du Coût</h3>
            
            <div style="background: #f3f4f6; border-radius: 0.75rem; padding: 1.5rem;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 0.75rem 0; color: #6b7280;">Coût Emballage</td>
                            <td style="padding: 0.75rem 0; text-align: right; color: #1f2937; font-weight: 500;">{{ number_format($emballageCost, 2) }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 0.75rem 0; color: #6b7280;">Coût Herb</td>
                            <td style="padding: 0.75rem 0; text-align: right; color: #1f2937; font-weight: 500;">{{ number_format($herbCost, 2) }}</td>
                        </tr>
                        @if($avec_joint_securite)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 0.75rem 0; color: #6b7280;">Coût Joint de Sécurité</td>
                            <td style="padding: 0.75rem 0; text-align: right; color: #1f2937; font-weight: 500;">{{ number_format($jointCost, 2) }}</td>
                        </tr>
                        @endif
                        @if($avec_ticket)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 0.75rem 0; color: #6b7280;">Coût Ticket ({{ $ticket_quantity }})</td>
                            <td style="padding: 0.75rem 0; text-align: right; color: #1f2937; font-weight: 500;">{{ number_format($ticketCost, 2) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td style="padding: 1rem 0; color: #1f2937; font-weight: 600; font-size: 1.125rem;">Coût Total</td>
                            <td style="padding: 1rem 0; text-align: right; color: #2d7a52; font-weight: 600; font-size: 1.125rem;">{{ number_format($totalCost, 2) }} DH</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Revenue Section -->
        <form action="{{ route('commandes.store') }}" method="POST" style="margin-bottom: 2rem;">
            @csrf
            
            <!-- Hidden form data -->
            <input type="hidden" name="client_id" value="{{ $formData['client_id'] }}">
            <input type="hidden" name="emballage_product_stock_id" value="{{ $formData['emballage_product_stock_id'] }}">
            <input type="hidden" name="filled_capsule_id" value="{{ $formData['filled_capsule_id'] }}">
            <input type="hidden" name="quantity" value="{{ $formData['quantity'] }}">
            <input type="hidden" name="capsules_per_unit" value="{{ $formData['capsules_per_unit'] }}">
            <input type="hidden" name="avec_joint_securite" value="{{ $avec_joint_securite ? '1' : '0' }}">
            <input type="hidden" name="avec_ticket" value="{{ $avec_ticket ? '1' : '0' }}">
            @if($avec_ticket)
                <input type="hidden" name="ticket_quantity" value="{{ $ticket_quantity }}">
                <input type="hidden" name="ticket_product_stock_id" value="{{ $ticket_product_stock_id }}">
            @endif
            <input type="hidden" name="nom_marque" value="{{ $formData['nom_marque'] ?? '' }}">
            <input type="hidden" name="numero_autorisation" value="{{ $formData['numero_autorisation'] ?? '' }}">

            <div style="background: #fef3c7; border: 2px solid #fbbf24; border-radius: 0.75rem; padding: 1.5rem;">
                <h3 style="margin-top: 0; color: #92400e; font-size: 1rem; font-weight: 600;">💰 Prix de Vente & Profit</h3>
                
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
                    @error('selling_price')
                        <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="background: white; border-radius: 0.5rem; padding: 1rem; margin-top: 1rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <p style="color: #6b7280; font-size: 0.875rem; margin: 0 0 0.25rem 0;">Coût Total</p>
                            <p style="color: #1f2937; font-size: 1.25rem; font-weight: 600; margin: 0;">{{ number_format($totalCost, 2) }} DH</p>
                        </div>
                        <div>
                            <p style="color: #6b7280; font-size: 0.875rem; margin: 0 0 0.25rem 0;">Profit</p>
                            <p id="profit-display" style="color: #2d7a52; font-size: 1.25rem; font-weight: 600; margin: 0;">0.00 DH</p>
                        </div>
                    </div>
                    <div>
                        <p style="color: #6b7280; font-size: 0.875rem; margin: 0 0 0.25rem 0;">Marge (%)</p>
                        <p id="margin-display" style="color: #2d7a52; font-size: 1.125rem; font-weight: 600; margin: 0;">0.00%</p>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div style="margin-top: 2rem;">
                <label for="notes" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Notes (optionnel)</label>
                <textarea 
                    id="notes" 
                    name="notes" 
                    rows="3"
                    placeholder="Ajouter des notes sur cette commande..."
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-family: inherit; resize: vertical;"
                >{{ old('notes') }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 1rem; margin-top: 2rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                <button 
                    type="submit" 
                    style="background: #2d7a52; color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; border: none; font-weight: 600; cursor: pointer; font-size: 1rem;"
                >
                    ✓ Créer la Commande
                </button>
                <button 
                    type="button" 
                    onclick="history.back()" 
                    style="background: white; color: #4b5563; padding: 0.75rem 2rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-weight: 600; cursor: pointer; font-size: 1rem;"
                >
                    ← Retour
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function calculateProfit() {
    const sellingPrice = parseFloat(document.getElementById('selling_price').value) || 0;
    const totalCost = {{ $totalCost }};
    
    const profit = sellingPrice - totalCost;
    const marginPercent = totalCost > 0 ? (profit / totalCost) * 100 : 0;
    
    document.getElementById('profit-display').textContent = number_format(profit, 2) + ' DH';
    document.getElementById('margin-display').textContent = number_format(marginPercent, 2) + '%';
    
    // Color code the profit
    const profitDisplay = document.getElementById('profit-display');
    if (profit < 0) {
        profitDisplay.style.color = '#dc2626'; // Red
    } else if (profit === 0) {
        profitDisplay.style.color = '#f59e0b'; // Amber
    } else {
        profitDisplay.style.color = '#2d7a52'; // Green
    }
}

function number_format(num, decimals) {
    return num.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Calculate on page load
window.addEventListener('DOMContentLoaded', calculateProfit);
</script>
@endsection
