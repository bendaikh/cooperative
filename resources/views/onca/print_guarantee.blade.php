<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat de Garantie - {{ $document->reference }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.4;
            background: #f5f5f5;
        }

        .container {
            width: 8.5in;
            height: auto;
            background: white;
            margin: 10px auto;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2d7a52;
            padding-bottom: 15px;
        }

        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #2d7a52;
            margin-bottom: 5px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 11px;
            color: #6b7280;
        }

        .meta-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 18px;
            padding: 12px;
            background: #f0fdf4;
            border-radius: 4px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            font-size: 10px;
            font-weight: bold;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .meta-value {
            font-size: 11px;
            color: #1f2937;
        }

        .section {
            margin-bottom: 12px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #2d7a52;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 1.5px solid #2d7a52;
        }

        .section-content {
            font-size: 11px;
            color: #4b5563;
            line-height: 1.5;
            margin-left: 0;
        }

        .field {
            margin-bottom: 6px;
        }

        .field-label {
            font-weight: bold;
            color: #1f2937;
            font-size: 11px;
            margin-bottom: 2px;
        }

        .field-value {
            color: #4b5563;
            padding-left: 8px;
            border-left: 2px solid #e5e7eb;
            font-size: 10px;
            word-wrap: break-word;
            white-space: normal;
        }

        .footer {
            margin-top: 20px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }

        .signature-block {
            margin-top: 15px;
            text-align: center;
            font-size: 10px;
        }

        .signature-line {
            width: 120px;
            height: 0.5px;
            background: #333;
            margin: 8px auto 3px;
        }

        .document-link {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            background: #2d7a52;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 10px;
        }

        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }
            .container {
                margin: 0;
                padding: 20px;
                box-shadow: none;
                width: 100%;
            }
            .document-link {
                display: none;
            }
            @page {
                margin: 0.5in;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">Co-op Anrar</div>
            <div class="title">Certificat de Garantie</div>
            <div class="subtitle">Attestation de Qualité et Fiabilité des Produits</div>
        </div>

        <!-- Metadata -->
        <div class="meta-info">
            <div class="meta-item">
                <span class="meta-label">Référence</span>
                <span class="meta-value">{{ $document->reference }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Date</span>
                <span class="meta-value">{{ $document->date->format('d/m/Y') }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Responsable</span>
                <span class="meta-value">{{ $document->responsible ?? 'N/A' }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Version</span>
                <span class="meta-value">{{ $document->version }}</span>
            </div>
        </div>

        <!-- Section 1: Signataire -->
        @if(isset($document->content['signatory']))
        <div class="section">
            <h2 class="section-title">1. Information du Signataire</h2>
            <div class="section-content">
                @if($document->content['signatory']['full_name'] ?? null)
                <div class="field">
                    <div class="field-label">Nom Complet</div>
                    <div class="field-value">{{ $document->content['signatory']['full_name'] }}</div>
                </div>
                @endif
                
                @if($document->content['signatory']['position'] ?? null)
                <div class="field">
                    <div class="field-label">Position</div>
                    <div class="field-value">{{ $document->content['signatory']['position'] }}</div>
                </div>
                @endif
                
                @if($document->content['signatory']['id_number'] ?? null)
                <div class="field">
                    <div class="field-label">Numéro d'Identité</div>
                    <div class="field-value">{{ $document->content['signatory']['id_number'] }}</div>
                </div>
                @endif
                
                @if($document->content['signatory']['organization'] ?? null)
                <div class="field">
                    <div class="field-label">Organisme</div>
                    <div class="field-value">{{ $document->content['signatory']['organization'] }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 2: Portée de la Garantie -->
        @if(isset($document->content['scope']))
        <div class="section">
            <h2 class="section-title">2. Portée de la Garantie</h2>
            <div class="section-content">
                @if($document->content['scope']['products'] ?? null)
                <div class="field">
                    <div class="field-label">Produits Concernés</div>
                    <div class="field-value">{{ nl2br(e($document->content['scope']['products'])) }}</div>
                </div>
                @endif
                
                @if($document->content['scope']['characteristics'] ?? null)
                <div class="field">
                    <div class="field-label">Caractéristiques Garanties</div>
                    <div class="field-value">{{ nl2br(e($document->content['scope']['characteristics'])) }}</div>
                </div>
                @endif
                
                @if($document->content['scope']['duration'] ?? null)
                <div class="field">
                    <div class="field-label">Durée de la Garantie</div>
                    <div class="field-value">{{ $document->content['scope']['duration'] }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 3: Conditions d'Applicabilité -->
        @if(isset($document->content['conditions']))
        <div class="section">
            <h2 class="section-title">3. Conditions d'Applicabilité</h2>
            <div class="section-content">
                @if($document->content['conditions']['security'] ?? null)
                <div class="field">
                    <div class="field-label">Sécurité Garantie</div>
                    <div class="field-value">{{ nl2br(e($document->content['conditions']['security'])) }}</div>
                </div>
                @endif
                
                @if($document->content['conditions']['liability'] ?? null)
                <div class="field">
                    <div class="field-label">Responsabilité en Cas de Dommage</div>
                    <div class="field-value">{{ nl2br(e($document->content['conditions']['liability'])) }}</div>
                </div>
                @endif
                
                @if($document->content['conditions']['special_terms'] ?? null)
                <div class="field">
                    <div class="field-label">Conditions Particulières</div>
                    <div class="field-value">{{ nl2br(e($document->content['conditions']['special_terms'])) }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 4: Procédure de Réclamation -->
        @if(isset($document->content['claims']))
        <div class="section">
            <h2 class="section-title">4. Procédure de Réclamation</h2>
            <div class="section-content">
                @if($document->content['claims']['return_procedure'] ?? null)
                <div class="field">
                    <div class="field-label">Modalités de Retour</div>
                    <div class="field-value">{{ nl2br(e($document->content['claims']['return_procedure'])) }}</div>
                </div>
                @endif
                
                @if($document->content['claims']['contact'] ?? null)
                <div class="field">
                    <div class="field-label">Contact pour Réclamation</div>
                    <div class="field-value">{{ $document->content['claims']['contact'] }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 5: Signature -->
        @if(isset($document->content['signature']))
        <div class="section">
            <h2 class="section-title">5. Signature et Authentification</h2>
            <div class="section-content">
                @if($document->content['signature']['signature_type'] ?? null)
                <div class="field">
                    <div class="field-label">Type de Signature</div>
                    <div class="field-value">{{ $document->content['signature']['signature_type'] }}</div>
                </div>
                @endif
                
                @if($document->content['signature']['place'] ?? null)
                <div class="field">
                    <div class="field-label">Lieu de Signature</div>
                    <div class="field-value">{{ $document->content['signature']['place'] }}</div>
                </div>
                @endif

                <div class="signature-block">
                    <p style="font-weight: bold; font-size: 10px;">Signé à {{ $document->content['signature']['place'] ?? 'Co-op Anrar' }}</p>
                    <p style="font-size: 10px;">Le {{ $document->date->format('d/m/Y') }}</p>
                    <div class="signature-line"></div>
                    <p style="font-size: 10px;">{{ $document->responsible ?? '' }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Document Link if available -->
        @if($document->document_url)
        <div style="text-align: center; margin-top: 12px;">
            <a href="{{ $document->document_url }}" target="_blank" class="document-link">
                📎 Document original
            </a>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>Document généré le {{ now()->format('d/m/Y à H:i') }} | Coopérative Anrar Ntgadirin</p>
        </div>
    </div>
</body>
</html>
