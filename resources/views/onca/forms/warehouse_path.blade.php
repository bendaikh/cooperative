<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <!-- Warehouse Path Tracking Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">تسجيل مسار الدفعة / Warehouse Path Tracking</h3>
        <div style="overflow-x: auto; direction: rtl;">
            <table class="onca-form-table" id="table-path" style="min-width: 100%; table-layout: fixed; direction: rtl;">
                <thead>
                    <tr style="background: #f2f2f2;">
                        <th colspan="2" style="width: 20%; border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">التموين / Supplies</th>
                        <th colspan="2" style="width: 20%; border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">الفرز والتنقية / Sorting & Cleaning</th>
                        <th colspan="2" style="width: 20%; border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">الخلط / Mixing</th>
                        <th colspan="2" style="width: 20%; border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">التحويل / Transformation</th>
                        <th colspan="2" style="width: 20%; border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">التعبئة والعنونة / Packaging & Labeling</th>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">التاريخ / Date</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">الكمية / Qty</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">التاريخ / Date</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">الكمية / Qty</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">التاريخ / Date</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">الكمية / Qty</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">التاريخ / Date</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">الكمية / Qty</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">التاريخ / Date</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.875rem; text-align: center;">الكمية / Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($content['path_records']) && is_array($content['path_records']))
                        @foreach($content['path_records'] as $index => $row)
                            <tr>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="date" name="content[path_records][{{ $index }}][supply_date]" value="{{ $row['supply_date'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" step="0.01" name="content[path_records][{{ $index }}][supply_qty]" value="{{ $row['supply_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="date" name="content[path_records][{{ $index }}][sorting_date]" value="{{ $row['sorting_date'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" step="0.01" name="content[path_records][{{ $index }}][sorting_qty]" value="{{ $row['sorting_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="date" name="content[path_records][{{ $index }}][mixing_date]" value="{{ $row['mixing_date'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" step="0.01" name="content[path_records][{{ $index }}][mixing_qty]" value="{{ $row['mixing_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="date" name="content[path_records][{{ $index }}][transformation_date]" value="{{ $row['transformation_date'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" step="0.01" name="content[path_records][{{ $index }}][transformation_qty]" value="{{ $row['transformation_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="date" name="content[path_records][{{ $index }}][packaging_date]" value="{{ $row['packaging_date'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem; text-align: center;">
                                    <input type="number" step="0.01" name="content[path_records][{{ $index }}][packaging_qty]" value="{{ $row['packaging_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
                                    <button type="button" onclick="removePathRow(this)" class="onca-btn-remove" style="display: block; width: 100%; margin-top: 0.25rem; padding: 0.25rem; background: #fee2e2; color: #dc2626; border: none; border-radius: 0.25rem; cursor: pointer; font-size: 0.875rem;">−</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div style="margin-top: 0.75rem; text-align: right;">
            <button type="button" onclick="addPathRow()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                إضافة صف
            </button>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; direction: rtl; text-align: right;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">التوقيع / Signature</h3>
        <div>
            <label class="onca-form-label" style="direction: rtl; text-align: right;">تأشير مسؤول المستودع / Warehouse Manager Signature</label>
            <input type="text" name="content[signature]" value="{{ $content['signature'] ?? '' }}" class="onca-form-input" style="min-height: 40px; border: 1px solid #d1d5db; direction: rtl; text-align: right;">
        </div>
    </div>
</div>

<template id="tpl-path">
    <tr>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="date" name="content[path_records][new_{index}][supply_date]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" step="0.01" name="content[path_records][new_{index}][supply_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="date" name="content[path_records][new_{index}][sorting_date]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" step="0.01" name="content[path_records][new_{index}][sorting_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="date" name="content[path_records][new_{index}][mixing_date]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" step="0.01" name="content[path_records][new_{index}][mixing_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="date" name="content[path_records][new_{index}][transformation_date]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" step="0.01" name="content[path_records][new_{index}][transformation_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="date" name="content[path_records][new_{index}][packaging_date]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem; text-align: center;">
            <input type="number" step="0.01" name="content[path_records][new_{index}][packaging_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.875rem; text-align: center;" placeholder="kg">
            <button type="button" onclick="removePathRow(this)" class="onca-btn-remove" style="display: block; width: 100%; margin-top: 0.25rem; padding: 0.25rem; background: #fee2e2; color: #dc2626; border: none; border-radius: 0.25rem; cursor: pointer; font-size: 0.875rem;">−</button>
        </td>
    </tr>
</template>

<script>
    function addPathRow() {
        const uniqueId = Date.now();
        const table = document.getElementById('table-path').querySelector('tbody');
        const template = document.getElementById('tpl-path').innerHTML;
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        table.appendChild(tr);
    }

    function removePathRow(btn) {
        btn.closest('tr').remove();
    }
</script>
