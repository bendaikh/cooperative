<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سجل تخزين المواد الأولية - PR-T-EN4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            direction: rtl;
            font-size: 14px;
        }

        @page {
            size: A4;
            margin: 10mm;
        }

        @media print {
            body {
                margin: 0;
                padding: 10mm;
                background-color: white;
            }
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .header-table td {
            border: 1px solid #000;
            vertical-align: middle;
        }

        .right-box {
            width: 20%;
            text-align: center;
            padding: 8px;
        }

        .right-box img {
            max-height: 70px;
        }

        .center-box {
            width: 60%;
            text-align: center;
            padding: 8px;
        }

        .center-box .title {
            font-size: 22px;
            font-weight: bold;
        }

        .center-box .subtitle {
            font-size: 18px;
            margin-top: 5px;
        }

        .left-box {
            width: 20%;
            text-align: center;
            padding: 0;
        }

        .left-box .label {
            font-size: 14px;
            text-align: right;
            font-weight: normal;
        }

        /* Document info section */
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

        /* Material section */
        .material-info {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .material-label {
            font-weight: bold;
            margin-right: 10px;
        }

        /* Content */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            direction: rtl;
            margin-bottom: 15px;
        }

        th, td {
            border: 1.2px solid #3b78b6;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
        }

        th {
            font-weight: bold;
            background-color: #e8f0f7;
        }

        .date-col {
            width: 10%;
        }

        .batch-col {
            width: 15%;
        }

        .qty-col {
            width: 12%;
        }

        .stock-col {
            width: 12%;
        }

        .row {
            height: 30px;
        }

        .signature {
            margin-top: 30px;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
        }

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <!-- Header Table -->
    <table class="header-table">
        <tr>
            <!-- Right: Logo -->
            <td class="right-box">
                <img src="{{ asset('logo.svg') }}" alt="Logo">
            </td>

            <!-- Center: Title -->
            <td class="center-box">
                <div class="title">سجل تخزين المواد الأولية</div>
            </td>

            <!-- Left: Code & Version -->
            <td class="left-box">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:6px;">
                            <div class="label">الرمز:</div>
                            <div style="font-size: 14px;">PR-T-EN4</div>
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

    <!-- Material Name -->
    @if($document->content['material_name'] ?? null)
        <div class="material-info">
            <span class="material-label">المادة الأولية:</span>
            <span>{{ $document->content['material_name'] }}</span>
        </div>
    @endif

    <!-- Stock Movements Table -->
    <div style="margin-bottom: 15px;">
        <div style="font-weight: bold; margin-bottom: 8px;">مجموعات المواد الأولية</div>
        <table>
            <thead>
                <tr>
                    <th class="date-col" rowspan="2" style="vertical-align: bottom; padding-bottom: 6px;">التاريخ</th>
                    <th colspan="2" style="text-align: center; border-bottom: 1px solid #3b78b6;">دخول المادة الأولية</th>
                    <th class="qty-col" style="text-align: center;">خروج المادة (كلغ)</th>
                    <th class="stock-col">المخزون النهائي (كلغ)</th>
                </tr>
                <tr>
                    <th class="batch-col">رقم الدفعة</th>
                    <th class="qty-col">الكمية (كلغ)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($document->content['movements'] ?? [] as $movement)
                    <tr class="row">
                        <td>{{ $movement['date'] ?? '' }}</td>
                        <td>{{ $movement['in_batch'] ?? '' }}</td>
                        <td>{{ $movement['in_qty'] ?? '' }}</td>
                        <td>{{ $movement['out_qty'] ?? '' }}</td>
                        <td>{{ $movement['stock'] ?? '' }}</td>
                    </tr>
                @empty
                    <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
                    <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="signature">تأشير المسؤول:</div>

</body>
</html>
