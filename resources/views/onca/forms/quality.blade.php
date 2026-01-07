<div style="margin-bottom: 1.5rem;">
    <!-- Quality Monitoring Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">نموذج مراقبة الجودة / Quality Monitoring Form</h3>
        <div style="overflow-x: auto;">
            <table class="onca-form-table" id="table-quality" style="min-width: 1000px;">
                <thead>
                    <tr style="background: #f2f2f2;">
                        <th style="width: 12%;">الفئة / Category</th>
                        <th style="width: 18%;">الأسباب / Causes</th>
                        <th style="width: 20%;">وصف الحالة / Description</th>
                        <th style="width: 30%;">إجراءات تصحيحية / Actions</th>
                        <th style="width: 2.5rem;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $categories = [
                            'material' => 'المادة',
                            'place' => 'المكان',
                            'climate' => 'المناخ',
                            'equipment' => 'المعدات',
                            'user' => 'المستخدم'
                        ];
                        $causes = [
                            'material' => ['raw_materials' => 'المواد الأولية', 'packaging' => 'التعبئة', 'other_materials' => 'مواد أخرى'],
                            'place' => ['situation' => 'الوضعية', 'condition' => 'الحالة'],
                            'climate' => ['procedures' => 'المساطر', 'information_flow' => 'تدفق المعلومات'],
                            'equipment' => ['machines' => 'الآلات', 'small_tools' => 'الأدوات الصغيرة'],
                            'user' => ['qualification' => 'التأهيل', 'training' => 'التكوين']
                        ];
                    @endphp

                    @if(isset($content['items']) && is_array($content['items']))
                        @foreach($content['items'] as $index => $row)
                            <tr>
                                <td style="font-weight: bold; text-align: center;">{{ $row['category'] ?? '' }}</td>
                                <td>
                                    <input type="text" name="content[items][{{ $index }}][cause]" value="{{ $row['cause'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                                </td>
                                <td>
                                    <textarea name="content[items][{{ $index }}][description]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem; min-height: 60px;">{{ $row['description'] ?? '' }}</textarea>
                                </td>
                                <td>
                                    <textarea name="content[items][{{ $index }}][action]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem; min-height: 60px;">{{ $row['action'] ?? '' }}</textarea>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div style="margin-top: 0.75rem;">
            <button type="button" onclick="addQualityRow()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajouter une ligne
            </button>
        </div>
    </div>

    <!-- Responsible Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">التوقيع / Signature</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label class="onca-form-label">تأشير مسؤول الجودة / Quality Manager Signature</label>
                <input type="text" name="content[signature]" value="{{ $content['signature'] ?? '' }}" class="onca-form-input" style="min-height: 40px; border: 1px solid #d1d5db;">
            </div>
            <div>
                <label class="onca-form-label">ملاحظات / Notes</label>
                <textarea name="content[notes]" class="onca-form-textarea" style="min-height: 40px;">{{ $content['notes'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>

<template id="tpl-quality">
    <tr>
        <td style="font-weight: bold; text-align: center;">
            <select name="content[items][new_{index}][category]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                <option value="">اختر</option>
                <option value="المادة">المادة</option>
                <option value="المكان">المكان</option>
                <option value="المناخ">المناخ</option>
                <option value="المعدات">المعدات</option>
                <option value="المستخدم">المستخدم</option>
            </select>
        </td>
        <td>
            <input type="text" name="content[items][new_{index}][cause]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td>
            <textarea name="content[items][new_{index}][description]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem; min-height: 60px;"></textarea>
        </td>
        <td>
            <textarea name="content[items][new_{index}][action]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem; min-height: 60px;"></textarea>
        </td>
        <td style="text-align: center;">
            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button>
        </td>
    </tr>
</template>

<script>
    function addQualityRow() {
        const uniqueId = Date.now();
        const table = document.getElementById('table-quality').querySelector('tbody');
        const template = document.getElementById('tpl-quality').innerHTML;
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        table.appendChild(tr);
    }
</script>
