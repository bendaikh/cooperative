@extends('layouts.app')

@section('title', 'Nouveau Document ONCA')
@section('page-title', 'Nouveau Document ONCA')

@push('styles')
<style>
    .onca-create-container {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        max-width: 56rem;
        margin: 0 auto;
    }
    
    .onca-create-header {
        margin-bottom: 1.5rem;
    }
    
    .onca-back-link {
        color: #4f46e5;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color 0.2s;
    }
    
    .onca-back-link:hover {
        color: #4338ca;
    }
    
    .onca-back-icon {
        width: 1rem;
        height: 1rem;
        margin-right: 0.25rem;
    }
    
    .onca-create-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-top: 1rem;
    }
    
    .onca-doc-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    @media (min-width: 768px) {
        .onca-doc-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    .onca-doc-card {
        display: block;
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .onca-doc-card:hover {
        border-color: #16a34a;
        background: #f0fdf4;
    }
    
    .onca-doc-content {
        display: flex;
        align-items: flex-start;
    }
    
    .onca-doc-icon-wrapper {
        flex-shrink: 0;
        padding: 0.75rem;
        border-radius: 0.375rem;
        font-size: 1.5rem;
    }
    
    .onca-doc-icon-health {
        background: #dcfce7;
    }
    
    .onca-doc-card:hover .onca-doc-icon-health {
        background: #bbf7d0;
    }
    
    .onca-doc-icon-pest {
        background: #fee2e2;
    }
    
    .onca-doc-card:hover .onca-doc-icon-pest {
        background: #fecaca;
    }
    
    .onca-doc-icon-cleaning {
        background: #dbeafe;
    }
    
    .onca-doc-card:hover .onca-doc-icon-cleaning {
        background: #bfdbfe;
    }
    
    .onca-doc-icon-batch {
        background: #fef3c7;
    }
    
    .onca-doc-card:hover .onca-doc-icon-batch {
        background: #fde68a;
    }

    .onca-doc-icon-batch_mixture {
        background: #f3d5ff;
    }

    .onca-doc-card:hover .onca-doc-icon-batch_mixture {
        background: #e9d5ff;
    }
    
    .onca-doc-icon-storage {
        background: #e9d5ff;
    }
    
    .onca-doc-card:hover .onca-doc-icon-storage {
        background: #ddd6fe;
    }

    .onca-doc-icon-alerts {
        background: #fed7aa;
    }

    .onca-doc-card:hover .onca-doc-icon-alerts {
        background: #fdba74;
    }

    .onca-doc-icon-mca {
        background: #bfdbfe;
    }

    .onca-doc-card:hover .onca-doc-icon-mca {
        background: #93c5fd;
    }

    .onca-doc-icon-quality {
        background: #dcfce7;
    }

    .onca-doc-card:hover .onca-doc-icon-quality {
        background: #bbf7d0;
    }

    .onca-doc-icon-traceability {
        background: #fce7f3;
    }

    .onca-doc-card:hover .onca-doc-icon-traceability {
        background: #fbcfe8;
    }

    .onca-doc-icon-guarantee {
        background: #d1d5ff;
    }

    .onca-doc-card:hover .onca-doc-icon-guarantee {
        background: #bfdbfe;
    }

    .onca-doc-icon-withdrawal {
        background: #fce7f3;
    }

    .onca-doc-card:hover .onca-doc-icon-withdrawal {
        background: #fbcfe8;
    }

    .onca-doc-icon-training {
        background: #dbeafe;
    }

    .onca-doc-card:hover .onca-doc-icon-training {
        background: #bfdbfe;
    }

    .onca-doc-icon-corrective {
        background: #f3e8ff;
    }

    .onca-doc-card:hover .onca-doc-icon-corrective {
        background: #e9d5ff;
    }

    .onca-doc-icon-warehouse_path {
        background: #cffafe;
    }

    .onca-doc-card:hover .onca-doc-icon-warehouse_path {
        background: #a5f3fc;
    }

    .onca-doc-icon-final_stock {
        background: #fef3c7;
    }

    .onca-doc-card:hover .onca-doc-icon-final_stock {
        background: #fde68a;
    }

    .onca-doc-icon-recall_verification {
        background: #dbeafe;
    }

    .onca-doc-card:hover .onca-doc-icon-recall_verification {
        background: #bfdbfe;
    }

    .onca-doc-icon-defects_report {
        background: #fed7aa;
    }

    .onca-doc-card:hover .onca-doc-icon-defects_report {
        background: #fdba74;
    }

    .onca-doc-icon-withdrawal_notice {
        background: #e9d5ff;
    }

    .onca-doc-card:hover .onca-doc-icon-withdrawal_notice {
        background: #ddd6fe;
    }

    .onca-doc-info {
        margin-left: 1rem;
        flex: 1;
    }
    
    .onca-doc-name {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
        margin-bottom: 0.25rem;
    }
    
    .onca-doc-card:hover .onca-doc-name {
        color: #15803d;
    }
    
    .onca-doc-description {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .onca-doc-code {
        display: inline-block;
        margin-top: 0.5rem;
        font-size: 0.75rem;
        font-family: monospace;
        background: #f3f4f6;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
    }
</style>
@endpush

@section('content')
<div class="onca-create-container">
    <div class="onca-create-header">
        <a href="{{ route('onca.index') }}" class="onca-back-link">
            <svg class="onca-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour à la liste
        </a>
        <h2 class="onca-create-title">Sélectionnez le type de document à créer</h2>
    </div>

    <div class="onca-doc-grid">
        <!-- Document 1: Health -->
        <a href="{{ route('onca.create-form', 'health') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-health">
                    <span>👨‍⚕️</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">Surveillance Santé & Hygiène</h3>
                    <p class="onca-doc-description">Mains, tenues, comportement et santé.</p>
                    <span class="onca-doc-code">PR-S-EN1</span>
                </div>
            </div>
        </a>

        <!-- Document 2: Pest -->
        <a href="{{ route('onca.create-form', 'pest') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-pest">
                    <span>🐀</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">Lutte contre les Nuisibles</h3>
                    <p class="onca-doc-description">Contrôle préventif et curatif.</p>
                    <span class="onca-doc-code">PR-V-EN1</span>
                </div>
            </div>
        </a>

        <!-- Document 3: Cleaning -->
        <a href="{{ route('onca.create-form', 'cleaning') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-cleaning">
                    <span>🧹</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">Nettoyage et Désinfection</h3>
                    <p class="onca-doc-description">Locaux, équipements, sanitaires.</p>
                    <span class="onca-doc-code">PR-N-EN1</span>
                </div>
            </div>
        </a>

        <!-- Document 4: Batch -->
        <a href="{{ route('onca.create-form', 'batch') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-batch">
                    <span>🏷️</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">Codification des Lots</h3>
                    <p class="onca-doc-description">Traçabilité des matières premières reçues.</p>
                    <span class="onca-doc-code">PR-T-EN2</span>
                </div>
            </div>
        </a>

        <!-- Document 4B: Batch Mixture -->
        <a href="{{ route('onca.create-form', 'batch_mixture') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-batch_mixture">
                    <span>🥣</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">Codification des Mélange</h3>
                    <p class="onca-doc-description">Traçabilité des mélanges de lots.</p>
                    <span class="onca-doc-code">PR-T-EN3</span>
                </div>
            </div>
        </a>

        <!-- Document 5: Storage -->
        <a href="{{ route('onca.create-form', 'storage') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-storage">
                    <span>📦</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">Fiche de Stock</h3>
                    <p class="onca-doc-description">Entrées, sorties et solde.</p>
                    <span class="onca-doc-code">PR-T-EN4</span>
                </div>
            </div>
        </a>

        <!-- Document 6: Alerts -->
        <a href="{{ route('onca.create-form', 'alerts') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-alerts">
                    <span>🚨</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">Enregistrement des Alertes</h3>
                    <p class="onca-doc-description">Détails d'état des alertes et incidents.</p>
                    <span class="onca-doc-code">PR-R-EN1</span>
                </div>
            </div>
        </a>

        <!-- Document 7: MCA -->
        <a href="{{ route('onca.create-form', 'mca') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-mca">
                    <span>📋</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">مراقبة الإنتاج</h3>
                    <p class="onca-doc-description">مراقبة الإنتاج (المكملات الغذائية)</p>
                    <span class="onca-doc-code">MCA-EN1</span>
                </div>
            </div>
        </a>

        <!-- Document 8: Quality Control -->
        <a href="{{ route('onca.create-form', 'quality') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-quality">
                    <span>✅</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">نموذج مراقبة الجودة</h3>
                    <p class="onca-doc-description">مراقبة جودة الإنتاج والمواد.</p>
                    <span class="onca-doc-code">PR-R-EN7</span>
                </div>
            </div>
        </a>

        <!-- Document 8: Traceability Recording -->
        <a href="{{ route('onca.create-form', 'traceability') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-traceability">
                    <span>🔍</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">إعادة التتبع</h3>
                    <p class="onca-doc-description">تسجيل السحب والتجميع والمواد الأولية.</p>
                    <span class="onca-doc-code">PR-R-EN3</span>
                </div>
            </div>
        </a>

        <!-- Document 9: Corrective and Preventive Actions -->
        <a href="{{ route('onca.create-form', 'corrective') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-corrective">
                    <span>🔧</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">الإجراءات التصحيحية والوقائية</h3>
                    <p class="onca-doc-description">سجل الإجراءات التصحيحية والوقائية المتخذة.</p>
                    <span class="onca-doc-code">PR-R-EN8</span>
                </div>
            </div>
        </a>

        <!-- Document 10: Warehouse Path Tracking -->
        <a href="{{ route('onca.create-form', 'warehouse_path') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-warehouse_path">
                    <span>📊</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">تسجيل مسار الدفعة</h3>
                    <p class="onca-doc-description">تتبع مسار الدفعة عبر مراحل الإنتاج.</p>
                    <span class="onca-doc-code">PR-T-EN9</span>
                </div>
            </div>
        </a>

        <!-- Document 11: Final Product Stock -->
        <a href="{{ route('onca.create-form', 'final_stock') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-final_stock">
                    <span>📦</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">دخول وخروج المنتج النهائي</h3>
                    <p class="onca-doc-description">سجل دخول وخروج المنتج النهائي والمخزون.</p>
                    <span class="onca-doc-code">PR-T-EN5</span>
                </div>
            </div>
        </a>

        <!-- Document 12: Recall Verification -->
        <a href="{{ route('onca.create-form', 'recall_verification') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-recall_verification">
                    <span>🔍</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">التحقق من السحب/التجميع</h3>
                    <p class="onca-doc-description">التحقق من فعالية عملية السحب أو التجميع.</p>
                    <span class="onca-doc-code">PR-R-EN9</span>
                </div>
            </div>
        </a>

        <!-- Document 13: Defects Report -->
        <a href="{{ route('onca.create-form', 'defects_report') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-defects_report">
                    <span>⚠️</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">تقرير العيوب</h3>
                    <p class="onca-doc-description">تسجيل وتحقيق العيوب المكتشفة في المنتجات.</p>
                    <span class="onca-doc-code">PR-R-EN2</span>
                </div>
            </div>
        </a>

        <!-- Document 14: Withdrawal Notice -->
        <a href="{{ route('onca.create-form', 'withdrawal_notice') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-withdrawal_notice">
                    <span>📢</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">إشعار بالسحب</h3>
                    <p class="onca-doc-description">إشعار رسمي بسحب المنتجات من السوق.</p>
                    <span class="onca-doc-code">PR-R-FR2</span>
                </div>
            </div>
        </a>

        <!-- Document 15: Guarantee Certificate -->
        <a href="{{ route('onca.create-form', 'guarantee') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-guarantee">
                    <span>📄</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">Certificat de Garantie</h3>
                    <p class="onca-doc-description">Attestation de garantie et qualité des produits.</p>
                    <span class="onca-doc-code">CERT-GAR-001</span>
                </div>
            </div>
        </a>

        <!-- Document 13: Training Participants -->
        <a href="{{ route('onca.create-form', 'training') }}" class="onca-doc-card">
            <div class="onca-doc-content">
                <div class="onca-doc-icon-wrapper onca-doc-icon-training">
                    <span>🎓</span>
                </div>
                <div class="onca-doc-info">
                    <h3 class="onca-doc-name">لائحة المشاركين في التكوين</h3>
                    <p class="onca-doc-description">تسجيل المشاركين في برامج التدريب والتكوين</p>
                    <span class="onca-doc-code">PR-S-EN2</span>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
