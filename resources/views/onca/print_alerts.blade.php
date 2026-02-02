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
        .section-header { background: #e8e8e8; font-weight: bold; }
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
        <!-- File and Date Info: Only render ONCE at the top of the document -->
        <table style="margin-bottom: 2px; page-break-after: avoid;">
            <tr class="info-row">
                <td style="width: 50%;">ملف رقم: ................................</td>
                <td style="width: 50%;">فتح بتاريخ: ................................</td>
            </tr>
        </table>

        <!-- Content Table -->
        <table style="font-size: 8.5px;">
            <!-- Section 1 -->
            <tr>
                <td colspan="4" class="section-header">1. مصدر الشكاية:</td>
            </tr>
            <tr>
                <td style="width: 20%;">- الاسم</td>
                <td colspan="3">{{ $c['complaint_source']['name'] ?? '' }}</td>
            </tr>
            <tr>
                <td>- العنوان</td>
                <td colspan="3">{{ $c['complaint_source']['address'] ?? '' }}</td>
            </tr>
            <tr>
                <td>- الهاتف</td>
                <td colspan="3">{{ $c['complaint_source']['phone'] ?? '' }}</td>
            </tr>

            <!-- Section 2 -->
            <tr>
                <td colspan="4" class="section-header">2. المنتج المعني:</td>
            </tr>
            <tr>
                <td>- المنتج</td>
                <td style="width: 25%;">{{ $c['product']['product_name'] ?? '' }}</td>
                <td style="width: 20%;">- الماركة</td>
                <td style="width: 35%;">{{ $c['product']['brand'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2">- رقم الدفعة: {{ $c['product']['batch_number'] ?? '' }}</td>
                <td colspan="2">- نوع وشكل التعبئة: {{ $c['product']['packaging_type'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="checkbox" {{ ($c['product']['sample_provided'] ?? '') === 'نعم' ? 'checked' : '' }} disabled>
                    نعم
                </td>
                <td colspan="2">
                    <input type="checkbox" {{ ($c['product']['sample_provided'] ?? '') === 'لا' ? 'checked' : '' }} disabled>
                    لا
                </td>
            </tr>
            <tr>
                <td colspan="4" style="font-size: 7.5px;">- هل قدمت عينة؟</td>
            </tr>

            <!-- Section 3 -->
            <tr>
                <td colspan="4" class="section-header">3. العيوب المنسوبة للمنتج:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 30px; vertical-align: top;">{{ $c['product_defects']['description'] ?? '' }}</td>
            </tr>

            <!-- Section 4 -->
            <tr>
                <td colspan="4" class="section-header">4. أصل المنتج (الحاصل):</td>
            </tr>
            <tr>
                <td>- الاسم</td>
                <td style="width: 25%;">{{ $c['product_origin']['name'] ?? '' }}</td>
                <td style="width: 20%;">- العنوان</td>
                <td style="width: 35%;">{{ $c['product_origin']['address'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="4">- تاريخ الشراء: {{ $c['product_origin']['purchase_date'] ?? '' }}</td>
            </tr>

            <!-- Section 5 -->
            <tr>
                <td colspan="4" class="section-header">5. كيف قام صاحب الشكوى بتخزين المنتج والتعامل معه بعد الشراء:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 30px; vertical-align: top;">{{ $c['storage_handling'] ?? '' }}</td>
            </tr>

            <!-- Section 6 -->
            <tr>
                <td colspan="4" class="section-header">6. حالة المرض / الإصابة:</td>
            </tr>
            <tr>
                <td colspan="2">- عدد الأشخاص الذين استهلكوا المنتج: {{ $c['illness']['total_consumers'] ?? '' }}</td>
                <td colspan="2">- عدد الأشخاص المصابين / الجرحى: {{ $c['illness']['affected_count'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="4" style="font-size: 7.5px;">- معلوماتهم (الأسماء – الأعمار – الكميات المستهلكة – التواريخ وأوقات الحدث): {{ $c['illness']['affected_info'] ?? '' }}</td>
            </tr>

            <!-- Section 7 -->
            <tr>
                <td colspan="4" class="section-header">- أعراض المرض (حسب الشدة) أو وصف الإصابة:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 30px; vertical-align: top;">{{ $c['symptoms'] ?? '' }}</td>
            </tr>

            <!-- Section 8 -->
            <tr>
                <td colspan="4" class="section-header">- الأطباء الذين تمت استشارتهم (الأسماء – العناوين – تواريخ الاستشارات):</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 30px; vertical-align: top;">{{ $c['doctors'] ?? '' }}</td>
            </tr>

            <!-- Section 9 -->
            <tr>
                <td colspan="4" class="section-header">- الحالة الراهنة للمرض / الإصابة:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 25px; vertical-align: top;">{{ $c['current_status'] ?? '' }}</td>
            </tr>

            <!-- Section 10 -->
            <tr>
                <td colspan="4" class="section-header">- المؤسسات أو الأماكن الآخرى التي اشتكى فيها مقدم الشكوى:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 25px; vertical-align: top;">{{ $c['other_institutions'] ?? '' }}</td>
            </tr>

            <!-- Signature -->
            <tr>
                <td colspan="4" style="padding: 4px;">تأشير مسسئول الجودة: ..................................</td>
            </tr>
        </table>
    </div>

</body>
</html>
