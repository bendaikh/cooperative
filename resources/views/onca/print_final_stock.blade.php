<!-- Final Product Stock Print Template -->
<div style="page-break-after: avoid; direction: rtl; text-align: right;">
    <table class="header-table" style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; page-break-after: avoid;">
        <tr>
            <td class="right-box" style="width: 20%; text-align: center; padding: 8px; border: 1px solid #000; vertical-align: middle;">
                <img src="{{ asset('logo.svg') }}" alt="Logo" style="max-height: 70px;">
            </td>
            <td class="center-box" style="width: 60%; text-align: center; padding: 8px; border: 1px solid #000; vertical-align: middle;">
                <div class="title" style="font-size: 22px; font-weight: bold;">سجل دخول وخروج المنتج النهائي</div>
                <!-- Removed English subtitle as per client request -->
            </td>
            <td class="left-box" style="width: 20%; text-align: center; padding: 0; border: 1px solid #000; vertical-align: middle;">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="border-bottom:1px solid #000; padding:6px;">
                            <div class="label" style="font-size: 14px; text-align: right; font-weight: normal;">المرجع:</div>
                            <div>PR-T-EN5</div>
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

    <!-- Stock Table -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; font-size: 0.75rem; border: 1px solid #d1d5db; direction: rtl;">
        <thead>
            <tr style="background: #f3f4f6;">
                <th rowspan="2" style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التاريخ</th>
                <th colspan="4" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">دخول المنتج النهائي</th>
                <th colspan="4" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">خروج المنتج النهائي</th>
                <th rowspan="2" style="width: 12%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">المخزون النهائي</th>
            </tr>
            <tr style="background: #f9fafb;">
                <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">رقم الدفعة</th>
                <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">كمية الوحدة</th>
                <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">العدد</th>
                <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">الكمية الإجمالية</th>
                <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">الزبون المعني</th>
                <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">كمية الوحدة</th>
                <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">العدد</th>
                <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">الكمية الإجمالية</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($document->content['stock_records']) && is_array($document->content['stock_records']) && count($document->content['stock_records']) > 0)
                @foreach($document->content['stock_records'] as $row)
                    <tr>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['date'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['batch_num'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['incoming_unit_qty'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['incoming_count'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['incoming_total_qty'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['customer'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['outgoing_unit_qty'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['outgoing_count'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['outgoing_total_qty'] ?? '-' }}</td>
                        <td style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center;">{{ $row['final_stock'] ?? '-' }}</td>
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

    <!-- Signature Section -->
    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; direction: rtl; text-align: right;">
        <p style="margin: 0 0 1rem 0; font-size: 0.875rem; font-weight: 600;">بتأشير مسئول المستودع / Warehouse Manager Signature</p>
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
