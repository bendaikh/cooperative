<div style="margin-bottom: 1.5rem;">
    @php
        $formContent = old('content', $content ?? []);
        $getValue = function ($section, $key, $index = 0) use ($formContent) {
            $value = $formContent[$section][$key] ?? '';
            if (is_array($value)) {
                return $value[$index] ?? '';
            }
            return $index === 0 ? $value : '';
        };
        $getRootValue = function ($key, $index = 0) use ($formContent) {
            $value = $formContent[$key] ?? '';
            if (is_array($value)) {
                return $value[$index] ?? '';
            }
            return $index === 0 ? $value : '';
        };
    @endphp

    <style>
        .production-body {
            direction: rtl;
        }

        .production-body h6 {
            margin: 20px 0 15px 0;
            padding: 0;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            color: #1f2937;
        }

        .production-body table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            direction: rtl;
        }

        .production-body th {
            background-color: #f8fbff;
            border: 1.2px solid #3b78b6;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 0.85rem;
            height: 30px;
        }

        .production-body td {
            border: 1.2px solid #3b78b6;
            padding: 0;
            height: 32px;
            vertical-align: middle;
        }

        .production-body .vertical-header {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            font-weight: bold;
            width: 38px;
            padding: 4px 2px;
            font-size: 0.85rem;
            background-color: #f8fbff;
        }

        .production-body .field-label {
            background-color: #f8fbff;
            font-weight: bold;
            padding: 6px;
            text-align: right;
            font-size: 0.85rem;
            word-break: break-word;
        }

        .production-body .input-cell {
            background-color: white;
        }

        .production-body input,
        .production-body textarea {
            width: 100%;
            height: 100%;
            border: none;
            background: transparent;
            padding: 4px 5px;
            font-family: Arial, sans-serif;
            font-size: 0.85rem;
            box-sizing: border-box;
            text-align: right;
            resize: none;
        }

        .production-body input:focus,
        .production-body textarea:focus {
            background-color: #f0f7ff;
            outline: none;
        }

        .production-body textarea {
            padding: 3px 5px;
            min-height: 32px;
        }

        .production-body .empty-cell {
            width: 38px;
            border: none;
            background: white;
        }

        .production-body .question-row td {
            vertical-align: top;
            padding: 4px;
            height: auto;
        }
    </style>

    <div class="production-body">
        <!-- ===== 1. التموين ===== -->
        <h6>1. التموين</h6>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>الحقل</th>
                    <th>القيمة 1</th>
                    <th>القيمة 2</th>
                    <th>القيمة 3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="9" class="vertical-header">مراقبة</td>
                    <td class="field-label">المادة</td>
                    <td class="input-cell"><input type="text" name="content[supply][material][0]" value="{{ old('content.supply.material.0', $getValue('supply', 'material', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][material][1]" value="{{ old('content.supply.material.1', $getValue('supply', 'material', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][material][2]" value="{{ old('content.supply.material.2', $getValue('supply', 'material', 2)) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">قسيمة استلام رقم</td>
                    <td class="input-cell"><input type="text" name="content[supply][receipt_voucher_number][0]" value="{{ old('content.supply.receipt_voucher_number.0', $getValue('supply', 'receipt_voucher_number', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][receipt_voucher_number][1]" value="{{ old('content.supply.receipt_voucher_number.1', $getValue('supply', 'receipt_voucher_number', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][receipt_voucher_number][2]" value="{{ old('content.supply.receipt_voucher_number.2', $getValue('supply', 'receipt_voucher_number', 2)) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">حالة نظافة العربة</td>
                    <td class="input-cell"><input type="text" name="content[supply][cart_cleanliness][0]" value="{{ old('content.supply.cart_cleanliness.0', $getValue('supply', 'cart_cleanliness', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][cart_cleanliness][1]" value="{{ old('content.supply.cart_cleanliness.1', $getValue('supply', 'cart_cleanliness', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][cart_cleanliness][2]" value="{{ old('content.supply.cart_cleanliness.2', $getValue('supply', 'cart_cleanliness', 2)) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">حالة نظافة التعليب</td>
                    <td class="input-cell"><input type="text" name="content[supply][packaging_cleanliness][0]" value="{{ old('content.supply.packaging_cleanliness.0', $getValue('supply', 'packaging_cleanliness', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][packaging_cleanliness][1]" value="{{ old('content.supply.packaging_cleanliness.1', $getValue('supply', 'packaging_cleanliness', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][packaging_cleanliness][2]" value="{{ old('content.supply.packaging_cleanliness.2', $getValue('supply', 'packaging_cleanliness', 2)) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">الرائحة</td>
                    <td class="input-cell"><input type="text" name="content[supply][odor][0]" value="{{ old('content.supply.odor.0', $getValue('supply', 'odor', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][odor][1]" value="{{ old('content.supply.odor.1', $getValue('supply', 'odor', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][odor][2]" value="{{ old('content.supply.odor.2', $getValue('supply', 'odor', 2)) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">اللون</td>
                    <td class="input-cell"><input type="text" name="content[supply][color][0]" value="{{ old('content.supply.color.0', $getValue('supply', 'color', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][color][1]" value="{{ old('content.supply.color.1', $getValue('supply', 'color', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][color][2]" value="{{ old('content.supply.color.2', $getValue('supply', 'color', 2)) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">التعفنات</td>
                    <td class="input-cell"><input type="text" name="content[supply][rot][0]" value="{{ old('content.supply.rot.0', $getValue('supply', 'rot', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][rot][1]" value="{{ old('content.supply.rot.1', $getValue('supply', 'rot', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][rot][2]" value="{{ old('content.supply.rot.2', $getValue('supply', 'rot', 2)) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">المواد الأجنبية</td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_materials][0]" value="{{ old('content.supply.foreign_materials.0', $getValue('supply', 'foreign_materials', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_materials][1]" value="{{ old('content.supply.foreign_materials.1', $getValue('supply', 'foreign_materials', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_materials][2]" value="{{ old('content.supply.foreign_materials.2', $getValue('supply', 'foreign_materials', 2)) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">الأجسام الأجنبية</td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_bodies][0]" value="{{ old('content.supply.foreign_bodies.0', $getValue('supply', 'foreign_bodies', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_bodies][1]" value="{{ old('content.supply.foreign_bodies.1', $getValue('supply', 'foreign_bodies', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_bodies][2]" value="{{ old('content.supply.foreign_bodies.2', $getValue('supply', 'foreign_bodies', 2)) }}"></td>
                </tr>
            </tbody>
        </table>

        <!-- Supply Questions -->
        <table>
            <tbody>
                <tr class="question-row">
                    <td colspan="2" class="field-label" style="background: white;">إن كانت الدفعة مقبولة، ما هو الرقم الذي خصص لها؟</td>
                    <td class="input-cell"><textarea name="content[supply][if_accepted_number][0]">{{ old('content.supply.if_accepted_number.0', $getValue('supply', 'if_accepted_number', 0)) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[supply][if_accepted_number][1]">{{ old('content.supply.if_accepted_number.1', $getValue('supply', 'if_accepted_number', 1)) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[supply][if_accepted_number][2]">{{ old('content.supply.if_accepted_number.2', $getValue('supply', 'if_accepted_number', 2)) }}</textarea></td>
                </tr>
                <tr class="question-row">
                    <td colspan="2" class="field-label" style="background: white;">إن كان العكس، ما هو الإجراء الذي اتخذ في شأنها؟</td>
                    <td class="input-cell"><textarea name="content[supply][if_rejected_action][0]">{{ old('content.supply.if_rejected_action.0', $getValue('supply', 'if_rejected_action', 0)) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[supply][if_rejected_action][1]">{{ old('content.supply.if_rejected_action.1', $getValue('supply', 'if_rejected_action', 1)) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[supply][if_rejected_action][2]">{{ old('content.supply.if_rejected_action.2', $getValue('supply', 'if_rejected_action', 2)) }}</textarea></td>
                </tr>
            </tbody>
        </table>

        <!-- ===== 2. الفرز والتنقية ===== -->
        <h6 style="margin-top: 30px;">2. الفرز والتنقية</h6>
        <table>
            <thead>
                <tr>
                    <th>المادة</th>
                    <th>رقم الدفعة</th>
                    <th>الكمية المستعملة (كغ)</th>
                    <th colspan="2">المراقبة (مواد / أجسام أجنبية)</th>
                    <th>التدابير التصحيحية</th>
                </tr>
            </thead>
            <tbody>
                <tr style="height: 32px;">
                    <td class="input-cell"><input type="text" name="content[sorting][0][material]" value="{{ old('content.sorting.0.material', isset($formContent['sorting'][0]['material']) ? $formContent['sorting'][0]['material'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][0][batch_number]" value="{{ old('content.sorting.0.batch_number', isset($formContent['sorting'][0]['batch_number']) ? $formContent['sorting'][0]['batch_number'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][0][quantity]" value="{{ old('content.sorting.0.quantity', isset($formContent['sorting'][0]['quantity']) ? $formContent['sorting'][0]['quantity'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][0][foreign_materials]" value="{{ old('content.sorting.0.foreign_materials', isset($formContent['sorting'][0]['foreign_materials']) ? $formContent['sorting'][0]['foreign_materials'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][0][foreign_bodies]" value="{{ old('content.sorting.0.foreign_bodies', isset($formContent['sorting'][0]['foreign_bodies']) ? $formContent['sorting'][0]['foreign_bodies'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][0][corrective_measures]" value="{{ old('content.sorting.0.corrective_measures', isset($formContent['sorting'][0]['corrective_measures']) ? $formContent['sorting'][0]['corrective_measures'] : '') }}"></td>
                </tr>
                <tr style="height: 32px;">
                    <td class="input-cell"><input type="text" name="content[sorting][1][material]" value="{{ old('content.sorting.1.material', isset($formContent['sorting'][1]['material']) ? $formContent['sorting'][1]['material'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][1][batch_number]" value="{{ old('content.sorting.1.batch_number', isset($formContent['sorting'][1]['batch_number']) ? $formContent['sorting'][1]['batch_number'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][1][quantity]" value="{{ old('content.sorting.1.quantity', isset($formContent['sorting'][1]['quantity']) ? $formContent['sorting'][1]['quantity'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][1][foreign_materials]" value="{{ old('content.sorting.1.foreign_materials', isset($formContent['sorting'][1]['foreign_materials']) ? $formContent['sorting'][1]['foreign_materials'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][1][foreign_bodies]" value="{{ old('content.sorting.1.foreign_bodies', isset($formContent['sorting'][1]['foreign_bodies']) ? $formContent['sorting'][1]['foreign_bodies'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][1][corrective_measures]" value="{{ old('content.sorting.1.corrective_measures', isset($formContent['sorting'][1]['corrective_measures']) ? $formContent['sorting'][1]['corrective_measures'] : '') }}"></td>
                </tr>
                <tr style="height: 32px;">
                    <td class="input-cell"><input type="text" name="content[sorting][2][material]" value="{{ old('content.sorting.2.material', isset($formContent['sorting'][2]['material']) ? $formContent['sorting'][2]['material'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][2][batch_number]" value="{{ old('content.sorting.2.batch_number', isset($formContent['sorting'][2]['batch_number']) ? $formContent['sorting'][2]['batch_number'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][2][quantity]" value="{{ old('content.sorting.2.quantity', isset($formContent['sorting'][2]['quantity']) ? $formContent['sorting'][2]['quantity'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][2][foreign_materials]" value="{{ old('content.sorting.2.foreign_materials', isset($formContent['sorting'][2]['foreign_materials']) ? $formContent['sorting'][2]['foreign_materials'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][2][foreign_bodies]" value="{{ old('content.sorting.2.foreign_bodies', isset($formContent['sorting'][2]['foreign_bodies']) ? $formContent['sorting'][2]['foreign_bodies'] : '') }}"></td>
                    <td class="input-cell"><input type="text" name="content[sorting][2][corrective_measures]" value="{{ old('content.sorting.2.corrective_measures', isset($formContent['sorting'][2]['corrective_measures']) ? $formContent['sorting'][2]['corrective_measures'] : '') }}"></td>
                </tr>
            </tbody>
        </table>

        <!-- ===== 3. الغسل والتنشيف ===== -->
        <h6 style="margin-top: 30px;">3. الغسل والتنشيف</h6>
        <table id="table-washing">
            <thead>
                <tr>
                    <th>المادة</th>
                    <th>رقم الدفعة</th>
                    <th>الكمية المستعملة (كغ)</th>
                    <th colspan="2">المراقبة (مواد / أجسام أجنبية)</th>
                    <th>التدابير التصحيحية</th>
                    <th style="width: 2.5rem;"></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($formContent['washing']) && is_array($formContent['washing']))
                    @foreach($formContent['washing'] as $index => $row)
                        <tr style="height: 32px;">
                            <td class="input-cell"><input type="text" name="content[washing][{{ $index }}][material]" value="{{ $row['material'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[washing][{{ $index }}][batch_number]" value="{{ $row['batch_number'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[washing][{{ $index }}][quantity]" value="{{ $row['quantity'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[washing][{{ $index }}][foreign_materials]" value="{{ $row['foreign_materials'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[washing][{{ $index }}][foreign_bodies]" value="{{ $row['foreign_bodies'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[washing][{{ $index }}][corrective_measures]" value="{{ $row['corrective_measures'] ?? '' }}"></td>
                            <td style="text-align: center;">
                                <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr style="height: 32px;">
                        <td class="input-cell"><input type="text" name="content[washing][0][material]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[washing][0][batch_number]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[washing][0][quantity]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[washing][0][foreign_materials]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[washing][0][foreign_bodies]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[washing][0][corrective_measures]" value=""></td>
                        <td style="text-align: center;">
                            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div style="margin-top: 0.75rem;">
            <button type="button" onclick="addProductionRow('washing')" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Row
            </button>
        </div>

        <template id="tpl-washing">
            <tr style="height: 32px;">
                <td class="input-cell"><input type="text" name="content[washing][new_{index}][material]"></td>
                <td class="input-cell"><input type="text" name="content[washing][new_{index}][batch_number]"></td>
                <td class="input-cell"><input type="text" name="content[washing][new_{index}][quantity]"></td>
                <td class="input-cell"><input type="text" name="content[washing][new_{index}][foreign_materials]"></td>
                <td class="input-cell"><input type="text" name="content[washing][new_{index}][foreign_bodies]"></td>
                <td class="input-cell"><input type="text" name="content[washing][new_{index}][corrective_measures]"></td>
                <td style="text-align: center;">
                    <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            </tr>
        </template>

        <!-- ===== 4. الخلط ===== -->
        <h6 style="margin-top: 30px;">4. الخلط</h6>
        <table id="table-mixing">
            <thead>
                <tr>
                    <th>المكون</th>
                    <th>رقم الدفعة</th>
                    <th>الكمية المستعملة (كغ)</th>
                    <th colspan="3">المنتج النهائي</th>
                    <th style="width: 2.5rem;"></th>
                </tr>
                <tr>
                    <th colspan="3"></th>
                    <th>المنتج</th>
                    <th>رقم الدفعة</th>
                    <th>الكمية (كغ)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($formContent['mixing']) && is_array($formContent['mixing']))
                    @php
                        $mixingRows = [];
                        foreach($formContent['mixing'] as $key => $value) {
                            if(is_numeric($key) && is_array($value)) {
                                $mixingRows[$key] = $value;
                            }
                        }
                        if(empty($mixingRows)) {
                            $mixingRows = [0 => []];
                        }
                    @endphp
                    @foreach($mixingRows as $index => $row)
                        <tr style="height: 32px;">
                            <td class="input-cell"><input type="text" name="content[mixing][{{ $index }}][ingredient]" value="{{ $row['ingredient'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[mixing][{{ $index }}][batch_number]" value="{{ $row['batch_number'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[mixing][{{ $index }}][quantity]" value="{{ $row['quantity'] ?? '' }}"></td>
                            @if($index == 0)
                                <td class="input-cell" rowspan="999"><input type="text" name="content[mixing][product_name]" value="{{ $formContent['mixing']['product_name'] ?? '' }}"></td>
                                <td class="input-cell" rowspan="999"><input type="text" name="content[mixing][product_batch]" value="{{ $formContent['mixing']['product_batch'] ?? '' }}"></td>
                                <td class="input-cell" rowspan="999"><input type="text" name="content[mixing][product_quantity]" value="{{ $formContent['mixing']['product_quantity'] ?? '' }}"></td>
                            @endif
                            <td style="text-align: center;">
                                <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr style="height: 32px;">
                        <td class="input-cell"><input type="text" name="content[mixing][0][ingredient]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[mixing][0][batch_number]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[mixing][0][quantity]" value=""></td>
                        <td class="input-cell" rowspan="999"><input type="text" name="content[mixing][product_name]" value=""></td>
                        <td class="input-cell" rowspan="999"><input type="text" name="content[mixing][product_batch]" value=""></td>
                        <td class="input-cell" rowspan="999"><input type="text" name="content[mixing][product_quantity]" value=""></td>
                        <td style="text-align: center;">
                            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div style="margin-top: 0.75rem;">
            <button type="button" onclick="addProductionRow('mixing')" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Row
            </button>
        </div>

        <template id="tpl-mixing">
            <tr style="height: 32px;">
                <td class="input-cell"><input type="text" name="content[mixing][new_{index}][ingredient]"></td>
                <td class="input-cell"><input type="text" name="content[mixing][new_{index}][batch_number]"></td>
                <td class="input-cell"><input type="text" name="content[mixing][new_{index}][quantity]"></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">
                    <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            </tr>
        </template>

        <!-- ===== 5. الشاي والنقع ===== -->
        <h6 style="margin-top: 30px;">5. الشاي والنقع</h6>
        <table id="table-tea">
            <thead>
                <tr>
                    <th>المادة (شاي أو نقيع من ...)</th>
                    <th>رقم الدفعة</th>
                    <th>الكمية المستعملة (كغ)</th>
                    <th colspan="2">المراقبة</th>
                    <th>التدابير التصحيحية</th>
                    <th style="width: 2.5rem;"></th>
                </tr>
                <tr>
                    <th colspan="3"></th>
                    <th>الصفاء</th>
                    <th>التجانس</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($formContent['tea']) && is_array($formContent['tea']))
                    @foreach($formContent['tea'] as $index => $row)
                        <tr style="height: 32px;">
                            <td class="input-cell"><input type="text" name="content[tea][{{ $index }}][material]" value="{{ $row['material'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[tea][{{ $index }}][batch_number]" value="{{ $row['batch_number'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[tea][{{ $index }}][quantity]" value="{{ $row['quantity'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[tea][{{ $index }}][clarity]" value="{{ $row['clarity'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[tea][{{ $index }}][homogeneity]" value="{{ $row['homogeneity'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[tea][{{ $index }}][corrective_measures]" value="{{ $row['corrective_measures'] ?? '' }}"></td>
                            <td style="text-align: center;">
                                <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr style="height: 32px;">
                        <td class="input-cell"><input type="text" name="content[tea][0][material]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[tea][0][batch_number]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[tea][0][quantity]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[tea][0][clarity]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[tea][0][homogeneity]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[tea][0][corrective_measures]" value=""></td>
                        <td style="text-align: center;">
                            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div style="margin-top: 0.75rem;">
            <button type="button" onclick="addProductionRow('tea')" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Row
            </button>
        </div>

        <template id="tpl-tea">
            <tr style="height: 32px;">
                <td class="input-cell"><input type="text" name="content[tea][new_{index}][material]"></td>
                <td class="input-cell"><input type="text" name="content[tea][new_{index}][batch_number]"></td>
                <td class="input-cell"><input type="text" name="content[tea][new_{index}][quantity]"></td>
                <td class="input-cell"><input type="text" name="content[tea][new_{index}][clarity]"></td>
                <td class="input-cell"><input type="text" name="content[tea][new_{index}][homogeneity]"></td>
                <td class="input-cell"><input type="text" name="content[tea][new_{index}][corrective_measures]"></td>
                <td style="text-align: center;">
                    <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            </tr>
        </template>

        <!-- ===== 6. التقطير والتصفية ===== -->
        <h6 style="margin-top: 30px;">6. التقطير والتصفية</h6>
        <table id="table-distillation" style="font-size: 0.8rem;">
            <thead>
                <tr>
                    <th>النبتة</th>
                    <th>رقم الدفعة</th>
                    <th>الكمية (كغ)</th>
                    <th>الضغط (بار)</th>
                    <th>الحرارة (°C)</th>
                    <th>المادة المستخلصة</th>
                    <th>الكمية (غ/مل)</th>
                    <th>رقم الدفعة</th>
                    <th>الصفاء</th>
                    <th>التدابير</th>
                    <th style="width: 2.5rem;"></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($formContent['distillation']) && is_array($formContent['distillation']))
                    @foreach($formContent['distillation'] as $index => $row)
                        <tr style="height: 32px;">
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][plant]" value="{{ $row['plant'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][batch_number]" value="{{ $row['batch_number'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][quantity]" value="{{ $row['quantity'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][pressure]" value="{{ $row['pressure'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][temperature]" value="{{ $row['temperature'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][extract_type]" value="{{ $row['extract_type'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][extract_quantity]" value="{{ $row['extract_quantity'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][extract_batch]" value="{{ $row['extract_batch'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][clarity]" value="{{ $row['clarity'] ?? '' }}"></td>
                            <td class="input-cell"><input type="text" name="content[distillation][{{ $index }}][corrective_measures]" value="{{ $row['corrective_measures'] ?? '' }}"></td>
                            <td style="text-align: center;">
                                <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr style="height: 32px;">
                        <td class="input-cell"><input type="text" name="content[distillation][0][plant]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][batch_number]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][quantity]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][pressure]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][temperature]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][extract_type]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][extract_quantity]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][extract_batch]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][clarity]" value=""></td>
                        <td class="input-cell"><input type="text" name="content[distillation][0][corrective_measures]" value=""></td>
                        <td style="text-align: center;">
                            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div style="margin-top: 0.75rem;">
            <button type="button" onclick="addProductionRow('distillation')" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Row
            </button>
        </div>

        <template id="tpl-distillation">
            <tr style="height: 32px;">
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][plant]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][batch_number]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][quantity]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][pressure]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][temperature]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][extract_type]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][extract_quantity]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][extract_batch]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][clarity]"></td>
                <td class="input-cell"><input type="text" name="content[distillation][new_{index}][corrective_measures]"></td>
                <td style="text-align: center;">
                    <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            </tr>
        </template>

        <!-- ===== 7. التعبئة والعنونة ===== -->
        <h6 style="margin-top: 30px;">7. التعبئة والعنونة</h6>
        <table>
            <tbody>
                <tr>
                    <th colspan="2">نوع المنتج</th>
                    <td class="input-cell"><input type="text" name="content[packaging][product_type][0]" value="{{ old('content.packaging.product_type.0', $getValue('packaging', 'product_type', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][product_type][1]" value="{{ old('content.packaging.product_type.1', $getValue('packaging', 'product_type', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][product_type][2]" value="{{ old('content.packaging.product_type.2', $getValue('packaging', 'product_type', 2)) }}"></td>
                </tr>
                <tr>
                    <th colspan="2">النبتة أو خليط نباتات</th>
                    <td class="input-cell"><input type="text" name="content[packaging][plant_or_mixture][0]" value="{{ old('content.packaging.plant_or_mixture.0', $getValue('packaging', 'plant_or_mixture', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][plant_or_mixture][1]" value="{{ old('content.packaging.plant_or_mixture.1', $getValue('packaging', 'plant_or_mixture', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][plant_or_mixture][2]" value="{{ old('content.packaging.plant_or_mixture.2', $getValue('packaging', 'plant_or_mixture', 2)) }}"></td>
                </tr>
                <tr>
                    <th colspan="2">رقم الدفعة</th>
                    <td class="input-cell"><input type="text" name="content[packaging][batch_number][0]" value="{{ old('content.packaging.batch_number.0', $getValue('packaging', 'batch_number', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][batch_number][1]" value="{{ old('content.packaging.batch_number.1', $getValue('packaging', 'batch_number', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][batch_number][2]" value="{{ old('content.packaging.batch_number.2', $getValue('packaging', 'batch_number', 2)) }}"></td>
                </tr>
                <tr>
                    <th rowspan="4" class="vertical-header">التعبئة</th>
                    <th>رقم دفعة التعليب</th>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_batch_number][0]" value="{{ old('content.packaging.packaging_batch_number.0', $getValue('packaging', 'packaging_batch_number', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_batch_number][1]" value="{{ old('content.packaging.packaging_batch_number.1', $getValue('packaging', 'packaging_batch_number', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_batch_number][2]" value="{{ old('content.packaging.packaging_batch_number.2', $getValue('packaging', 'packaging_batch_number', 2)) }}"></td>
                </tr>
                <tr>
                    <th>سعة التعليب (غ / مل)</th>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_capacity][0]" value="{{ old('content.packaging.packaging_capacity.0', $getValue('packaging', 'packaging_capacity', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_capacity][1]" value="{{ old('content.packaging.packaging_capacity.1', $getValue('packaging', 'packaging_capacity', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_capacity][2]" value="{{ old('content.packaging.packaging_capacity.2', $getValue('packaging', 'packaging_capacity', 2)) }}"></td>
                </tr>
                <tr>
                    <th>نظافة التعليب والكبسولات</th>
                    <td class="input-cell"><input type="text" name="content[packaging][cleanliness][0]" value="{{ old('content.packaging.cleanliness.0', $getValue('packaging', 'cleanliness', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][cleanliness][1]" value="{{ old('content.packaging.cleanliness.1', $getValue('packaging', 'cleanliness', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][cleanliness][2]" value="{{ old('content.packaging.cleanliness.2', $getValue('packaging', 'cleanliness', 2)) }}"></td>
                </tr>
                <tr>
                    <th>حالة تمكين إغلاق التعليب</th>
                    <td class="input-cell"><input type="text" name="content[packaging][closure_condition][0]" value="{{ old('content.packaging.closure_condition.0', $getValue('packaging', 'closure_condition', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][closure_condition][1]" value="{{ old('content.packaging.closure_condition.1', $getValue('packaging', 'closure_condition', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][closure_condition][2]" value="{{ old('content.packaging.closure_condition.2', $getValue('packaging', 'closure_condition', 2)) }}"></td>
                </tr>
                <tr>
                    <th rowspan="4" class="vertical-header">العنونة</th>
                    <th>التسمية الدقيقة للمنتج</th>
                    <td class="input-cell"><input type="text" name="content[labeling][exact_product_name][0]" value="{{ old('content.labeling.exact_product_name.0', $getValue('labeling', 'exact_product_name', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][exact_product_name][1]" value="{{ old('content.labeling.exact_product_name.1', $getValue('labeling', 'exact_product_name', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][exact_product_name][2]" value="{{ old('content.labeling.exact_product_name.2', $getValue('labeling', 'exact_product_name', 2)) }}"></td>
                </tr>
                <tr>
                    <th>المحتوى الصافي</th>
                    <td class="input-cell"><input type="text" name="content[labeling][net_content][0]" value="{{ old('content.labeling.net_content.0', $getValue('labeling', 'net_content', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][net_content][1]" value="{{ old('content.labeling.net_content.1', $getValue('labeling', 'net_content', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][net_content][2]" value="{{ old('content.labeling.net_content.2', $getValue('labeling', 'net_content', 2)) }}"></td>
                </tr>
                <tr>
                    <th>رقم الدفعة</th>
                    <td class="input-cell"><input type="text" name="content[labeling][batch_number][0]" value="{{ old('content.labeling.batch_number.0', $getValue('labeling', 'batch_number', 0)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][batch_number][1]" value="{{ old('content.labeling.batch_number.1', $getValue('labeling', 'batch_number', 1)) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][batch_number][2]" value="{{ old('content.labeling.batch_number.2', $getValue('labeling', 'batch_number', 2)) }}"></td>
                </tr>
                <tr>
                    <th>تاريخ انتهاء الصلاحية</th>
                    <td class="input-cell"><input type="date" name="content[labeling][expiry_date][0]" value="{{ old('content.labeling.expiry_date.0', $getValue('labeling', 'expiry_date', 0)) }}"></td>
                    <td class="input-cell"><input type="date" name="content[labeling][expiry_date][1]" value="{{ old('content.labeling.expiry_date.1', $getValue('labeling', 'expiry_date', 1)) }}"></td>
                    <td class="input-cell"><input type="date" name="content[labeling][expiry_date][2]" value="{{ old('content.labeling.expiry_date.2', $getValue('labeling', 'expiry_date', 2)) }}"></td>
                </tr>
                <tr style="height: 50px;">
                    <th colspan="2">التدابير التصحيحية المتخذة، عند الضرورة</th>
                    <td class="input-cell"><textarea name="content[corrective_measures][0]" style="min-height: 40px;">{{ old('content.corrective_measures.0', $getRootValue('corrective_measures', 0)) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[corrective_measures][1]" style="min-height: 40px;">{{ old('content.corrective_measures.1', $getRootValue('corrective_measures', 1)) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[corrective_measures][2]" style="min-height: 40px;">{{ old('content.corrective_measures.2', $getRootValue('corrective_measures', 2)) }}</textarea></td>
                </tr>
            </tbody>
        </table>

        <h6 style="margin-top: 30px;">توقيع مسؤول الإنتاج:</h6>
    </div>
</div>

<script>
    function addProductionRow(sectionName) {
        const ms = Date.now();
        const rand = Math.floor(Math.random() * 1000);
        const uniqueId = ms + '_' + rand;
        
        const table = document.getElementById('table-' + sectionName).querySelector('tbody');
        const template = document.getElementById('tpl-' + sectionName).innerHTML;
        
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        tr.style.height = '32px';
        table.appendChild(tr);
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
    }
</script>
