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
        td { border: 1px solid #000; padding: 3px 4px; font-size: 9px; text-align: right; }
        
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 8px; }
        .right-box img { max-height: 70px; }
        .center-box { width: 60%; text-align: center; padding: 8px; }
        .center-box .title { font-size: 22px; font-weight: bold; }
        .center-box .subtitle { font-size: 18px; margin-top: 5px; }
        .left-box { width: 20%; text-align: center; padding: 0; }
        .left-box .label { font-size: 14px; text-align: right; font-weight: normal; }
        .subsection-header { background: #f0f0f0; font-weight: bold; }
        .info-row td { padding: 3px; }
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
                    <div class="title">تسجيل:</div>
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
        <!-- Info Row: Only render ONCE at the top of the document -->
        <table style="margin-bottom: 2px; page-break-after: avoid;">
            <tr class="info-row">
                <td style="width: 50%; text-align: right;">المسؤول: {{ $document->responsible }}</td>
                <td style="width: 50%;">التاريخ: {{ $document->date->format('Y/m/d') }}</td>
            </tr>
        </table>

        <!-- Content Table -->
        <table style="font-size: 8.5px;">
            <!-- Section 1: التموين -->
            <tr>
                <td colspan="4" class="section-header">1. التموين</td>
            </tr>
            <tr>
                <td style="width: 40%;">المادة</td>
                <td colspan="3">{{ $c['supply']['material'] ?? '' }}</td>
            </tr>
            <tr>
                <td>قسيمة استلام رقم</td>
                <td colspan="3">{{ $c['supply']['receipt_voucher_number'] ?? '' }}</td>
            </tr>
            
            <!-- مواصفات المادة -->
            <tr>
                <td colspan="4" class="subsection-header">مواصفات المادة</td>
            </tr>
            <tr>
                <td>حالة نظافة العربة</td>
                <td>{{ $c['supply']['cart_cleanliness'] ?? '' }}</td>
                <td>حالة نظافة التعليب</td>
                <td>{{ $c['supply']['packaging_cleanliness'] ?? '' }}</td>
            </tr>
            <tr>
                <td>الرائحة</td>
                <td>{{ $c['supply']['odor'] ?? '' }}</td>
                <td>اللون</td>
                <td>{{ $c['supply']['color'] ?? '' }}</td>
            </tr>

            <!-- مراقبة -->
            <tr>
                <td colspan="4" class="subsection-header">مراقبة</td>
            </tr>
            <tr>
                <td>التعفنات</td>
                <td>{{ $c['supply']['rot'] ?? '' }}</td>
                <td>المواد الأجنبية</td>
                <td>{{ $c['supply']['foreign_materials'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2">الأجسام الأجنبية: {{ $c['supply']['foreign_bodies'] ?? '' }}</td>
                <td colspan="2"></td>
            </tr>

            <!-- Conditional fields -->
            <tr>
                <td colspan="4" style="font-size: 7.5px; padding: 3px; text-align: right;">إن كانت الدفعة مقبولة، ما هو الرقم الذي خصص لها؟ {{ $c['supply']['if_accepted_number'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="4" style="font-size: 7.5px; padding: 3px; text-align: right;">إن كان العكس، ما هو الإجراء الذي اتخذ في شأنها؟ {{ $c['supply']['if_rejected_action'] ?? '' }}</td>
            </tr>

            <!-- Section 2: التعبئة والعنونة -->
            <tr>
                <td colspan="4" class="section-header">2. التعبئة والعنونة</td>
            </tr>

            <!-- التعبئة subsection -->
            <tr>
                <td colspan="4" class="subsection-header">التعبئة</td>
            </tr>
            <tr>
                <td>نوع المنتج</td>
                <td colspan="3">{{ $c['packaging']['product_type'] ?? '' }}</td>
            </tr>
            <tr>
                <td>النبتة أو خليط نبات</td>
                <td colspan="3">{{ $c['packaging']['plant_or_mixture'] ?? '' }}</td>
            </tr>
            <tr>
                <td>رقم الدفعة</td>
                <td style="width: 25%;">{{ $c['packaging']['batch_number'] ?? '' }}</td>
                <td>رقم دفعة التعليب</td>
                <td style="width: 25%;">{{ $c['packaging']['packaging_batch_number'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2">سعة التعليب (غ/مل): {{ $c['packaging']['packaging_capacity'] ?? '' }}</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td>نظافة التعليب والكبسولات</td>
                <td>{{ $c['packaging']['cleanliness'] ?? '' }}</td>
                <td>حالة تمكين إغلاق التعليب</td>
                <td>{{ $c['packaging']['closure_condition'] ?? '' }}</td>
            </tr>

            <!-- العنونة subsection -->
            <tr>
                <td colspan="4" class="subsection-header">العنونة</td>
            </tr>
            <tr>
                <td>التسمية الدقيقة للمنتج</td>
                <td colspan="3">{{ $c['labeling']['exact_product_name'] ?? '' }}</td>
            </tr>
            <tr>
                <td>المحتوى الصافي</td>
                <td>{{ $c['labeling']['net_content'] ?? '' }}</td>
                <td>رقم الدفعة</td>
                <td>{{ $c['labeling']['batch_number'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="4">تاريخ انتهاء الصلاحية: {{ $c['labeling']['expiry_date'] ?? '' }}</td>
            </tr>

            <!-- Final section -->
            <tr>
                <td colspan="4" class="section-header">التدابير التصحيحية المتخذة، عند الضرورة</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 25px; vertical-align: top;">{{ $c['corrective_measures'] ?? '' }}</td>
            </tr>

            <!-- Signature -->
            <tr>
                <td colspan="4" style="padding: 4px;">توقيع مسؤول الإنتاج: {{ $c['signature'] ?? '' }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
