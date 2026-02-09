@php
    $content = $document->content ?? [];
    $basePath = config('app.url');
@endphp

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
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        td, th { border: 1px solid #000; padding: 4px; font-size: 9px; text-align: right; }
        
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
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

        h4,
        h5 {
            margin: 10px 0;
            font-weight: bold;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
            text-align: right;
        }

        th {
            background: #f3f3f3;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .big {
            height: 70px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .signature {
            height: 20px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

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
                    <div class="title">{{ $document->title }}</div>
                    <div class="subtitle">بطاقة عدم المطابقة</div>
                </td>
                <!-- Left: Code & Version -->
                <td class="left-box">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="border-bottom:1px solid #000; padding:6px;">
                                <div class="label">الرمز:</div>
                                <div>{{ $document->reference ?? 'PR-R-FF1' }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:6px;">
                                <div class="label">الإصدار:</div>
                                <div>{{ $document->version ?? '01' }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Main Content -->

        <!-- Header Section -->
        <table>
            <tr>
                <th>المصرح:</th>
                <td>{{ $content['authorized'] ?? '' }}</td>
                <th>الصفة:</th>
                <td>{{ $content['quality'] ?? '' }}</td>
                <th>التاريخ:</th>
                <td>{{ $content['date'] ?? '' }}</td>
                <th>الساعة:</th>
                <td>{{ $content['time'] ?? '' }}</td>
            </tr>
        </table>

    <!-- Detection Section -->
    <h5 style="text-align: center; text-decoration: underline;">الكشف عن عدم المطابقة</h5>

    <table dir="rtl">
        <!-- العناوين -->
        <tr>
            <th style="width: 25%;">نوعية عدم المطابقة:</th>
            <td style="width: 25%;">{{ $content['non_conformance_type'] ?? '' }}</td>
            <th style="width: 50%; text-align: right;">وصف عدم المطابقة:</th>
        </tr>

        <!-- مادة خام -->
        <tr>
            <th>مادة خام</th>
            <td>{{ $content['raw_material'] ?? '' }}</td>
            <td class="big" rowspan="3">{{ $content['non_conformance_description'] ?? '' }}</td>
        </tr>

        <!-- منتج وسيط -->
        <tr>
            <th>منتج وسيط</th>
            <td>{{ $content['intermediate_product'] ?? '' }}</td>
        </tr>

        <!-- منتج نهائي -->
        <tr>
            <th>منتج نهائي</th>
            <td>{{ $content['final_product'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Signatures Section 1 -->
    <table>
        <tr>
            <th>يأسير المصرح:</th>
            <td>{{ $content['authorized_signature'] ?? '' }}</td>
            <th>تأشير مسئول الحودة:</th>
            <td>{{ $content['quality_signature_1'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Investigation Section -->
    <table>
        <tr>
            <th>التقصي حول أسباب عدم المطابقة:</th>
        </tr>
        <tr>
            <td class="big">{{ $content['investigation'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Corrective Actions Section -->
    <h5 style="text-align: center; text-decoration: underline;">الإجراءات التصحيحية:</h5>

    <table>
        <tr>
            <th>الرقم</th>
            <th>الإجراء</th>
            <th>المسؤول</th>
            <th>الأجل المحدد</th>
        </tr>
        <tr>
            <td>{{ $content['corrective_number_1'] ?? '' }}</td>
            <td class="big">{{ $content['corrective_action_1'] ?? '' }}</td>
            <td>{{ $content['corrective_responsible_1'] ?? '' }}</td>
            <td>{{ $content['corrective_deadline_1'] ?? '' }}</td>
        </tr>
        <tr>
            <td>{{ $content['corrective_number_2'] ?? '' }}</td>
            <td class="big">{{ $content['corrective_action_2'] ?? '' }}</td>
            <td>{{ $content['corrective_responsible_2'] ?? '' }}</td>
            <td>{{ $content['corrective_deadline_2'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Preventive Actions Section -->
    <h5 style="text-align: center; text-decoration: underline;">الإجراءات الوقائية:</h5>

    <table>
        <tr>
            <th>الرقم</th>
            <th>الإجراء</th>
            <th>المسؤول</th>
            <th>الأجل المحدد</th>
        </tr>
        <tr>
            <td>{{ $content['preventive_number_1'] ?? '' }}</td>
            <td class="big">{{ $content['preventive_action_1'] ?? '' }}</td>
            <td>{{ $content['preventive_responsible_1'] ?? '' }}</td>
            <td>{{ $content['preventive_deadline_1'] ?? '' }}</td>
        </tr>
        <tr>
            <td>{{ $content['preventive_number_2'] ?? '' }}</td>
            <td class="big">{{ $content['preventive_action_2'] ?? '' }}</td>
            <td>{{ $content['preventive_responsible_2'] ?? '' }}</td>
            <td>{{ $content['preventive_deadline_2'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Signatures Section 2 -->
    <table>
        <tr>
            <th> تأشير مسئول الحودة: </th>
            <td>{{ $content['quality_signature_2'] ?? '' }}</td>
            <th>توقيع المدير:</th>
            <td>{{ $content['manager_signature_1'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Tracking Section -->
    <h5 style="text-align: center; text-decoration: underline; margin-top: 20px;">تتبع الإجراءات التصحيحية والوقائية</h5>

    <table>
        <tr>
            <th style="vertical-align: middle;">رقم الإجراء</th>
            <th style="vertical-align: middle;">التاريخ</th>
            <th>التنفيذ</th>
            <th>النجاعة</th>
            <th style="vertical-align: middle;">الخلاصة</th>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;"><strong>نعم / لا</strong></td>
            <td style="text-align: center;">نعم / لا</td>
            <td style="text-align: center;">نعم / لا</td>
            <td style="vertical-align: middle;"></td>
        </tr>
        <tr>
            <td>{{ $content['tracking_number'] ?? '' }}</td>
            <td>{{ $content['tracking_date'] ?? '' }}</td>
            <td class="big">{{ $content['tracking_execution'] ?? '' }}</td>
            <td class="big">{{ $content['tracking_effectiveness'] ?? '' }}</td>
            <td class="big">{{ $content['tracking_conclusion'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Signatures Section 3 -->
    <table>
        <tr>
            <th> تأشير مسئول الحودة: </th>
            <td>{{ $content['quality_signature_3'] ?? '' }}</td>
            <th>توقيع المدير:</th>
            <td>{{ $content['manager_signature_2'] ?? '' }}</td>
        </tr>
    </table>
    </div>
</body>
</html>
