@extends('layouts.app')

@section('title', isset($document) ? 'تحرير وثيقة' : 'وثيقة جديدة')
@section('page-title', isset($document) ? 'تحرير وثيقة' : 'وثيقة جديدة')

@push('styles')
<style>
    html, body {
        height: 100%;
    }

    .form-container {
        background: white;
        border-radius: 0;
        box-shadow: none;
        padding: 0.75rem;
        max-width: 100%;
        margin: 0;
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .form-header {
        margin-bottom: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: none;
    }
    
    .back-link {
        color: #2563eb;
        text-decoration: none;
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        transition: color 0.2s;
        font-size: 0.85rem;
    }
    
    .back-link:hover {
        color: #1d4ed8;
    }
    
    .form-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0.25rem 0 0.15rem 0;
        text-align: center;
    }
    
    .form-meta {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.5rem;
        margin-top: 0.5rem;
        padding: 0.4rem;
        background: #f0f9ff;
        border-radius: 0.25rem;
        border: 1px solid #bfdbfe;
        font-size: 0.85rem;
    }
    
    .meta-field {
        display: flex;
        flex-direction: column;
    }
    
    .meta-label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #6b7280;
        margin-bottom: 0.15rem;
    }
    
    .meta-value {
        font-size: 0.8rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .form-input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.95rem;
        font-family: inherit;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.95rem;
        font-family: inherit;
        background-color: white;
        cursor: pointer;
    }
    
    .form-select:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-field {
        margin-bottom: 0;
    }
    
    .form-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.25rem;
        text-align: right;
    }
    
    .onca-form-section {
        margin-bottom: 0.5rem;
        padding: 0;
        background: white;
        border-left: none;
        border-radius: 0;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .onca-form-section-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
        text-align: right;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .form-grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    textarea.form-input {
        min-height: 100px;
        resize: vertical;
        font-family: inherit;
    }
    
    .form-footer {
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }
    
    .btn {
        padding: 0.4rem 0.8rem;
        border-radius: 0.25rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
        font-size: 0.85rem;
    }
    
    .btn-primary {
        background-color: #2563eb;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #1d4ed8;
    }
    
    .btn-secondary {
        background-color: #e5e7eb;
        color: #374151;
    }
    
    .btn-secondary:hover {
        background-color: #d1d5db;
    }
    
    .section-group {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
    }
    
    .section-group-title {
        font-weight: 700;
        color: #374151;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f3f4f6;
        text-align: right;
    }
    
    .subsection-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin: 1.5rem 0 1rem 0;
        text-align: right;
    }

    .onca-form-field {
        margin-bottom: 1.5rem;
    }

    .onca-form-label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        text-align: right;
    }

    .onca-form-input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.95rem;
        font-family: inherit;
    }

    .onca-form-input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .onca-form-select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.95rem;
        font-family: inherit;
        background-color: white;
        cursor: pointer;
    }

    .onca-form-select:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
</style>
@endpush

@section('content')

