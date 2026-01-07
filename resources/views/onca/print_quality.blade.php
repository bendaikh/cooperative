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
        td, th { border: 1px solid #000; padding: 6px; font-size: 10px; text-align: right; }
        
        .header-row td { padding: 4px; border: 1px solid #000; }
        .logo-cell { text-align: center; width: 12%; }
        .title-cell { text-align: center; width: 56%; }
        .ref-cell { text-align: center; width: 32%; font-size: 9px; }
        .section-header { background: #e8e8e8; font-weight: bold; }
        .info-row td { padding: 3px; }
        .category-cell { font-weight: bold; text-align: center; background: #fafafa; width: 12%; }
        textarea { width: 100%; min-height: 50px; }
        .footer { margin-top: 15px; }
        .signature-line { display: inline-block; width: 150px; border-bottom: 1px solid #000; text-align: center; margin: 0 10px; }
    </style>
</head>
<body onload="window.print()">

    @php $c = $document->content ?? []; @endphp

    <div class="container">
        <!-- Header -->
        <table style="margin-bottom: 2px;">
            <tr class="header-row">
                <td class="logo-cell">
                    <img src="/logo.png" alt="Logo" style="max-height: 32px; width: auto;">
                </td>
                <td class="title-cell" style="padding: 4px;">
                    <div style="font-weight: bold; font-size: 12px; margin-bottom: 2px;">تسجيل:</div>
                    <div style="font-weight: bold; font-size: 11px;">نموذج مراقبة الجودة</div>
                    <div style="font-size: 9px; margin-top: 2px;">تعاونية أنرار نتجادرين</div>
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

        <!-- Quality Monitoring Table -->
        <table style="font-size: 9px;">
            <thead>
                <tr class="section-header">
                    <th colspan="2">أسباب السحب / التجميع</th>
                    <th>وصف الحالة</th>
                    <th>إجراءات تصحيحية / إصلاحات</th>
                </tr>
            </thead>
            <tbody>
                @php $items = $c['items'] ?? []; @endphp
                @forelse($items as $item)
                    <tr>
                        <td class="category-cell">{{ $item['category'] ?? '' }}</td>
                        <td style="width: 18%;">{{ $item['cause'] ?? '' }}</td>
                        <td style="width: 25%;">{{ $item['description'] ?? '' }}</td>
                        <td style="width: 35%;">{{ $item['action'] ?? '' }}</td>
                    </tr>
                @empty
                    @for($i = 0; $i < 10; $i++)
                        <tr>
                            <td class="category-cell"></td>
                            <td style="width: 18%;"></td>
                            <td style="width: 25%;"></td>
                            <td style="width: 35%;"></td>
                        </tr>
                    @endfor
                @endforelse
            </tbody>
        </table>

        <!-- Footer with Signature -->
        <div class="footer">
            <div style="margin-top: 20px; display: flex; justify-content: space-between; padding: 10px 0;">
                <div style="text-align: center;">
                    <div>تأشير مسؤول الجودة:</div>
                    <div class="signature-line" style="margin-top: 5px;">{{ $c['signature'] ?? '' }}</div>
                </div>
                <div style="text-align: center;">
                    <div>التاريخ:</div>
                    <div class="signature-line" style="margin-top: 5px;">{{ $document->date->format('d/m/Y') }}</div>
                </div>
            </div>
            @if($c['notes'] ?? false)
                <div style="margin-top: 15px; padding: 10px; background: #f9f9f9; border: 1px solid #ddd;">
                    <strong>ملاحظات:</strong>
                    <div style="margin-top: 5px;">{{ $c['notes'] }}</div>
                </div>
            @endif
        </div>
    </div>

</body>
</html>
