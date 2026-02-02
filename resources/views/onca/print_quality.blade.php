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
        .category-cell { font-weight: bold; text-align: center; background: #fafafa; width: 15%; }
        textarea { width: 100%; min-height: 50px; }
        .footer { margin-top: 15px; }
        .signature-line { display: inline-block; width: 150px; border-bottom: 1px solid #000; text-align: center; margin: 0 10px; }
    </style>
</head>
<body onload="window.print()">

    @php $c = $document->content ?? []; @endphp

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
                    <div class="title">استقصاء:</div>
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
        <table style="margin-bottom: 2px;">
            <tr class="info-row">
                <td style="width: 50%; text-align: right;">المسؤول: {{ $document->responsible ?? '' }}</td>
                <td style="width: 50%;">التاريخ: {{ $document->date->format('d/m/Y') }}</td>
            </tr>
        </table>

        <!-- Quality Monitoring Table -->
        <table style="width: 100%; border-collapse: collapse; table-layout: fixed; direction: rtl;">
            <thead>
                <tr>
                    <th class="category"></th>
                    <th class="items"></th>
                    <th class="causes">أسباب السحب / التجميع</th>
                    <th class="description">وصف الحالة</th>
                    <th class="actions">إجراءات تصحيحية / إصلاحات</th>
                </tr>
            </thead>
            <tbody>
                @php
                $fixedRows = [
                    [ 'cat' => '1) المواد', 'rowspan' => 3, 'item' => '- المواد الأولية' ],
                    [ 'cat' => null, 'rowspan' => null, 'item' => '- التعليم' ],
                    [ 'cat' => null, 'rowspan' => null, 'item' => '- مواد أخرى' ],
                    [ 'cat' => '2) المكان', 'rowspan' => 2, 'item' => '- الوضعية' ],
                    [ 'cat' => null, 'rowspan' => null, 'item' => '- الحالة' ],
                    [ 'cat' => '3) المناهج', 'rowspan' => 2, 'item' => '- المساطر' ],
                    [ 'cat' => null, 'rowspan' => null, 'item' => '- تدفق المعلومات' ],
                    [ 'cat' => '4) المعدات', 'rowspan' => 2, 'item' => '- الآلات' ],
                    [ 'cat' => null, 'rowspan' => null, 'item' => '- الأدوات الصغيرة' ],
                    [ 'cat' => '5) المستخدمين', 'rowspan' => 2, 'item' => '- التأهيل' ],
                    [ 'cat' => null, 'rowspan' => null, 'item' => '- التكوين' ],
                ];
                $items = $c['items'] ?? [];
                @endphp
                @foreach($fixedRows as $i => $row)
                <tr>
                    @if($row['cat'])
                        <td class="vertical" rowspan="{{ $row['rowspan'] }}">{{ $row['cat'] }}</td>
                    @endif
                    @if(!$row['cat'] && isset($fixedRows[$i-1]) && $fixedRows[$i-1]['cat'])
                        {{-- skip category cell for subrows --}}
                    @endif
                    <td>{{ $row['item'] }}</td>
                    <td>{{ $items[$i]['cause'] ?? '' }}</td>
                    <td>{{ $items[$i]['description'] ?? '' }}</td>
                    <td>{{ $items[$i]['action'] ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <style>
            th, td { border: 1.5px solid #000; padding: 10px; vertical-align: middle; font-size: 14px; }
            th { text-align: center; font-weight: bold; }
            td { text-align: right; }
            .category { width: 5%; }
            .items { width: 15%; }
            .causes { width: 30%; }
            .description { width: 25%; }
            .actions { width: 25%; }
            .vertical { writing-mode: vertical-rl; transform: rotate(180deg); text-align: center; font-weight: bold; color: #a00000; }
            tbody td { height: 55px; }
        </style>

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
