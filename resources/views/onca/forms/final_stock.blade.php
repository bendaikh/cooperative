<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <!-- Final Product Stock Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">سجل دخول وخروج المنتج النهائي / Final Product Stock Register</h3>
        <div style="overflow-x: auto; direction: rtl;">
            <table class="onca-form-table" id="table-stock" style="min-width: 100%; table-layout: fixed; direction: rtl; font-size: 0.75rem;">
                <thead>
                    <tr style="background: #f2f2f2;">
                        <th rowspan="2" style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">التاريخ / Date</th>
                        <th colspan="4" style="border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">دخول المنتج النهائي / Incoming Final Product</th>
                        <th colspan="4" style="border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">خروج المنتج النهائي / Outgoing Final Product</th>
                        <th rowspan="2" style="width: 12%; border: 1px solid #d1d5db; padding: 0.5rem; font-weight: 600; text-align: center;">المخزون النهائي / Final Stock</th>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.75rem; text-align: center;">رقم الدفعة / Batch #</th>
                        <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.75rem; text-align: center;">كمية الوحدة (كلغ) / Unit Qty</th>
                        <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.75rem; text-align: center;">العدد / Qty</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.75rem; text-align: center;">الكمية الإجمالية (كلغ) / Total Qty</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.75rem; text-align: center;">الزبون المعني / Customer</th>
                        <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.75rem; text-align: center;">كمية الوحدة (كلغ) / Unit Qty</th>
                        <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.75rem; text-align: center;">العدد / Qty</th>
                        <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; font-size: 0.75rem; text-align: center;">الكمية الإجمالية (كلغ) / Total Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($content['stock_records']) && is_array($content['stock_records']))
                        @foreach($content['stock_records'] as $index => $row)
                            <tr>
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="date" name="content[stock_records][{{ $index }}][date]" value="{{ $row['date'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
                                </td>
                                <!-- Incoming: Batch # -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="text" name="content[stock_records][{{ $index }}][batch_num]" value="{{ $row['batch_num'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
                                </td>
                                <!-- Incoming: Unit Qty -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" step="0.01" name="content[stock_records][{{ $index }}][incoming_unit_qty]" value="{{ $row['incoming_unit_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
                                </td>
                                <!-- Incoming: Count -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" name="content[stock_records][{{ $index }}][incoming_count]" value="{{ $row['incoming_count'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
                                </td>
                                <!-- Incoming: Total Qty -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" step="0.01" name="content[stock_records][{{ $index }}][incoming_total_qty]" value="{{ $row['incoming_total_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
                                </td>
                                <!-- Outgoing: Customer -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="text" name="content[stock_records][{{ $index }}][customer]" value="{{ $row['customer'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
                                </td>
                                <!-- Outgoing: Unit Qty -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" step="0.01" name="content[stock_records][{{ $index }}][outgoing_unit_qty]" value="{{ $row['outgoing_unit_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
                                </td>
                                <!-- Outgoing: Count -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" name="content[stock_records][{{ $index }}][outgoing_count]" value="{{ $row['outgoing_count'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
                                </td>
                                <!-- Outgoing: Total Qty -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
                                    <input type="number" step="0.01" name="content[stock_records][{{ $index }}][outgoing_total_qty]" value="{{ $row['outgoing_total_qty'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
                                </td>
                                <!-- Final Stock -->
                                <td style="border: 1px solid #d1d5db; padding: 0.375rem; text-align: center;">
                                    <input type="number" step="0.01" name="content[stock_records][{{ $index }}][final_stock]" value="{{ $row['final_stock'] ?? '' }}" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
                                    <button type="button" onclick="removeStockRow(this)" class="onca-btn-remove" style="display: block; width: 100%; margin-top: 0.25rem; padding: 0.25rem; background: #fee2e2; color: #dc2626; border: none; border-radius: 0.25rem; cursor: pointer; font-size: 0.75rem;">−</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div style="margin-top: 0.75rem; text-align: right;">
            <button type="button" onclick="addStockRow()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
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

<template id="tpl-stock">
    <tr>
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="date" name="content[stock_records][new_{index}][date]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
        </td>
        <!-- Incoming: Batch # -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="text" name="content[stock_records][new_{index}][batch_num]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
        </td>
        <!-- Incoming: Unit Qty -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" step="0.01" name="content[stock_records][new_{index}][incoming_unit_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
        </td>
        <!-- Incoming: Count -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" name="content[stock_records][new_{index}][incoming_count]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
        </td>
        <!-- Incoming: Total Qty -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" step="0.01" name="content[stock_records][new_{index}][incoming_total_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
        </td>
        <!-- Outgoing: Customer -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="text" name="content[stock_records][new_{index}][customer]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
        </td>
        <!-- Outgoing: Unit Qty -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" step="0.01" name="content[stock_records][new_{index}][outgoing_unit_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
        </td>
        <!-- Outgoing: Count -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" name="content[stock_records][new_{index}][outgoing_count]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;">
        </td>
        <!-- Outgoing: Total Qty -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem;">
            <input type="number" step="0.01" name="content[stock_records][new_{index}][outgoing_total_qty]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
        </td>
        <!-- Final Stock -->
        <td style="border: 1px solid #d1d5db; padding: 0.375rem; text-align: center;">
            <input type="number" step="0.01" name="content[stock_records][new_{index}][final_stock]" style="width: 100%; padding: 0.375rem; border: none; font-size: 0.75rem; text-align: center;" placeholder="kg">
            <button type="button" onclick="removeStockRow(this)" class="onca-btn-remove" style="display: block; width: 100%; margin-top: 0.25rem; padding: 0.25rem; background: #fee2e2; color: #dc2626; border: none; border-radius: 0.25rem; cursor: pointer; font-size: 0.75rem;">−</button>
        </td>
    </tr>
</template>

<script>
    function addStockRow() {
        const uniqueId = Date.now();
        const table = document.getElementById('table-stock').querySelector('tbody');
        const template = document.getElementById('tpl-stock').innerHTML;
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        table.appendChild(tr);
    }

    function removeStockRow(btn) {
        btn.closest('tr').remove();
    }
</script>
