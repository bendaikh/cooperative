@extends('layouts.app')

@section('title', 'Confirmation Commande - Co-op ERP')
@section('page-title', 'Confirmation de la Commande')

@section('content')
<div style="max-width: 900px;">
    <div style="background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 2rem; color: #1f2937;">✓ Confirmation Final</h2>

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
            <h3 style="color: #1f2937; font-size: 1rem; font-weight: 600; margin-bottom: 1rem;">Résumé des Coûts</h3>
            
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
                        <tr style="border-bottom: 2px solid #e5e7eb;">
                            <td style="padding: 1rem 0; color: #1f2937; font-weight: 600;">Coût Total Production</td>
                            <td style="padding: 1rem 0; text-align: right; color: #1f2937; font-weight: 600; font-size: 1.125rem;">{{ number_format($totalCost, 2) }} DH</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Revenue Summary -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #1f2937; font-size: 1rem; font-weight: 600; margin-bottom: 1rem;">💰 Résumé Financier</h3>
            
            <div style="background: #f0fdf4; border: 2px solid #86efac; border-radius: 0.75rem; padding: 1.5rem;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr style="border-bottom: 1px solid #d1fae5;">
                            <td style="padding: 1rem 0; color: #1f2937; font-weight: 500;">Coût Total</td>
                            <td style="padding: 1rem 0; text-align: right; color: #1f2937; font-weight: 600; font-size: 1.1rem;">{{ number_format($totalCost, 2) }} DH</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #d1fae5;">
                            <td style="padding: 1rem 0; color: #1f2937; font-weight: 500;">Prix de Vente</td>
                            <td style="padding: 1rem 0; text-align: right; color: #16a34a; font-weight: 600; font-size: 1.1rem;">{{ number_format($selling_price, 2) }} DH</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #d1fae5;">
                            <td style="padding: 1rem 0; color: #1f2937; font-weight: 500;">Profit Brut</td>
                            <td style="padding: 1rem 0; text-align: right; color: #2d7a52; font-weight: 600; font-size: 1.1rem;">{{ number_format($profit, 2) }} DH</td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem 0; color: #1f2937; font-weight: 600;">Marge (%)</td>
                            <td style="padding: 1rem 0; text-align: right; color: #2d7a52; font-weight: 600; font-size: 1.25rem;">{{ number_format($margin_percentage, 2) }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notes Section -->
        <form action="{{ route('commandes.store') }}" method="POST">
            @csrf
            
            <!-- Hidden form data from preview -->
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <input type="hidden" name="emballage_product_stock_id" value="{{ $emballageStock->id }}">
            <input type="hidden" name="filled_capsule_id" value="{{ $filledCapsule->id }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <input type="hidden" name="capsules_per_unit" value="{{ $capsules_per_unit }}">
            <input type="hidden" name="avec_joint_securite" value="{{ $avec_joint_securite ? '1' : '0' }}">
            <input type="hidden" name="avec_ticket" value="{{ $avec_ticket ? '1' : '0' }}">
            @if($avec_ticket)
                <input type="hidden" name="ticket_quantity" value="{{ $ticket_quantity }}">
                <input type="hidden" name="ticket_product_stock_id" value="{{ $ticket_product_stock_id ?? '' }}">
            @endif
            <input type="hidden" name="nom_marque" value="{{ $nom_marque ?? '' }}">
            <input type="hidden" name="numero_autorisation" value="{{ $numero_autorisation ?? '' }}">
            <input type="hidden" name="selling_price" value="{{ $selling_price }}">

            <div style="margin-bottom: 2rem;">
                <label for="notes" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Notes et Commentaires (optionnel)</label>
                <textarea 
                    id="notes" 
                    name="notes" 
                    rows="4"
                    placeholder="Ajouter des notes détaillées sur cette commande, conditions spéciales, etc..."
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; outline: none; font-family: inherit; resize: vertical; font-size: 0.95rem;"
                >{{ $notes ?? '' }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 1rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
                <button 
                    type="submit" 
                    style="flex: 1; background: #2d7a52; color: white; padding: 1rem; border-radius: 0.5rem; border: none; font-weight: 600; cursor: pointer; font-size: 1rem;"
                >
                    ✓ Créer la Commande
                </button>
                <button 
                    type="button" 
                    onclick="history.back()" 
                    style="flex: 1; background: white; color: #4b5563; padding: 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-weight: 600; cursor: pointer; font-size: 1rem;"
                >
                    ← Retour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
