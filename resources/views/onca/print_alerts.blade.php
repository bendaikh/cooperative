<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $document->title }}</title>
    <style>
        @page { size: A4 portrait; margin: 8mm; }
        * { margin: 0; padding: 0; }
        body { 
            font-family: Arial, sans-serif; 
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
            direction: rtl;
            line-height: 1.3;
        }
        
        .container { width: 100%; }
        table { width: 100%; border-collapse: collapse; }
        td { border: 1px solid #333; padding: 5px 4px; font-size: 9px; text-align: right; }
        
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 6px; }
        .right-box img { max-height: 60px; }
        .center-box { width: 60%; text-align: center; padding: 6px; }
        .center-box .title { font-size: 18px; font-weight: bold; margin-bottom: 2px; }
        .center-box .subtitle { font-size: 11px; margin-top: 3px; font-weight: 500; }
        .left-box { width: 20%; text-align: center; padding: 3px; }
        .left-box .label { font-size: 9px; text-align: right; font-weight: normal; }
        .left-box table td { padding: 2px; font-size: 8px; }
        
        .section-header { 
            background: #d0d8e0; 
            font-weight: bold; 
            font-size: 9px;
            padding: 4px 3px !important;
        }
        
        .info-row td { 
            padding: 5px 3px;
            font-size: 9px;
        }
        
        .section-label {
            font-weight: 600;
            font-size: 9px;
            padding: 5px 3px;
        }
        
        .section-content {
            padding: 6px 4px;
            font-size: 9px;
            min-height: 25px;
            vertical-align: top;
        }
        
        .row-normal td {
            padding: 5px 4px;
            font-size: 9px;
        }
        
        .signature-row td {
            padding: 8px 4px;
            font-size: 9px;
            border: none;
            border-top: 1px solid #000;
        }
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
        <table style="margin-bottom: 6px; page-break-after: avoid;">
            <tr class="info-row">
                <td style="width: 50%; border-right: 1px solid #333;">ملف رقم: ................................</td>
                <td style="width: 50%;">فتح بتاريخ: ................................</td>
            </tr>
        </table>

        <!-- Content Table -->
        <table>
            <!-- Section 1 -->
            <tr>
                <td colspan="4" class="section-header">1. مصدر الشكاية:</td>
            </tr>
            <tr class="row-normal">
                <td style="width: 15%; font-weight: 600;">- الاسم</td>
                <td colspan="3">{{ $c['complaint_source']['name'] ?? '' }}</td>
            </tr>
            <tr class="row-normal">
                <td style="font-weight: 600;">- العنوان</td>
                <td colspan="3">{{ $c['complaint_source']['address'] ?? '' }}</td>
            </tr>
            <tr class="row-normal">
                <td style="font-weight: 600;">- الهاتف</td>
                <td colspan="3">{{ $c['complaint_source']['phone'] ?? '' }}</td>
            </tr>

            <!-- Section 2 -->
            <tr>
                <td colspan="4" class="section-header">2. المنتج المعني:</td>
            </tr>
            <tr class="row-normal">
                <td style="width: 15%; font-weight: 600;">- المنتج</td>
                <td style="width: 27%;">{{ $c['product']['product_name'] ?? '' }}</td>
                <td style="width: 15%; font-weight: 600;">- الماركة</td>
                <td style="width: 43%;">{{ $c['product']['brand'] ?? '' }}</td>
            </tr>
            <tr class="row-normal">
                <td colspan="2" style="font-weight: 600;">- رقم الدفعة: {{ $c['product']['batch_number'] ?? '' }}</td>
                <td colspan="2" style="font-weight: 600;">- نوع وشكل التعبئة: {{ $c['product']['packaging_type'] ?? '' }}</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="font-weight: 600; padding: 10px 6px;">هل قدمت عينة؟</td>
            </tr>
            <tr class="row-normal">
                <td colspan="2" style="text-align: center;">
                    <input type="checkbox" {{ ($c['product']['sample_provided'] ?? '') === 'نعم' ? 'checked' : '' }} disabled>
                    <span style="padding-right: 8px;">نعم</span>
                </td>
                <td colspan="2" style="text-align: center;">
                    <input type="checkbox" {{ ($c['product']['sample_provided'] ?? '') === 'لا' ? 'checked' : '' }} disabled>
                    <span style="padding-right: 8px;">لا</span>
                </td>
            </tr>

            <!-- Section 3 -->
            <tr>
                <td colspan="4" class="section-header">3. العيوب المنسوبة للمنتج:</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="height: 22px; vertical-align: top; padding: 4px 3px; overflow: hidden;">{{ $c['product_defects']['description'] ?? '' }}</td>
            </tr>

            <!-- Section 4 -->
            <tr>
                <td colspan="4" class="section-header">4. أصل المنتج (الحاصل):</td>
            </tr>
            <tr class="row-normal">
                <td style="width: 15%; font-weight: 600;">- الاسم</td>
                <td style="width: 27%;">{{ $c['product_origin']['name'] ?? '' }}</td>
                <td style="width: 15%; font-weight: 600;">- العنوان</td>
                <td style="width: 43%;">{{ $c['product_origin']['address'] ?? '' }}</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="font-weight: 600;">- تاريخ الشراء: {{ $c['product_origin']['purchase_date'] ?? '' }}</td>
            </tr>

            <!-- Section 5 -->
            <tr>
                <td colspan="4" class="section-header">5. كيف قام صاحب الشكوى بتخزين المنتج والتعامل معه بعد الشراء:</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="height: 22px; vertical-align: top; padding: 4px 3px; overflow: hidden;">{{ $c['storage_handling'] ?? '' }}</td>
            </tr>

            <!-- Section 6 -->
            <tr>
                <td colspan="4" class="section-header">6. حالة المرض / الإصابة:</td>
            </tr>
            <tr class="row-normal">
                <td colspan="2" style="font-weight: 600;">- عدد الأشخاص الذين استهلكوا المنتج: {{ $c['illness']['total_consumers'] ?? '' }}</td>
                <td colspan="2" style="font-weight: 600;">- عدد الأشخاص المصابين / الجرحى: {{ $c['illness']['affected_count'] ?? '' }}</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="font-weight: 600; padding: 10px 6px;">- معلوماتهم (الأسماء – الأعمار – الكميات المستهلكة – التواريخ وأوقات الحدث):</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="padding: 10px 6px;">{{ $c['illness']['affected_info'] ?? '' }}</td>
            </tr>

            <!-- Section 7 -->
            <tr>
                <td colspan="4" class="section-header">7. أعراض المرض (حسب الشدة) أو وصف الإصابة:</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="height: 20px; vertical-align: top; padding: 4px 3px; overflow: hidden;">{{ $c['symptoms'] ?? '' }}</td>
            </tr>

            <!-- Section 8 -->
            <tr>
                <td colspan="4" class="section-header">8. الأطباء الذين تمت استشارتهم (الأسماء – العناوين – تواريخ الاستشارات):</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="height: 20px; vertical-align: top; padding: 4px 3px; overflow: hidden;">{{ $c['doctors'] ?? '' }}</td>
            </tr>

            <!-- Section 9 -->
            <tr>
                <td colspan="4" class="section-header">9. الحالة الراهنة للمرض / الإصابة:</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="height: 18px; vertical-align: top; padding: 4px 3px; overflow: hidden;">{{ $c['current_status'] ?? '' }}</td>
            </tr>

            <!-- Section 10 -->
            <tr>
                <td colspan="4" class="section-header">10. المؤسسات أو الأماكن الآخرى التي اشتكى فيها مقدم الشكوى:</td>
            </tr>
            <tr class="row-normal">
                <td colspan="4" style="height: 18px; vertical-align: top; padding: 4px 3px; overflow: hidden;">{{ $c['other_institutions'] ?? '' }}</td>
            </tr>

            <!-- Signature -->
            <tr class="signature-row">
                <td colspan="4">تأشير مسؤول الجودة: ..................................</td>
            </tr>
        </table>
    </div>

</body>
</html>
