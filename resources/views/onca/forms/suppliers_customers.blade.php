<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <!-- Suppliers and Customers Register Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">لائحة الزبناء المعنيين بالإنذار / Customers Alert List</h3>

        <!-- Table -->
        <table style="width: 100%; border-collapse: collapse; table-layout: fixed; font-size: 0.85rem;">
            <thead>
                <tr style="background: #e5e7eb;">
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 10%;">اسم الزبون</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 7%;">نوعه</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 12%;">عنوانه</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 10%;">الأشخاص المكلفون بالتواصل</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 8%;">الهاتف</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 8%;">الفاكس</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 10%;">البريد الإلكتروني</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 10%;">تسمية المنتج</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 7%;">رقم الدفعة</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 8%;">الكمية المسلمة (كلغ)</th>
                    <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600; width: 5%;">حذف</th>
                </tr>
            </thead>
            <tbody id="customers-table-body">
                @php
                    $customers = is_array($content['customers'] ?? null) ? $content['customers'] : [];
                    if (empty($customers)) {
                        $customers = array_fill(0, 10, [
                            'name' => '',
                            'type' => '',
                            'address' => '',
                            'contact_person' => '',
                            'phone' => '',
                            'fax' => '',
                            'email' => '',
                            'product_name' => '',
                            'batch_number' => '',
                            'quantity' => ''
                        ]);
                    }
                @endphp
                
                @foreach($customers as $index => $customer)
                    @php $rowId = $index . '_' . time() . '_' . rand(1000, 9999); @endphp
                    <tr id="customer-row-{{ $rowId }}" style="height: 40px;">
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][name]" value="{{ $customer['name'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][type]" value="{{ $customer['type'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][address]" value="{{ $customer['address'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][contact_person]" value="{{ $customer['contact_person'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][phone]" value="{{ $customer['phone'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][fax]" value="{{ $customer['fax'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="email" name="content[customers][{{ $rowId }}][email]" value="{{ $customer['email'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][product_name]" value="{{ $customer['product_name'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][batch_number]" value="{{ $customer['batch_number'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
                            <input type="text" name="content[customers][{{ $rowId }}][quantity]" value="{{ $customer['quantity'] ?? '' }}" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
                        </td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">
                            <button type="button" onclick="removeRow(this)" style="padding: 0.25rem 0.5rem; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 2px; font-size: 0.75rem;">حذف</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding: 0.75rem 0; text-align: left;">
            <button type="button" onclick="addCustomerRow()" style="padding: 0.5rem 1rem; background: #4f46e5; color: white; border: none; cursor: pointer; border-radius: 0.375rem; font-size: 0.85rem;">+ إضافة صف</button>
        </div>
    </div>
</div>

<script>
function removeRow(btn) {
    btn.closest('tr').remove();
}

function addCustomerRow() {
    const table = document.getElementById('customers-table-body');
    const rowId = 'c' + Date.now() + Math.random();
    
    const newRow = document.createElement('tr');
    newRow.id = 'customer-row-' + rowId;
    newRow.style.height = '40px';
    newRow.innerHTML = `
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][name]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][type]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][address]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][contact_person]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][phone]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][fax]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="email" name="content[customers][${rowId}][email]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][product_name]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][batch_number]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem;">
            <input type="text" name="content[customers][${rowId}][quantity]" value="" style="width: 100%; border: none; padding: 0.25rem; text-align: center;">
        </td>
        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">
            <button type="button" onclick="removeRow(this)" style="padding: 0.25rem 0.5rem; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 2px; font-size: 0.75rem;">حذف</button>
        </td>
    `;
    table.appendChild(newRow);
}
</script>
