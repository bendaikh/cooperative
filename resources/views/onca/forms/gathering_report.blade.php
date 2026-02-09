@php
    $formContent = isset($document) ? $document->content : [];
@endphp

<div style="direction: rtl; text-align: right; font-family: Arial, sans-serif; font-size: 13px;">

    <!-- Header Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td rowspan="2" style="border: 1px solid #1f4e79; padding: 10px; width: 120px; text-align: center;">
                <!-- Logo placeholder -->
            </td>
            <td rowspan="2" style="border: 1px solid #1f4e79; padding: 10px; text-align: center; font-size: 18px; font-weight: bold;">
                استمارة:<br>
                بلاغ للبيت بخصوص التجمع
            </td>
            <td style="border: 1px solid #1f4e79; padding: 6px 8px; text-align: center; width: 90px; font-weight: bold;">الرمز</td>
            <td style="border: 1px solid #1f4e79; padding: 6px 8px; text-align: center; width: 90px; font-weight: bold;">PR-R-FR3</td>
        </tr>
        <tr>
            <td style="border: 1px solid #1f4e79; padding: 6px 8px; text-align: center; width: 90px; font-weight: bold;">الإصدار</td>
            <td style="border: 1px solid #1f4e79; padding: 6px 8px; text-align: center; width: 90px; font-weight: bold;">01</td>
        </tr>
    </table>

    <!-- File Info Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <th style="border: 1px solid #1f4e79; padding: 6px 8px; text-align: right; font-weight: bold; background-color: #f5f5f5;">فتح بتاريخ:</th>
            <td style="border: 1px solid #1f4e79; padding: 6px 8px;">
                <input type="date" name="content[file_date]" 
                    value="{{ $formContent['file_date'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
            <th style="border: 1px solid #1f4e79; padding: 6px 8px; text-align: right; font-weight: bold; background-color: #f5f5f5;">ملف رقم:</th>
            <td style="border: 1px solid #1f4e79; padding: 6px 8px;">
                <input type="text" name="content[file_number]" 
                    value="{{ $formContent['file_number'] ?? '' }}" 
                    style="width: 100%; border: none; padding: 4px; font-size: 13px;">
            </td>
        </tr>
    </table>

    <!-- Lined Area for Notes -->
    <div style="border: 1px solid #1f4e79; padding: 0; margin-bottom: 20px; min-height: 520px;">
        <textarea name="content[notes]" 
            style="width: 100%; height: 500px; border: none; padding: 10px; font-family: Arial, sans-serif; font-size: 13px; resize: none; outline: none; background: white;">{{ $formContent['notes'] ?? '' }}</textarea>
    </div>

    <!-- Signature Section -->
    <div style="margin-top: 20px; font-weight: bold;">
        <p>توقيع مدير المؤسسة:</p>
        <div style="height: 80px; border-top: 1px solid #000; margin-top: 40px;"></div>
    </div>

</div>
