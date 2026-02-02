<!-- Corrective and Preventive Actions Print Template -->
<div style="page-break-after: avoid; direction: rtl; width: 210mm; min-height: 297mm; background: white; margin: 0 auto;">
    <table class="header-table" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; page-break-after: avoid;">
        <tr>
            <td class="right-box" style="width: 20%; text-align: center; padding: 8px; border: 1px solid #000; vertical-align: middle;">
                <img src="{{ asset('logo.svg') }}" alt="Logo" style="max-height: 70px;">
            </td>
            <td class="center-box" style="width: 60%; text-align: center; padding: 8px; border: 1px solid #000; vertical-align: middle;">
                <div class="title" style="font-size: 22px; font-weight: bold;">سجل الإجراءات التصحيحية والوقائية</div>
                <div class="subtitle" style="font-size: 18px; margin-top: 5px;">سجل الإجراءات التصحيحية والوقائية</div>
            </td>
            <td class="left-box" style="width: 20%; text-align: center; padding: 0; border: 1px solid #000; vertical-align: middle;">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:6px;">
                            <div class="label" style="font-size: 14px; text-align: right; font-weight: normal;">المرجع:</div>
                            <div>PR-R-EN8</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:6px;">
                            <div class="label" style="font-size: 14px; text-align: right; font-weight: normal;">الإصدار:</div>
                            <div>01</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Actions Table -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; font-size: 0.875rem; border: 1px solid #d1d5db;">
        <thead>
            <tr style="background: #f3f4f6;">
                <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600;">التاريخ</th>
                <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600;">نوع العملية</th>
                <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600;">وصفها</th>
                <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600;">ملاحظات</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($document->content['actions']) && is_array($document->content['actions']) && count($document->content['actions']) > 0)
                @foreach($document->content['actions'] as $row)
                    <tr>
                        <td style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center;">{{ $row['date'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center;">{{ $row['type'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.75rem;">{{ $row['description'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.75rem;">{{ $row['notes'] ?? '-' }}</td>
                    </tr>
                @endforeach
            @else
                @for($i = 0; $i < 15; $i++)
                    <tr>
                        <td style="border: 1px solid #d1d5db; padding: 0.75rem; height: 30px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.75rem; height: 30px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.75rem; height: 30px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.75rem; height: 30px;">&nbsp;</td>
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>

    <!-- Signature Section -->
    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem; margin-top: 2rem;">
            <div style="text-align: center;">
                <div style="height: 60px; border-bottom: 2px solid #000; margin-bottom: 0.5rem;"></div>
                <p style="margin: 0; font-size: 0.875rem; font-weight: 600;">بتأشير مسئول الجودة</p>
                <p style="margin: 0.25rem 0 0; font-size: 0.75rem; color: #666;">التاريخ: _______________</p>
            </div>
            <div style="text-align: center;">
                <div style="height: 60px; border-bottom: 2px solid #000; margin-bottom: 0.5rem;"></div>
                <p style="margin: 0; font-size: 0.875rem; font-weight: 600;">مسئول التطبيق</p>
                <p style="margin: 0.25rem 0 0; font-size: 0.75rem; color: #666;">التاريخ: _______________</p>
            </div>
        </div>
    </div>
</div>
