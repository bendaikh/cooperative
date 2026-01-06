<style>
    .form-container-guarantee {
        background: transparent;
        border-radius: 0;
        box-shadow: none;
        padding: 0;
        max-width: 100%;
        margin: 0;
    }
    
    .form-header-guarantee {
        display: none;
    }
    
    .back-link-guarantee {
        color: #2563eb;
        text-decoration: none;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        transition: color 0.2s;
    }
    
    .back-link-guarantee:hover {
        color: #1d4ed8;
    }
    
    .form-title-guarantee {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin: 1rem 0 0.5rem 0;
        text-align: center;
    }
    
    .form-meta-guarantee {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
        padding: 1rem;
        background: #f0f9ff;
        border-radius: 0.5rem;
    }
    
    .meta-field-guarantee {
        display: flex;
        flex-direction: column;
    }
    
    .meta-label-guarantee {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }
    
    .meta-value-guarantee {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .section-guarantee {
        margin-bottom: 2.5rem;
    }
    
    .section-title-guarantee {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid #6366f1;
    }
    
    .section-content-guarantee {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .section-content-guarantee.full {
        grid-template-columns: 1fr;
    }
    
    .form-field-guarantee {
        display: flex;
        flex-direction: column;
    }
    
    .form-label-guarantee {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .form-input-guarantee,
    .form-textarea-guarantee,
    .form-select-guarantee {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    
    .form-input-guarantee:focus,
    .form-textarea-guarantee:focus,
    .form-select-guarantee:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    .form-textarea-guarantee {
        resize: vertical;
        min-height: 100px;
    }
    
    .radio-group-guarantee {
        display: flex;
        gap: 2rem;
        margin-top: 0.5rem;
    }
    
    .radio-item-guarantee {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .radio-item-guarantee input[type="radio"] {
        cursor: pointer;
    }
    
    .radio-item-guarantee label {
        cursor: pointer;
        margin: 0;
        font-weight: 500;
    }
    
    .form-footer-guarantee {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-guarantee {
        padding: 0.625rem 1.5rem;
        border-radius: 0.5rem;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-primary-guarantee {
        background: #6366f1;
        color: white;
    }
    
    .btn-primary-guarantee:hover {
        background: #4f46e5;
    }
    
    .btn-secondary-guarantee {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .btn-secondary-guarantee:hover {
        background: #e5e7eb;
    }
    
    .doc-section-guarantee {
        background: #fef3c7;
        border: 1px solid #fcd34d;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .doc-section-title-guarantee {
        font-size: 1rem;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 1rem;
    }
</style>

<div class="form-container-guarantee">
    <div class="form-header-guarantee">
        <a href="{{ route('onca.index') }}" class="back-link-guarantee">
            ← Retour
        </a>
        <div style="text-align: center;">
            <h2 class="form-title-guarantee">Certificat de Garantie</h2>
        </div>
    </div>

    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="reference" value="{{ $meta['ref'] ?? 'CERT-GAR-001' }}">
    <input type="hidden" name="title" value="Certificat de Garantie">
    <input type="hidden" name="version" value="{{ $meta['ver'] ?? '01' }}">>

        <!-- Information Header -->
        <div class="form-meta-guarantee">
            <div class="meta-field-guarantee">
                <span class="meta-label-guarantee">Référence</span>
                <span class="meta-value-guarantee">{{ $meta['ref'] ?? 'CERT-GAR-001' }}</span>
            </div>
            <div class="meta-field-guarantee">
                <span class="meta-label-guarantee">Version</span>
                <span class="meta-value-guarantee">{{ $meta['ver'] ?? '01' }}</span>
            </div>
            <div class="meta-field-guarantee">
                <label class="meta-label-guarantee">Date</label>
                <input type="date" name="date" class="form-input-guarantee" 
                    value="{{ old('date', isset($document) ? $document->date->format('Y-m-d') : date('Y-m-d')) }}" required>
            </div>
            <div class="meta-field-guarantee">
                <label class="meta-label-guarantee">Responsable</label>
                <input type="text" name="responsible" class="form-input-guarantee"
                    value="{{ old('responsible', isset($document) ? $document->responsible : Auth::user()->name) }}">
            </div>
        </div>

        <!-- SECTION 1: Information Signataire -->
        <div class="section-guarantee">
            <h3 class="section-title-guarantee">1. Information du Signataire</h3>
            <div class="section-content-guarantee">
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Nom Complet</label>
                    <input type="text" name="content[signatory][full_name]" class="form-input-guarantee"
                        value="{{ old('content.signatory.full_name', $document->content['signatory']['full_name'] ?? '') }}" required>
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Position/Titre</label>
                    <input type="text" name="content[signatory][position]" class="form-input-guarantee"
                        value="{{ old('content.signatory.position', $document->content['signatory']['position'] ?? '') }}" required>
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Numéro d'Identité</label>
                    <input type="text" name="content[signatory][id_number]" class="form-input-guarantee"
                        value="{{ old('content.signatory.id_number', $document->content['signatory']['id_number'] ?? '') }}" required>
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Organisme/Institution</label>
                    <input type="text" name="content[signatory][organization]" class="form-input-guarantee"
                        value="{{ old('content.signatory.organization', $document->content['signatory']['organization'] ?? '') }}" required>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Portée de la Garantie -->
        <div class="section-guarantee">
            <h3 class="section-title-guarantee">2. Portée de la Garantie</h3>
            <div class="section-content-guarantee full">
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Produits Concernés</label>
                    <textarea name="content[scope][products]" class="form-textarea-guarantee"
                        placeholder="Énumérez les produits couverts par cette garantie">{{ old('content.scope.products', $document->content['scope']['products'] ?? '') }}</textarea>
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Caractéristiques Garanties</label>
                    <textarea name="content[scope][characteristics]" class="form-textarea-guarantee"
                        placeholder="Décrivez les qualités et fiabilité garanties">{{ old('content.scope.characteristics', $document->content['scope']['characteristics'] ?? '') }}</textarea>
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Durée de la Garantie</label>
                    <input type="text" name="content[scope][duration]" class="form-input-guarantee"
                        value="{{ old('content.scope.duration', $document->content['scope']['duration'] ?? '') }}"
                        placeholder="ex: 1 an, 2 ans, durée indéfinie">
                </div>
            </div>
        </div>

        <!-- SECTION 3: Conditions d'Applicabilité -->
        <div class="section-guarantee">
            <h3 class="section-title-guarantee">3. Conditions d'Applicabilité</h3>
            <div class="section-content-guarantee full">
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Sécurité Garantie</label>
                    <textarea name="content[conditions][security]" class="form-textarea-guarantee"
                        placeholder="Détails sur la sécurité garantie">{{ old('content.conditions.security', $document->content['conditions']['security'] ?? '') }}</textarea>
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Responsabilité en Cas de Dommage</label>
                    <textarea name="content[conditions][liability]" class="form-textarea-guarantee"
                        placeholder="Mesures à prendre en cas de produit endommagé ou non-utilisable">{{ old('content.conditions.liability', $document->content['conditions']['liability'] ?? '') }}</textarea>
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Conditions Particulières</label>
                    <textarea name="content[conditions][special_terms]" class="form-textarea-guarantee"
                        placeholder="Autres conditions applicables">{{ old('content.conditions.special_terms', $document->content['conditions']['special_terms'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 4: Procédure de Réclamation -->
        <div class="section-guarantee">
            <h3 class="section-title-guarantee">4. Procédure de Réclamation</h3>
            <div class="section-content-guarantee full">
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Modalités de Retour de Produit</label>
                    <textarea name="content[claims][return_procedure]" class="form-textarea-guarantee"
                        placeholder="Conditions et processus pour retourner un produit expiré ou non-utilisable">{{ old('content.claims.return_procedure', $document->content['claims']['return_procedure'] ?? '') }}</textarea>
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Contact pour Réclamation</label>
                    <input type="text" name="content[claims][contact]" class="form-input-guarantee"
                        value="{{ old('content.claims.contact', $document->content['claims']['contact'] ?? '') }}"
                        placeholder="Email, téléphone ou adresse">
                </div>
            </div>
        </div>

        <!-- SECTION 5: Signature et Authentification -->
        <div class="section-guarantee">
            <h3 class="section-title-guarantee">5. Signature et Authentification</h3>
            <div class="section-content-guarantee">
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Signature Numérique/Physique</label>
                    <input type="text" name="content[signature][signature_type]" class="form-input-guarantee"
                        value="{{ old('content.signature.signature_type', $document->content['signature']['signature_type'] ?? '') }}"
                        placeholder="Type de signature">
                </div>
                <div class="form-field-guarantee">
                    <label class="form-label-guarantee">Lieu de Signature</label>
                    <input type="text" name="content[signature][place]" class="form-input-guarantee"
                        value="{{ old('content.signature.place', $document->content['signature']['place'] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- DOCUMENTS SECTION -->
        <div class="doc-section-guarantee">
            <h3 class="doc-section-title-guarantee">📎 Documents Justificatifs</h3>
            <p style="color: #92400e; margin-bottom: 1rem;">Attachez les documents CamScanner ou autres preuves justificatives</p>
            
            <div style="margin-bottom: 1rem;">
                <label class="form-label-guarantee">Source du Document</label>
                <select name="document_source" class="form-select-guarantee">
                    <option value="">-- Sélectionnez une source --</option>
                    <option value="camscanner" {{ old('document_source', $document->document_source ?? '') === 'camscanner' ? 'selected' : '' }}>CamScanner</option>
                    <option value="upload" {{ old('document_source', $document->document_source ?? '') === 'upload' ? 'selected' : '' }}>Téléchargement Direct</option>
                    <option value="physical" {{ old('document_source', $document->document_source ?? '') === 'physical' ? 'selected' : '' }}>Document Physique</option>
                </select>
            </div>

            <div style="margin-bottom: 1rem;">
                <label class="form-label-guarantee">Lien du Document (si CamScanner)</label>
                <input type="url" name="document_url" class="form-input-guarantee"
                    value="{{ old('document_url', $document->document_url ?? '') }}"
                    placeholder="https://www.camscanner.com/file/detail?id=...">
                <small style="color: #6b7280;">Collez le lien de partage CamScanner du certificat original</small>
            </div>
        </div>

        <!-- DOCUMENTS SECTION -->
        <div class="doc-section-guarantee">
            <h3 class="doc-section-title-guarantee">📎 Documents Justificatifs</h3>
