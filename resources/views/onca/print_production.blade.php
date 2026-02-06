<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $document->title }}</title>
    <style>
        @page { size: A4 portrait; margin: 10mm; }
        * { margin: 0; padding: 0; }
        body { 
            font-family: Arial, sans-serif; 
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
            direction: rtl;
        }
        
        .container { width: 100%; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1.2px solid #3b78b6; padding: 3px 4px; font-size: 9px; text-align: right; }
        
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 8px; }
        .right-box img { max-height: 70px; }
        .center-box { width: 60%; text-align: center; padding: 8px; }
        .center-box .title { font-size: 22px; font-weight: bold; }
        .center-box .subtitle { font-size: 18px; margin-top: 5px; }
        .left-box { width: 20%; text-align: center; padding: 0; }
        .left-box .label { font-size: 14px; text-align: right; font-weight: normal; }
        .info-row td { padding: 3px; }

        .body-content h6 {
            margin: 10px 0 5px;
            text-decoration: underline;
            font-size: 12px;
        }
        .body-content table {
            width: 100%;
            border-collapse: collapse;
            direction: rtl;
            margin-bottom: 15px;
        }
        .body-content th {
            background: #f8fbff;
            border: 1.2px solid #3b78b6;
            padding: 6px;
            vertical-align: middle;
            font-size: 10px;
            font-weight: bold;
        }
        .body-content td {
            border: 1.2px solid #3b78b6;
            padding: 4px;
            vertical-align: middle;
            font-size: 9px;
        }
        .body-content .vertical {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            font-weight: bold;
            width: 35px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body onload="window.print()">

    @php
        $c = $document->content ?? [];
        $getValue = function ($section, $key, $index = 0) use ($c) {
            $value = $c[$section][$key] ?? '';
            if (is_array($value)) {
                return $value[$index] ?? '';
            }
            return $index === 0 ? $value : '';
        };
        $getRootValue = function ($key, $index = 0) use ($c) {
            $value = $c[$key] ?? '';
            if (is_array($value)) {
                return $value[$index] ?? '';
            }
            return $index === 0 ? $value : '';
        };
        $getRowValue = function ($section, $rowIndex, $field) use ($c) {
            return $c[$section][$rowIndex][$field] ?? '';
        };
    @endphp

    <div class="container">
        <!-- Header Table: Logo right, Title center, Code/version left -->
        <table class="header-table" style="page-break-after: avoid;">
            <tr>
                <!-- Right: Logo -->
                <td class="right-box">
                    <img src="{{ asset('logo.svg') }}" alt="Logo">
                </td>
                <!-- Center: Title -->
                <td class="center-box">
                    <div class="title">مراقبة الإنتاج</div>
                    <div class="subtitle">{{ $document->title }}</div>
                </td>
                <!-- Left: Code & Version -->
                <td class="left-box">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="border-bottom:1px solid #000; padding:6px;">
                                <div class="label">الرمز:</div>
                                <div>{{ $document->reference }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:6px;">
                                <div class="label">الإصدار:</div>
                                <div>{{ $document->version }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <!-- Info Row -->
        <table style="margin-bottom: 2px; page-break-after: avoid;">
            <tr class="info-row">
                <td style="width: 50%; text-align: right;">المسؤول: {{ $document->responsible }}</td>
                <td style="width: 50%;">التاريخ: {{ $document->date->format('Y/m/d') }}</td>
            </tr>
        </table>

        <div class="body-content">
            <!-- 1. التموين -->
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
                    <td rowspan="9" class="vertical">مراقبة</td>
                    <td>المادة</td>
                    <td>{{ $getValue('supply', 'material', 0) }}</td>
                    <td>{{ $getValue('supply', 'material', 1) }}</td>
                    <td>{{ $getValue('supply', 'material', 2) }}</td>
                </tr>
                <tr>
                    <td>قسيمة استلام رقم</td>
                    <td>{{ $getValue('supply', 'receipt_voucher_number', 0) }}</td>
                    <td>{{ $getValue('supply', 'receipt_voucher_number', 1) }}</td>
                    <td>{{ $getValue('supply', 'receipt_voucher_number', 2) }}</td>
                </tr>
                <tr>
                    <td>حالة نظافة العربة</td>
                    <td>{{ $getValue('supply', 'cart_cleanliness', 0) }}</td>
                    <td>{{ $getValue('supply', 'cart_cleanliness', 1) }}</td>
                    <td>{{ $getValue('supply', 'cart_cleanliness', 2) }}</td>
                </tr>
                <tr>
                    <td>حالة نظافة التعليب</td>
                    <td>{{ $getValue('supply', 'packaging_cleanliness', 0) }}</td>
                    <td>{{ $getValue('supply', 'packaging_cleanliness', 1) }}</td>
                    <td>{{ $getValue('supply', 'packaging_cleanliness', 2) }}</td>
                </tr>
                <tr>
                    <td>الرائحة</td>
                    <td>{{ $getValue('supply', 'odor', 0) }}</td>
                    <td>{{ $getValue('supply', 'odor', 1) }}</td>
                    <td>{{ $getValue('supply', 'odor', 2) }}</td>
                </tr>
                <tr>
                    <td>اللون</td>
                    <td>{{ $getValue('supply', 'color', 0) }}</td>
                    <td>{{ $getValue('supply', 'color', 1) }}</td>
                    <td>{{ $getValue('supply', 'color', 2) }}</td>
                </tr>
                <tr>
                    <td>التعفنات</td>
                    <td>{{ $getValue('supply', 'rot', 0) }}</td>
                    <td>{{ $getValue('supply', 'rot', 1) }}</td>
                    <td>{{ $getValue('supply', 'rot', 2) }}</td>
                </tr>
                <tr>
                    <td>المواد الأجنبية</td>
                    <td>{{ $getValue('supply', 'foreign_materials', 0) }}</td>
                    <td>{{ $getValue('supply', 'foreign_materials', 1) }}</td>
                    <td>{{ $getValue('supply', 'foreign_materials', 2) }}</td>
                </tr>
                <tr>
                    <td>الأجسام الأجنبية</td>
                    <td>{{ $getValue('supply', 'foreign_bodies', 0) }}</td>
                    <td>{{ $getValue('supply', 'foreign_bodies', 1) }}</td>
                    <td>{{ $getValue('supply', 'foreign_bodies', 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2">إن كانت الدفعة مقبولة، ما هو الرقم الذي خصص لها؟</td>
                    <td>{{ $getValue('supply', 'if_accepted_number', 0) }}</td>
                    <td>{{ $getValue('supply', 'if_accepted_number', 1) }}</td>
                    <td>{{ $getValue('supply', 'if_accepted_number', 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2">إن كان العكس، ما هو الإجراء الذي اتخذ في شأنها؟</td>
                    <td>{{ $getValue('supply', 'if_rejected_action', 0) }}</td>
                    <td>{{ $getValue('supply', 'if_rejected_action', 1) }}</td>
                    <td>{{ $getValue('supply', 'if_rejected_action', 2) }}</td>
                </tr>
                </tbody>
            </table>

            <!-- 2. الفرز والتنقية -->
            <h6>2. الفرز والتنقية</h6>
            <table>
                <tr>
                    <th>المادة</th>
                    <th>رقم الدفعة</th>
                    <th>الكمية (كغ)</th>
                    <th colspan="2">المراقبة</th>
                    <th>التدابير</th>
                </tr>
                @for ($i = 0; $i < 3; $i++)
                <tr>
                    <td>{{ $getRowValue('sorting', $i, 'material') }}</td>
                    <td>{{ $getRowValue('sorting', $i, 'batch_number') }}</td>
                    <td>{{ $getRowValue('sorting', $i, 'quantity') }}</td>
                    <td>{{ $getRowValue('sorting', $i, 'foreign_materials') }}</td>
                    <td>{{ $getRowValue('sorting', $i, 'foreign_bodies') }}</td>
                    <td>{{ $getRowValue('sorting', $i, 'corrective_measures') }}</td>
                </tr>
                @endfor
            </table>

            <!-- 3. الغسل والتنشيف -->
            <h6>3. الغسل والتنشيف</h6>
            <table>
                <tr>
                    <th>المادة</th>
                    <th>رقم الدفعة</th>
                    <th>الكمية (كغ)</th>
                    <th colspan="2">المراقبة</th>
                    <th>التدابير</th>
                </tr>
                @for ($i = 0; $i < 3; $i++)
                <tr>
                    <td>{{ $getRowValue('washing', $i, 'material') }}</td>
                    <td>{{ $getRowValue('washing', $i, 'batch_number') }}</td>
                    <td>{{ $getRowValue('washing', $i, 'quantity') }}</td>
                    <td>{{ $getRowValue('washing', $i, 'foreign_materials') }}</td>
                    <td>{{ $getRowValue('washing', $i, 'foreign_bodies') }}</td>
                    <td>{{ $getRowValue('washing', $i, 'corrective_measures') }}</td>
                </tr>
                @endfor
            </table>

            <!-- Page Break -->
            <div class="page-break"></div>

            <!-- 4. الخلط -->
            <h6>4. الخلط</h6>
            <table>
                <thead>
                    <tr>
                        <th colspan="3">المكونات</th>
                        <th colspan="3">المنتج النهائي</th>
                    </tr>
                    <tr>
                        <th>المكون</th>
                        <th>رقم الدفعة</th>
                        <th>الكمية (كغ)</th>
                        <th>المنتج</th>
                        <th>رقم الدفعة</th>
                        <th>الكمية (كغ)</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 3; $i++)
                    <tr>
                        <td>{{ $getRowValue('mixing', $i, 'ingredient') }}</td>
                        <td>{{ $getRowValue('mixing', $i, 'batch_number') }}</td>
                        <td>{{ $getRowValue('mixing', $i, 'quantity') }}</td>
                        <td>{{ $getValue('mixing', 'product_name', 0) }}</td>
                        <td>{{ $getValue('mixing', 'product_batch', 0) }}</td>
                        <td>{{ $getValue('mixing', 'product_quantity', 0) }}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>

            <!-- 5. الشاي والنقع -->
            <h6>5. الشاي والنقع</h6>
            <table>
                <thead>
                    <tr>
                        <th>المادة</th>
                        <th>رقم الدفعة</th>
                        <th>الكمية (كغ)</th>
                        <th colspan="2">المراقبة</th>
                        <th>التدابير</th>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                        <th>الصفاء</th>
                        <th>التجانس</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 3; $i++)
                    <tr>
                        <td>{{ $getRowValue('tea', $i, 'material') }}</td>
                        <td>{{ $getRowValue('tea', $i, 'batch_number') }}</td>
                        <td>{{ $getRowValue('tea', $i, 'quantity') }}</td>
                        <td>{{ $getRowValue('tea', $i, 'clarity') }}</td>
                        <td>{{ $getRowValue('tea', $i, 'homogeneity') }}</td>
                        <td>{{ $getRowValue('tea', $i, 'corrective_measures') }}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>

            <!-- 6. التقطير والتصفية -->
            <h6>6. التقطير والتصفية</h6>
            <table style="font-size: 8px;">
                <thead>
                    <tr>
                        <th>النبتة</th>
                        <th>رقم الدفعة</th>
                        <th>الكمية</th>
                        <th>الضغط</th>
                        <th>الحرارة</th>
                        <th>المادة</th>
                        <th>الكمية</th>
                        <th>رقم</th>
                        <th>الصفاء</th>
                        <th>التدابير</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 4; $i++)
                    <tr>
                        <td>{{ $getRowValue('distillation', $i, 'plant') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'batch_number') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'quantity') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'pressure') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'temperature') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'extract_type') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'extract_quantity') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'extract_batch') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'clarity') }}</td>
                        <td>{{ $getRowValue('distillation', $i, 'corrective_measures') }}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>

            <!-- 7. التعبئة والعنونة -->
            <h6>7. التعبئة والعنونة</h6>
            <table>
                <tr>
                    <th colspan="2">نوع المنتج</th>
                    <td>{{ $getValue('packaging', 'product_type', 0) }}</td>
                    <td>{{ $getValue('packaging', 'product_type', 1) }}</td>
                    <td>{{ $getValue('packaging', 'product_type', 2) }}</td>
                </tr>
                <tr>
                    <th colspan="2">النبتة أو خليط نباتات</th>
                    <td>{{ $getValue('packaging', 'plant_or_mixture', 0) }}</td>
                    <td>{{ $getValue('packaging', 'plant_or_mixture', 1) }}</td>
                    <td>{{ $getValue('packaging', 'plant_or_mixture', 2) }}</td>
                </tr>
                <tr>
                    <th colspan="2">رقم الدفعة</th>
                    <td>{{ $getValue('packaging', 'batch_number', 0) }}</td>
                    <td>{{ $getValue('packaging', 'batch_number', 1) }}</td>
                    <td>{{ $getValue('packaging', 'batch_number', 2) }}</td>
                </tr>
                <tr>
                    <th rowspan="4" class="vertical">التعبئة</th>
                    <th>رقم دفعة التعليب</th>
                    <td>{{ $getValue('packaging', 'packaging_batch_number', 0) }}</td>
                    <td>{{ $getValue('packaging', 'packaging_batch_number', 1) }}</td>
                    <td>{{ $getValue('packaging', 'packaging_batch_number', 2) }}</td>
                </tr>
                <tr>
                    <th>سعة التعليب (غ / مل)</th>
                    <td>{{ $getValue('packaging', 'packaging_capacity', 0) }}</td>
                    <td>{{ $getValue('packaging', 'packaging_capacity', 1) }}</td>
                    <td>{{ $getValue('packaging', 'packaging_capacity', 2) }}</td>
                </tr>
                <tr>
                    <th>نظافة التعليب</th>
                    <td>{{ $getValue('packaging', 'cleanliness', 0) }}</td>
                    <td>{{ $getValue('packaging', 'cleanliness', 1) }}</td>
                    <td>{{ $getValue('packaging', 'cleanliness', 2) }}</td>
                </tr>
                <tr>
                    <th>حالة الإغلاق</th>
                    <td>{{ $getValue('packaging', 'closure_condition', 0) }}</td>
                    <td>{{ $getValue('packaging', 'closure_condition', 1) }}</td>
                    <td>{{ $getValue('packaging', 'closure_condition', 2) }}</td>
                </tr>
                <tr>
                    <th rowspan="4" class="vertical">العنونة</th>
                    <th>التسمية الدقيقة</th>
                    <td>{{ $getValue('labeling', 'exact_product_name', 0) }}</td>
                    <td>{{ $getValue('labeling', 'exact_product_name', 1) }}</td>
                    <td>{{ $getValue('labeling', 'exact_product_name', 2) }}</td>
                </tr>
                <tr>
                    <th>المحتوى الصافي</th>
                    <td>{{ $getValue('labeling', 'net_content', 0) }}</td>
                    <td>{{ $getValue('labeling', 'net_content', 1) }}</td>
                    <td>{{ $getValue('labeling', 'net_content', 2) }}</td>
                </tr>
                <tr>
                    <th>رقم الدفعة</th>
                    <td>{{ $getValue('labeling', 'batch_number', 0) }}</td>
                    <td>{{ $getValue('labeling', 'batch_number', 1) }}</td>
                    <td>{{ $getValue('labeling', 'batch_number', 2) }}</td>
                </tr>
                <tr>
                    <th>تاريخ الانتهاء</th>
                    <td>{{ $getValue('labeling', 'expiry_date', 0) }}</td>
                    <td>{{ $getValue('labeling', 'expiry_date', 1) }}</td>
                    <td>{{ $getValue('labeling', 'expiry_date', 2) }}</td>
                </tr>
                <tr style="height: 50px;">
                    <th colspan="2">التدابير التصحيحية المتخذة، عند الضرورة</th>
                    <td>{{ $getRootValue('corrective_measures', 0) }}</td>
                    <td>{{ $getRootValue('corrective_measures', 1) }}</td>
                    <td>{{ $getRootValue('corrective_measures', 2) }}</td>
                </tr>
            </table>

            <h6 style="margin-top: 30px;">توقيع مسؤول الإنتاج:</h6>
        </div>
    </div>

</body>
</html>
