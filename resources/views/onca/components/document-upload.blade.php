<!-- ONCA Document Upload Section -->
<div class="onca-form-section">
    <h3 class="onca-form-section-title">Documents Numérisés</h3>
    <p class="onca-section-description">Ajoutez les documents scannés depuis CamScanner ou d'autres sources</p>
    
    <div style="margin-top: 1rem;">
        <!-- Document Source Selection -->
        <div class="onca-form-field">
            <label class="onca-form-label" for="document_source">Source du Document</label>
            <select name="document_source" id="document_source" class="onca-form-select" onchange="toggleDocumentInput()">
                <option value="upload">Télécharger un fichier</option>
                <option value="camscanner" {{ isset($document) && $document->document_source === 'camscanner' ? 'selected' : '' }}>Lien CamScanner</option>
                <option value="external">Lien externe</option>
            </select>
        </div>

        <!-- Primary Document URL Input -->
        <div class="onca-form-field" id="primary-url-field" style="display: none;">
            <label class="onca-form-label" for="document_url">
                <strong>Lien Principal du Document</strong>
                <span style="color: #6b7280; font-weight: normal;">(requis)</span>
            </label>
            <input 
                type="url" 
                name="document_url" 
                id="document_url"
                class="onca-form-input" 
                value="{{ isset($document) ? $document->document_url : '' }}"
                placeholder="https://link.camscanner.com/xxxxx"
            >
            <small style="color: #6b7280; margin-top: 0.25rem; display: block;">
                Collez l'URL complète du document CamScanner
            </small>
        </div>

        <!-- Multiple URLs Input -->
        <div class="onca-form-field" id="multiple-urls-field" style="display: none;">
            <label class="onca-form-label">Documents Additionnels</label>
            <div id="document-urls-container">
                @if(isset($document) && $document->document_urls)
                    @foreach($document->document_urls as $index => $url)
                        <div class="document-url-input-group" style="margin-bottom: 0.75rem; display: flex; gap: 0.5rem;">
                            <input 
                                type="url" 
                                name="document_urls[]" 
                                class="onca-form-input" 
                                value="{{ $url }}"
                                placeholder="https://link.camscanner.com/xxxxx"
                                style="flex: 1;"
                            >
                            <button 
                                type="button" 
                                class="btn-remove-url" 
                                onclick="removeDocumentUrl(this)"
                                style="padding: 0.5rem 0.75rem; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem; transition: all 0.2s;"
                            >
                                Supprimer
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <button 
                type="button" 
                class="btn-add-url"
                onclick="addDocumentUrl()"
                style="margin-top: 0.75rem; padding: 0.5rem 1rem; background: #f0fdf4; color: #166534; border: 1px solid #86efac; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem; transition: all 0.2s;"
            >
                + Ajouter un autre document
            </button>
        </div>

        <!-- Help Text -->
        <div style="margin-top: 1.5rem; background: #eff6ff; border-left: 4px solid #3b82f6; padding: 1rem; border-radius: 0.375rem;">
            <p style="font-size: 0.875rem; color: #1e40af; margin: 0;">
                <strong>Comment obtenir les liens CamScanner :</strong>
            </p>
            <ul style="font-size: 0.875rem; color: #1e40af; margin: 0.5rem 0 0 1.5rem; padding-left: 0;">
                <li>Ouvrez CamScanner et sélectionnez le document</li>
                <li>Cliquez sur le bouton "Partager" (Share)</li>
                <li>Copiez le lien court (https://link.camscanner.com/xxxxx)</li>
                <li>Collez-le dans le champ ci-dessus</li>
            </ul>
        </div>
    </div>
</div>

<style>
    .onca-section-description {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }
    
    .document-url-input-group {
        animation: slideIn 0.2s ease-in;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .btn-remove-url:hover {
        background: #fecaca;
        color: #7f1d1d;
    }
    
    .btn-add-url:hover {
        background: #dcfce7;
        color: #15803d;
    }
</style>

<script>
function toggleDocumentInput() {
    const source = document.getElementById('document_source').value;
    const primaryUrlField = document.getElementById('primary-url-field');
    const multipleUrlsField = document.getElementById('multiple-urls-field');
    
    if (source === 'upload') {
        primaryUrlField.style.display = 'none';
        multipleUrlsField.style.display = 'none';
    } else {
        primaryUrlField.style.display = 'block';
        multipleUrlsField.style.display = 'block';
    }
}

function addDocumentUrl() {
    const container = document.getElementById('document-urls-container');
    const inputGroup = document.createElement('div');
    inputGroup.className = 'document-url-input-group';
    inputGroup.style.cssText = 'margin-bottom: 0.75rem; display: flex; gap: 0.5rem;';
    
    inputGroup.innerHTML = `
        <input 
            type="url" 
            name="document_urls[]" 
            class="onca-form-input" 
            placeholder="https://link.camscanner.com/xxxxx"
            style="flex: 1;"
        >
        <button 
            type="button" 
            class="btn-remove-url" 
            onclick="removeDocumentUrl(this)"
            style="padding: 0.5rem 0.75rem; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem; transition: all 0.2s;"
        >
            Supprimer
        </button>
    `;
    
    container.appendChild(inputGroup);
}

function removeDocumentUrl(button) {
    button.parentElement.remove();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleDocumentInput();
});
</script>
