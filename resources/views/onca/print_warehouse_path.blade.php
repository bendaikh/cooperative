<!-- Warehouse Path Tracking Print Template -->
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
                <div class="title">تسجيل مسار الدفعة</div>
            </td>
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
                            <div>{{ $document->version ?? '01' }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Path Tracking Table -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; font-size: 0.75rem; border: 1px solid #d1d5db; direction: rtl;">
        <thead>
            <tr style="background: #f3f4f6;">
                <th colspan="2" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التموين</th>
                <th colspan="2" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">الفرز والتنقية</th>
                <th colspan="2" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">الخلط</th>
                <th colspan="2" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التحويل</th>
                <th colspan="2" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التعبئة والعنونة</th>
            </tr>
            <tr style="background: #f9fafb;">
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التاريخ</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">الكمية</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التاريخ</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">الكمية</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التاريخ</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">الكمية</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التاريخ</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">الكمية</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التاريخ</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">الكمية</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($document->content['path_records']) && is_array($document->content['path_records']) && count($document->content['path_records']) > 0)
                @foreach($document->content['path_records'] as $row)
                    <tr>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['supply_date'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['supply_qty'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['sorting_date'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['sorting_qty'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['mixing_date'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['mixing_qty'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['transformation_date'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['transformation_qty'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['packaging_date'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['packaging_qty'] ?? '-' }}</td>
                    </tr>
                @endforeach
            @else
                @for($i = 0; $i < 8; $i++)
                    <tr>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; height: 28px;">&nbsp;</td>
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>

    <!-- Totals Row (Optional) -->
    <div style="background: #f3f4f6; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; direction: rtl; text-align: right;">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem; direction: rtl;">
            <tr>
                <td style="width: 20%; text-align: center;"><strong>إجمالي التموين</strong><br>{{ $document->content['total_supply'] ?? '___' }} kg</td>
                <td style="width: 20%; text-align: center;"><strong>إجمالي الفرز</strong><br>{{ $document->content['total_sorting'] ?? '___' }} kg</td>
                <td style="width: 20%; text-align: center;"><strong>إجمالي الخلط</strong><br>{{ $document->content['total_mixing'] ?? '___' }} kg</td>
                <td style="width: 20%; text-align: center;"><strong>إجمالي التحويل</strong><br>{{ $document->content['total_transformation'] ?? '___' }} kg</td>
                <td style="width: 20%; text-align: center;"><strong>إجمالي التعبئة</strong><br>{{ $document->content['total_packaging'] ?? '___' }} kg</td>
            </tr>
        </table>
    </div>

    <!-- Signature Section -->
    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; direction: rtl; text-align: right;">
        <p style="margin: 0 0 1rem 0; font-size: 0.875rem; font-weight: 600;">بتأشير مسئول المستودع</p>
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
