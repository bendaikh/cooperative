<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مراقبة صحة وسلوك العمال - PR-S-EN1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            direction: rtl;
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

        /* Tables for content */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            direction: rtl;
            margin-bottom: 25px;
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .content-table th, .content-table td {
            border: 1.5px solid #003366;
            padding: 8px;
            font-size: 13px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .content-table th {
            font-weight: bold;
            text-align: center;
            background-color: #e8f0f7;
            color: #003366;
        }

        .content-table td {
            text-align: right;
            background-color: white;
        }

        /* Column sizes */
        .col-hour { width: 8%; }
        .col-name { width: 15%; }
        .col-detect { width: 10%; }
        .col-desc { width: 32%; }
        .col-action { width: 32%; }

        .section-title {
            border: none !important;
            font-weight: bold;
            background-color: #d4e0ed;
            padding: 10px 8px;
            text-align: right;
            font-size: 13px;
            color: #003366;
        }

        .row-height td {
            height: 45px;
        }

        .center {
            text-align: center;
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
                <div class="title">مراقبة صحة وسلوك العمال</div>
                <div class="subtitle">Surveillance de la Santé et du Comportement</div>
            </td>

            <!-- Left: Code & Version -->
            <td class="left-box">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:6px;">
                            <div class="label">الرمز:</div>
                            <div style="font-size: 14px;">PR-S-EN1</div>
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

    <!-- 1 - صحة العمال -->
    <table class="content-table">
        <tr>
            <td colspan="6" class="section-title">1 - صحة العمال</td>
        </tr>
        <tr>
            <th class="col-hour" rowspan="2">الساعة</th>
            <th class="col-name" rowspan="2">اسم العامل</th>
            <th colspan="2">طريقة الكشف عن الحالة</th>
            <th class="col-desc" rowspan="2">وصف الحالة</th>
            <th class="col-action" rowspan="2">الإجراء المتخذ</th>
        </tr>
        <tr>
            <th class="center col-detect">ملاحظة</th>
            <th class="center col-detect">تصريح</th>
        </tr>
        @if(isset($document->content['health']) && count($document->content['health']) > 0)
            @foreach($document->content['health'] as $row)
                <tr class="row-height">
                    <td>{{ $row['time'] ?? '' }}</td>
                    <td>{{ $row['name'] ?? '' }}</td>
                    <td class="center">{{ ($row['observation'] ?? false) ? '✓' : '' }}</td>
                    <td class="center">{{ ($row['report'] ?? false) ? '✓' : '' }}</td>
                    <td>{{ $row['desc'] ?? '' }}</td>
                    <td>{{ $row['action'] ?? '' }}</td>
                </tr>
            @endforeach
        @else
            <tr class="row-height">
                <td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr class="row-height">
                <td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr class="row-height">
                <td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
        @endif
    </table>

    <!-- 2 - سلوك العمال -->
    <table class="content-table">
        <tr>
            <td colspan="4" class="section-title">2 - سلوك العمال</td>
        </tr>
        <tr>
            <th class="col-hour">الساعة</th>
            <th class="col-name">اسم العامل</th>
            <th class="col-desc">السلوك الغير مقبول</th>
            <th class="col-action">الإجراء المتخذ</th>
        </tr>
        @if(isset($document->content['behavior']) && count($document->content['behavior']) > 0)
            @foreach($document->content['behavior'] as $row)
                <tr class="row-height">
                    <td>{{ $row['time'] ?? '' }}</td>
                    <td>{{ $row['name'] ?? '' }}</td>
                    <td>{{ $row['desc'] ?? '' }}</td>
                    <td>{{ $row['action'] ?? '' }}</td>
                </tr>
            @endforeach
        @else
            <tr class="row-height">
                <td></td><td></td><td></td><td></td>
            </tr>
            <tr class="row-height">
                <td></td><td></td><td></td><td></td>
            </tr>
        @endif
    </table>

    <!-- 3 - الغسل الصحي لليدين -->
    <table class="content-table">
        <tr>
            <td colspan="4" class="section-title">3 - الغسل الصحي لليدين</td>
        </tr>
        <tr>
            <th class="col-hour">الساعة</th>
            <th class="col-name">اسم العامل</th>
            <th class="col-desc">العيب الملاحظ</th>
            <th class="col-action">الإجراء المتخذ</th>
        </tr>
        @if(isset($document->content['hands']) && count($document->content['hands']) > 0)
            @foreach($document->content['hands'] as $row)
                <tr class="row-height">
                    <td>{{ $row['time'] ?? '' }}</td>
                    <td>{{ $row['name'] ?? '' }}</td>
                    <td>{{ $row['desc'] ?? '' }}</td>
                    <td>{{ $row['action'] ?? '' }}</td>
                </tr>
            @endforeach
        @else
            <tr class="row-height">
                <td></td><td></td><td></td><td></td>
            </tr>
            <tr class="row-height">
                <td></td><td></td><td></td><td></td>
            </tr>
        @endif
    </table>

    <!-- 4 - لباس الشغل -->
    <table class="content-table">
        <tr>
            <td colspan="4" class="section-title">4 - لباس الشغل</td>
        </tr>
        <tr>
            <th class="col-hour">الساعة</th>
            <th class="col-name">اسم العامل</th>
            <th class="col-desc">العيب الملاحظ</th>
            <th class="col-action">الإجراء المتخذ</th>
        </tr>
        @if(isset($document->content['clothes']) && count($document->content['clothes']) > 0)
            @foreach($document->content['clothes'] as $row)
                <tr class="row-height">
                    <td>{{ $row['time'] ?? '' }}</td>
                    <td>{{ $row['name'] ?? '' }}</td>
                    <td>{{ $row['desc'] ?? '' }}</td>
                    <td>{{ $row['action'] ?? '' }}</td>
                </tr>
            @endforeach
        @else
            <tr class="row-height">
                <td></td><td></td><td></td><td></td>
            </tr>
            <tr class="row-height">
                <td></td><td></td><td></td><td></td>
            </tr>
        @endif
    </table>
</body>
</html>
