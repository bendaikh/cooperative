<div style="margin-bottom: 1.5rem;">
    <!-- Quality Monitoring Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">نموذج مراقبة الجودة / Quality Monitoring Form</h3>
        <div style="overflow-x: auto;">
            <table class="onca-form-table" id="table-quality" style="width: 100%; border-collapse: collapse; table-layout: fixed; direction: rtl;">
                <thead>
                    <tr>
                        <th class="category"></th>
                        <th class="items"></th>
                        <th class="causes">أسباب السحب / التجميع</th>
                        <th class="description">وصف الحالة</th>
                        <th class="actions">إجراءات تصحيحية / إصلاحات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="vertical" rowspan="3">1) المواد</td>
                        <td>- المواد الأولية</td>
                        <td><input type="text" name="content[items][0][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][0][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][0][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td>- التعليم</td>
                        <td><input type="text" name="content[items][1][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][1][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][1][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td>- مواد أخرى</td>
                        <td><input type="text" name="content[items][2][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][2][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][2][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td class="vertical" rowspan="2">2) المكان</td>
                        <td>- الوضعية</td>
                        <td><input type="text" name="content[items][3][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][3][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][3][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td>- الحالة</td>
                        <td><input type="text" name="content[items][4][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][4][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][4][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td class="vertical" rowspan="2">3) المناهج</td>
                        <td>- المساطر</td>
                        <td><input type="text" name="content[items][5][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][5][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][5][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td>- تدفق المعلومات</td>
                        <td><input type="text" name="content[items][6][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][6][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][6][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td class="vertical" rowspan="2">4) المعدات</td>
                        <td>- الآلات</td>
                        <td><input type="text" name="content[items][7][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][7][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][7][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td>- الأدوات الصغيرة</td>
                        <td><input type="text" name="content[items][8][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][8][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][8][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td class="vertical" rowspan="2">5) المستخدمين</td>
                        <td>- التأهيل</td>
                        <td><input type="text" name="content[items][9][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][9][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][9][action]" style="width:100%"></td>
                    </tr>
                    <tr>
                        <td>- التكوين</td>
                        <td><input type="text" name="content[items][10][cause]" style="width:100%"></td>
                        <td><input type="text" name="content[items][10][description]" style="width:100%"></td>
                        <td><input type="text" name="content[items][10][action]" style="width:100%"></td>
                    </tr>
                </tbody>
            </table>
            <style>
                th, td { border: 1.5px solid #000; padding: 10px; vertical-align: middle; font-size: 14px; }
                th { text-align: center; font-weight: bold; }
                td { text-align: right; }
                .category { width: 5%; }
                .items { width: 15%; }
                .causes { width: 30%; }
                .description { width: 25%; }
                .actions { width: 25%; }
                .vertical { writing-mode: vertical-rl; transform: rotate(180deg); text-align: center; font-weight: bold; color: #a00000; }
                tbody td { height: 55px; }
            </style>
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
