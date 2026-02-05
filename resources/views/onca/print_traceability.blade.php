<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سجل الإنتاج - PR-R-EN3</title>
    <style>
        @page { size: A4 portrait; margin: 10mm; }
        * { margin: 0; padding: 0; }
        body { 
            font-family: Arial, sans-serif; 
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
            direction: rtl;
        }
        
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 8px; }
        .right-box img { max-height: 70px; }
        .center-box { width: 60%; text-align: center; padding: 8px; }
        .center-box .title { font-size: 22px; font-weight: bold; }
        .left-box { width: 20%; text-align: center; padding: 0; }
        .left-box .label { font-size: 14px; text-align: right; font-weight: normal; }
        
        .doc-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        .doc-info td {
            padding: 6px;
            border-bottom: 1px dotted #999;
        }
        .doc-info .info-label {
            font-weight: bold;
            width: 15%;
            text-align: right;
        }
        .doc-info .info-value {
            width: 35%;
            text-align: right;
            border-bottom: 1px solid #000;
        }
        
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            direction: rtl;
            margin-bottom: 20px;
        }
        table.data-table th, table.data-table td {
            border: 1.2px solid #3b78b6;
            padding: 6px;
            text-align: right;
            vertical-align: middle;
            font-size: 11px;
        }
        table.data-table th {
            font-weight: bold;
            background-color: #e8f0f7;
        }
        .row {
            height: 32px;
        }
        .signature {
            margin-top: 30px;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>

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
                    <div class="title">سجل الإنتاج</div>
                </td>
                <!-- Left: Code & Version -->
                <td class="left-box">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="border-bottom:1px solid #000; padding:6px;">
                                <div class="label">الرمز:</div>
                                <div style="font-size: 14px;">PR-R-EN3</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:6px;">
                                <div class="label">الإصدار:</div>
                                <div style="font-size: 14px;">01</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Document Info Section -->
        <table class="doc-info">
            <tr>
                <td class="info-label">ملف رقم:</td>
                <td class="info-value">................................</td>
                <td class="info-label">فتح بتاريخ:</td>
                <td class="info-value">................................</td>
            </tr>
        </table>

        <!-- Data Table with simplified structure -->
        <table class="data-table">
            <!-- HEADER LEVEL 1 -->
            <tr>
                <th colspan="3">المنتوج</th>
                <th colspan="5">المادة الأولية</th>
                <th colspan="3">التعليب</th>
            </tr>

            <!-- HEADER LEVEL 2 -->
            <tr>
                <!-- المنتج -->
                <th>التسمية</th>
                <th>رقم الدفعة</th>
                <th>الكمية المنتجة<br>(كلغ)</th>

                <!-- المادة الأولية -->
                <th>طبيعتها</th>
                <th>المزود</th>
                <th>المنطقة</th>
                <th>تاريخ الاستلام</th>
                <th>الكمية<br>(كلغ)</th>

                <!-- التعليب -->
                <th>طبيعة</th>
                <th>رقم الدفعة</th>
                <th>الكمية<br>(وحدة)</th>
            </tr>

            <!-- DATA ROWS -->
            @php
                $materials = $document->content['materials'] ?? [];
                $packaging = $document->content['packaging'] ?? [];
                $maxRows = max(count($materials), count($packaging));
                $productName = $document->content['product_name'] ?? '';
                $productBatch = $document->content['product_batch'] ?? '';
                $productQty = $document->content['product_qty'] ?? '';
            @endphp
            @if($maxRows > 0)
                @foreach(range(0, $maxRows - 1) as $index)
                    @php
                        $material = $materials[$index] ?? [];
                        $pack = $packaging[$index] ?? [];
                    @endphp
                    <tr class="row">
                        @if($index === 0)
                            <td>{{ $productName }}</td>
                            <td>{{ $productBatch }}</td>
                            <td>{{ $productQty }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                        <td>{{ $material['nature'] ?? '' }}</td>
                        <td>{{ $material['supplier'] ?? '' }}</td>
                        <td>{{ $material['region'] ?? '' }}</td>
                        <td>{{ $material['receipt_date'] ?? '' }}</td>
                        <td>{{ $material['qty'] ?? '' }}</td>
                        <td>{{ $pack['nature'] ?? '' }}</td>
                        <td>{{ $pack['batch'] ?? '' }}</td>
                        <td>{{ $pack['qty'] ?? '' }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="row">
                    <td>{{ $productName }}</td>
                    <td>{{ $productBatch }}</td>
                    <td>{{ $productQty }}</td>
                    <td></td><td></td><td></td><td></td><td></td>
                    <td></td><td></td><td></td>
                </tr>

                <tr class="row">
                    <td></td><td></td><td></td>
                    <td></td><td></td><td></td><td></td><td></td>
                    <td></td><td></td><td></td>
                </tr>

                <tr class="row">
                    <td></td><td></td><td></td>
                    <td></td><td></td><td></td><td></td><td></td>
                    <td></td><td></td><td></td>
                </tr>
            @endif
        </table>

        <div class="signature">تأشير مسؤول الجودة:</div>

    </div>

</body>
</html>
