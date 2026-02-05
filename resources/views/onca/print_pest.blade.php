<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نتائج عمليات الوقاية والمعالجة - PR-V-EN1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            direction: rtl;
            background: #fff;
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
        body {
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            direction: rtl;
            margin-bottom: 15px;
            margin-top: 10px;
        }

        th, td {
            border: 1.5px solid #003366;
            padding: 8px;
            vertical-align: middle;
        }

        td {
            text-align: right;
            background-color: white;
        }

        .section-title {
            font-weight: bold;
            margin: 10px 0 5px;
            font-size: 14px;
            color: #003366;
        }

        .row {
            height: 38px;
        }

        .summary-line {
            border-bottom: 1px dotted #999;
            height: 22px;
            margin-bottom: 6px;
            background-color: #f9f9f9;
        }

        .signature {
            margin-top: 30px;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
        }

        .observation-label {
            font-weight: bold;
            margin: 10px 0 5px;
            font-size: 13px;
        }

        .observation-content {
            margin-bottom: 15px;
            padding: 8px;
            background-color: #f9f9f9;
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
                <div class="title">نتائج عمليات الوقاية والمعالجة</div>
            </td>

            <!-- Left: Code & Version -->
            <td class="left-box">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:6px;">
                            <div class="label">الرمز:</div>
                            <div style="font-size: 14px;">PR-V-EN1</div>
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

    <!-- 1 نتائج عمليات الوقاية -->
    <div class="section-title">1. نتائج عمليات الوقاية:</div>
    <div class="observation-label">ملاحظات حول:</div>

    <table>
        <tr class="row">
            <td style="width:30%">- مدى عدم قابلية الأبواب و النوافذ لتسرب الكائنات الضارة</td>
            <td style="width:70%">{{ $document->content['prevention'][0]['doors'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- أسطح الأرضيات و الحيطان و الأسقف</td>
            <td>{{ $document->content['prevention'][0]['surfaces'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- "ناموسيات" النوافذ</td>
            <td>{{ $document->content['prevention'][0]['windows'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- بالوعات و مجاري الصرف الصحي</td>
            <td>{{ $document->content['prevention'][0]['drainage'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- الحالة العامة لأماكن تواجد مصائد الفئران و الحشرات و نظافتها</td>
            <td>{{ $document->content['prevention'][0]['traps_condition'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- عمل مصائد الحشرات</td>
            <td>{{ $document->content['prevention'][0]['insect_traps'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- عمل مصائد الفئران</td>
            <td>{{ $document->content['prevention'][0]['rodent_traps'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- وجود الحيوانات الأليفة أو البرية</td>
            <td>{{ $document->content['prevention'][0]['animals'] ?? '' }}</td>
        </tr>
    </table>

    <div class="observation-label">خلاصة:</div>
    <div class="observation-content">
        <div class="summary-line"></div>
        <div class="summary-line"></div>
        <div class="summary-line" style="margin-bottom: 0;"></div>
    </div>

    <!-- 2 إجراءات المعالجة -->
    <div class="section-title" style="margin-top:25px;">2. إجراءات المعالجة:</div>

    <table>
        <tr class="row">
            <td style="width:20%">- مكان التدخل</td>
            <td style="width:80%">{{ $document->content['treatment'][0]['location'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- نوع التدخل</td>
            <td>{{ $document->content['treatment'][0]['type'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- مسؤول المعالجة</td>
            <td>{{ $document->content['treatment'][0]['responsible'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- المادة الكيميائية المستعملة</td>
            <td>{{ $document->content['treatment'][0]['chemical'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- التركيز</td>
            <td>{{ $document->content['treatment'][0]['concentration'] ?? '' }}</td>
        </tr>
        <tr class="row">
            <td>- وتيرة التطبيق</td>
            <td>{{ $document->content['treatment'][0]['frequency'] ?? '' }}</td>
        </tr>
    </table>

    <div class="observation-label">خلاصة نتائج المعالجة:</div>
    <div class="observation-content">
        <div class="summary-line"></div>
        <div class="summary-line"></div>
        <div class="summary-line" style="margin-bottom: 0;"></div>
    </div>

    <div class="signature">تأشير مسؤول النظافة</div>

</body>
</html>
