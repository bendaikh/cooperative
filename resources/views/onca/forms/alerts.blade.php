@extends('layouts.app')

@section('title', isset($document) ? 'تحرير وثيقة' : 'وثيقة جديدة')
@section('page-title', isset($document) ? 'تحرير وثيقة' : 'وثيقة جديدة')

@push('styles')
<style>
    .form-container {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 2rem;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .back-link {
        color: #2563eb;
        text-decoration: none;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        transition: color 0.2s;
    }
    
    .back-link:hover {
        color: #1d4ed8;
    }
    
    .form-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin: 1rem 0 0.5rem 0;
        text-align: center;
    }
    
    .form-meta {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
        padding: 1rem;
        background: #f0f9ff;
        border-radius: 0.5rem;
    }
    
    .meta-field {
        display: flex;
        flex-direction: column;
    }
    
    .meta-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }
    
    .meta-value {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .section {
        margin-bottom: 2.5rem;
    }
    
    .section-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid #3b82f6;
    }
    
    .section-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .section-content.full {
        grid-template-columns: 1fr;
    }
    
    .form-field {
        display: flex;
        flex-direction: column;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    
    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .radio-group {
        display: flex;
        gap: 2rem;
        margin-top: 0.5rem;
    }
    
    .radio-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .radio-item input[type="radio"] {
        cursor: pointer;
    }
    
    .radio-item label {
        cursor: pointer;
        margin: 0;
        font-weight: 500;
    }
    
    .form-footer {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn {
        padding: 0.625rem 1.5rem;
        border-radius: 0.5rem;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-primary {
        background: #3b82f6;
        color: white;
    }
    
    .btn-primary:hover {
        background: #2563eb;
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    .doc-section {
        background: #fef3c7;
        border: 1px solid #fcd34d;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .doc-section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <div class="form-header">
        <a href="{{ route('onca.index') }}" class="back-link">
            ← العودة إلى القائمة
        </a>
        <div style="text-align: center;">
            <h2 class="form-title">تسجيل</h2>
            <p style="font-size: 1.25rem; color: #6b7280; margin: 0.25rem 0 0 0;">تفاصيل حالة الإنذار</p>
        </div>
    </div>

    <form method="POST" action="{{ isset($document) ? route('onca.update', $document) : route('onca.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($document))
            @method('PUT')
        @endif

        <!-- Hidden Fields -->
        <input type="hidden" name="type" value="{{ $type ?? 'alerts' }}">
        <input type="hidden" name="reference" value="{{ $meta['ref'] ?? 'PR-R-EN1' }}">
        <input type="hidden" name="title" value="تسجيل تفاصيل حالة الإنذار">
        <input type="hidden" name="version" value="{{ $meta['ver'] ?? '01' }}">

        <!-- Information Header -->
        <div class="form-meta">
            <div class="meta-field">
                <span class="meta-label">الرمز</span>
                <span class="meta-value">{{ $meta['ref'] ?? 'PR-R-EN1' }}</span>
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

        <!-- SECTION 1: مصدر الشكاية -->
        <div class="section">
            <h3 class="section-title">1️⃣ مصدر الشكاية</h3>
            <div class="section-content">
                <div class="form-field">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="content[complaint_source][name]" class="form-input"
                        value="{{ old('content.complaint_source.name', $document->content['complaint_source']['name'] ?? '') }}">
                </div>
                <div class="form-field">
                    <label class="form-label">العنوان</label>
                    <input type="text" name="content[complaint_source][address]" class="form-input"
                        value="{{ old('content.complaint_source.address', $document->content['complaint_source']['address'] ?? '') }}">
                </div>
                <div class="form-field">
                    <label class="form-label">الهاتف</label>
                    <input type="tel" name="content[complaint_source][phone]" class="form-input"
                        value="{{ old('content.complaint_source.phone', $document->content['complaint_source']['phone'] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- SECTION 2: المنتج المعني -->
        <div class="section">
            <h3 class="section-title">2️⃣ المنتج المعني</h3>
            <div class="section-content">
                <div class="form-field">
                    <label class="form-label">المنتج</label>
                    <input type="text" name="content[product][product_name]" class="form-input"
                        value="{{ old('content.product.product_name', $document->content['product']['product_name'] ?? '') }}">
                </div>
                <div class="form-field">
                    <label class="form-label">الماركة</label>
                    <input type="text" name="content[product][brand]" class="form-input"
                        value="{{ old('content.product.brand', $document->content['product']['brand'] ?? '') }}">
                </div>
                <div class="form-field">
                    <label class="form-label">رقم الدفعة</label>
                    <input type="text" name="content[product][batch_number]" class="form-input"
                        value="{{ old('content.product.batch_number', $document->content['product']['batch_number'] ?? '') }}">
                </div>
                <div class="form-field">
                    <label class="form-label">نوع وشكل التعبئة</label>
                    <input type="text" name="content[product][packaging_type]" class="form-input"
                        value="{{ old('content.product.packaging_type', $document->content['product']['packaging_type'] ?? '') }}">
                </div>
                <div class="form-field" style="grid-column: 1 / -1;">
                    <label class="form-label">هل قدمت عينة؟</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="sample_yes" name="content[product][sample_provided]" value="نعم"
                                {{ old('content.product.sample_provided', $document->content['product']['sample_provided'] ?? '') === 'نعم' ? 'checked' : '' }}>
                            <label for="sample_yes">نعم</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="sample_no" name="content[product][sample_provided]" value="لا"
                                {{ old('content.product.sample_provided', $document->content['product']['sample_provided'] ?? '') === 'لا' ? 'checked' : '' }}>
                            <label for="sample_no">لا</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: العيوب المنسوبة للمنتج -->
        <div class="section">
            <h3 class="section-title">3️⃣ العيوب المنسوبة للمنتج</h3>
            <div class="section-content full">
                <div class="form-field">
                    <label class="form-label">وصف العيوب</label>
                    <textarea name="content[product_defects][description]" class="form-textarea"
                        placeholder="اشرح العيوب بالتفصيل">{{ old('content.product_defects.description', $document->content['product_defects']['description'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 4: أصل المنتج (الإنتاج) -->
        <div class="section">
            <h3 class="section-title">4️⃣ أصل المنتج (الإنتاج)</h3>
            <div class="section-content">
                <div class="form-field">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="content[product_origin][name]" class="form-input"
                        value="{{ old('content.product_origin.name', $document->content['product_origin']['name'] ?? '') }}">
                </div>
                <div class="form-field">
                    <label class="form-label">العنوان</label>
                    <input type="text" name="content[product_origin][address]" class="form-input"
                        value="{{ old('content.product_origin.address', $document->content['product_origin']['address'] ?? '') }}">
                </div>
                <div class="form-field">
                    <label class="form-label">تاريخ الشراء</label>
                    <input type="date" name="content[product_origin][purchase_date]" class="form-input"
                        value="{{ old('content.product_origin.purchase_date', $document->content['product_origin']['purchase_date'] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- SECTION 5: كيفية تخزين المنتج -->
        <div class="section">
            <h3 class="section-title">5️⃣ كيفية تخزين المنتج والتعامل معه بعد الشراء</h3>
            <div class="section-content full">
                <div class="form-field">
                    <label class="form-label">وصف التخزين والتعامل</label>
                    <textarea name="content[storage_handling]" class="form-textarea"
                        placeholder="اشرح كيفية التخزين والتعامل مع المنتج">{{ old('content.storage_handling', $document->content['storage_handling'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 6: حالة المرض / الإصابة -->
        <div class="section">
            <h3 class="section-title">6️⃣ حالة المرض / الإصابة</h3>
            <div class="section-content">
                <div class="form-field">
                    <label class="form-label">عدد الأشخاص الذين استهلكوا المنتج</label>
                    <input type="number" name="content[illness][total_consumers]" class="form-input" min="0"
                        value="{{ old('content.illness.total_consumers', $document->content['illness']['total_consumers'] ?? '') }}">
                </div>
                <div class="form-field">
                    <label class="form-label">عدد الأشخاص المصابين</label>
                    <input type="number" name="content[illness][affected_count]" class="form-input" min="0"
                        value="{{ old('content.illness.affected_count', $document->content['illness']['affected_count'] ?? '') }}">
                </div>
                <div class="form-field" style="grid-column: 1 / -1;">
                    <label class="form-label">معلومات المصابين (الأسماء – الأعمار – الكميات المستهلكة – التواريخ)</label>
                    <textarea name="content[illness][affected_info]" class="form-textarea"
                        placeholder="أدخل معلومات المصابين">{{ old('content.illness.affected_info', $document->content['illness']['affected_info'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 7: أعراض المرض -->
        <div class="section">
            <h3 class="section-title">7️⃣ أعراض المرض (حسب الشدة)</h3>
            <div class="section-content full">
                <div class="form-field">
                    <label class="form-label">وصف الأعراض</label>
                    <textarea name="content[symptoms]" class="form-textarea"
                        placeholder="اشرح أعراض المرض بالتفصيل">{{ old('content.symptoms', $document->content['symptoms'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 8: الأطباء -->
        <div class="section">
            <h3 class="section-title">8️⃣ الأطباء الذين تمت استشارتهم</h3>
            <div class="section-content full">
                <div class="form-field">
                    <label class="form-label">الأسماء – العناوين – تواريخ الاستشارات</label>
                    <textarea name="content[doctors]" class="form-textarea"
                        placeholder="أدخل بيانات الأطباء">{{ old('content.doctors', $document->content['doctors'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 9: الحالة الراهنة -->
        <div class="section">
            <h3 class="section-title">9️⃣ الحالة الراهنة للمرض / الإصابة</h3>
            <div class="section-content full">
                <div class="form-field">
                    <label class="form-label">الحالة الصحية الحالية</label>
                    <textarea name="content[current_status]" class="form-textarea"
                        placeholder="اشرح الحالة الحالية">{{ old('content.current_status', $document->content['current_status'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 10: المؤسسات الأخرى -->
        <div class="section">
            <h3 class="section-title">🔟 المؤسسات أو الأماكن الأخرى التي اشتكى فيها مقدم الشكوى</h3>
            <div class="section-content full">
                <div class="form-field">
                    <label class="form-label">المؤسسات أو الأماكن المعنية</label>
                    <textarea name="content[other_institutions]" class="form-textarea"
                        placeholder="أدخل المؤسسات الأخرى">{{ old('content.other_institutions', $document->content['other_institutions'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SIGNATURE SECTION -->
        <div class="section">
            <h3 class="section-title">✍️ تأشير مسؤول الجودة</h3>
            <div class="section-content">
                <div class="form-field">
                    <label class="form-label">اسم مسؤول الجودة</label>
                    <input type="text" name="content[quality_officer_signature]" class="form-input"
                        value="{{ old('content.quality_officer_signature', $document->content['quality_officer_signature'] ?? '') }}">
                </div>
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
