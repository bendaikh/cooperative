<div style="margin-bottom: 1.5rem;">
    <!-- Product Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">المنتج / Product</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
            <div>
                <label class="onca-form-label">التسمية / Name</label>
                <input type="text" name="content[product_name]" value="{{ $content['product_name'] ?? '' }}" class="onca-form-input">
            </div>
            <div>
                <label class="onca-form-label">رقم الدفعة / Batch Number</label>
                <input type="text" name="content[product_batch]" value="{{ $content['product_batch'] ?? '' }}" class="onca-form-input">
            </div>
            <div>
                <label class="onca-form-label">الكمية المنتجة (كغ) / Qty Produced (kg)</label>
                <input type="number" name="content[product_qty]" value="{{ $content['product_qty'] ?? '' }}" class="onca-form-input" step="0.01">
            </div>
        </div>
    </div>

    <!-- Raw Materials Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">المادة الأولية / Raw Materials</h3>
        <div style="overflow-x: auto;">
            <table class="onca-form-table" id="table-materials" style="min-width: 900px;">
                <thead>
                    <tr style="background: #f2f2f2;">
                        <th style="width: 12%;">طبيعتها / Nature</th>
                        <th style="width: 15%;">المورد / Supplier</th>
                        <th style="width: 12%;">المنطقة / Region</th>
                        <th style="width: 12%;">تاريخ الاستلام / Receipt Date</th>
                        <th style="width: 12%;">الكمية (كغ) / Qty (kg)</th>
                        <th style="width: 25%;">ملاحظة / Notes</th>
                        <th style="width: 2.5rem;"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($content['materials']) && is_array($content['materials']))
                        @foreach($content['materials'] as $index => $row)
                            <tr>
                                <td>
                                    <input type="text" name="content[materials][{{ $index }}][nature]" value="{{ $row['nature'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                                </td>
                                <td>
                                    <input type="text" name="content[materials][{{ $index }}][supplier]" value="{{ $row['supplier'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                                </td>
                                <td>
                                    <input type="text" name="content[materials][{{ $index }}][region]" value="{{ $row['region'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                                </td>
                                <td>
                                    <input type="date" name="content[materials][{{ $index }}][receipt_date]" value="{{ $row['receipt_date'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                                </td>
                                <td>
                                    <input type="number" name="content[materials][{{ $index }}][qty]" value="{{ $row['qty'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;" step="0.01">
                                </td>
                                <td>
                                    <input type="text" name="content[materials][{{ $index }}][notes]" value="{{ $row['notes'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
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
            <button type="button" onclick="addMaterialRow()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajouter une ligne
            </button>
        </div>
    </div>

    <!-- Packaging Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">التعليب / Packaging</h3>
        <div style="overflow-x: auto;">
            <table class="onca-form-table" id="table-packaging" style="min-width: 600px;">
                <thead>
                    <tr style="background: #f2f2f2;">
                        <th style="width: 30%;">طبيعته / Nature</th>
                        <th style="width: 30%;">رقم الدفعة / Batch Number</th>
                        <th style="width: 25%;">الكمية (وحدة) / Qty (units)</th>
                        <th style="width: 2.5rem;"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($content['packaging']) && is_array($content['packaging']))
                        @foreach($content['packaging'] as $index => $row)
                            <tr>
                                <td>
                                    <input type="text" name="content[packaging][{{ $index }}][nature]" value="{{ $row['nature'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                                </td>
                                <td>
                                    <input type="text" name="content[packaging][{{ $index }}][batch]" value="{{ $row['batch'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                                </td>
                                <td>
                                    <input type="number" name="content[packaging][{{ $index }}][qty]" value="{{ $row['qty'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;" step="0.01">
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
            <button type="button" onclick="addPackagingRow()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajouter une ligne
            </button>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white;">
        <h3 class="onca-form-section-title">التوقيع / Signature</h3>
        <div>
            <label class="onca-form-label">تأشير مسؤول الجودة / Quality Manager Signature</label>
            <input type="text" name="content[signature]" value="{{ $content['signature'] ?? '' }}" class="onca-form-input" style="min-height: 40px; border: 1px solid #d1d5db;">
        </div>
    </div>
</div>

<template id="tpl-materials">
    <tr>
        <td>
            <input type="text" name="content[materials][new_{index}][nature]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td>
            <input type="text" name="content[materials][new_{index}][supplier]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td>
            <input type="text" name="content[materials][new_{index}][region]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td>
            <input type="date" name="content[materials][new_{index}][receipt_date]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td>
            <input type="number" name="content[materials][new_{index}][qty]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;" step="0.01">
        </td>
        <td>
            <input type="text" name="content[materials][new_{index}][notes]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td style="text-align: center;">
            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button>
        </td>
    </tr>
</template>

<template id="tpl-packaging">
    <tr>
        <td>
            <input type="text" name="content[packaging][new_{index}][nature]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td>
            <input type="text" name="content[packaging][new_{index}][batch]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td>
            <input type="number" name="content[packaging][new_{index}][qty]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;" step="0.01">
        </td>
        <td style="text-align: center;">
            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button>
        </td>
    </tr>
</template>

<script>
    function addMaterialRow() {
        const uniqueId = Date.now();
        const table = document.getElementById('table-materials').querySelector('tbody');
        const template = document.getElementById('tpl-materials').innerHTML;
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        table.appendChild(tr);
    }

    function addPackagingRow() {
        const uniqueId = Date.now();
        const table = document.getElementById('table-packaging').querySelector('tbody');
        const template = document.getElementById('tpl-packaging').innerHTML;
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        table.appendChild(tr);
    }
</script>
