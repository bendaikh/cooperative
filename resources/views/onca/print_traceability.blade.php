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
        td, th { border: 1px solid #000; padding: 4px; font-size: 9px; text-align: right; }
        
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 8px; }
        .right-box img { max-height: 70px; }
        .center-box { width: 60%; text-align: center; padding: 8px; }
        .center-box .title { font-size: 22px; font-weight: bold; }
        .center-box .subtitle { font-size: 18px; margin-top: 5px; }
        .left-box { width: 20%; text-align: center; padding: 0; }
        .left-box .label { font-size: 14px; text-align: right; font-weight: normal; }
        .section-header { background: #e8e8e8; font-weight: bold; }
        .info-row td { padding: 3px; }
        h2 { text-align: center; font-size: 12px; margin: 8px 0; }
    </style>
</head>
<body onload="window.print()">

    @php $c = $document->content ?? []; @endphp

    <div class="container">
        <!-- Header -->
        <!-- Unified Header Table: Logo right, Title center, Code/version left -->
        <table class="header-table" style="width: 100%; margin-bottom: 8px; border-collapse: collapse; page-break-after: avoid;">
            <tr>
                <!-- Right: Logo -->
                <td class="right-box" style="width: 20%; text-align: center; padding: 8px; border: 1px solid #000; vertical-align: middle;">
                    <img src="{{ asset('logo.svg') }}" alt="Logo" style="max-height: 70px;">
                </td>
                <!-- Center: Title -->
                <td class="center-box" style="width: 60%; text-align: center; padding: 8px; border: 1px solid #000; vertical-align: middle;">
                    <div class="title" style="font-size: 22px; font-weight: bold;">استقصاء التتبع</div>
                    <div class="subtitle" style="font-size: 18px; margin-top: 5px;">{{ $document->title }}</div>
                </td>
                <!-- Left: Code and Version -->
                <td class="left-box" style="width: 20%; text-align: center; padding: 0; border: 1px solid #000; vertical-align: middle;">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="border-bottom:1px solid #000; padding:6px;">
                                <div class="label" style="font-size: 14px; text-align: right; font-weight: normal;">الرمز:</div>
                                <div>{{ $document->reference }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:6px;">
                                <div class="label" style="font-size: 14px; text-align: right; font-weight: normal;">الإصدار:</div>
                                <div>{{ $document->version }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Info Row -->
        <table style="margin-bottom: 2px;">
            <tr class="info-row">
                <td style="width: 50%; text-align: right;">المسؤول: {{ $document->responsible ?? '' }}</td>
                <td style="width: 50%;">التاريخ: {{ $document->date->format('d/m/Y') }}</td>
            </tr>
        </table>

        <h2>تسجيل إعادة التتبع (السحب / التجميع)</h2>

        <!-- Product Section -->
        <table style="margin-bottom: 5px;">
            <tr class="section-header">
                <th colspan="3">المنتج / Product</th>
            </tr>
            <tr>
                <th style="width: 33%;">التسمية / Name</th>
                <th style="width: 33%;">رقم الدفعة / Batch</th>
                <th style="width: 34%;">الكمية (كغ) / Qty (kg)</th>
            </tr>
            <tr style="height: 25px;">
                <td>{{ $c['product_name'] ?? '' }}</td>
                <td>{{ $c['product_batch'] ?? '' }}</td>
                <td>{{ $c['product_qty'] ?? '' }}</td>
            </tr>
        </table>

        <!-- Raw Materials Section -->
        <table style="margin-bottom: 5px; font-size: 9px;">
            <tr class="section-header">
                <th colspan="6">المادة الأولية / Raw Materials</th>
            </tr>
            <tr>
                <th style="width: 12%;">طبيعتها</th>
                <th style="width: 15%;">المورد</th>
                <th style="width: 12%;">المنطقة</th>
                <th style="width: 12%;">تاريخ الاستلام</th>
                <th style="width: 12%;">الكمية (كغ)</th>
                <th style="width: 37%;">ملاحظة</th>
            </tr>
            @php $materials = $c['materials'] ?? []; $max_m = max(count($materials), 5); @endphp
            @for($i=0; $i<$max_m; $i++)
                <tr style="height: 20px;">
                    <td>{{ $materials[$i]['nature'] ?? '' }}</td>
                    <td>{{ $materials[$i]['supplier'] ?? '' }}</td>
                    <td>{{ $materials[$i]['region'] ?? '' }}</td>
                    <td>{{ $materials[$i]['receipt_date'] ?? '' }}</td>
                    <td>{{ $materials[$i]['qty'] ?? '' }}</td>
                    <td>{{ $materials[$i]['notes'] ?? '' }}</td>
                </tr>
            @endfor
        </table>

        <!-- Packaging Section -->
        <table style="margin-bottom: 10px; font-size: 9px;">
            <tr class="section-header">
                <th colspan="3">التعليب / Packaging</th>
            </tr>
            <tr>
                <th style="width: 33%;">طبيعته</th>
                <th style="width: 33%;">رقم الدفعة</th>
                <th style="width: 34%;">الكمية (وحدة)</th>
            </tr>
            @php $packaging = $c['packaging'] ?? []; $max_p = max(count($packaging), 3); @endphp
            @for($i=0; $i<$max_p; $i++)
                <tr style="height: 20px;">
                    <td>{{ $packaging[$i]['nature'] ?? '' }}</td>
                    <td>{{ $packaging[$i]['batch'] ?? '' }}</td>
                    <td>{{ $packaging[$i]['qty'] ?? '' }}</td>
                </tr>
            @endfor
        </table>

        <!-- Signature -->
        <div style="margin-top: 20px;">
            <p style="font-weight: bold;">
                تأشير مسؤول الجودة: <span style="display: inline-block; width: 150px; border-bottom: 1px solid #000;">{{ $c['signature'] ?? '' }}</span>
            </p>
        </div>
    </div>

</body>
</html>
