<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ترميز المواد الأولية - PR-T-EN2</title>
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

        /* Content */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            direction: rtl;
            margin-bottom: 15px;
            text-align: right;
        }

        th, td {
            border: 1.2px solid #3b78b6;
            padding: 6px;
            text-align: right;
            vertical-align: middle;
            font-size: 11px;
        }

        th {
            font-weight: bold;
            background-color: #e8f0f7;
        }

        .date-col {
            width: 15%;
        }

        .source-col {
            width: 15%;
        }

        .supplier-col {
            width: 15%;
        }

        .material-col {
            width: 20%;
        }

        .batch-col {
            width: 20%;
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
                <div class="title">ترميز المواد الأولية</div>
            </td>

            <!-- Left: Code & Version -->
            <td class="left-box">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:6px;">
                            <div class="label">الرمز:</div>
                            <div style="font-size: 14px;">PR-T-EN2</div>
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

    <!-- Raw Materials Table -->
    <div style="margin-bottom: 15px;">
        <div style="font-weight: bold; margin-bottom: 8px;">قائمة المواد الأولية</div>
        <table>
            <thead>
                <tr>
                    <th class="batch-col">ترميز
رقم
الدفعة</th>
                    <th class="material-col">المادة</th>
                    <th class="supplier-col">المزود</th>
                    <th class="source-col">المصدر</th>
                    <th class="date-col">تاريخ الاستلام</th>

                </tr>
            </thead>
            <tbody>
                @forelse($document->content['items'] ?? [] as $item)
                    <tr class="row">
                        <td>{{ $item['date'] ?? '' }}</td>
                        <td>{{ $item['source'] ?? '' }}</td>
                        <td>{{ $item['supplier'] ?? '' }}</td>
                        <td>{{ $item['material'] ?? '' }}</td>
                        <td>{{ $item['batch_no'] ?? '' }}</td>
                    </tr>
                @empty
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
