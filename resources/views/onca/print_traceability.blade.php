<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $document->title }}</title>
    <style>
        @page { size: A4 portrait; margin: 8mm; }
        * { margin: 0; padding: 0; }
        body { 
            font-family: Arial, sans-serif; 
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
            direction: rtl;
        }
        
        .container { width: 100%; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 5px; font-size: 10px; text-align: right; }
        
        .header-row td { padding: 4px; border: 1px solid #000; }
        .logo-cell { text-align: center; width: 12%; }
        .title-cell { text-align: center; width: 56%; }
        .ref-cell { text-align: center; width: 32%; font-size: 9px; }
        .section-header { background: #e8e8e8; font-weight: bold; }
        .info-row td { padding: 3px; }
        h2 { text-align: center; font-size: 12px; margin: 10px 0; }
    </style>
</head>
<body onload="window.print()">

    @php $c = $document->content ?? []; @endphp

    <div class="container">
        <!-- Header -->
        <table style="margin-bottom: 2px;">
            <tr class="header-row">
                <td class="logo-cell">
                    <img src="/logo.png" alt="Logo" style="max-height: 30px; width: auto;">
                </td>
                <td class="title-cell" style="padding: 4px;">
                    <div style="font-weight: bold; font-size: 11px; margin-bottom: 2px;">تسجيل:</div>
                    <div style="font-weight: bold; font-size: 10px;">إعادة التتبع (السحب / التجميع)</div>
                    <div style="font-size: 8px; margin-top: 2px;">تعاونية أنرار نتجادرين</div>
                </td>
                <td class="ref-cell">
                    <div style="margin-bottom: 2px;">الرمز: <strong>{{ $document->reference }}</strong></div>
                    <div>الإصدار: <strong>{{ $document->version }}</strong></div>
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
