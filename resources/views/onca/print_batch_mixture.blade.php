<!-- Batch Mixture Print Template -->
<div style="page-break-after: avoid; direction: rtl; text-align: right;">
    <style>
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 8px; }
        .right-box img { max-height: 70px; }
        .center-box { width: 60%; text-align: center; padding: 8px; }
        .center-box .title { font-size: 22px; font-weight: bold; }
        .center-box .subtitle { font-size: 18px; margin-top: 5px; }
        .left-box { width: 20%; text-align: center; padding: 0; }
        .left-box .label { font-size: 14px; text-align: right; font-weight: normal; }
    </style>

    <table class="header-table" style="page-break-after: avoid;">
        <tr>
            <td class="right-box">
                <img src="{{ asset('logo.svg') }}" alt="Logo">
            </td>
            <td class="center-box">
                <div class="title">تسجيل:</div>
                <div class="subtitle">{{ $document->title ?? 'قائمة ترميز الدفعة' }}</div>
            </td>
            <td class="left-box">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:6px;">
                            <div class="label">الرمز:</div>
                            <div>{{ $document->reference ?? 'PR-T-EN3' }}</div>
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
        <p style="margin: 0 0 1rem 0; font-size: 0.875rem; font-weight: 600;">بتأشير مسئول الإنتاج</p>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem; margin-top: 2rem;">
            <div style="text-align: center;">
                <p style="margin: 0; font-size: 0.875rem; font-weight: 600;">الختم</p>
                <div style="height: 60px; border-bottom: 2px solid #000; margin-bottom: 0.5rem;"></div>
                <p style="margin: 0.25rem 0 0; font-size: 0.75rem; color: #666;">_______________</p>
            </div>
            <div style="text-align: center;">
                <p style="margin: 0; font-size: 0.875rem; font-weight: 600;">الاسم</p>
                <div style="height: 60px; border-bottom: 2px solid #000; margin-bottom: 0.5rem;"></div>
                <p style="margin: 0.25rem 0 0; font-size: 0.75rem; color: #666;">التاريخ: _______________</p>
            </div>
        </div>
    </div>
</div>
