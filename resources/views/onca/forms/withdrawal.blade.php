<style>
    .form-container-withdrawal {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 2rem;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .form-header-withdrawal {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .back-link-withdrawal {
        color: #2563eb;
        text-decoration: none;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        transition: color 0.2s;
    }
    
    .back-link-withdrawal:hover {
        color: #1d4ed8;
    }
    
    .form-title-withdrawal {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin: 1rem 0 0.5rem 0;
        text-align: center;
    }
    
    .form-meta-withdrawal {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
        padding: 1rem;
        background: #fef3c7;
        border-radius: 0.5rem;
    }
    
    .meta-field-withdrawal {
        display: flex;
        flex-direction: column;
    }
    
    .meta-label-withdrawal {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }
    
    .meta-value-withdrawal {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .section-withdrawal {
        margin-bottom: 2.5rem;
    }
    
    .section-title-withdrawal {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid #dc2626;
    }
    
    .section-content-withdrawal {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .section-content-withdrawal.full {
        grid-template-columns: 1fr;
    }
    
    .form-field-withdrawal {
        display: flex;
        flex-direction: column;
    }
    
    .form-label-withdrawal {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .form-input-withdrawal,
    .form-textarea-withdrawal,
    .form-select-withdrawal {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    
    .form-input-withdrawal:focus,
    .form-textarea-withdrawal:focus,
    .form-select-withdrawal:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }
    
    .form-textarea-withdrawal {
        resize: vertical;
        min-height: 100px;
    }
    
    .radio-group-withdrawal {
        display: flex;
        gap: 2rem;
        margin-top: 0.5rem;
    }
    
    .radio-item-withdrawal {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .radio-item-withdrawal input[type="radio"] {
        cursor: pointer;
    }
    
    .radio-item-withdrawal label {
        cursor: pointer;
        margin: 0;
        font-weight: 500;
    }
    
    .form-footer-withdrawal {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-withdrawal {
        padding: 0.625rem 1.5rem;
        border-radius: 0.5rem;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-primary-withdrawal {
        background: #dc2626;
        color: white;
    }
    
    .btn-primary-withdrawal:hover {
        background: #b91c1c;
    }
    
    .btn-secondary-withdrawal {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .btn-secondary-withdrawal:hover {
        background: #e5e7eb;
    }
    
    .doc-section-withdrawal {
        background: #fef3c7;
        border: 1px solid #fcd34d;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .doc-section-title-withdrawal {
        font-size: 1rem;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 1rem;
    }
</style>

<div class="form-container-withdrawal">
    <div class="form-header-withdrawal">
        <a href="{{ route('onca.index') }}" class="back-link-withdrawal">
            ← العودة
        </a>
        <div style="text-align: center;">
            <h2 class="form-title-withdrawal">استمارة اشعار بالسحب</h2>
            <p style="font-size: 1rem; color: #6b7280; margin: 0.25rem 0 0 0;">Formulaire d'Avis de Retrait</p>
        </div>
    </div>

    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="reference" value="{{ $meta['ref'] ?? 'PR-R-FR2' }}">
    <input type="hidden" name="title" value="استمارة اشعار بالسحب">
    <input type="hidden" name="version" value="{{ $meta['ver'] ?? '01' }}">

        <!-- Information Header -->
        <div class="form-meta-withdrawal">
            <div class="meta-field-withdrawal">
                <span class="meta-label-withdrawal">الرمز</span>
                <span class="meta-value-withdrawal">{{ $meta['ref'] ?? 'PR-R-FR2' }}</span>
            </div>
            <div class="meta-field-withdrawal">
                <span class="meta-label-withdrawal">الإصدار</span>
                <span class="meta-value-withdrawal">{{ $meta['ver'] ?? '01' }}</span>
            </div>
            <div class="meta-field-withdrawal">
                <label class="meta-label-withdrawal">ملف رقم</label>
                <input type="text" name="file_number" class="form-input-withdrawal"
                    value="{{ old('file_number', isset($document) ? $document->file_number : '') }}" required>
            </div>
            <div class="meta-field-withdrawal">
                <label class="meta-label-withdrawal">فتح بتاريخ</label>
                <input type="date" name="date" class="form-input-withdrawal" 
                    value="{{ old('date', isset($document) ? $document->date->format('Y-m-d') : date('Y-m-d')) }}" required>
            </div>
        </div>

        <!-- SECTION 1: معلومات المنتج -->
        <div class="section-withdrawal">
            <h3 class="section-title-withdrawal">1. معلومات المنتج المسحوب</h3>
            <div class="section-content-withdrawal">
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">اسم المنتج</label>
                    <input type="text" name="content[product][name]" class="form-input-withdrawal"
                        value="{{ old('content.product.name', $document->content['product']['name'] ?? '') }}" required>
                </div>
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">ماركة المنتج</label>
                    <input type="text" name="content[product][brand]" class="form-input-withdrawal"
                        value="{{ old('content.product.brand', $document->content['product']['brand'] ?? '') }}">
                </div>
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">رقم الدفعة</label>
                    <input type="text" name="content[product][batch_number]" class="form-input-withdrawal"
                        value="{{ old('content.product.batch_number', $document->content['product']['batch_number'] ?? '') }}" required>
                </div>
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">صلاحية المنتج</label>
                    <input type="date" name="content[product][expiry_date]" class="form-input-withdrawal"
                        value="{{ old('content.product.expiry_date', $document->content['product']['expiry_date'] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- SECTION 2: سبب السحب -->
        <div class="section-withdrawal">
            <h3 class="section-title-withdrawal">2. سبب السحب من السوق</h3>
            <div class="section-content-withdrawal full">
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">تصنيف السبب</label>
                    <select name="content[reason][category]" class="form-select-withdrawal" required>
                        <option value="">-- اختر نوع السبب --</option>
                        <option value="quality_issue" {{ old('content.reason.category', $document->content['reason']['category'] ?? '') === 'quality_issue' ? 'selected' : '' }}>مشكلة جودة</option>
                        <option value="contamination" {{ old('content.reason.category', $document->content['reason']['category'] ?? '') === 'contamination' ? 'selected' : '' }}>تلوث</option>
                        <option value="safety_concern" {{ old('content.reason.category', $document->content['reason']['category'] ?? '') === 'safety_concern' ? 'selected' : '' }}>مخاوف سلامة</option>
                        <option value="expired" {{ old('content.reason.category', $document->content['reason']['category'] ?? '') === 'expired' ? 'selected' : '' }}>انتهاء الصلاحية</option>
                        <option value="regulatory" {{ old('content.reason.category', $document->content['reason']['category'] ?? '') === 'regulatory' ? 'selected' : '' }}>مخالفة تنظيمية</option>
                        <option value="other" {{ old('content.reason.category', $document->content['reason']['category'] ?? '') === 'other' ? 'selected' : '' }}>أخرى</option>
                    </select>
                </div>
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">وصف مفصل للسبب</label>
                    <textarea name="content[reason][description]" class="form-textarea-withdrawal"
                        placeholder="اشرح بالتفصيل السبب الذي أدى إلى سحب المنتج من السوق" required>{{ old('content.reason.description', $document->content['reason']['description'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 3: نطاق السحب -->
        <div class="section-withdrawal">
            <h3 class="section-title-withdrawal">3. نطاق السحب</h3>
            <div class="section-content-withdrawal">
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">الكمية المسحوبة</label>
                    <input type="number" name="content[scope][quantity]" class="form-input-withdrawal" step="0.001"
                        value="{{ old('content.scope.quantity', $document->content['scope']['quantity'] ?? '') }}">
                </div>
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">وحدة القياس</label>
                    <input type="text" name="content[scope][unit]" class="form-input-withdrawal"
                        value="{{ old('content.scope.unit', $document->content['scope']['unit'] ?? '') }}"
                        placeholder="كج، لتر، علبة، إلخ">
                </div>
                <div class="form-field-withdrawal" style="grid-column: 1 / -1;">
                    <label class="form-label-withdrawal">نطاق التوزيع</label>
                    <div class="radio-group-withdrawal">
                        <div class="radio-item-withdrawal">
                            <input type="radio" id="scope_local" name="content[scope][distribution]" value="محلي"
                                {{ old('content.scope.distribution', $document->content['scope']['distribution'] ?? '') === 'محلي' ? 'checked' : '' }}>
                            <label for="scope_local">محلي</label>
                        </div>
                        <div class="radio-item-withdrawal">
                            <input type="radio" id="scope_national" name="content[scope][distribution]" value="وطني"
                                {{ old('content.scope.distribution', $document->content['scope']['distribution'] ?? '') === 'وطني' ? 'checked' : '' }}>
                            <label for="scope_national">وطني</label>
                        </div>
                        <div class="radio-item-withdrawal">
                            <input type="radio" id="scope_international" name="content[scope][distribution]" value="دولي"
                                {{ old('content.scope.distribution', $document->content['scope']['distribution'] ?? '') === 'دولي' ? 'checked' : '' }}>
                            <label for="scope_international">دولي</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: الإجراءات المتخذة -->
        <div class="section-withdrawal">
            <h3 class="section-title-withdrawal">4. الإجراءات المتخذة</h3>
            <div class="section-content-withdrawal full">
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">الإجراءات المتخذة</label>
                    <textarea name="content[actions][measures_taken]" class="form-textarea-withdrawal"
                        placeholder="اشرح الإجراءات التي تم اتخاذها لسحب المنتج">{{ old('content.actions.measures_taken', $document->content['actions']['measures_taken'] ?? '') }}</textarea>
                </div>
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">نتيجة التحقيق</label>
                    <textarea name="content[actions][investigation_result]" class="form-textarea-withdrawal"
                        placeholder="نتائج التحقيق المتعلقة بالمشكلة">{{ old('content.actions.investigation_result', $document->content['actions']['investigation_result'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 5: التوقيع -->
        <div class="section-withdrawal">
            <h3 class="section-title-withdrawal">5. توقيع مدير المؤسسة</h3>
            <div class="section-content-withdrawal">
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">اسم مدير المؤسسة</label>
                    <input type="text" name="content[signature][manager_name]" class="form-input-withdrawal"
                        value="{{ old('content.signature.manager_name', $document->content['signature']['manager_name'] ?? Auth::user()->name) }}">
                </div>
                <div class="form-field-withdrawal">
                    <label class="form-label-withdrawal">التاريخ</label>
                    <input type="date" name="content[signature][date]" class="form-input-withdrawal"
                        value="{{ old('content.signature.date', $document->content['signature']['date'] ?? date('Y-m-d')) }}">
                </div>
            </div>
        </div>

        <!-- DOCUMENTS SECTION -->
        <div class="doc-section-withdrawal">
            <h3 class="doc-section-title-withdrawal">📎 المستندات المرفقة</h3>
            <p style="color: #92400e; margin-bottom: 1rem;">ارفق المستندات الداعمة من CamScanner أو غيرها</p>
            
            <div style="margin-bottom: 1rem;">
                <label class="form-label-withdrawal">مصدر المستند</label>
                <select name="document_source" class="form-select-withdrawal">
                    <option value="">-- اختر المصدر --</option>
                    <option value="camscanner" {{ old('document_source', $document->document_source ?? '') === 'camscanner' ? 'selected' : '' }}>CamScanner</option>
                    <option value="upload" {{ old('document_source', $document->document_source ?? '') === 'upload' ? 'selected' : '' }}>تحميل مباشر</option>
                    <option value="physical" {{ old('document_source', $document->document_source ?? '') === 'physical' ? 'selected' : '' }}>مستند فيزيائي</option>
                </select>
            </div>

            <div style="margin-bottom: 1rem;">
                <label class="form-label-withdrawal">رابط المستند (CamScanner)</label>
                <input type="url" name="document_url" class="form-input-withdrawal"
                    value="{{ old('document_url', $document->document_url ?? '') }}"
                    placeholder="https://www.camscanner.com/file/detail?id=...">
                <small style="color: #6b7280;">اختياري - ألصق رابط CamScanner للنموذج الأصلي</small>
            </div>
        </div>

        <!-- DOCUMENTS SECTION -->
        <div class="doc-section-withdrawal">
            <h3 class="doc-section-title-withdrawal">📎 المستندات المرفقة</h3>
