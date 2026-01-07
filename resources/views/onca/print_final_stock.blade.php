<!-- Final Product Stock Print Template -->
<div style="page-break-after: avoid; direction: rtl; text-align: right;">
    <div class="onca-print-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 1.5rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 0.5rem; flex-direction: row-reverse;">
            @if(file_exists(public_path('logo.png')))
                <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 50px; width: auto;">
            @endif
            <div style="text-align: right;">
                <h1 style="margin: 0; font-size: 1.5rem; font-weight: bold;">سجل دخول وخروج المنتج النهائي</h1>
                <p style="margin: 0; font-size: 0.875rem; opacity: 0.9;">FINAL PRODUCT STOCK REGISTER</p>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; font-size: 0.875rem; margin-top: 1rem; border-top: 1px solid rgba(255,255,255,0.3); padding-top: 1rem; text-align: right;">
            <div>
                <span style="opacity: 0.8;">Version / الإصدار:</span>
                <strong>01</strong>
            </div>
            <div>
                <span style="opacity: 0.8;">Period / الفترة:</span>
                <strong>{{ now()->locale('ar')->translatedFormat('F Y') }}</strong>
            </div>
            <div>
                <span style="opacity: 0.8;">Reference / المرجع:</span>
                <strong>PR-T-EN5</strong>
            </div>
        </div>
    </div>

    <!-- Stock Table -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; font-size: 0.75rem; border: 1px solid #d1d5db; direction: rtl;">
        <thead>
            <tr style="background: #f3f4f6;">
                <th rowspan="2" style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">التاريخ / Date</th>
                <th colspan="4" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">دخول المنتج النهائي / Incoming Final Product</th>
                <th colspan="4" style="border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">خروج المنتج النهائي / Outgoing Final Product</th>
                <th rowspan="2" style="width: 12%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600;">المخزون النهائي / Final Stock</th>
            </tr>
            <tr style="background: #f9fafb;">
                <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">رقم الدفعة / Batch #</th>
                <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">كمية الوحدة / Unit Qty</th>
                <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">العدد / Qty</th>
                <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">الكمية الإجمالية / Total</th>
                <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">الزبون المعني / Customer</th>
                <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">كمية الوحدة / Unit Qty</th>
                <th style="width: 8%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">العدد / Qty</th>
                <th style="width: 10%; border: 1px solid #d1d5db; padding: 0.5rem; text-align: center; font-weight: 600; font-size: 0.7rem;">الكمية الإجمالية / Total</th>
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
