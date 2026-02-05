<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سجل الملاحظات - PR-N-EN1</title>
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

        /* Content */
        .section-title {
            font-weight: bold;
            margin: 20px 0 5px;
            font-size: 14px;
            color: #333;
        }

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
            font-size: 12px;
        }

        th {
            font-weight: bold;
            background-color: #e8f0f7;
        }

        .hour {
            width: 8%;
        }

        .defect {
            width: 28%;
        }

        .place {
            width: 18%;
        }

        .person {
            width: 18%;
        }

        .action {
            width: 28%;
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
                <div class="title">سجل الملاحظات</div>
                <div class="subtitle">Registre des Observations</div>
            </td>

            <!-- Left: Code & Version -->
            <td class="left-box">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:6px;">
                            <div class="label">الرمز:</div>
                            <div style="font-size: 14px;">PR-N-EN1</div>
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

    <!-- 1. قاعات العمل -->
    <div class="section-title">1. قاعات العمل:</div>
    <table>
        <tr>
            <th class="hour">الساعة</th>
            <th class="defect">العيب الملاحظ</th>
            <th class="place">المكان</th>
            <th class="person">المسؤول</th>
            <th class="action">الإجراء المتخذ</th>
        </tr>
        @forelse($document->content['work_halls'] ?? [] as $row)
            <tr class="row">
                <td>{{ $row['time'] ?? '' }}</td>
                <td>{{ $row['defect'] ?? '' }}</td>
                <td>{{ $row['place'] ?? '' }}</td>
                <td>{{ $row['person'] ?? '' }}</td>
                <td>{{ $row['action'] ?? '' }}</td>
            </tr>
        @empty
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
        @endforelse
    </table>

    <!-- 2. قاعات التعبئة -->
    <div class="section-title">2. قاعات التعبئة:</div>
    <table>
        <tr>
            <th class="hour">الساعة</th>
            <th class="defect">العيب الملاحظ</th>
            <th class="place">المكان</th>
            <th class="person">المسؤول</th>
            <th class="action">الإجراء المتخذ</th>
        </tr>
        @forelse($document->content['filling_halls'] ?? [] as $row)
            <tr class="row">
                <td>{{ $row['time'] ?? '' }}</td>
                <td>{{ $row['defect'] ?? '' }}</td>
                <td>{{ $row['place'] ?? '' }}</td>
                <td>{{ $row['person'] ?? '' }}</td>
                <td>{{ $row['action'] ?? '' }}</td>
            </tr>
        @empty
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
        @endforelse
    </table>

    <!-- 3. قاعة العرض والمكاتب الإدارية -->
    <div class="section-title">3. قاعة العرض والمكاتب الإدارية:</div>
    <table>
        <tr>
            <th class="hour">الساعة</th>
            <th class="defect">العيب الملاحظ</th>
            <th class="place">المكان</th>
            <th class="person">المسؤول</th>
            <th class="action">الإجراء المتخذ</th>
        </tr>
        @forelse($document->content['display_offices'] ?? [] as $row)
            <tr class="row">
                <td>{{ $row['time'] ?? '' }}</td>
                <td>{{ $row['defect'] ?? '' }}</td>
                <td>{{ $row['place'] ?? '' }}</td>
                <td>{{ $row['person'] ?? '' }}</td>
                <td>{{ $row['action'] ?? '' }}</td>
            </tr>
        @empty
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
        @endforelse
    </table>

    <!-- 4. المخازن -->
    <div class="section-title">4. المخازن:</div>
    <table>
        <tr>
            <th class="hour">الساعة</th>
            <th class="defect">العيب الملاحظ</th>
            <th class="place">المكان</th>
            <th class="person">المسؤول</th>
            <th class="action">الإجراء المتخذ</th>
        </tr>
        @forelse($document->content['storage'] ?? [] as $row)
            <tr class="row">
                <td>{{ $row['time'] ?? '' }}</td>
                <td>{{ $row['defect'] ?? '' }}</td>
                <td>{{ $row['place'] ?? '' }}</td>
                <td>{{ $row['person'] ?? '' }}</td>
                <td>{{ $row['action'] ?? '' }}</td>
            </tr>
        @empty
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
        @endforelse
    </table>

    <!-- 5. الممرات وغرف تغيير الملابس -->
    <div class="section-title">5. الممرات وغرف تغيير الملابس:</div>
    <table>
        <tr>
            <th class="hour">الساعة</th>
            <th class="defect">العيب الملاحظ</th>
            <th class="place">المكان</th>
            <th class="person">المسؤول</th>
            <th class="action">الإجراء المتخذ</th>
        </tr>
        @forelse($document->content['corridors'] ?? [] as $row)
            <tr class="row">
                <td>{{ $row['time'] ?? '' }}</td>
                <td>{{ $row['defect'] ?? '' }}</td>
                <td>{{ $row['place'] ?? '' }}</td>
                <td>{{ $row['person'] ?? '' }}</td>
                <td>{{ $row['action'] ?? '' }}</td>
            </tr>
        @empty
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
        @endforelse
    </table>

    <!-- 6. المرافق الصحية والمغاسل -->
    <div class="section-title">6. المرافق الصحية والمغاسل:</div>
    <table>
        <tr>
            <th class="hour">الساعة</th>
            <th class="defect">العيب الملاحظ</th>
            <th class="place">المكان</th>
            <th class="person">المسؤول</th>
            <th class="action">الإجراء المتخذ</th>
        </tr>
        @forelse($document->content['sanitary'] ?? [] as $row)
            <tr class="row">
                <td>{{ $row['time'] ?? '' }}</td>
                <td>{{ $row['defect'] ?? '' }}</td>
                <td>{{ $row['place'] ?? '' }}</td>
                <td>{{ $row['person'] ?? '' }}</td>
                <td>{{ $row['action'] ?? '' }}</td>
            </tr>
        @empty
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
        @endforelse
    </table>

    <!-- 7. حالات أخرى -->
    <div class="section-title">7. حالات أخرى (خارج المؤسسة وبعد الصيانة):</div>
    <table>
        <tr>
            <th class="hour">الساعة</th>
            <th class="defect">العيب الملاحظ</th>
            <th class="place">المكان</th>
            <th class="person">المسؤول</th>
            <th class="action">الإجراء المتخذ</th>
        </tr>
        @forelse($document->content['other_cases'] ?? [] as $row)
            <tr class="row">
                <td>{{ $row['time'] ?? '' }}</td>
                <td>{{ $row['defect'] ?? '' }}</td>
                <td>{{ $row['place'] ?? '' }}</td>
                <td>{{ $row['person'] ?? '' }}</td>
                <td>{{ $row['action'] ?? '' }}</td>
            </tr>
        @empty
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
            <tr class="row"><td></td><td></td><td></td><td></td><td></td></tr>
        @endforelse
    </table>

    <div class="signature">تأشير مسؤول الإنتاج:</div>

</body>
</html>
