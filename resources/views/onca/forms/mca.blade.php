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
        .mca-body {
            direction: rtl;
        }

        .mca-body h6 {
            margin: 20px 0 15px 0;
            padding: 0;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: underline;
            text-align: right;
            color: #1f2937;
        }

        .mca-body table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            direction: rtl;
        }

        .mca-body th {
            background-color: #e8e8e8;
            border: 1.2px solid #3b78b6;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 0.85rem;
            height: 30px;
        }

        .mca-body td {
            border: 1.2px solid #3b78b6;
            padding: 0;
            height: 32px;
            vertical-align: middle;
        }

        .mca-body .vertical-header {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            font-weight: bold;
            width: 38px;
            padding: 4px 2px;
            font-size: 0.85rem;
            background-color: #e8e8e8;
        }

        .mca-body .field-label {
            background-color: #f9fafb;
            font-weight: bold;
            padding: 6px;
            text-align: right;
            font-size: 0.85rem;
            width: 22%;
            word-break: break-word;
        }

        .mca-body .input-cell {
            width: 26%;
        }

        .mca-body input,
        .mca-body textarea {
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

        .mca-body input:focus,
        .mca-body textarea:focus {
            background-color: #f0f7ff;
            outline: none;
        }

        .mca-body textarea {
            padding: 3px 5px;
            min-height: 32px;
        }

        .mca-body .question-row {
            height: auto;
            min-height: 40px;
        }

        .mca-body .question-row td {
            vertical-align: top;
            padding: 4px;
            height: auto;
        }

        .mca-body .empty-cell {
            width: 38px;
            border: none;
            background: white;
        }
    </style>

    <div class="mca-body">
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
                    <td class="input-cell"><input type="text" name="content[supply][material][0]" value="{{ $getValue('supply', 'material', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][material][1]" value="{{ $getValue('supply', 'material', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][material][2]" value="{{ $getValue('supply', 'material', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">قسيمة استلام رقم</td>
                    <td class="input-cell"><input type="text" name="content[supply][receipt_voucher_number][0]" value="{{ $getValue('supply', 'receipt_voucher_number', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][receipt_voucher_number][1]" value="{{ $getValue('supply', 'receipt_voucher_number', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][receipt_voucher_number][2]" value="{{ $getValue('supply', 'receipt_voucher_number', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">حالة نظافة العربة</td>
                    <td class="input-cell"><input type="text" name="content[supply][cart_cleanliness][0]" value="{{ $getValue('supply', 'cart_cleanliness', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][cart_cleanliness][1]" value="{{ $getValue('supply', 'cart_cleanliness', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][cart_cleanliness][2]" value="{{ $getValue('supply', 'cart_cleanliness', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">حالة نظافة التعليب</td>
                    <td class="input-cell"><input type="text" name="content[supply][packaging_cleanliness][0]" value="{{ $getValue('supply', 'packaging_cleanliness', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][packaging_cleanliness][1]" value="{{ $getValue('supply', 'packaging_cleanliness', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][packaging_cleanliness][2]" value="{{ $getValue('supply', 'packaging_cleanliness', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">الرائحة</td>
                    <td class="input-cell"><input type="text" name="content[supply][odor][0]" value="{{ $getValue('supply', 'odor', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][odor][1]" value="{{ $getValue('supply', 'odor', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][odor][2]" value="{{ $getValue('supply', 'odor', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">اللون</td>
                    <td class="input-cell"><input type="text" name="content[supply][color][0]" value="{{ $getValue('supply', 'color', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][color][1]" value="{{ $getValue('supply', 'color', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][color][2]" value="{{ $getValue('supply', 'color', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">التعفنات</td>
                    <td class="input-cell"><input type="text" name="content[supply][rot][0]" value="{{ $getValue('supply', 'rot', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][rot][1]" value="{{ $getValue('supply', 'rot', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][rot][2]" value="{{ $getValue('supply', 'rot', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">المواد الأجنبية</td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_materials][0]" value="{{ $getValue('supply', 'foreign_materials', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_materials][1]" value="{{ $getValue('supply', 'foreign_materials', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_materials][2]" value="{{ $getValue('supply', 'foreign_materials', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">الأجسام الأجنبية</td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_bodies][0]" value="{{ $getValue('supply', 'foreign_bodies', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_bodies][1]" value="{{ $getValue('supply', 'foreign_bodies', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[supply][foreign_bodies][2]" value="{{ $getValue('supply', 'foreign_bodies', 2) }}"></td>
                </tr>
            </tbody>
        </table>

        <!-- Supply Questions -->
        <table>
            <tbody>
                <tr class="question-row">
                    <td colspan="2" class="field-label" style="background: white;">إن كانت الدفعة مقبولة، ما هو الرقم الذي خصص لها؟</td>
                    <td class="input-cell"><textarea name="content[supply][if_accepted_number][0]">{{ $getValue('supply', 'if_accepted_number', 0) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[supply][if_accepted_number][1]">{{ $getValue('supply', 'if_accepted_number', 1) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[supply][if_accepted_number][2]">{{ $getValue('supply', 'if_accepted_number', 2) }}</textarea></td>
                </tr>
                <tr class="question-row">
                    <td colspan="2" class="field-label" style="background: white;">إن كان العكس، ما هو الإجراء الذي اتخذ في شأنها؟</td>
                    <td class="input-cell"><textarea name="content[supply][if_rejected_action][0]">{{ $getValue('supply', 'if_rejected_action', 0) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[supply][if_rejected_action][1]">{{ $getValue('supply', 'if_rejected_action', 1) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[supply][if_rejected_action][2]">{{ $getValue('supply', 'if_rejected_action', 2) }}</textarea></td>
                </tr>
            </tbody>
        </table>

        <!-- ============ SECTION 2: التعبئة والعنونة ============ -->
        <h6 style="margin-top: 30px;">2. التعبئة والعنونة</h6>
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
                <!-- Product Info - No vertical header -->
                <tr>
                    <td class="empty-cell"></td>
                    <td class="field-label">نوع المنتج</td>
                    <td class="input-cell"><input type="text" name="content[packaging][product_type][0]" value="{{ $getValue('packaging', 'product_type', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][product_type][1]" value="{{ $getValue('packaging', 'product_type', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][product_type][2]" value="{{ $getValue('packaging', 'product_type', 2) }}"></td>
                </tr>
                <tr>
                    <td class="empty-cell"></td>
                    <td class="field-label">النبتة أو خليط نباتات</td>
                    <td class="input-cell"><input type="text" name="content[packaging][plant_or_mixture][0]" value="{{ $getValue('packaging', 'plant_or_mixture', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][plant_or_mixture][1]" value="{{ $getValue('packaging', 'plant_or_mixture', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][plant_or_mixture][2]" value="{{ $getValue('packaging', 'plant_or_mixture', 2) }}"></td>
                </tr>
                <tr>
                    <td class="empty-cell"></td>
                    <td class="field-label">رقم الدفعة</td>
                    <td class="input-cell"><input type="text" name="content[packaging][batch_number][0]" value="{{ $getValue('packaging', 'batch_number', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][batch_number][1]" value="{{ $getValue('packaging', 'batch_number', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][batch_number][2]" value="{{ $getValue('packaging', 'batch_number', 2) }}"></td>
                </tr>
                <!-- التعبئة Section -->
                <tr>
                    <td rowspan="4" class="vertical-header">التعبئة</td>
                    <td class="field-label">رقم دفعة التعليب</td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_batch_number][0]" value="{{ $getValue('packaging', 'packaging_batch_number', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_batch_number][1]" value="{{ $getValue('packaging', 'packaging_batch_number', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_batch_number][2]" value="{{ $getValue('packaging', 'packaging_batch_number', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">سعة التعليب (غ / مل)</td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_capacity][0]" value="{{ $getValue('packaging', 'packaging_capacity', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_capacity][1]" value="{{ $getValue('packaging', 'packaging_capacity', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][packaging_capacity][2]" value="{{ $getValue('packaging', 'packaging_capacity', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">نظافة التعليب والكبسولات</td>
                    <td class="input-cell"><input type="text" name="content[packaging][cleanliness][0]" value="{{ $getValue('packaging', 'cleanliness', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][cleanliness][1]" value="{{ $getValue('packaging', 'cleanliness', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][cleanliness][2]" value="{{ $getValue('packaging', 'cleanliness', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">حالة تمكين إغلاق التعليب</td>
                    <td class="input-cell"><input type="text" name="content[packaging][closure_condition][0]" value="{{ $getValue('packaging', 'closure_condition', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][closure_condition][1]" value="{{ $getValue('packaging', 'closure_condition', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[packaging][closure_condition][2]" value="{{ $getValue('packaging', 'closure_condition', 2) }}"></td>
                </tr>
                <!-- العنونة Section -->
                <tr>
                    <td rowspan="4" class="vertical-header">العنونة</td>
                    <td class="field-label">التسمية الدقيقة للمنتج</td>
                    <td class="input-cell"><input type="text" name="content[labeling][exact_product_name][0]" value="{{ $getValue('labeling', 'exact_product_name', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][exact_product_name][1]" value="{{ $getValue('labeling', 'exact_product_name', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][exact_product_name][2]" value="{{ $getValue('labeling', 'exact_product_name', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">المحتوى الصافي</td>
                    <td class="input-cell"><input type="text" name="content[labeling][net_content][0]" value="{{ $getValue('labeling', 'net_content', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][net_content][1]" value="{{ $getValue('labeling', 'net_content', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][net_content][2]" value="{{ $getValue('labeling', 'net_content', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">رقم الدفعة</td>
                    <td class="input-cell"><input type="text" name="content[labeling][batch_number][0]" value="{{ $getValue('labeling', 'batch_number', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][batch_number][1]" value="{{ $getValue('labeling', 'batch_number', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[labeling][batch_number][2]" value="{{ $getValue('labeling', 'batch_number', 2) }}"></td>
                </tr>
                <tr>
                    <td class="field-label">تاريخ انتهاء الصلاحية</td>
                    <td class="input-cell"><input type="date" name="content[labeling][expiry_date][0]" value="{{ $getValue('labeling', 'expiry_date', 0) }}"></td>
                    <td class="input-cell"><input type="date" name="content[labeling][expiry_date][1]" value="{{ $getValue('labeling', 'expiry_date', 1) }}"></td>
                    <td class="input-cell"><input type="date" name="content[labeling][expiry_date][2]" value="{{ $getValue('labeling', 'expiry_date', 2) }}"></td>
                </tr>
                <!-- Corrective Measures -->
                <tr class="question-row">
                    <td class="empty-cell"></td>
                    <td class="field-label" style="background: white;">التدابير التصحيحية المتخذة، عند الضرورة</td>
                    <td class="input-cell"><textarea name="content[corrective_measures][0]" style="min-height: 40px;">{{ $getRootValue('corrective_measures', 0) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[corrective_measures][1]" style="min-height: 40px;">{{ $getRootValue('corrective_measures', 1) }}</textarea></td>
                    <td class="input-cell"><textarea name="content[corrective_measures][2]" style="min-height: 40px;">{{ $getRootValue('corrective_measures', 2) }}</textarea></td>
                </tr>
                <!-- Signature -->
                <tr>
                    <td class="empty-cell"></td>
                    <td class="field-label">توقيع مسؤول الإنتاج</td>
                    <td class="input-cell"><input type="text" name="content[signature][0]" value="{{ $getRootValue('signature', 0) }}"></td>
                    <td class="input-cell"><input type="text" name="content[signature][1]" value="{{ $getRootValue('signature', 1) }}"></td>
                    <td class="input-cell"><input type="text" name="content[signature][2]" value="{{ $getRootValue('signature', 2) }}"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