<div class="form-container">
    <div class="form-header">
        <a href="{{ route('onca.index') }}" class="back-link">
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            الرجوع
        </a>
        <div style="text-align: center;">
            <h2 class="form-title">تسجيل:</h2>
            <p style="font-size: 1.25rem; color: #6b7280; margin: 0.25rem 0 0 0;">مراقبة الإنتاج (المكملات الغذائية)</p>
        </div>
    </div>

    <form method="POST" action="{{ isset($document) ? route('onca.update', $document) : route('onca.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($document))
            @method('PUT')
        @endif

        <!-- Hidden Fields -->
        <input type="hidden" name="type" value="{{ $type ?? 'mca' }}">
        <input type="hidden" name="reference" value="{{ $meta['ref'] ?? 'MCA-EN1' }}">
        <input type="hidden" name="title" value="مراقبة الإنتاج (المكملات الغذائية)">
        <input type="hidden" name="version" value="{{ $meta['ver'] ?? '01' }}">

        <!-- Information Header -->
        <div class="form-meta">
            <div class="meta-field">
                <span class="meta-label">الرمز</span>
                <span class="meta-value">{{ $meta['ref'] ?? 'MCA-EN1' }}</span>
            </div>
            <div class="meta-field">
                <span class="meta-label">الإصدار</span>
                <span class="meta-value">{{ $meta['ver'] ?? '01' }}</span>
            </div>
            <div class="meta-field">
                <label class="meta-label">التاريخ</label>
                <input type="date" name="date" class="form-input" 
                    value="{{ old('date', isset($document) ? $document->date->format('Y-m-d') : date('Y-m-d')) }}" required>
            </div>
            <div class="meta-field">
                <label class="meta-label">المسؤول</label>
                <input type="text" name="responsible" class="form-input"
                    value="{{ old('responsible', isset($document) ? $document->responsible : Auth::user()->name) }}">
            </div>
        </div>

        <!-- SECTION 1: التموين -->
        <div class="onca-form-section">
            <h3 class="onca-form-section-title">1️⃣ التموين</h3>
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 0; direction: rtl; table-layout: fixed; flex: 1;">
                <tbody style="display: flex; flex-direction: column; height: 100%;">
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>المادة</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][material]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.material', isset($document) ? ($document->content['supply']['material'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>قسيمة استلام رقم</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][receipt_voucher_number]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.receipt_voucher_number', isset($document) ? ($document->content['supply']['receipt_voucher_number'] ?? '') : '') }}">
                        </td>
                    </tr>

                    <!-- مواصفات subsection -->
                    <tr style="border: 1px solid #d1d5db; background-color: #f3f4f6; display: flex; flex: 0.8; min-height: 1.5rem;">
                        <td colspan="2" style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; font-weight: 700; display: flex; align-items: center;">
                            مواصفات
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>حالة نظافة العربة</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][cart_cleanliness]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.cart_cleanliness', isset($document) ? ($document->content['supply']['cart_cleanliness'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>حالة نظافة التعليب</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][packaging_cleanliness]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.packaging_cleanliness', isset($document) ? ($document->content['supply']['packaging_cleanliness'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>الرائحة</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][odor]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.odor', isset($document) ? ($document->content['supply']['odor'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>اللون</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][color]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.color', isset($document) ? ($document->content['supply']['color'] ?? '') : '') }}">
                        </td>
                    </tr>

                    <!-- مراقبة subsection -->
                    <tr style="border: 1px solid #d1d5db; background-color: #f3f4f6; display: flex; flex: 0.8; min-height: 1.5rem;">
                        <td colspan="2" style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; font-weight: 700; display: flex; align-items: center;">
                            مراقبة
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>التعفنات</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][rot]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.rot', isset($document) ? ($document->content['supply']['rot'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>المواد الأجنبية</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][foreign_materials]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.foreign_materials', isset($document) ? ($document->content['supply']['foreign_materials'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>الأجسام الأجنبية</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[supply][foreign_bodies]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.supply.foreign_bodies', isset($document) ? ($document->content['supply']['foreign_bodies'] ?? '') : '') }}">
                        </td>
                    </tr>

                    <!-- Conditional rows -->
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>إن كانت الدفعة مقبولة، ما هو الرقم الذي خصص لها؟</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <textarea name="content[supply][if_accepted_number]" style="width: 100%; border: none; padding: 0; background: transparent; min-height: 60px; font-family: inherit;">{{ old('content.supply.if_accepted_number', isset($document) ? ($document->content['supply']['if_accepted_number'] ?? '') : '') }}</textarea>
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>إن كان العكس، ما هو الإجراء الذي اتخذ في شأنها؟</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <textarea name="content[supply][if_rejected_action]" style="width: 100%; border: none; padding: 0; background: transparent; min-height: 60px; font-family: inherit;">{{ old('content.supply.if_rejected_action', isset($document) ? ($document->content['supply']['if_rejected_action'] ?? '') : '') }}</textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- SECTION 2: التعبئة والعنونة -->
        <div class="onca-form-section">
            <h3 class="onca-form-section-title">2️⃣ التعبئة والعنونة</h3>

            <table style="width: 100%; border-collapse: collapse; margin-top: 0; direction: rtl; table-layout: fixed; flex: 1;">
                <tbody style="display: flex; flex-direction: column; height: 100%;">
                    <!-- التعبئة subsection -->
                    <tr style="border: 1px solid #d1d5db; background-color: #f3f4f6; display: flex; flex: 0.8; min-height: 1.5rem;">
                        <td colspan="2" style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; font-weight: 700; display: flex; align-items: center;">
                            التعبئة
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>نوع المنتج</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[packaging][product_type]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.packaging.product_type', isset($document) ? ($document->content['packaging']['product_type'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>البنية أو خليط نبات</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[packaging][plant_or_mixture]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.packaging.plant_or_mixture', isset($document) ? ($document->content['packaging']['plant_or_mixture'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>رقم الدفعة</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[packaging][batch_number]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.packaging.batch_number', isset($document) ? ($document->content['packaging']['batch_number'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>رقم دفعة التعليب</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[packaging][packaging_batch_number]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.packaging.packaging_batch_number', isset($document) ? ($document->content['packaging']['packaging_batch_number'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>سعة التعليب (غ/مل)</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[packaging][packaging_capacity]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.packaging.packaging_capacity', isset($document) ? ($document->content['packaging']['packaging_capacity'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>نظافة التعليب والكبسولات</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[packaging][cleanliness]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.packaging.cleanliness', isset($document) ? ($document->content['packaging']['cleanliness'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>حالة تمكين إغلاق التعليب</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[packaging][closure_condition]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.packaging.closure_condition', isset($document) ? ($document->content['packaging']['closure_condition'] ?? '') : '') }}">
                        </td>
                    </tr>

                    <!-- العنونة subsection -->
                    <tr style="border: 1px solid #d1d5db; background-color: #f3f4f6; display: flex; flex: 0.8; min-height: 1.5rem;">
                        <td colspan="2" style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; font-weight: 700; display: flex; align-items: center;">
                            العنونة
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>التسمية الدقيقة للمنتج</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[labeling][exact_product_name]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.labeling.exact_product_name', isset($document) ? ($document->content['labeling']['exact_product_name'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>المحتوى الصافي</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[labeling][net_content]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.labeling.net_content', isset($document) ? ($document->content['labeling']['net_content'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>رقم الدفعة</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="text" name="content[labeling][batch_number]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.labeling.batch_number', isset($document) ? ($document->content['labeling']['batch_number'] ?? '') : '') }}">
                        </td>
                    </tr>
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>تاريخ انتهاء الصلاحية</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <input type="date" name="content[labeling][expiry_date]" style="width: 100%; border: none; padding: 0; background: transparent;"
                                value="{{ old('content.labeling.expiry_date', isset($document) ? ($document->content['labeling']['expiry_date'] ?? '') : '') }}">
                        </td>
                    </tr>

                    <!-- Additional rows from original -->
                    <tr style="border: 1px solid #d1d5db; display: flex; flex: 1; min-height: 2rem;">
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; text-align: right; width: 25%; background-color: #f9fafb; display: flex; align-items: center;">
                            <strong>التدابير الصحية المتخذة، عند الضرورة</strong>
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.3rem; width: 75%; display: flex; align-items: center;">
                            <textarea name="content[corrective_measures]" style="width: 100%; border: none; padding: 0; background: transparent; min-height: 60px; font-family: inherit;">{{ old('content.corrective_measures', isset($document) ? ($document->content['corrective_measures'] ?? '') : '') }}</textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- FINAL SECTION -->
        <div class="onca-form-section">
            <h3 class="onca-form-section-title">📋 التدابير التصحيحية</h3>

            <div class="form-field">
                <label class="form-label">توقيع مسؤول الإنتاج</label>
                <input type="text" name="content[signature]" class="form-input"
                    value="{{ old('content.signature', isset($document) ? ($document->content['signature'] ?? '') : '') }}">
            </div>
        </div>

        <!-- DOCUMENTS SECTION -->
        <div class="onca-form-section">
            <h3 class="onca-form-section-title">📎 المستندات المرفقة</h3>
            
            <div style="margin-top: 1rem;">
                <!-- Document Source Selection -->
                <div class="onca-form-field">
                    <label class="onca-form-label" for="document_source">نوع إضافة الملف</label>
                    <select name="document_source" id="document_source" class="onca-form-select" onchange="toggleDocumentInput()">
                        <option value="camscanner" {{ isset($document) ? ($document->document_source === 'camscanner' ? 'selected' : '') : 'selected' }}>رابط CamScanner</option>
                        <option value="external" {{ isset($document) && $document->document_source === 'external' ? 'selected' : '' }}>رابط خارجي آخر</option>
                    </select>
                </div>

                <!-- Primary Document URL Input -->
                <div class="onca-form-field" id="primary-url-field">
                    <label class="onca-form-label" for="document_url">
                        <strong>الرابط الرئيسي للملف</strong>
                        <span style="color: #6b7280; font-weight: normal;">(اختياري)</span>
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
                        الصق رابط الملف من CamScanner أو مصدر آخر
                    </small>
                </div>

                <!-- Multiple URLs Input -->
                <div class="onca-form-field" id="multiple-urls-field">
                    <label class="onca-form-label">ملفات إضافية أخرى</label>
                    <div id="document-urls-container">
                        @if(isset($document) && $document->document_urls && is_array($document->document_urls))
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
                                        onclick="removeDocumentUrl(event)"
                                        style="padding: 0.5rem 0.75rem; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem; transition: all 0.2s; white-space: nowrap;"
                                    >
                                        حذف
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    <button 
                        type="button" 
                        class="btn-add-url"
                        onclick="addDocumentUrl(event)"
                        style="margin-top: 0.75rem; padding: 0.5rem 1rem; background: #f0fdf4; color: #166534; border: 1px solid #86efac; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem; transition: all 0.2s;"
                    >
                        + إضافة ملف آخر
                    </button>
                </div>

                <!-- Help Text -->
                <div style="margin-top: 1.5rem; background: #eff6ff; border-right: 4px solid #3b82f6; padding: 1rem; border-radius: 0.375rem; text-align: right;">
                    <p style="font-size: 0.875rem; color: #1e40af; margin: 0;">
                        <strong>كيفية الحصول على روابط CamScanner :</strong>
                    </p>
                    <ul style="font-size: 0.875rem; color: #1e40af; margin: 0.5rem 0 0 0; padding-right: 1.5rem; text-align: right;">
                        <li>افتح تطبيق CamScanner واختر الملف المراد مشاركته</li>
                        <li>انقر على زر "مشاركة" (Share)</li>
                        <li>انسخ الرابط القصير (https://link.camscanner.com/xxxxx)</li>
                        <li>الصقه في الحقل أعلاه</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- FORM FOOTER -->
        <div class="form-footer">
            <a href="{{ route('onca.index') }}" class="btn btn-secondary">إلغاء</a>
            <button type="submit" class="btn btn-primary">
                {{ isset($document) ? 'تحديث الوثيقة' : 'حفظ الوثيقة' }}
            </button>
        </div>
    </form>
</div>

<script>
// Toggle document input fields based on source selection
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

// Add new document URL input field
function addDocumentUrl(event) {
    event.preventDefault();
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
            onclick="removeDocumentUrl(event)"
            style="padding: 0.5rem 0.75rem; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem; transition: all 0.2s; white-space: nowrap;"
        >
            حذف
        </button>
    `;
    
    container.appendChild(inputGroup);
}

// Remove document URL input field
function removeDocumentUrl(event) {
    event.preventDefault();
    event.target.parentElement.remove();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleDocumentInput();
});
</script>

@endsection
