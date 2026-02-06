<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $document->title }} - {{ $document->reference }}</title>
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
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .center-box .subtitle {
            font-size: 13px;
        }

        .left-box {
            width: 20%;
            text-align: center;
            padding: 8px;
        }

        .left-box .label {
            font-size: 11px;
            display: block;
            margin-bottom: 3px;
        }

        .left-box .value {
            font-size: 13px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            direction: rtl;
            margin-bottom: 25px;
        }

        th, td {
            border: 1.5px solid #003366;
            padding: 8px;
            font-size: 12px;
            vertical-align: middle;
            text-align: right;
        }

        th {
            font-weight: bold;
            text-align: center;
            background-color: #f0f0f0;
        }

        .col-name { width: 14%; }
        .col-product { width: 14%; }
        .col-usage { width: 18%; }
        .col-material { width: 18%; }
        .col-concentration { width: 18%; }
        .col-frequency { width: 18%; }

        .row-height {
            height: 45px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 20px 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #999;
        }

        .signature-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 40px;
        }

        .signature-block {
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 40px;
            padding-top: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body onload="window.print()">
    <!-- Header Table -->
    <table class="header-table">
        <tr>
            <td class="right-box">
                <img src="{{ asset('logo.svg') }}" alt="Logo">
            </td>
            <td class="center-box">
                <div class="title">الاحتياطات المرتبطة بمكافحة الآفات</div>
                <div class="subtitle">PEST CONTROL INTERVENTION MEASURES</div>
            </td>
            <td class="left-box">
                <span class="label">المرجع:</span>
                <span class="value">{{ $document->reference }}</span>
                <span class="label" style="margin-top: 8px;">النسخة:</span>
                <span class="value">{{ $document->version }}</span>
            </td>
        </tr>
    </table>

    <div style="margin-bottom: 15px; font-size: 12px;">
        <strong>التاريخ:</strong> {{ $document->date->format('Y-m-d') }}
        @if($document->responsible)
            | <strong>المسؤول:</strong> {{ $document->responsible }}
        @endif
    </div>

    <h3 class="section-title">الاحتياطات والمنتجات المستخدمة</h3>

    <table>
        <thead>
            <tr>
                <th class="col-name">الاسم</th>
                <th class="col-product">نوع المنتج</th>
                <th class="col-usage">طريقة الاستخدام</th>
                <th class="col-material">المادة الفعالة</th>
                <th class="col-concentration">التركيز المطلوب</th>
                <th class="col-frequency">الوتيرة</th>
            </tr>
        </thead>
        <tbody>
            @php
                $interventions = $document->content['interventions'] ?? [];
            @endphp

            @if(!empty($interventions))
                @foreach($interventions as $intervention)
                    <tr class="row-height">
                        <td>{{ $intervention['name'] ?? '' }}</td>
                        <td>{{ $intervention['product_type'] ?? '' }}</td>
                        <td>{{ $intervention['usage_method'] ?? '' }}</td>
                        <td>{{ $intervention['active_material'] ?? '' }}</td>
                        <td>{{ $intervention['concentration'] ?? '' }}</td>
                        <td>{{ $intervention['frequency'] ?? '' }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="row-height">
                    <td colspan="6" style="text-align: center; color: #999;">لا توجد بيانات</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="signature-area">
        <div class="signature-block">
            <div class="signature-line">توقيع المسؤول</div>
        </div>
        <div class="signature-block">
            <div class="signature-line">التاريخ</div>
        </div>
    </div>
</body>
</html>
