<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>استمارة تبليغ مصلحة أونسا</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Arial", sans-serif;
            font-size: 13px;
            direction: rtl;
            line-height: 1.5;
            color: #1f2937;
        }

        .print-container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 20px;
            background: white;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #000;
        }

        .header-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        .logo-cell {
            width: 20%;
        }

        .logo-cell img {
            max-width: 80px;
            height: auto;
        }

        .title-cell {
            width: 60%;
            font-weight: bold;
            font-size: 16px;
        }

        .ref-cell {
            width: 20%;
            font-size: 12px;
        }

        .metadata-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .metadata-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: right;
        }

        .metadata-label {
            width: 25%;
            background: #f5f5f5;
            font-weight: bold;
        }

        .metadata-value {
            width: 75%;
        }

        h4 {
            text-align: center;
            font-size: 14px;
            margin: 20px 0 10px;
            font-weight: bold;
        }

        h5 {
            margin: 12px 0 6px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
            text-align: right;
        }

        th.label {
            width: 22%;
            background: #f5f5f5;
            font-weight: bold;
        }

        td.value {
            width: 26%;
            height: 32px;
        }

        .large-cell {
            height: 90px;
        }

        .note {
            border: 1px solid #000;
            padding: 8px;
            margin-top: 10px;
            font-size: 12px;
        }

        .signature-section {
            margin-top: 30px;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 50px;
            padding-top: 5px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .print-container {
                max-width: 100%;
                padding: 0;
                margin: 0;
            }

            table {
                page-break-inside: avoid;
            }

            h5 {
                page-break-after: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="print-container" style="direction: rtl; text-align: right;">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    @if(file_exists(public_path('logo.svg')))
                        <img src="{{ asset('logo.svg') }}" alt="Logo">
                    @else
                        <div style="text-align: center; padding: 10px;">Logo</div>
                    @endif
                </td>
                <td class="title-cell">
                    استمارة تبليغ مصلحة "أونسا"
                </td>
                <td class="ref-cell">
                    <div>{{ $document->reference }}</div>
                    <div>Version: {{ $document->version }}</div>
                </td>
            </tr>
        </table>

        <!-- Metadata -->
        <table class="metadata-table">
            <tr>
                <td class="metadata-label">التاريخ</td>
                <td class="metadata-value">{{ $document->date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="metadata-label">المسؤول</td>
                <td class="metadata-value">{{ $document->responsible }}</td>
            </tr>
        </table>

        <hr style="margin: 20px 0;">

        <!-- 1 -->
        <h5>1. المسؤول عن الملف (مع من ستتواصل أونسا):</h5>
        <table>
            <tr>
                <th></th>
                <th>المسئول</th>
                <th>النائب</th>
            </tr>
            <tr>
                <th class="label">الاسم</th>
                <td class="value">{{ $document->content['contact']['responsible_name'] ?? '' }}</td>
                <td class="value">{{ $document->content['contact']['deputy_name'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">الوظيفة</th>
                <td class="value">{{ $document->content['contact']['responsible_position'] ?? '' }}</td>
                <td class="value">{{ $document->content['contact']['deputy_position'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">الهاتف</th>
                <td class="value">{{ $document->content['contact']['responsible_phone'] ?? '' }}</td>
                <td class="value">{{ $document->content['contact']['deputy_phone'] ?? '' }}</td>
            </tr>
        </table>

        <!-- 2 -->
        <h5>2. المنتجات المعنية (انظر ملصقات المنتجات المرفقة):</h5>
        <table>
            <tr>
                <th class="label">التسمية</th>
                <td class="value">{{ $document->content['products'][0]['name'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][1]['name'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][2]['name'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">العلامة التجارية</th>
                <td class="value">{{ $document->content['products'][0]['brand'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][1]['brand'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][2]['brand'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">طريقة العرض</th>
                <td class="value">{{ $document->content['products'][0]['presentation'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][1]['presentation'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][2]['presentation'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">رقم الدفعة</th>
                <td class="value">{{ $document->content['products'][0]['batch'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][1]['batch'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][2]['batch'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">تاريخ الإنتاج</th>
                <td class="value">{{ $document->content['products'][0]['production_date'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][1]['production_date'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][2]['production_date'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">تاريخ انتهاء الصلاحية</th>
                <td class="value">{{ $document->content['products'][0]['expiry_date'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][1]['expiry_date'] ?? '' }}</td>
                <td class="value">{{ $document->content['products'][2]['expiry_date'] ?? '' }}</td>
            </tr>
        </table>

        <!-- 3 -->
        <h5>3. وصف تفصيلي لطبيعة العيوب:</h5>
        <table>
            <tr>
                <td class="large-cell">{{ $document->content['defect_description'][0] ?? '' }}</td>
                <td class="large-cell">{{ $document->content['defect_description'][1] ?? '' }}</td>
                <td class="large-cell">{{ $document->content['defect_description'][2] ?? '' }}</td>
            </tr>
        </table>

        <!-- 4 -->
        <h5>4. الحالة العامة للشكاية:</h5>
        <table>
            <tr>
                <th class="label">المنتج (رقم الدفعة)</th>
                <td class="value">{{ $document->content['complaint'][0]['product_batch'] ?? '' }}</td>
                <td class="value">{{ $document->content['complaint'][1]['product_batch'] ?? '' }}</td>
                <td class="value">{{ $document->content['complaint'][2]['product_batch'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">عدد الشكاوى الواردة</th>
                <td class="value">{{ $document->content['complaint'][0]['complaints_count'] ?? '' }}</td>
                <td class="value">{{ $document->content['complaint'][1]['complaints_count'] ?? '' }}</td>
                <td class="value">{{ $document->content['complaint'][2]['complaints_count'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">عدد حالات المرض أو الإصابة المعلنة</th>
                <td class="value">{{ $document->content['complaint'][0]['illness_cases'] ?? '' }}</td>
                <td class="value">{{ $document->content['complaint'][1]['illness_cases'] ?? '' }}</td>
                <td class="value">{{ $document->content['complaint'][2]['illness_cases'] ?? '' }}</td>
            </tr>
            <tr>
                <th class="label">أعراض المرض (حسب الشدة) أو وصف الإصابة</th>
                <td class="large-cell">{{ $document->content['complaint'][0]['symptoms'] ?? '' }}</td>
                <td class="large-cell">{{ $document->content['complaint'][1]['symptoms'] ?? '' }}</td>
                <td class="large-cell">{{ $document->content['complaint'][2]['symptoms'] ?? '' }}</td>
            </tr>
        </table>

        <!-- 5 -->
        <h5>5. توزيع المنتجات (على الصعيد المحلي والوطني والدولي):</h5>
        <div class="note">
            (انظر نسخة من التسجيل PR-R-EN4 المرفق، الذي يشمل جميع الزبناء/المزودين من هذه المنتجات)
        </div>

        <br><br>

        <div class="signature-section">
            <p><strong>توقيع مدير المؤسسة:</strong></p>
            <div class="signature-line"></div>
        </div>
    </div>
</body>
</html>
