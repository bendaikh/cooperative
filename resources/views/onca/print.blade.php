<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $document->title }}</title>
    <style>
        @page { size: A4 portrait; margin: 5mm; }
        * { margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        
        .container { width: 100%; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid black; padding: 3px; font-size: 10px; text-align: right; }
        
        .header-table { width: 100%; margin-bottom: 2px; }
        .header-table td { padding: 2px; font-size: 9px; }
        .logo { height: 30px; width: auto; }
        .title-cell { font-weight: bold; font-size: 12px; }
        .section-header { background: #f0f0f0; font-weight: bold; }
    </style>
</head>
<body onload="window.print()">

    <div class="container">
        <!-- Header Table -->
        <table class="header-table" style="margin-bottom: 3px;">
            <tr>
                <!-- Left: Logo -->
                <td style="width: 15%; text-align: center; border: 1px solid black; padding: 3px;">
                    <img src="/logo.png" alt="Logo" style="max-height: 35px;">
                </td>
                <!-- Center: Main Title -->
                <td style="width: 55%; text-align: center; border: 1px solid black; padding: 5px 3px;">
                    <div style="font-weight: bold; font-size: 13px;">تسجيل:</div>
                    <div style="font-weight: bold; font-size: 12px;">{{ $document->title }}</div>
                </td>
                <!-- Right: Reference and Version -->
                <td style="width: 30%; text-align: center; border: 1px solid black; padding: 3px;">
                    <div style="font-size: 9px;">
                        <div>الرمز: <span style="font-weight: bold;">{{ $document->reference }}</span></div>
                        <div>الإصدار: <span style="font-weight: bold;">{{ $document->version }}</span></div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Info Row -->
        <table style="margin-bottom: 3px;">
            <tr>
                <td style="text-align: left; padding: 2px; width: 50%; border: 1px solid black;">ملف رقم: ................................</td>
                <td style="text-align: center; padding: 2px; width: 50%; border: 1px solid black;">فتح بتاريخ: ................................</td>
            </tr>
        </table>

        <!-- Main Content Table -->
        <table style="font-size: 9px; line-height: 1.2;">
            <!-- Section 1: مصدر الشكاية -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">1. مصدر الشكاية:</td>
            </tr>
            <tr>
                <td style="text-align: right;">- الاسم</td>
                <td colspan="3">{{ $c['complaint_source']['name'] ?? '' }}</td>
            </tr>
            <tr>
                <td style="text-align: right;">- العنوان</td>
                <td colspan="3">{{ $c['complaint_source']['address'] ?? '' }}</td>
            </tr>
            <tr>
                <td style="text-align: right;">- الهاتف</td>
                <td colspan="3">{{ $c['complaint_source']['phone'] ?? '' }}</td>
            </tr>

            <!-- Section 2: المنتج المعني -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">2. المنتج المعني:</td>
            </tr>
            <tr>
                <td style="width: 15%; text-align: right;">- المنتج</td>
                <td style="width: 28%;">{{ $c['product']['product_name'] ?? '' }}</td>
                <td style="width: 15%; text-align: right;">- الماركة</td>
                <td style="width: 42%;">{{ $c['product']['brand'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">- رقم الدفعة: {{ $c['product']['batch_number'] ?? '' }}</td>
                <td colspan="2" style="text-align: right;">- نوع وشكل التعبئة: {{ $c['product']['packaging_type'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; padding: 2px;">
                    <input type="checkbox" {{ ($c['product']['sample_provided'] ?? '') === 'نعم' ? 'checked' : '' }} disabled>
                    نعم
                </td>
                <td colspan="2" style="text-align: center; padding: 2px;">
                    <input type="checkbox" {{ ($c['product']['sample_provided'] ?? '') === 'لا' ? 'checked' : '' }} disabled>
                    لا
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right; font-size: 8px;">- هل قدمت عينة؟</td>
            </tr>

            <!-- Section 3: العيوب -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">3. العيوب المنسوبة للمنتج:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 35px; vertical-align: top;">{{ $c['product_defects']['description'] ?? '' }}</td>
            </tr>

            <!-- Section 4: أصل المنتج -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">4. أصل المنتج (الحاصل):</td>
            </tr>
            <tr>
                <td style="width: 15%; text-align: right;">- الاسم</td>
                <td style="width: 28%;">{{ $c['product_origin']['name'] ?? '' }}</td>
                <td style="width: 15%; text-align: right;">- العنوان</td>
                <td style="width: 42%;">{{ $c['product_origin']['address'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">- تاريخ الشراء: {{ $c['product_origin']['purchase_date'] ?? '' }}</td>
            </tr>

            <!-- Section 5: التخزين والتعامل -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">5. كيف قام صاحب الشكوى بتخزين المنتج والتعامل معه بعد الشراء:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 35px; vertical-align: top;">{{ $c['storage_handling'] ?? '' }}</td>
            </tr>

            <!-- Section 6: المرض / الإصابة -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">6. حالة المرض / الإصابة:</td>
            </tr>
            <tr>
                <td style="width: 25%; text-align: right;">- عدد الأشخاص الذين استهلكوا المنتج:</td>
                <td style="width: 25%; text-align: center;">{{ $c['illness']['total_consumers'] ?? '' }}</td>
                <td style="width: 25%; text-align: right;">- عدد الأشخاص المصابين / الجرحى:</td>
                <td style="width: 25%; text-align: center;">{{ $c['illness']['affected_count'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right; font-size: 8px;">
                    - معلوماتهم (الأسماء – الأعمار – الكميات المستهلكة – التواريخ وأوقات الحدث):
                    {{ $c['illness']['affected_info'] ?? '' }}
                </td>
            </tr>

            <!-- Section 7: الأعراض -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">- أعراض المرض (حسب الشدة) أو وصف الإصابة:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 35px; vertical-align: top;">{{ $c['symptoms'] ?? '' }}</td>
            </tr>

            <!-- Section 8: الأطباء -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">- الأطباء الذين تمت استشارتهم (الأسماء – العناوين – تواريخ الاستشارات):</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 35px; vertical-align: top;">{{ $c['doctors'] ?? '' }}</td>
            </tr>

            <!-- Section 9: الحالة الراهنة -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">- الحالة الراهنة للمرض / الإصابة:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 30px; vertical-align: top;">{{ $c['current_status'] ?? '' }}</td>
            </tr>

            <!-- Section 10: المؤسسات -->
            <tr>
                <td colspan="4" class="section-header" style="text-align: right;">- المؤسسات أو الأماكن الأخرى التي اشتكى فيها مقدم الشكوى:</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 30px; vertical-align: top;">{{ $c['other_institutions'] ?? '' }}</td>
            </tr>

            <!-- Signature -->
            <tr>
                <td colspan="4" style="text-align: right; padding: 5px;">
                    تأشير مسسئول الجودة: .................................
                </td>
            </tr>
        </table>
    </div>

    <div class="header-box">
        <div class="header-right" style="width: 20%; font-size: 10px;">
            <table style="margin: 0; border: none;">
                <tr style="border: none;"><td style="border: none; text-align: left;">الرمز:</td><td style="border: 1px solid black; text-align: center; font-weight: bold; width: 60px;">{{ $document->reference }}</td></tr>
                <tr style="border: none;"><td style="border: none; text-align: left;">الإصدار:</td><td style="border: 1px solid black; text-align: center; font-weight: bold; width: 60px;">{{ $document->version }}</td></tr>
            </table>
        </div>
        <div class="header-center">
            <div style="font-size: 16px; font-weight: bold; border-bottom: 1px solid black; display: inline-block; padding: 0 20px; margin-bottom: 5px;">تسجيل:</div>
            <div style="font-size: 20px; font-weight: bold;">{{ $document->title }}</div>
        </div>
        <div class="header-left" style="width: 25%; display: flex; align-items: center; justify-content: space-between;">
             <div style="text-align: right; font-size: 11px; line-height: 1.2;">
                <strong>تعاونية أنرار نتجادرين</strong><br>
                Cooperative Anrar Ntgadirin
            </div>
            <img src="/logo.png" alt="Logo" style="max-height: 50px; margin-left: 10px;">
        </div>
    </div>

    <div class="info-bar" style="border: none; border-bottom: 1px solid black; background: none; margin-bottom: 20px;">
        <div>التاريخ: <span style="border-bottom: 1px dotted black; min-width: 150px; display: inline-block;">{{ $document->date->format('Y/m/d') }}</span></div>
        <div>المسئول: <span style="border-bottom: 1px dotted black; min-width: 150px; display: inline-block;">{{ $document->responsible }}</span></div>
    </div>

    @php $c = $document->content; @endphp

    @if($document->type === 'health')
        <!-- Health Layout: 4 major sections side-by-side -->
        <table style="width: 100%; table-layout: fixed;">
            <thead>
                <tr>
                    <th colspan="4" style="background-color: #f2f2f2;">1- صحة العمال</th>
                    <th colspan="4" style="background-color: #f2f2f2;">2- سلوك العمال</th>
                    <th colspan="4" style="background-color: #f2f2f2;">3- الغسل الصحي لليدين</th>
                    <th colspan="4" style="background-color: #f2f2f2;">4- لباس الشغل</th>
                </tr>
                <tr style="font-size: 10px;">
                    <!-- Section 1 -->
                    <th>الساعة</th><th>اسم العامل</th><th>وصف الحالة</th><th>الإجراء</th>
                    <!-- Section 2 -->
                    <th>الساعة</th><th>اسم العامل</th><th>السلوك</th><th>الإجراء</th>
                    <!-- Section 3 -->
                    <th>الساعة</th><th>اسم العامل</th><th>العيب</th><th>الإجراء</th>
                    <!-- Section 4 -->
                    <th>الساعة</th><th>اسم العامل</th><th>العيب</th><th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $h = isset($c['health']) && is_array($c['health']) ? array_values($c['health']) : [];
                    $b = isset($c['behavior']) && is_array($c['behavior']) ? array_values($c['behavior']) : [];
                    $w = isset($c['hands']) && is_array($c['hands']) ? array_values($c['hands']) : []; 
                    $l = isset($c['clothes']) && is_array($c['clothes']) ? array_values($c['clothes']) : [];
                    $max = max(count($h), count($b), count($w), count($l), 15);
                @endphp
                
                @for($i=0; $i<$max; $i++)
                    <tr style="height: 25px;">
                        <!-- 1 -->
                        <td>{{ isset($h[$i]) && is_array($h[$i]) ? ($h[$i]['time'] ?? '') : '' }}</td>
                        <td>{{ isset($h[$i]) && is_array($h[$i]) ? ($h[$i]['name'] ?? '') : '' }}</td>
                        <td>{{ isset($h[$i]) && is_array($h[$i]) ? ($h[$i]['desc'] ?? '') : '' }}</td>
                        <td>{{ isset($h[$i]) && is_array($h[$i]) ? ($h[$i]['action'] ?? '') : '' }}</td>
                        <!-- 2 -->
                        <td>{{ isset($b[$i]) && is_array($b[$i]) ? ($b[$i]['time'] ?? '') : '' }}</td>
                        <td>{{ isset($b[$i]) && is_array($b[$i]) ? ($b[$i]['name'] ?? '') : '' }}</td>
                        <td>{{ isset($b[$i]) && is_array($b[$i]) ? ($b[$i]['desc'] ?? '') : '' }}</td>
                        <td>{{ isset($b[$i]) && is_array($b[$i]) ? ($b[$i]['action'] ?? '') : '' }}</td>
                        <!-- 3 -->
                        <td>{{ isset($w[$i]) && is_array($w[$i]) ? ($w[$i]['time'] ?? '') : '' }}</td>
                        <td>{{ isset($w[$i]) && is_array($w[$i]) ? ($w[$i]['name'] ?? '') : '' }}</td>
                        <td>{{ isset($w[$i]) && is_array($w[$i]) ? ($w[$i]['desc'] ?? '') : '' }}</td>
                        <td>{{ isset($w[$i]) && is_array($w[$i]) ? ($w[$i]['action'] ?? '') : '' }}</td>
                        <!-- 4 -->
                        <td>{{ isset($l[$i]) && is_array($l[$i]) ? ($l[$i]['time'] ?? '') : '' }}</td>
                        <td>{{ isset($l[$i]) && is_array($l[$i]) ? ($l[$i]['name'] ?? '') : '' }}</td>
                        <td>{{ isset($l[$i]) && is_array($l[$i]) ? ($l[$i]['desc'] ?? '') : '' }}</td>
                        <td>{{ isset($l[$i]) && is_array($l[$i]) ? ($l[$i]['action'] ?? '') : '' }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
        
        <div style="margin-top: 20px; font-weight: bold; text-align: left;">تأشير مسئول الجودة: .................................</div>

    @elseif($document->type === 'pest')
        <!-- Pest Control -->
        <h4 style="margin: 0 0 5px 0;">1. نتائج عمليات الوقاية: ملاحظات حول:</h4>
        <table style="width: 100%;">
            <tbody>
                @foreach([
                    'door_window' => 'مدى عدم قابلية الأبواب والنوافذ لتسريب الكائنات الضارة',
                    'surfaces' => 'أسطح الأرضيات والحيطان والأسقف',
                    'screens' => '"ناموسيات" النوافذ',
                    'drains' => 'بالوعات ومجاري الصرف الصحي',
                    'cleanliness' => 'الحالة العامة لأماكن تواجد مصائد الفئران والحشرات ونظافتها',
                    'insect_traps' => 'عمل مصائد الحشرات',
                    'rat_traps' => 'عمل مصائد الفئران',
                    'animals' => 'وجود الحيوانات الأليفة أو البرية'
                ] as $key => $label)
                <tr>
                    <td style="text-align: right; width: 60%; padding: 3px 10px;">{{ $label }}</td>
                    <td style="text-align: center;">{{ $c['preventive'][$key] ?? '' }}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="text-align: right; font-weight: bold; padding: 5px 10px;">خلاصة:</td>
                    <td style="padding: 10px; text-align: right;">{{ $c['preventive_summary'] ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <h4 style="margin: 10px 0 5px 0;">2. إجراءات المعالجة:</h4>
        <table>
            <thead>
                <tr style="background: #f2f2f2;">
                    <th>مكان التدخل</th>
                    <th>نوع التدخل</th>
                    <th>مسئول المعالجة</th>
                    <th>المادة الكيميائية المستخدمة</th>
                    <th>التركيز</th>
                    <th>وتيرة التطبيق</th>
                </tr>
            </thead>
            <tbody>
                @php $cur = $c['curative'] ?? []; $max_cur = max(count($cur), 8); @endphp
                @for($i=0; $i<$max_cur; $i++)
                <tr style="height: 25px;">
                    <td>{{ $cur[$i]['location'] ?? '' }}</td>
                    <td>{{ $cur[$i]['type'] ?? '' }}</td>
                    <td>{{ $cur[$i]['resp'] ?? '' }}</td>
                    <td>{{ $cur[$i]['product'] ?? '' }}</td>
                    <td>{{ $cur[$i]['conc'] ?? '' }}</td>
                    <td>{{ $cur[$i]['freq'] ?? '' }}</td>
                </tr>
                @endfor
            </tbody>
            <tfoot>
                 <tr>
                    <td colspan="1" style="text-align: right; font-weight: bold; border: none; padding-top: 10px;">خلاصة (نتائج المعالجة):</td>
                    <td colspan="5" style="padding: 10px; text-align: right; border: none; border-bottom: 1px dotted black;">{{ $c['curative_summary'] ?? '' }}</td>
                </tr>
            </tfoot>
        </table>
         <div style="margin-top: 30px; font-weight: bold; text-align: left;">تأشير مسئول النظافة: .................................</div>

    @elseif($document->type === 'cleaning')
        
        @php
            $sections = [
                'work_halls' => '1. قاعات العمل:',
                'packing_halls' => '2. قاعات التعبئة:',
                'admin_offices' => '3. قاعة العرض والمكاتب الإدارية:',
                'warehouses' => '4. المخازن:',
                'changing_rooms' => '5. الممرات وغرف تغيير الملابس:',
                'sanitary' => '6. المرافق الصحية والمغاسل:',
                'external' => '7. حالات أخرى (خارج المؤسسة وبعد الصيانة):',
            ];
        @endphp
        
        @foreach($sections as $key => $label)
             <h4 style="margin: 5px 0 2px 0; font-size: 12px; text-decoration: underline;">{{ $label }}</h4>
             <table style="margin-bottom: 5px;">
                <thead>
                    <tr style="background: #f2f2f2;">
                        <th width="10%">الساعة</th>
                        <th width="30%">العيب الملاحظ</th>
                        <th width="20%">المكان</th>
                        <th width="20%">المسئول</th>
                        <th width="20%">الإجراء المتخذ</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rows = $c[$key] ?? []; $max_r = max(count($rows), 3); @endphp
                    @for($i=0; $i<$max_r; $i++)
                    <tr style="height: 22px;">
                        <td>{{ $rows[$i]['time'] ?? '' }}</td>
                        <td>{{ $rows[$i]['defect'] ?? '' }}</td>
                         <td>{{ $rows[$i]['location'] ?? '' }}</td>
                        <td>{{ $rows[$i]['resp'] ?? '' }}</td>
                        <td>{{ $rows[$i]['action'] ?? '' }}</td>
                    </tr>
                    @endfor
                </tbody>
             </table>
        @endforeach
         <div style="margin-top: 15px; font-weight: bold; text-align: left;">تأشير مسئول الإنتاج: .................................</div>

    @elseif($document->type === 'batch')
        <table style="width: 100%;">
            <thead>
                <tr style="background: #f2f2f2;">
                    <th>تاريخ الاستلام</th>
                    <th>المصدر</th>
                    <th>المزود</th>
                    <th>المادة</th>
                    <th>ترميز رقم الدفعة (N)</th>
                </tr>
            </thead>
            <tbody>
                @php $items = $c['items'] ?? []; $max_i = max(count($items), 20); @endphp
                @for($i=0; $i<$max_i; $i++)
                <tr style="height: 25px;">
                    <td>{{ $items[$i]['date'] ?? '' }}</td>
                     <td>{{ $items[$i]['source'] ?? '' }}</td>
                    <td>{{ $items[$i]['supplier'] ?? '' }}</td>
                    <td>{{ $items[$i]['material'] ?? '' }}</td>
                    <td>{{ $items[$i]['batch_no'] ?? '' }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
         <div style="margin-top: 20px; font-weight: bold; text-align: left;">تأشير مسئول الإنتاج: .................................</div>

    @elseif($document->type === 'storage')
        <div style="text-align: right; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid black; padding-bottom: 5px;">المادة: <span style="font-weight: normal; margin-right: 20px;">{{ $c['material_name'] ?? '................................' }}</span></div>
        <table style="width: 100%;">
            <thead>
                <tr style="background: #f2f2f2;">
                    <th rowspan="2">التاريخ</th>
                    <th colspan="2">دخول المادة الأولية</th>
                    <th colspan="1">خروج المادة الأولية</th>
                    <th colspan="1">المخزون النهائي</th>
                </tr>
                <tr style="background: #f2f2f2;">
                     <th>رقم الدفعة</th>
                     <th>الكمية (كلغ)</th>
                     <th>الكمية (كلغ)</th>
                     <th>(كلغ)</th>
                </tr>
            </thead>
            <tbody>
                @php $moves = $c['movements'] ?? []; $max_m = max(count($moves), 25); @endphp
                @for($i=0; $i<$max_m; $i++)
                <tr style="height: 25px;">
                    <td>{{ $moves[$i]['date'] ?? '' }}</td>
                    <td>{{ $moves[$i]['in_batch'] ?? '' }}</td>
                    <td>{{ $moves[$i]['in_qty'] ?? '' }}</td>
                    <td>{{ $moves[$i]['out_qty'] ?? '' }}</td>
                    <td>{{ $moves[$i]['stock'] ?? '' }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
         <div style="margin-top: 20px; font-weight: bold; text-align: left;">تأشير مسئول الإنتاج: .................................</div>

    @elseif($document->type === 'alerts')
        <!-- Alerts Type - Single Page Table Layout -->
        <table style="width: 100%; border-collapse: collapse; font-size: 11px; line-height: 1.3;">
            <!-- Section 1: مصدر الشكاية -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">1. مصدر الشكاية:</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 3px; width: 33%; text-align: right;">- الاسم</td>
                <td colspan="2" style="border: 1px solid black; padding: 3px;">{{ $c['complaint_source']['name'] ?? '' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 3px; width: 33%; text-align: right;">- العنوان</td>
                <td colspan="2" style="border: 1px solid black; padding: 3px;">{{ $c['complaint_source']['address'] ?? '' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 3px; width: 33%; text-align: right;">- الهاتف</td>
                <td colspan="2" style="border: 1px solid black; padding: 3px;">{{ $c['complaint_source']['phone'] ?? '' }}</td>
            </tr>

            <!-- Section 2: المنتج المعني -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">2. المنتج المعني:</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 3px; text-align: right;">- المنتج</td>
                <td style="border: 1px solid black; padding: 3px; text-align: right;">- الماركة</td>
                <td style="border: 1px solid black; padding: 3px;">{{ $c['product']['brand'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 3px;">{{ $c['product']['product_name'] ?? '' }}</td>
                <td style="border: 1px solid black; padding: 3px;">{{ $c['product']['batch_number'] ?? '' }} - رقم الدفعة</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 3px;">{{ $c['product']['packaging_type'] ?? '' }} - نوع وشكل التعبئة</td>
                <td style="border: 1px solid black; padding: 3px; text-align: center;">
                    {{ ($c['product']['sample_provided'] ?? '') === 'نعم' ? '✓' : '✗' }}
                    <br><small>هل قدمت عينة؟</small>
                </td>
            </tr>

            <!-- Section 3: العيوب -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">3. العيوب المنسوبة للمنتج:</td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 5px; height: 40px; text-align: right; vertical-align: top;">
                    {{ $c['product_defects']['description'] ?? '' }}
                </td>
            </tr>

            <!-- Section 4: أصل المنتج -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">4. أصل المنتج (الإنتاج):</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 3px; text-align: right;">- الاسم</td>
                <td style="border: 1px solid black; padding: 3px; text-align: right;">- العنوان</td>
                <td style="border: 1px solid black; padding: 3px;">{{ $c['product_origin']['address'] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2" style="border: 1px solid black; padding: 3px;">{{ $c['product_origin']['name'] ?? '' }}</td>
                <td style="border: 1px solid black; padding: 3px;">{{ $c['product_origin']['purchase_date'] ?? '' }} - تاريخ الشراء</td>
            </tr>

            <!-- Section 5: التخزين والتعامل -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">5. كيف قام صاحب الشكوى بتخزين المنتج والتعامل معه بعد الشراء:</td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 5px; height: 40px; text-align: right; vertical-align: top;">
                    {{ $c['storage_handling'] ?? '' }}
                </td>
            </tr>

            <!-- Section 6: المرض / الإصابة -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">6. حالة المرض / الإصابة:</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 3px; text-align: right;">
                    {{ $c['illness']['total_consumers'] ?? '' }}<br>
                    <small>عدد الأشخاص الذين استهلكوا المنتج</small>
                </td>
                <td style="border: 1px solid black; padding: 3px; text-align: right;">
                    {{ $c['illness']['affected_count'] ?? '' }}<br>
                    <small>عدد الأشخاص المصابين / الجرحى</small>
                </td>
                <td style="border: 1px solid black; padding: 3px; text-align: right; vertical-align: top;">
                    <small>معلوماتهم (الأسماء - الأعمار - الكميات المستهلكة - التواريخ وأوقات الحدث):</small><br>
                    {{ $c['illness']['affected_info'] ?? '' }}
                </td>
            </tr>

            <!-- Section 7: الأعراض -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">- أعراض المرض (حسب الشدة) أو وصف الإصابة:</td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 5px; height: 40px; text-align: right; vertical-align: top;">
                    {{ $c['symptoms'] ?? '' }}
                </td>
            </tr>

            <!-- Section 8: الأطباء -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">- الأطباء الذين تمت استشارتهم (الأسماء – العناوين – تواريخ الاستشارات):</td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 5px; height: 40px; text-align: right; vertical-align: top;">
                    {{ $c['doctors'] ?? '' }}
                </td>
            </tr>

            <!-- Section 9: الحالة الراهنة -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">- الحالة الراهنة للمرض / الإصابة:</td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 5px; height: 40px; text-align: right; vertical-align: top;">
                    {{ $c['current_status'] ?? '' }}
                </td>
            </tr>

            <!-- Section 10: المؤسسات -->
            <tr>
                <td colspan="3" style="border: 1px solid black; background: #f2f2f2; padding: 3px; font-weight: bold; text-align: right;">- المؤسسات أو الأماكن الآخرى التي اشتكى فيها مقدم الشكوى:</td>
            </tr>
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 5px; height: 40px; text-align: right; vertical-align: top;">
                    {{ $c['other_institutions'] ?? '' }}
                </td>
            </tr>

            <!-- Signature -->
            <tr>
                <td colspan="3" style="border: 1px solid black; padding: 5px; text-align: right; font-weight: bold;">
                    تأشير مسئول الجودة: ................................
                </td>
            </tr>
        </table>

    @elseif($document->type === 'quality')
        <!-- Include Quality Print Template -->
        @include('onca.print_quality')

    @elseif($document->type === 'traceability')
        <!-- Include Traceability Print Template -->
        @include('onca.print_traceability')

    @elseif($document->type === 'corrective')
        <!-- Include Corrective Actions Print Template -->
        @include('onca.print_corrective')

    @elseif($document->type === 'warehouse_path')
        <!-- Include Warehouse Path Tracking Print Template -->
        @include('onca.print_warehouse_path')

    @elseif($document->type === 'final_stock')
        <!-- Include Final Product Stock Print Template -->
        @include('onca.print_final_stock')

    @elseif($document->type === 'recall_verification')
        <!-- Include Recall Verification Print Template -->
        @include('onca.print_recall_verification')

    @elseif($document->type === 'defects_report')
        <!-- Include Defects Report Print Template -->
        @include('onca.print_defects_report')

    @elseif($document->type === 'withdrawal_notice')
        <!-- Include Withdrawal Notice Print Template -->
        @include('onca.print_withdrawal_notice')

    @endif

</body>
</html>
