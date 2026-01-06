<!-- MCA-EN2 Document Form -->
<input type="hidden" name="type" value="mca2">
<input type="hidden" name="reference" value="{{ $meta['ref'] ?? 'MCA-EN2' }}">
<input type="hidden" name="title" value="{{ $meta['title'] ?? 'سجل التحاليل المكروبيولوجية' }}">
<input type="hidden" name="version" value="{{ $meta['ver'] ?? '01' }}">

<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <div style="background: #f9fafb; padding: 1rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
        <label class="onca-form-label">المنتج (رقم الدفعة) / Produit (N° de lot)</label>
        <input type="text" name="content[product_batch]" value="{{ $content['product_batch'] ?? '' }}" class="onca-form-input" style="max-width: 50%;">
    </div>

    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">سجل التحاليل المكروبيولوجية / Enregistrement des Analyses</h3>
        <div style="overflow-x: auto;">
            <table class="onca-form-table" id="table-mca2" style="min-width: 900px;">
                <thead>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <th rowspan="2" style="border-left: 1px solid #e5e7eb; padding: 0.75rem; vertical-align: bottom; text-align: right;">المنتج (رقم الدفعة) / Produit (N° lot)</th>
                        <th rowspan="2" style="border-left: 1px solid #e5e7eb; padding: 0.75rem; vertical-align: bottom; text-align: right;">تاريخ التحاليل / Date analyses</th>
                        <th rowspan="2" style="border-left: 1px solid #e5e7eb; padding: 0.75rem; vertical-align: bottom; text-align: right;">رقم تقرير التحاليل / N° rapport</th>
                        <th colspan="2" style="border-left: 1px solid #e5e7eb; padding: 0.75rem; text-align: center;">خلاصة التحاليل (مطابق) / Résumé analyses</th>
                        <th rowspan="2" style="border-left: 1px solid #e5e7eb; padding: 0.75rem; vertical-align: bottom; text-align: right;">التدابير التصحيحية (تاريخ الإتلاف) / Actions correctives</th>
                        <th rowspan="2" style="width: 2.5rem; vertical-align: bottom;"></th>
                    </tr>
                    <tr>
                        <th style="border-left: 1px solid #e5e7eb; padding: 0.5rem; text-align: center;">نعم</th>
                        <th style="border-left: 1px solid #e5e7eb; padding: 0.5rem; text-align: center;">لا</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($content['analyses']) && is_array($content['analyses']))
                        @foreach($content['analyses'] as $index => $row)
                            <tr>
                                <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[analyses][{{ $index }}][product]" value="{{ $row['product'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="date" name="content[analyses][{{ $index }}][date]" value="{{ $row['date'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[analyses][{{ $index }}][report_number]" value="{{ $row['report_number'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: center;"><input type="checkbox" name="content[analyses][{{ $index }}][compliant]" value="yes" {{ ($row['compliant'] ?? '') === 'yes' ? 'checked' : '' }}></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: center;"><input type="checkbox" name="content[analyses][{{ $index }}][non_compliant]" value="yes" {{ ($row['non_compliant'] ?? '') === 'yes' ? 'checked' : '' }}></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[analyses][{{ $index }}][actions]" value="{{ $row['actions'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;" placeholder="Actions / التاريخ"></td>
                                <td style="text-align: center;"><button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div style="margin-top: 0.75rem;">
            <button type="button" onclick="addMca2Row()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajouter une ligne
            </button>
        </div>
    </div>

    <!-- QUALITY OFFICER SECTION -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">تأشير مسؤول الجودة / Signature du Responsable QA</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div>
                <label class="onca-form-label">الاسم / Nom</label>
                <input type="text" name="content[quality_officer_name]" value="{{ $content['quality_officer_name'] ?? Auth::user()->name }}" class="onca-form-input">
            </div>
            <div>
                <label class="onca-form-label">التاريخ / Date</label>
                <input type="date" name="content[signature_date]" value="{{ $content['signature_date'] ?? date('Y-m-d') }}" class="onca-form-input">
            </div>
        </div>
    </div>
</div>

<template id="tpl-mca2">
    <tr>
        <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[analyses][new_{index}][product]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="date" name="content[analyses][new_{index}][date]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[analyses][new_{index}][report_number]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: center;"><input type="checkbox" name="content[analyses][new_{index}][compliant]" value="yes"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: center;"><input type="checkbox" name="content[analyses][new_{index}][non_compliant]" value="yes"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[analyses][new_{index}][actions]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;" placeholder="Actions / التاريخ"></td>
        <td style="text-align: center;"><button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button></td>
    </tr>
</template>

<script>
    function addMca2Row() {
        const uniqueId = Date.now();
        const table = document.getElementById('table-mca2').querySelector('tbody');
        const template = document.getElementById('tpl-mca2').innerHTML;
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        table.appendChild(tr);
    }
</script>
