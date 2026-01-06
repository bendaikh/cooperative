<style>
    .form-container-training {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 2rem;
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .form-header-training {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .back-link-training {
        color: #2563eb;
        text-decoration: none;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        transition: color 0.2s;
    }
    
    .back-link-training:hover {
        color: #1d4ed8;
    }
    
    .form-title-training {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin: 1rem 0 0.5rem 0;
        text-align: center;
    }
    
    .form-meta-training {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
        padding: 1rem;
        background: #dbeafe;
        border-radius: 0.5rem;
    }
    
    .meta-field-training {
        display: flex;
        flex-direction: column;
    }
    
    .meta-label-training {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }
    
    .meta-value-training {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .section-training {
        margin-bottom: 2.5rem;
    }
    
    .section-title-training {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid #0ea5e9;
    }
    
    .section-content-training {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .section-content-training.full {
        grid-template-columns: 1fr;
    }
    
    .form-field-training {
        display: flex;
        flex-direction: column;
    }
    
    .form-label-training {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .form-input-training,
    .form-textarea-training,
    .form-select-training {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    
    .form-input-training:focus,
    .form-textarea-training:focus,
    .form-select-training:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }
    
    .form-textarea-training {
        resize: vertical;
        min-height: 80px;
    }
    
    .table-container-training {
        overflow-x: auto;
        margin-bottom: 2rem;
    }
    
    .participants-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }
    
    .participants-table thead {
        background: #0ea5e9;
        color: white;
    }
    
    .participants-table th {
        padding: 12px;
        text-align: right;
        font-weight: 600;
        font-size: 0.875rem;
        border: 1px solid #d1d5db;
    }
    
    .participants-table td {
        padding: 10px;
        border: 1px solid #d1d5db;
        font-size: 0.875rem;
    }
    
    .participants-table tbody tr:hover {
        background: #f0f9ff;
    }
    
    .btn-add-row {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #0ea5e9;
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        cursor: pointer;
        margin-bottom: 1rem;
    }
    
    .btn-add-row:hover {
        background: #0284c7;
    }
    
    .btn-remove-row {
        padding: 0.25rem 0.5rem;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        cursor: pointer;
    }
    
    .btn-remove-row:hover {
        background: #dc2626;
    }
    
    .form-footer-training {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-training {
        padding: 0.625rem 1.5rem;
        border-radius: 0.5rem;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-primary-training {
        background: #0ea5e9;
        color: white;
    }
    
    .btn-primary-training:hover {
        background: #0284c7;
    }
    
    .btn-secondary-training {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .btn-secondary-training:hover {
        background: #e5e7eb;
    }
    
    .doc-section-training {
        background: #dbeafe;
        border: 1px solid #7dd3fc;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .doc-section-title-training {
        font-size: 1rem;
        font-weight: 700;
        color: #0369a1;
        margin-bottom: 1rem;
    }

    .list-item {
        margin-bottom: 0.75rem;
    }

    .list-item input {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .list-item label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }
</style>

<div class="form-container-training">
    <div class="form-header-training">
        <a href="{{ route('onca.index') }}" class="back-link-training">
            ← العودة
        </a>
        <div style="text-align: center;">
            <h2 class="form-title-training">لائحة المشاركين في التكوين</h2>
            <p style="font-size: 1rem; color: #6b7280; margin: 0.25rem 0 0 0;">Liste des Participants à la Formation</p>
        </div>
    </div>

    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="reference" value="{{ $meta['ref'] ?? 'PR-S-EN2' }}">
    <input type="hidden" name="title" value="لائحة المشاركين في التكوين">
    <input type="hidden" name="version" value="{{ $meta['ver'] ?? '01' }}">

        <!-- Information Header -->
        <div class="form-meta-training">
            <div class="meta-field-training">
                <span class="meta-label-training">الرمز</span>
                <span class="meta-value-training">{{ $meta['ref'] ?? 'PR-S-EN2' }}</span>
            </div>
            <div class="meta-field-training">
                <span class="meta-label-training">الإصدار</span>
                <span class="meta-value-training">{{ $meta['ver'] ?? '01' }}</span>
            </div>
            <div class="meta-field-training">
                <label class="meta-label-training">التاريخ</label>
                <input type="date" name="date" class="form-input-training" 
                    value="{{ old('date', isset($document) ? $document->date->format('Y-m-d') : date('Y-m-d')) }}" required>
            </div>
            <div class="meta-field-training">
                <label class="meta-label-training">المسؤول</label>
                <input type="text" name="responsible" class="form-input-training"
                    value="{{ old('responsible', isset($document) ? $document->responsible : Auth::user()->name) }}">
            </div>
        </div>

        <!-- SECTION 1: موضوع التكوين -->
        <div class="section-training">
            <h3 class="section-title-training">1. موضوع التكوين</h3>
            <div class="section-content-training full">
                <div class="form-field-training">
                    <label class="form-label-training">موضوع التكوين</label>
                    <input type="text" name="content[training_subject]" class="form-input-training"
                        value="{{ old('content.training_subject', $document->content['training_subject'] ?? '') }}" required>
                </div>
            </div>
        </div>

        <!-- SECTION 2: أهداف التكوين -->
        <div class="section-training">
            <h3 class="section-title-training">2. أهداف التكوين</h3>
            <div class="section-content-training full">
                <div class="list-item">
                    <label>الهدف 1</label>
                    <input type="text" name="content[objectives][0]" class="form-input-training"
                        value="{{ old('content.objectives.0', $document->content['objectives'][0] ?? '') }}">
                </div>
                <div class="list-item">
                    <label>الهدف 2</label>
                    <input type="text" name="content[objectives][1]" class="form-input-training"
                        value="{{ old('content.objectives.1', $document->content['objectives'][1] ?? '') }}">
                </div>
                <div class="list-item">
                    <label>الهدف 3</label>
                    <input type="text" name="content[objectives][2]" class="form-input-training"
                        value="{{ old('content.objectives.2', $document->content['objectives'][2] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- SECTION 3: الهيئة المكلفة بالتكوين -->
        <div class="section-training">
            <h3 class="section-title-training">3. الهيئة المكلفة بتقديم التكوين</h3>
            <div class="section-content-training full">
                <div class="form-field-training">
                    <label class="form-label-training">اسم الهيئة</label>
                    <input type="text" name="content[training_body][name]" class="form-input-training"
                        value="{{ old('content.training_body.name', $document->content['training_body']['name'] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- SECTION 4: المكونون -->
        <div class="section-training">
            <h3 class="section-title-training">4. المكونون</h3>
            <div class="section-content-training full">
                <div class="list-item">
                    <label>المكون 1</label>
                    <input type="text" name="content[trainers][0]" class="form-input-training"
                        value="{{ old('content.trainers.0', $document->content['trainers'][0] ?? '') }}">
                </div>
                <div class="list-item">
                    <label>المكون 2</label>
                    <input type="text" name="content[trainers][1]" class="form-input-training"
                        value="{{ old('content.trainers.1', $document->content['trainers'][1] ?? '') }}">
                </div>
                <div class="list-item">
                    <label>المكون 3</label>
                    <input type="text" name="content[trainers][2]" class="form-input-training"
                        value="{{ old('content.trainers.2', $document->content['trainers'][2] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- SECTION 5: تفاصيل التكوين -->
        <div class="section-training">
            <h3 class="section-title-training">5. تفاصيل التكوين</h3>
            <div class="section-content-training">
                <div class="form-field-training">
                    <label class="form-label-training">يوم البدء</label>
                    <input type="date" name="content[training_dates][start_date]" class="form-input-training"
                        value="{{ old('content.training_dates.start_date', $document->content['training_dates']['start_date'] ?? '') }}">
                </div>
                <div class="form-field-training">
                    <label class="form-label-training">يوم الانتهاء</label>
                    <input type="date" name="content[training_dates][end_date]" class="form-input-training"
                        value="{{ old('content.training_dates.end_date', $document->content['training_dates']['end_date'] ?? '') }}">
                </div>
                <div class="form-field-training">
                    <label class="form-label-training">عدد أيام التكوين</label>
                    <input type="number" name="content[training_dates][number_of_days]" class="form-input-training" step="0.5"
                        value="{{ old('content.training_dates.number_of_days', $document->content['training_dates']['number_of_days'] ?? '') }}">
                </div>
                <div class="form-field-training">
                    <label class="form-label-training">عدد ساعات التكوين</label>
                    <input type="number" name="content[training_dates][number_of_hours]" class="form-input-training" step="0.5"
                        value="{{ old('content.training_dates.number_of_hours', $document->content['training_dates']['number_of_hours'] ?? '') }}">
                </div>
            </div>
            <div class="section-content-training full" style="margin-top: 1.5rem;">
                <div class="form-field-training">
                    <label class="form-label-training">مكان التكوين</label>
                    <input type="text" name="content[training_location]" class="form-input-training"
                        value="{{ old('content.training_location', $document->content['training_location'] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- SECTION 6: لائحة المشاركين -->
        <div class="section-training">
            <h3 class="section-title-training">6. لائحة المشاركين في التكوين</h3>
            <div class="table-container-training">
                <button type="button" class="btn-add-row" onclick="addParticipantRow()">+ إضافة مشارك</button>
                <table class="participants-table">
                    <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>النطاق الزمني</th>
                            <th>الاسم الكامل</th>
                            <th>التأشير</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody id="participants-tbody">
                        @php
                            $participants = isset($document) && isset($document->content['participants']) 
                                ? (is_array($document->content['participants']) ? array_values($document->content['participants']) : [])
                                : [];
                        @endphp
                        @forelse($participants as $index => $participant)
                            <tr class="participant-row">
                                <td>
                                    <input type="date" name="content[participants][{{ $index }}][date]" class="form-input-training"
                                        value="{{ $participant['date'] ?? '' }}" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
                                </td>
                                <td>
                                    <input type="text" name="content[participants][{{ $index }}][time_range]" class="form-input-training"
                                        placeholder="مثال: 9:00-12:00" value="{{ $participant['time_range'] ?? '' }}" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
                                </td>
                                <td>
                                    <input type="text" name="content[participants][{{ $index }}][full_name]" class="form-input-training"
                                        value="{{ $participant['full_name'] ?? '' }}" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
                                </td>
                                <td>
                                    <input type="text" name="content[participants][{{ $index }}][signature]" class="form-input-training"
                                        placeholder="التوقيع" value="{{ $participant['signature'] ?? '' }}" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
                                </td>
                                <td>
                                    <button type="button" class="btn-remove-row" onclick="removeParticipantRow(this)">حذف</button>
                                </td>
                            </tr>
                        @empty
                            <tr class="participant-row">
                                <td>
                                    <input type="date" name="content[participants][0][date]" class="form-input-training" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
                                </td>
                                <td>
                                    <input type="text" name="content[participants][0][time_range]" class="form-input-training"
                                        placeholder="مثال: 9:00-12:00" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
                                </td>
                                <td>
                                    <input type="text" name="content[participants][0][full_name]" class="form-input-training" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
                                </td>
                                <td>
                                    <input type="text" name="content[participants][0][signature]" class="form-input-training"
                                        placeholder="التوقيع" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
                                </td>
                                <td>
                                    <button type="button" class="btn-remove-row" onclick="removeParticipantRow(this)">حذف</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SECTION 7: التوقيع -->
        <div class="section-training">
            <h3 class="section-title-training">7. تأشير مسؤول الجودة</h3>
            <div class="section-content-training">
                <div class="form-field-training">
                    <label class="form-label-training">اسم مسؤول الجودة</label>
                    <input type="text" name="content[quality_officer_name]" class="form-input-training"
                        value="{{ old('content.quality_officer_name', $document->content['quality_officer_name'] ?? Auth::user()->name) }}">
                </div>
                <div class="form-field-training">
                    <label class="form-label-training">التاريخ</label>
                    <input type="date" name="content[signature_date]" class="form-input-training"
                        value="{{ old('content.signature_date', $document->content['signature_date'] ?? date('Y-m-d')) }}">
                </div>
            </div>
        </div>

        <!-- DOCUMENTS SECTION -->
        <div class="doc-section-training">
            <h3 class="doc-section-title-training">📎 المستندات المرفقة</h3>
            <p style="color: #0369a1; margin-bottom: 1rem;">ارفق النسخة المسحوبة من CamScanner</p>
            
            <div style="margin-bottom: 1rem;">
                <label class="form-label-training">مصدر المستند</label>
                <select name="document_source" class="form-select-training">
                    <option value="">-- اختر المصدر --</option>
                    <option value="camscanner" {{ old('document_source', $document->document_source ?? '') === 'camscanner' ? 'selected' : '' }}>CamScanner</option>
                    <option value="upload" {{ old('document_source', $document->document_source ?? '') === 'upload' ? 'selected' : '' }}>تحميل مباشر</option>
                    <option value="physical" {{ old('document_source', $document->document_source ?? '') === 'physical' ? 'selected' : '' }}>مستند فيزيائي</option>
                </select>
            </div>

            <div style="margin-bottom: 1rem;">
                <label class="form-label-training">رابط المستند</label>
                <input type="url" name="document_url" class="form-input-training"
                    value="{{ old('document_url', $document->document_url ?? '') }}"
                    placeholder="https://www.camscanner.com/file/detail?id=...">
                <small style="color: #6b7280;">اختياري - ألصق رابط CamScanner للنموذج الأصلي</small>
            </div>
        </div>


<script>
    function addParticipantRow() {
        const tbody = document.getElementById('participants-tbody');
        const rowCount = tbody.querySelectorAll('tr').length;
        
        const newRow = document.createElement('tr');
        newRow.className = 'participant-row';
        newRow.innerHTML = `
            <td>
                <input type="date" name="content[participants][${rowCount}][date]" class="form-input-training" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
            </td>
            <td>
                <input type="text" name="content[participants][${rowCount}][time_range]" class="form-input-training"
                    placeholder="مثال: 9:00-12:00" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
            </td>
            <td>
                <input type="text" name="content[participants][${rowCount}][full_name]" class="form-input-training" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
            </td>
            <td>
                <input type="text" name="content[participants][${rowCount}][signature]" class="form-input-training"
                    placeholder="التوقيع" style="width: 100%; padding: 5px; border: 1px solid #d1d5db;">
            </td>
            <td>
                <button type="button" class="btn-remove-row" onclick="removeParticipantRow(this)">حذف</button>
            </td>
        `;
        tbody.appendChild(newRow);
    }
    
    function removeParticipantRow(button) {
        button.closest('tr').remove();
    }
</script>
