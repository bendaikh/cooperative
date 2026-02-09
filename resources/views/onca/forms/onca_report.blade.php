@php
    $formContent = isset($document) ? $document->content : [];
@endphp

<div style="direction: rtl; text-align: right; font-family: Arial, sans-serif; font-size: 13px;">

    <!-- Section 1: Responsible Contact -->
    <h5 style="margin: 12px 0 6px; font-weight: bold;">1. المسؤول عن الملف (مع من ستتواصل أونسا):</h5>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 14px;">
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px;"></th>
            <th style="border: 1px solid #000; padding: 6px;">المسئول</th>
            <th style="border: 1px solid #000; padding: 6px;">النائب</th>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">الاسم</th>
            <td style="border: 1px solid #000; padding: 6px; width: 26%; height: 32px;">
                <input type="text" name="content[contact][responsible_name]" 
                    value="{{ $formContent['contact']['responsible_name'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; width: 26%; height: 32px;">
                <input type="text" name="content[contact][deputy_name]" 
                    value="{{ $formContent['contact']['deputy_name'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">الوظيفة</th>
            <td style="border: 1px solid #000; padding: 6px; width: 26%; height: 32px;">
                <input type="text" name="content[contact][responsible_position]" 
                    value="{{ $formContent['contact']['responsible_position'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; width: 26%; height: 32px;">
                <input type="text" name="content[contact][deputy_position]" 
                    value="{{ $formContent['contact']['deputy_position'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">الهاتف</th>
            <td style="border: 1px solid #000; padding: 6px; width: 26%; height: 32px;">
                <input type="tel" name="content[contact][responsible_phone]" 
                    value="{{ $formContent['contact']['responsible_phone'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; width: 26%; height: 32px;">
                <input type="tel" name="content[contact][deputy_phone]" 
                    value="{{ $formContent['contact']['deputy_phone'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
    </table>

    <!-- Section 2: Products Involved -->
    <h5 style="margin: 12px 0 6px; font-weight: bold;">2. المنتجات المعنية (انظر ملصقات المنتجات المرفقة):</h5>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 14px;">
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">التسمية</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][0][name]" 
                    value="{{ $formContent['products'][0]['name'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][1][name]" 
                    value="{{ $formContent['products'][1]['name'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][2][name]" 
                    value="{{ $formContent['products'][2]['name'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">العلامة التجارية</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][0][brand]" 
                    value="{{ $formContent['products'][0]['brand'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][1][brand]" 
                    value="{{ $formContent['products'][1]['brand'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][2][brand]" 
                    value="{{ $formContent['products'][2]['brand'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">طريقة العرض</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][0][presentation]" 
                    value="{{ $formContent['products'][0]['presentation'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][1][presentation]" 
                    value="{{ $formContent['products'][1]['presentation'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][2][presentation]" 
                    value="{{ $formContent['products'][2]['presentation'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">رقم الدفعة</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][0][batch]" 
                    value="{{ $formContent['products'][0]['batch'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][1][batch]" 
                    value="{{ $formContent['products'][1]['batch'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[products][2][batch]" 
                    value="{{ $formContent['products'][2]['batch'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">تاريخ الإنتاج</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="date" name="content[products][0][production_date]" 
                    value="{{ $formContent['products'][0]['production_date'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="date" name="content[products][1][production_date]" 
                    value="{{ $formContent['products'][1]['production_date'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="date" name="content[products][2][production_date]" 
                    value="{{ $formContent['products'][2]['production_date'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">تاريخ انتهاء الصلاحية</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="date" name="content[products][0][expiry_date]" 
                    value="{{ $formContent['products'][0]['expiry_date'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="date" name="content[products][1][expiry_date]" 
                    value="{{ $formContent['products'][1]['expiry_date'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="date" name="content[products][2][expiry_date]" 
                    value="{{ $formContent['products'][2]['expiry_date'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
    </table>

    <!-- Section 3: Defect Description -->
    <h5 style="margin: 12px 0 6px; font-weight: bold;">3. وصف تفصيلي لطبيعة العيوب:</h5>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 14px;">
        <tr style="border: 1px solid #000;">
            <td style="border: 1px solid #000; padding: 6px; height: 90px; vertical-align: top;">
                <textarea name="content[defect_description][0]" 
                    style="width: 100%; height: 90px; border: none; padding: 4px; font-size: 13px; resize: none;">{{ $formContent['defect_description'][0] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 90px; vertical-align: top;">
                <textarea name="content[defect_description][1]" 
                    style="width: 100%; height: 90px; border: none; padding: 4px; font-size: 13px; resize: none;">{{ $formContent['defect_description'][1] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 90px; vertical-align: top;">
                <textarea name="content[defect_description][2]" 
                    style="width: 100%; height: 90px; border: none; padding: 4px; font-size: 13px; resize: none;">{{ $formContent['defect_description'][2] ?? '' }}</textarea>
            </td>
        </tr>
    </table>

    <!-- Section 4: Complaint Status -->
    <h5 style="margin: 12px 0 6px; font-weight: bold;">4. الحالة العامة للشكاية:</h5>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 14px;">
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">المنتج (رقم الدفعة)</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[complaint][0][product_batch]" 
                    value="{{ $formContent['complaint'][0]['product_batch'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[complaint][1][product_batch]" 
                    value="{{ $formContent['complaint'][1]['product_batch'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="text" name="content[complaint][2][product_batch]" 
                    value="{{ $formContent['complaint'][2]['product_batch'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">عدد الشكاوى الواردة</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="number" name="content[complaint][0][complaints_count]" 
                    value="{{ $formContent['complaint'][0]['complaints_count'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="number" name="content[complaint][1][complaints_count]" 
                    value="{{ $formContent['complaint'][1]['complaints_count'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="number" name="content[complaint][2][complaints_count]" 
                    value="{{ $formContent['complaint'][2]['complaints_count'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">عدد حالات المرض أو الإصابة المعلنة</th>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="number" name="content[complaint][0][illness_cases]" 
                    value="{{ $formContent['complaint'][0]['illness_cases'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="number" name="content[complaint][1][illness_cases]" 
                    value="{{ $formContent['complaint'][1]['illness_cases'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <td style="border: 1px solid #000; padding: 4px; width: 26%; height: 32px;">
                <input type="number" name="content[complaint][2][illness_cases]" 
                    value="{{ $formContent['complaint'][2]['illness_cases'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
        <tr style="border: 1px solid #000;">
            <th style="border: 1px solid #000; padding: 6px; width: 22%; background: #f5f5f5; font-weight: bold;">أعراض المرض (حسب الشدة) أو وصف الإصابة</th>
            <td style="border: 1px solid #000; padding: 4px; height: 90px; vertical-align: top;">
                <textarea name="content[complaint][0][symptoms]" 
                    style="width: 100%; height: 90px; border: none; padding: 4px; font-size: 13px; resize: none;">{{ $formContent['complaint'][0]['symptoms'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 4px; height: 90px; vertical-align: top;">
                <textarea name="content[complaint][1][symptoms]" 
                    style="width: 100%; height: 90px; border: none; padding: 4px; font-size: 13px; resize: none;">{{ $formContent['complaint'][1]['symptoms'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 4px; height: 90px; vertical-align: top;">
                <textarea name="content[complaint][2][symptoms]" 
                    style="width: 100%; height: 90px; border: none; padding: 4px; font-size: 13px; resize: none;">{{ $formContent['complaint'][2]['symptoms'] ?? '' }}</textarea>
            </td>
        </tr>
    </table>

    <!-- Section 5: Distribution -->
    <h5 style="margin: 12px 0 6px; font-weight: bold;">5. توزيع المنتجات (على الصعيد المحلي والوطني والدولي):</h5>
    
    <div style="border: 1px solid #000; padding: 8px; margin-top: 10px; font-size: 12px;">
        <p><em>(انظر نسخة من التسجيل PR-R-EN4 المرفق، الذي يشمل جميع الزبناء/المزودين من هذه المنتجات)</em></p>
    </div>

</div>

