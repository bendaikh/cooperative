@extends('layouts.app')

@section('title', 'Commande #' . $commande->id . ' - Co-op ERP')
@section('page-title', 'Détails Commande #' . $commande->id)

@section('content')
<div style="background: #ffffff; min-height: 100vh; padding: 0;">
    <!-- No-Print Navigation -->
    <div class="no-print" style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1.25rem 2rem; position: sticky; top: 0; z-index: 100;">
        <div style="max-width: 1400px; margin: 0 auto; display: flex; align-items: center; gap: 1rem;">
            <a href="{{ route('commandes.index') }}" style="display: inline-flex; align-items: center; gap: 0.375rem; color: #2d7a52; text-decoration: none; font-weight: 600; font-size: 0.9375rem; padding: 0.5rem 1rem; background: white; border: 2px solid #d1d5db; border-radius: 0.5rem; transition: all 0.2s;" onmouseover="this.style.borderColor='#2d7a52'; this.style.boxShadow='0 2px 4px rgba(45,122,82,0.2)';" onmouseout="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                <span style="font-size: 0.875rem;">←</span>
                <span>Retour</span>
            </a>
            <div style="flex: 1; text-align: center;">
                <h1 style="margin: 0; font-size: 1.75rem; font-weight: 700; color: #1f2937;">Commande #{{ $commande->id }}</h1>
            </div>
            <div style="width: auto;"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div style="padding: 2rem 1rem;">
        <div style="max-width: 1400px; margin: 0 auto;">

        <!-- Header Info - Clean Layout -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
            <!-- Client Card -->
            <div style="background: white; border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #2d7a52; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; margin-bottom: 0.75rem;">👤 Client</div>
                <div style="font-size: 1.25rem; font-weight: 700; color: #1f2937; margin-bottom: 0.25rem;">{{ $commande->client->name }}</div>
                <div style="font-size: 0.8125rem; color: #6b7280;">ID: {{ $commande->client_id }}</div>
            </div>

            <!-- Status Card -->
            <div style="background: white; border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #0891b2; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; margin-bottom: 0.75rem;">📋 Statut</div>
                <div style="display: inline-block; padding: 0.5rem 1rem; background: #e0f2fe; color: #0369a1; border-radius: 0.5rem; font-weight: 700; font-size: 1rem;">{{ $commande->status }}</div>
            </div>

            <!-- Date Card -->
            <div style="background: white; border-radius: 0.75rem; padding: 1.5rem; border-left: 4px solid #2563eb; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; margin-bottom: 0.75rem;">📅 Date</div>
                <div style="font-size: 1.125rem; font-weight: 700; color: #1f2937; margin-bottom: 0.25rem;">{{ $commande->created_at->format('d/m/Y') }}</div>
                <div style="font-size: 0.8125rem; color: #6b7280;">{{ $commande->created_at->format('H:i') }}</div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 2rem;">

            <!-- Emballages Card (UNIFIED) -->
            <div style="background: white; border-radius: 0.75rem; padding: 1.75rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <span style="font-size: 1.5rem;">📦</span>
                    <h2 style="margin: 0; font-size: 1.125rem; font-weight: 700; color: #1f2937;">Emballage</h2>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    @forelse($commande->emballages as $emballage)
                    {{-- Skip Joint de sécurité from main emballage display --}}
                    @if($emballage->productStock->product->name !== 'Joint de sécurité')
                    <div style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.625rem;">
                        <div style="width: 40px; height: 40px; background: #2d7a52; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; color: white;">
                            EMB
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 600; color: #1f2937; font-size: 0.9375rem; margin-bottom: 0.125rem;">{{ $emballage->productStock->product->name }}</div>
                        </div>
                        <div style="background: #2d7a52; color: white; padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-size: 1rem; font-weight: 700; text-align: center; min-width: 50px;">
                            ×{{ $emballage->quantity }}
                        </div>
                    </div>
                    @endif
                    @empty
                    <div style="text-align: center; padding: 1.5rem; color: #9ca3af; background: #f9fafb; border-radius: 0.625rem; border: 1px dashed #e5e7eb;">
                        <div style="font-size: 1.5rem; margin-bottom: 0.5rem; opacity: 0.5;">📦</div>
                        <div style="font-size: 0.875rem;">Aucun emballage</div>
                    </div>
                    @endforelse
                </div>

                <!-- Joint de sécurité (separate section if present) -->
                @if($commande->emballages->where('productStock.product.name', 'Joint de sécurité')->count() > 0)
                <div style="margin-top: 1rem; padding: 0.875rem; background: #dcfce7; border: 1px solid #86efac; border-radius: 0.625rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 1rem;">🔒</span>
                        <span style="font-weight: 600; color: #166534; font-size: 0.875rem;">Joint de sécurité inclus (×{{ $commande->emballages->where('productStock.product.name', 'Joint de sécurité')->first()->quantity ?? 0 }})</span>
                    </div>
                </div>
                @elseif($commande->avec_joint_securite)
                <div style="margin-top: 1rem; padding: 0.875rem; background: #dcfce7; border: 1px solid #86efac; border-radius: 0.625rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 1rem;">🔒</span>
                        <span style="font-weight: 600; color: #166534; font-size: 0.875rem;">Joint de sécurité inclus</span>
                    </div>
                </div>
                @endif
            </div>

            <!-- Quantity & Capsules Card -->
            <div style="background: white; border-radius: 0.75rem; padding: 1.75rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <span style="font-size: 1.5rem;">📊</span>
                    <h2 style="margin: 0; font-size: 1.125rem; font-weight: 700; color: #1f2937;">Quantité</h2>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem;">
                    <!-- Total Quantity -->
                    <div style="background: #eff6ff; padding: 1rem; border-radius: 0.625rem; border: 1px solid #bfdbfe;">
                        <div style="font-size: 0.625rem; color: #1e40af; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.375rem;">Total</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: #1e40af;">{{ $commande->quantity }}</div>
                    </div>

                    <!-- Capsules per Unit -->
                    <div style="background: #f0fdf4; padding: 1rem; border-radius: 0.625rem; border: 1px solid #86efac;">
                        <div style="font-size: 0.625rem; color: #166534; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.375rem;">Par Unité</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: #166534;">{{ $commande->capsules_per_unit }}</div>
                    </div>
                </div>

                <!-- Total Capsules -->
                <div style="background: #fefce8; padding: 1rem; border-radius: 0.625rem; border: 1px solid #fcd34d; text-align: center;">
                    <div style="font-size: 0.625rem; color: #92400e; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.375rem;">Total Capsules</div>
                    <div style="font-size: 2rem; font-weight: 700; color: #92400e;">{{ $commande->quantity * $commande->capsules_per_unit }}</div>
                </div>

                <!-- Capsules Content -->
                @if($commande->filledCapsules->isNotEmpty())
                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 2px solid #f3f4f6;">
                    <div style="font-size: 0.8125rem; font-weight: 700; color: #1f2937; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.025em;">🌿 Contenu</div>
                    
                    <div style="display: flex; flex-direction: column; gap: 0.625rem;">
                        @foreach($commande->filledCapsules as $capsule)
                        <div style="display: flex; align-items: center; gap: 0.625rem; padding: 0.75rem; background: #f0fdf4; border: 1px solid #86efac; border-radius: 0.5rem;">
                            <div style="width: 32px; height: 32px; background: #166534; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; color: white;">
                                🌿
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <div style="font-weight: 600; color: #166534; font-size: 0.8125rem;">{{ $capsule->filledCapsule->herb->name ?? 'Herbe inconnue' }}</div>
                                <div style="font-size: 0.75rem; color: #16a34a;">{{ $capsule->quantity }} caps</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Tickets Card -->
            @if($commande->avec_ticket)
            <div style="background: white; border-radius: 0.75rem; padding: 1.75rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                    <span style="font-size: 1.5rem;">🎟️</span>
                    <h2 style="margin: 0; font-size: 1.125rem; font-weight: 700; color: #1f2937;">Tickets</h2>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <!-- Ticket Type -->
                    <div style="background: #fce7f3; padding: 1rem; border-radius: 0.625rem; border: 1px solid #fbcfe8;">
                        <div style="font-size: 0.625rem; color: #be123c; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.375rem;">Type de Ticket</div>
                        <div style="font-size: 1.125rem; font-weight: 700; color: #be123c;">{{ $commande->tickets()->first()?->ticket_type ?? 'PAPIER' }}</div>
                    </div>

                    <!-- Ticket Quantity -->
                    <div style="background: #faf5ff; padding: 1rem; border-radius: 0.625rem; border: 1px solid #e9d5ff;">
                        <div style="font-size: 0.625rem; color: #6b21a8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.375rem;">Quantité</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: #6b21a8;">{{ $commande->tickets()->first()?->quantity ?? 0 }}</div>
                    </div>

                    <!-- Brand Name -->
                    <div style="background: #f9fafb; padding: 1rem; border-radius: 0.625rem; border: 1px solid #e5e7eb;">
                        <div style="font-size: 0.625rem; color: #4b5563; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.375rem;">Marque</div>
                        <div style="font-size: 1rem; font-weight: 700; color: #1f2937; word-break: break-word;">{{ $commande->tickets()->first()?->nom_marque ?? '-' }}</div>
                    </div>

                    <!-- Authorization Number -->
                    <div style="background: #fffbeb; padding: 1rem; border-radius: 0.625rem; border: 1px solid #fde68a;">
                        <div style="font-size: 0.625rem; color: #92400e; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.375rem;">N° Autorisation</div>
                        <div style="font-size: 0.9375rem; font-weight: 700; color: #78350f; font-family: monospace; word-break: break-all;">{{ $commande->tickets()->first()?->numero_autorisation ?? '-' }}</div>
                    </div>

                    <!-- Product Info -->
                    @if($commande->tickets->isNotEmpty())
                    <div style="background: #eff6ff; padding: 1rem; border-radius: 0.625rem; border: 1px solid #bfdbfe;">
                        <div style="font-size: 0.625rem; color: #1e40af; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.375rem;">📦 Produit</div>
                        <div style="font-size: 0.9375rem; font-weight: 700; color: #1e40af;">{{ $commande->tickets->first()->productStock->product->name }}</div>
                        <div style="font-size: 0.8125rem; color: #1e40af; margin-top: 0.375rem;">Stock: <span style="font-weight: 700;">{{ $commande->tickets->first()->productStock->quantity }}</span></div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Pricing & Revenue Section -->
        @if($commande->revenue)
        <div style="background: white; border-radius: 0.75rem; padding: 1.75rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                <span style="font-size: 1.5rem;">💰</span>
                <h2 style="margin: 0; font-size: 1.125rem; font-weight: 700; color: #1f2937;">Tarification & Rentabilité</h2>
            </div>

            <!-- Cost, Price & Profit Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <!-- Selling Price -->
                <div style="background: #fef2f2; padding: 1.25rem; border-radius: 0.625rem; border: 2px solid #fecaca;">
                    <div style="font-size: 0.75rem; color: #7f1d1d; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.5rem;">Prix de Vente</div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: #991b1b;">{{ number_format($commande->revenue->selling_price ?? 0, 2) }} <span style="font-size: 0.75rem; color: #dc2626;">DH</span></div>
                </div>

                <!-- Profit -->
                <div style="background: #ecfdf5; padding: 1.25rem; border-radius: 0.625rem; border: 2px solid #86efac;">
                    <div style="font-size: 0.75rem; color: #065f46; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.5rem;">Profit</div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: #059669;">{{ number_format(($commande->revenue->selling_price ?? 0) - ($commande->revenue->cost ?? 0), 2) }} <span style="font-size: 0.75rem; color: #10b981;">DH</span></div>
                </div>

                <!-- Profit Margin -->
                <div style="background: #fbbf24; padding: 1.25rem; border-radius: 0.625rem; border: 2px solid #fcd34d;">
                    <div style="font-size: 0.75rem; color: #78350f; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.5rem;">Marge</div>
                    <div style="font-size: 1.75rem; font-weight: 700; color: #92400e;">{{ number_format($commande->revenue->margin_percentage ?? 0, 1) }} <span style="font-size: 0.75rem; color: #b45309;">%</span></div>
                </div>
            </div>
        </div>
        @endif

        <!-- Notes Section -->
        @if($commande->notes)
        <div style="background: white; border-radius: 0.75rem; padding: 1.75rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">
                <span style="font-size: 1.5rem;">📝</span>
                <h2 style="margin: 0; font-size: 1.125rem; font-weight: 700; color: #1f2937;">Notes</h2>
            </div>
            <div style="font-size: 0.9375rem; color: #4b5563; line-height: 1.6; white-space: pre-wrap; word-wrap: break-word;">{{ $commande->notes }}</div>
        </div>
        @endif

        <!-- Action Buttons - No Print -->
        <div class="no-print" style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
            <a href="{{ route('commandes.edit', $commande->id) }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #2d7a52; color: white; padding: 0.75rem 1.5rem; border-radius: 0.625rem; text-decoration: none; font-weight: 600; font-size: 0.9375rem; transition: all 0.2s;" onmouseover="this.style.background='#236844'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 6px rgba(45,122,82,0.3)';" onmouseout="this.style.background='#2d7a52'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <span>✏️ Modifier</span>
            </a>

            <button onclick="window.print()" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #0891b2; color: white; padding: 0.75rem 1.5rem; border-radius: 0.625rem; border: none; font-weight: 600; font-size: 0.9375rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#0e7490'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 6px rgba(8,145,178,0.3)';" onmouseout="this.style.background='#0891b2'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <span>🖨️ Imprimer</span>
            </button>

            <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer cette commande ?\n\nCette action est irréversible.');" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #dc2626; color: white; padding: 0.75rem 1.5rem; border-radius: 0.625rem; border: none; font-weight: 600; font-size: 0.9375rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#b91c1c'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 6px rgba(220,38,38,0.3)';" onmouseout="this.style.background='#dc2626'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <span>🗑️ Supprimer</span>
                </button>
            </form>
        </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .no-print {
        display: block !important;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        @page {
            size: A4;
            margin: 15mm 10mm;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
            background: white !important;
            width: 100% !important;
            height: 100% !important;
            overflow: visible !important;
        }

        * {
            box-shadow: none !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Hide sidebar and navigation */
        nav, aside, .sidebar, .app-sidebar, .layout-sidebar {
            display: none !important;
        }

        /* Hide all app layout elements */
        body > *:not(main):not(.main-content) {
            display: none !important;
        }

        /* Main content takes full width */
        main {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Main container */
        div[style*="padding: 2rem 1rem"] {
            padding: 0 !important;
            background: white !important;
            width: 100% !important;
            margin: 0 !important;
        }

        div[style*="max-width: 1400px"] {
            max-width: 100% !important;
            margin: 0 !important;
            width: 100% !important;
        }

        /* Print Header */
        div[style*="background: white; border-bottom: 1px solid #e5e7eb; padding: 1.25rem"] {
            display: none !important;
        }

        /* Print Title */
        h1 {
            font-size: 18pt !important;
            margin: 0 0 0.5rem 0 !important;
            text-align: center !important;
            color: #000 !important;
            font-weight: bold !important;
            border-bottom: 2px solid #000 !important;
            padding-bottom: 0.3rem !important;
        }

        /* Header Info Grid - Print Layout */
        div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px"] {
            display: table !important;
            width: 100% !important;
            margin-bottom: 1rem !important;
            border-collapse: collapse !important;
            page-break-inside: avoid !important;
        }

        div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px"] > div {
            display: table-cell !important;
            width: 25% !important;
            padding: 0.6rem !important;
            border: 1px solid #000 !important;
            vertical-align: top !important;
        }

        /* Card styling for print */
        div[style*="background: white; border-radius: 0.75rem; padding: 1.75rem"] {
            background: white !important;
            border: 1px solid #000 !important;
            border-radius: 0 !important;
            padding: 0.6rem !important;
            margin-bottom: 0.8rem !important;
            page-break-inside: avoid !important;
        }

        /* Main grid layout - 2 columns for print */
        div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px"] {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 0.6rem !important;
            margin-bottom: 1rem !important;
            page-break-inside: avoid !important;
        }

        /* Card headers */
        div[style*="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px"] {
            display: block !important;
            margin-bottom: 0.4rem !important;
            padding-bottom: 0.3rem !important;
            border-bottom: 1px solid #000 !important;
        }

        h2 {
            font-size: 11pt !important;
            margin: 0 !important;
            font-weight: bold !important;
            color: #000 !important;
            display: inline !important;
        }

        /* Emballage items */
        div[style*="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #f9fafb"] {
            display: flex !important;
            padding: 0.4rem !important;
            margin-bottom: 0.3rem !important;
            background: white !important;
            border: 1px solid #ccc !important;
            font-size: 9pt !important;
        }

        /* Badge styling */
        div[style*="width: 40px; height: 40px; background: #2d7a52"] {
            width: 28px !important;
            height: 28px !important;
            background: #333 !important;
            color: white !important;
            font-size: 7pt !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
            border-radius: 2px !important;
        }

        /* Quantity displays */
        div[style*="background: #eff6ff; padding: 1rem; border-radius: 0.625rem"] {
            background: white !important;
            border: 1px solid #666 !important;
            padding: 0.5rem !important;
            border-radius: 0 !important;
            margin-bottom: 0.4rem !important;
        }

        div[style*="background: #f0fdf4; padding: 1rem; border-radius: 0.625rem"] {
            background: white !important;
            border: 1px solid #666 !important;
            padding: 0.5rem !important;
            border-radius: 0 !important;
            margin-bottom: 0.4rem !important;
        }

        div[style*="background: #fefce8; padding: 1rem; border-radius: 0.625rem"] {
            background: #f0f0f0 !important;
            border: 1px solid #000 !important;
            padding: 0.5rem !important;
            border-radius: 0 !important;
            margin-bottom: 0.4rem !important;
        }

        div[style*="background: #faf5ff; padding: 1rem; border-radius: 0.625rem"] {
            background: white !important;
            border: 1px solid #666 !important;
            padding: 0.5rem !important;
            border-radius: 0 !important;
        }

        div[style*="background: #f9fafb; padding: 1rem; border-radius: 0.625rem"] {
            background: white !important;
            border: 1px solid #666 !important;
            padding: 0.5rem !important;
            border-radius: 0 !important;
        }

        div[style*="background: #fffbeb; padding: 1rem; border-radius: 0.625rem"] {
            background: white !important;
            border: 1px solid #666 !important;
            padding: 0.5rem !important;
            border-radius: 0 !important;
        }

        div[style*="background: #eff6ff; padding: 1rem; border-radius: 0.625rem"] {
            background: white !important;
            border: 1px solid #666 !important;
            padding: 0.5rem !important;
            border-radius: 0 !important;
        }

        /* Text sizing */
        div {
            font-size: 9pt !important;
            line-height: 1.3 !important;
        }

        div[style*="font-size: 1.25rem"] {
            font-size: 11pt !important;
            font-weight: bold !important;
        }

        div[style*="font-size: 1.125rem"] {
            font-size: 10pt !important;
            font-weight: bold !important;
        }

        div[style*="font-size: 1rem"] {
            font-size: 9pt !important;
        }

        div[style*="font-size: 0.9375rem"] {
            font-size: 8pt !important;
        }

        div[style*="font-size: 0.875rem"] {
            font-size: 8pt !important;
        }

        div[style*="font-size: 0.8125rem"] {
            font-size: 7pt !important;
        }

        div[style*="font-size: 0.75rem"] {
            font-size: 7pt !important;
        }

        div[style*="font-size: 0.625rem"] {
            font-size: 6pt !important;
        }

        /* Large numbers */
        div[style*="font-size: 1.75rem"],
        div[style*="font-size: 2rem"] {
            font-size: 14pt !important;
            font-weight: bold !important;
        }

        /* Label styling */
        div[style*="font-weight: 700; text-transform: uppercase; letter-spacing"] {
            font-size: 6pt !important;
            font-weight: bold !important;
            letter-spacing: 0 !important;
            margin-bottom: 0.2rem !important;
            color: #000 !important;
        }

        /* Flex layouts */
        div[style*="display: flex"] {
            display: flex !important;
        }

        /* Notes section - full width */
        div[style*="background: white; border-radius: 0.75rem; padding: 1.75rem; box-shadow: 0 1px 2px"] {
            page-break-inside: avoid !important;
            margin-bottom: 1rem !important;
        }

        /* Joint de sécurité */
        div[style*="background: #dcfce7; border: 1px solid #86efac"] {
            background: white !important;
            border: 1px solid #000 !important;
            padding: 0.4rem !important;
        }

        /* Capsule content */
        div[style*="background: #f0fdf4; border: 1px solid #86efac; border-radius: 0.5rem"] {
            background: white !important;
            border: 1px solid #999 !important;
            padding: 0.3rem !important;
            margin-bottom: 0.3rem !important;
            border-radius: 0 !important;
        }

        div[style*="width: 32px; height: 32px; background: #166534"] {
            width: 24px !important;
            height: 24px !important;
            background: #666 !important;
            font-size: 8pt !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
            border-radius: 2px !important;
        }

        /* Spacing reductions */
        div[style*="gap: 2rem"] {
            gap: 0.4rem !important;
        }

        div[style*="gap: 1.5rem"] {
            gap: 0.4rem !important;
        }

        div[style*="gap: 1rem"] {
            gap: 0.3rem !important;
        }

        div[style*="gap: 0.75rem"] {
            gap: 0.3rem !important;
        }

        div[style*="margin-bottom: 2rem"] {
            margin-bottom: 0.6rem !important;
        }

        div[style*="margin-bottom: 2.5rem"] {
            margin-bottom: 0.6rem !important;
        }

        div[style*="margin-bottom: 1.5rem"] {
            margin-bottom: 0.5rem !important;
        }

        div[style*="margin-bottom: 1rem"] {
            margin-bottom: 0.4rem !important;
        }

        div[style*="margin-top: 1rem"] {
            margin-top: 0.3rem !important;
        }

        div[style*="margin-top: 1.5rem"] {
            margin-top: 0.5rem !important;
        }

        /* Empty states */
        div[style*="text-align: center; padding: 1.5rem; color: #9ca3af"] {
            display: none !important;
        }

        /* Color text - make black for print */
        div[style*="color: #1f2937"] {
            color: #000 !important;
        }

        div[style*="color: #6b7280"],
        div[style*="color: #4b5563"],
        div[style*="color: #166534"],
        div[style*="color: #16a34a"],
        div[style*="color: #1e40af"],
        div[style*="color: #6b21a8"],
        div[style*="color: #78350f"],
        div[style*="color: #92400e"] {
            color: #000 !important;
        }

        /* Truncate long text */
        div[style*="word-break: break-word"] {
            word-break: break-word !important;
        }

        /* Font family for numbers */
        div[style*="font-family: monospace"] {
            font-family: monospace !important;
            font-size: 8pt !important;
        }
    }

    @media (max-width: 768px) {
        div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px"] {
            grid-template-columns: 1fr 1fr !important;
        }

        div[style*="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush
@endsection
