@php
    $formContent = isset($document) ? $document->content : [];
@endphp

<div style="direction: rtl; text-align: right; font-family: Arial, sans-serif; font-size: 13px;">

    <!-- Header Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">المصرح:</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[authorized]" value="{{ $formContent['authorized'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">الصفة:</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[quality]" value="{{ $formContent['quality'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">التاريخ:</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="date" name="content[date]" value="{{ $formContent['date'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">الساعة:</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="time" name="content[time]" value="{{ $formContent['time'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
        </tr>
    </table>

    <!-- Detection Section -->
    <h5 style="text-align: center; text-decoration: underline; margin: 10px 0;">الكشف عن عدم المطابقة</h5>

    <table dir="rtl" style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
        <!-- العناوين -->
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold; width: 25%;">نوعية عدم المطابقة:</th>
            <td style="border: 1px solid #000; padding: 6px; width: 25%;">
                <input type="text" name="content[non_conformance_type]" value="{{ $formContent['non_conformance_type'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold; width: 50%; text-align: right;">وصف عدم المطابقة:</th>
        </tr>

        <!-- مادة خام -->
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">مادة خام</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[raw_material]" value="{{ $formContent['raw_material'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top; text-align: right;" rowspan="3">
                <textarea name="content[non_conformance_description]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['non_conformance_description'] ?? '' }}</textarea>
            </td>
        </tr>

        <!-- منتج وسيط -->
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">منتج وسيط</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[intermediate_product]" value="{{ $formContent['intermediate_product'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
        </tr>

        <!-- منتج نهائي -->
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">منتج نهائي</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[final_product]" value="{{ $formContent['final_product'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
        </tr>
    </table>

    <!-- Signatures Section 1 -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">يأسير المصرح:</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[authorized_signature]" value="{{ $formContent['authorized_signature'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">تأشير مسئول الحودة:</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[quality_signature_1]" value="{{ $formContent['quality_signature_1'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
        </tr>
    </table>

    <!-- Investigation Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">التقصي حول أسباب عدم المطابقة:</th>
        </tr>
        <tr>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
                <textarea name="content[investigation]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['investigation'] ?? '' }}</textarea>
            </td>
        </tr>
    </table>

    <!-- Corrective Actions Section -->
    <h5 style="text-align: center; text-decoration: underline; margin: 10px 0;">الإجراءات التصحيحية:</h5>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;" id="corrective_table">
        <thead>
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">الرقم</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">الإجراء</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">المسؤول</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">الأجل المحدد</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold; width: 50px;">إجراء</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[corrective_number_1]" value="{{ $formContent['corrective_number_1'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
                <textarea name="content[corrective_action_1]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['corrective_action_1'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[corrective_responsible_1]" value="{{ $formContent['corrective_responsible_1'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="date" name="content[corrective_deadline_1]" value="{{ $formContent['corrective_deadline_1'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                <button type="button" onclick="removeRow(this)" style="padding: 4px 8px; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 3px;">حذف</button>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[corrective_number_2]" value="{{ $formContent['corrective_number_2'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
                <textarea name="content[corrective_action_2]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['corrective_action_2'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[corrective_responsible_2]" value="{{ $formContent['corrective_responsible_2'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="date" name="content[corrective_deadline_2]" value="{{ $formContent['corrective_deadline_2'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                <button type="button" onclick="removeRow(this)" style="padding: 4px 8px; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 3px;">حذف</button>
            </td>
        </tr>
        </tbody>
    </table>
    <button type="button" onclick="addCorrectiveRow()" style="margin-bottom: 12px; padding: 8px 16px; background: #4f46e5; color: white; border: none; cursor: pointer; border-radius: 4px;">+ إضافة صف</button>

    <!-- Preventive Actions Section -->
    <h5 style="text-align: center; text-decoration: underline; margin: 10px 0;">الإجراءات الوقائية:</h5>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;" id="preventive_table">
        <thead>
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">الرقم</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">الإجراء</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">المسؤول</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">الأجل المحدد</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold; width: 50px;">إجراء</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[preventive_number_1]" value="{{ $formContent['preventive_number_1'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
                <textarea name="content[preventive_action_1]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['preventive_action_1'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[preventive_responsible_1]" value="{{ $formContent['preventive_responsible_1'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="date" name="content[preventive_deadline_1]" value="{{ $formContent['preventive_deadline_1'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                <button type="button" onclick="removeRow(this)" style="padding: 4px 8px; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 3px;">حذف</button>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[preventive_number_2]" value="{{ $formContent['preventive_number_2'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
                <textarea name="content[preventive_action_2]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['preventive_action_2'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[preventive_responsible_2]" value="{{ $formContent['preventive_responsible_2'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="date" name="content[preventive_deadline_2]" value="{{ $formContent['preventive_deadline_2'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                <button type="button" onclick="removeRow(this)" style="padding: 4px 8px; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 3px;">حذف</button>
            </td>
        </tr>
        </tbody>
    </table>
    <button type="button" onclick="addPreventiveRow()" style="margin-bottom: 12px; padding: 8px 16px; background: #4f46e5; color: white; border: none; cursor: pointer; border-radius: 4px;">+ إضافة صف</button>

    <!-- Signatures Section 2 -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;"> تأشير مسئول الحودة: </th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[quality_signature_2]" value="{{ $formContent['quality_signature_2'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">توقيع المدير:</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[manager_signature_1]" value="{{ $formContent['manager_signature_1'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
        </tr>
    </table>

    <!-- Tracking Section -->
    <h5 style="text-align: center; text-decoration: underline; margin: 10px 0;">تتبع الإجراءات التصحيحية والوقائية</h5>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;" id="tracking_table">
        <thead>
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold; vertical-align: middle;" rowspan="2">رقم الإجراء</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold; vertical-align: middle;" rowspan="2">التاريخ</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">التنفيذ</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">النجاعة</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold; vertical-align: middle;" rowspan="2">الخلاصة</th>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold; vertical-align: middle; width: 50px;" rowspan="2">إجراء</th>
        </tr>
        <tr>
            <td style="border: 1px solid #000; padding: 6px; text-align: center;">نعم / لا</td>
            <td style="border: 1px solid #000; padding: 6px; text-align: center;">نعم / لا</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[tracking_number]" value="{{ $formContent['tracking_number'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="date" name="content[tracking_date]" value="{{ $formContent['tracking_date'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
                <textarea name="content[tracking_execution]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['tracking_execution'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
                <textarea name="content[tracking_effectiveness]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['tracking_effectiveness'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
                <textarea name="content[tracking_conclusion]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;">{{ $formContent['tracking_conclusion'] ?? '' }}</textarea>
            </td>
            <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                <button type="button" onclick="removeRow(this)" style="padding: 4px 8px; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 3px;">حذف</button>
            </td>
        </tr>
        </tbody>
    </table>
    <button type="button" onclick="addTrackingRow()" style="margin-bottom: 12px; padding: 8px 16px; background: #4f46e5; color: white; border: none; cursor: pointer; border-radius: 4px;">+ إضافة صف</button>

    <!-- Signatures Section 3 -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px;">
        <tr>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;"> تأشير مسئول الحودة: </th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[quality_signature_3]" value="{{ $formContent['quality_signature_3'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
            <th style="border: 1px solid #000; padding: 6px; background: #f3f3f3; font-weight: bold;">توقيع المدير:</th>
            <td style="border: 1px solid #000; padding: 6px;">
                <input type="text" name="content[manager_signature_2]" value="{{ $formContent['manager_signature_2'] ?? '' }}" style="width: 100%; border: none; padding: 4px;">
            </td>
        </tr>
    </table>

</div>

<script>
function removeRow(btn) {
    btn.closest('tr').remove();
}

function addCorrectiveRow() {
    const table = document.getElementById('corrective_table').querySelector('tbody');
    const newRow = document.createElement('tr');
    const timestamp = Date.now() + Math.random();
    
    newRow.innerHTML = `
        <td style="border: 1px solid #000; padding: 6px;">
            <input type="text" name="content[corrective_number_${timestamp}]" value="" style="width: 100%; border: none; padding: 4px;">
        </td>
        <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
            <textarea name="content[corrective_action_${timestamp}]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;"></textarea>
        </td>
        <td style="border: 1px solid #000; padding: 6px;">
            <input type="text" name="content[corrective_responsible_${timestamp}]" value="" style="width: 100%; border: none; padding: 4px;">
        </td>
        <td style="border: 1px solid #000; padding: 6px;">
            <input type="date" name="content[corrective_deadline_${timestamp}]" value="" style="width: 100%; border: none; padding: 4px;">
        </td>
        <td style="border: 1px solid #000; padding: 6px; text-align: center;">
            <button type="button" onclick="removeRow(this)" style="padding: 4px 8px; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 3px;">حذف</button>
        </td>
    `;
    table.appendChild(newRow);
}

function addPreventiveRow() {
    const table = document.getElementById('preventive_table').querySelector('tbody');
    const newRow = document.createElement('tr');
    const timestamp = Date.now() + Math.random();
    
    newRow.innerHTML = `
        <td style="border: 1px solid #000; padding: 6px;">
            <input type="text" name="content[preventive_number_${timestamp}]" value="" style="width: 100%; border: none; padding: 4px;">
        </td>
        <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
            <textarea name="content[preventive_action_${timestamp}]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;"></textarea>
        </td>
        <td style="border: 1px solid #000; padding: 6px;">
            <input type="text" name="content[preventive_responsible_${timestamp}]" value="" style="width: 100%; border: none; padding: 4px;">
        </td>
        <td style="border: 1px solid #000; padding: 6px;">
            <input type="date" name="content[preventive_deadline_${timestamp}]" value="" style="width: 100%; border: none; padding: 4px;">
        </td>
        <td style="border: 1px solid #000; padding: 6px; text-align: center;">
            <button type="button" onclick="removeRow(this)" style="padding: 4px 8px; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 3px;">حذف</button>
        </td>
    `;
    table.appendChild(newRow);
}

function addTrackingRow() {
    const table = document.getElementById('tracking_table').querySelector('tbody');
    const newRow = document.createElement('tr');
    const timestamp = Date.now() + Math.random();
    
    newRow.innerHTML = `
        <td style="border: 1px solid #000; padding: 6px;">
            <input type="text" name="content[tracking_number_${timestamp}]" value="" style="width: 100%; border: none; padding: 4px;">
        </td>
        <td style="border: 1px solid #000; padding: 6px;">
            <input type="date" name="content[tracking_date_${timestamp}]" value="" style="width: 100%; border: none; padding: 4px;">
        </td>
        <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
            <textarea name="content[tracking_execution_${timestamp}]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;"></textarea>
        </td>
        <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
            <textarea name="content[tracking_effectiveness_${timestamp}]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;"></textarea>
        </td>
        <td style="border: 1px solid #000; padding: 6px; height: 70px; vertical-align: top;">
            <textarea name="content[tracking_conclusion_${timestamp}]" style="width: 100%; height: 70px; border: none; padding: 4px; resize: none;"></textarea>
        </td>
        <td style="border: 1px solid #000; padding: 6px; text-align: center;">
            <button type="button" onclick="removeRow(this)" style="padding: 4px 8px; background: #dc2626; color: white; border: none; cursor: pointer; border-radius: 3px;">حذف</button>
        </td>
    `;
    table.appendChild(newRow);
}
</script>
