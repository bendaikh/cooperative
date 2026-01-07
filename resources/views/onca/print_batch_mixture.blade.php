<!-- Batch Mixture Print Template -->
<div style="page-break-after: avoid; direction: rtl; text-align: right;">
    <!-- Print Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 2px solid #333; padding-bottom: 1rem; gap: 1rem;">
        <div style="flex: 1; text-align: center;">
            <h2 style="margin: 0; font-size: 1.1rem; font-weight: bold; color: #333;">تعاونية الوالتكاديين</h2>
            <p style="margin: 0.25rem 0; font-size: 0.9rem; color: #333;">قائمة ترميز الدفعة (الخلطات)</p>
            <p style="margin: 0.25rem 0; font-size: 0.85rem; color: #666;"><strong>Batch Mixture Coding List</strong></p>
        </div>
        <div style="text-align: left; font-size: 0.85rem;">
            <p style="margin: 0.25rem 0;"><strong>الرمز:</strong> PR-T-EN3</p>
            <p style="margin: 0.25rem 0;"><strong>الإصدار:</strong> 01</p>
        </div>
    </div>

    <!-- Mixture Table -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; font-size: 12px; border: 1px solid #333; direction: rtl;">
        <thead>
            <tr style="background: #f0f0f0;">
                <th style="border: 1px solid #333; padding: 0.5rem; text-align: center; font-weight: 600; width: 80px;">ترميز رقم الدفعة (M)</th>
                <th style="border: 1px solid #333; padding: 0.5rem; text-align: center; font-weight: 600; width: 80px;">تاريخ الخلط</th>
                <th colspan="6" style="border: 1px solid #333; padding: 0.5rem; text-align: center; font-weight: 600;">المكونات</th>
                <th style="border: 1px solid #333; padding: 0.5rem; text-align: center; font-weight: 600; width: 80px;">كمية الخليط (كلغ)</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($document->content['mixture_records']) && is_array($document->content['mixture_records']) && count($document->content['mixture_records']) > 0)
                @foreach($document->content['mixture_records'] as $row)
                    <!-- Ingredient 1 Row -->
                    <tr>
                        <td rowspan="3" style="border: 1px solid #333; padding: 0.5rem; text-align: center; background: #f0f0f0; vertical-align: middle;">{{ $row['batch_code'] ?? '-' }}</td>
                        <td rowspan="3" style="border: 1px solid #333; padding: 0.5rem; text-align: center; background: #f0f0f0; vertical-align: middle;">{{ $row['mixing_date'] ?? '-' }}</td>
                        <td style="border: 1px solid #333; padding: 0.5rem; text-align: right; width: 50px;">المكون</td>
                        <td colspan="5" style="border: 1px solid #333; padding: 0.5rem;">{{ $row['ingredient_1_name'] ?? '-' }}</td>
                        <td rowspan="3" style="border: 1px solid #333; padding: 0.5rem; text-align: center; background: #f0f0f0; vertical-align: middle;">{{ $row['total_mix_qty'] ?? '-' }}</td>
                    </tr>
                    <!-- Ingredient 1 Batch # Row -->
                    <tr>
                        <td style="border: 1px solid #333; padding: 0.5rem; text-align: right; width: 50px;">رقم الدفعة</td>
                        <td colspan="5" style="border: 1px solid #333; padding: 0.5rem;">{{ $row['ingredient_1_batch'] ?? '-' }}</td>
                    </tr>
                    <!-- Ingredient 1 Qty Row -->
                    <tr>
                        <td style="border: 1px solid #333; padding: 0.5rem; text-align: right; width: 50px;">الكمية (كلغ)</td>
                        <td colspan="5" style="border: 1px solid #333; padding: 0.5rem;">{{ $row['ingredient_1_qty'] ?? '-' }}</td>
                    </tr>
                @endforeach
            @else
                @for($i = 0; $i < 8; $i++)
                    <!-- Empty Ingredient 1 Row -->
                    <tr>
                        <td rowspan="3" style="border: 1px solid #333; padding: 0.5rem; text-align: center; background: #f0f0f0; vertical-align: middle; height: 18px;">&nbsp;</td>
                        <td rowspan="3" style="border: 1px solid #333; padding: 0.5rem; text-align: center; background: #f0f0f0; vertical-align: middle;">&nbsp;</td>
                        <td style="border: 1px solid #333; padding: 0.5rem; text-align: right; width: 50px; font-size: 11px;">المكون</td>
                        <td colspan="5" style="border: 1px solid #333; padding: 0.5rem;">&nbsp;</td>
                        <td rowspan="3" style="border: 1px solid #333; padding: 0.5rem; text-align: center; background: #f0f0f0; vertical-align: middle;">&nbsp;</td>
                    </tr>
                    <!-- Empty Ingredient 1 Batch # Row -->
                    <tr>
                        <td style="border: 1px solid #333; padding: 0.5rem; text-align: right; width: 50px; font-size: 11px;">رقم الدفعة</td>
                        <td colspan="5" style="border: 1px solid #333; padding: 0.5rem;">&nbsp;</td>
                    </tr>
                    <!-- Empty Ingredient 1 Qty Row -->
                    <tr>
                        <td style="border: 1px solid #333; padding: 0.5rem; text-align: right; width: 50px; font-size: 11px;">الكمية (كلغ)</td>
                        <td colspan="5" style="border: 1px solid #333; padding: 0.5rem;">&nbsp;</td>
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>

    <!-- Signature Section -->
    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; direction: rtl; text-align: right;">
        <p style="margin: 0 0 1rem 0; font-size: 0.875rem; font-weight: 600;">بتأشير مسئول الإنتاج / Production Manager Signature</p>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem; margin-top: 2rem;">
            <div style="text-align: center;">
                <p style="margin: 0; font-size: 0.875rem; font-weight: 600;">الختم / Stamp</p>
                <div style="height: 60px; border-bottom: 2px solid #000; margin-bottom: 0.5rem;"></div>
                <p style="margin: 0.25rem 0 0; font-size: 0.75rem; color: #666;">_______________</p>
            </div>
            <div style="text-align: center;">
                <p style="margin: 0; font-size: 0.875rem; font-weight: 600;">الاسم / Name</p>
                <div style="height: 60px; border-bottom: 2px solid #000; margin-bottom: 0.5rem;"></div>
                <p style="margin: 0.25rem 0 0; font-size: 0.75rem; color: #666;">التاريخ / Date: _______________</p>
            </div>
        </div>
    </div>
</div>
