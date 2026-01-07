<!-- Corrective and Preventive Actions Print Template -->
<div style="page-break-after: avoid;">
    <div class="onca-print-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%); color: white; padding: 1.5rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 0.5rem;">
            @if(file_exists(public_path('logo.png')))
                <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 50px; width: auto;">
            @endif
            <div>
                <h1 style="margin: 0; font-size: 1.5rem; font-weight: bold;">سجل الإجراءات التصحيحية والوقائية</h1>
                <p style="margin: 0; font-size: 0.875rem; opacity: 0.9;">CORRECTIVE AND PREVENTIVE ACTIONS RECORD</p>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; font-size: 0.875rem; margin-top: 1rem; border-top: 1px solid rgba(255,255,255,0.3); padding-top: 1rem;">
            <div>
                <span style="opacity: 0.8;">Reference / المرجع:</span>
                <strong>PR-R-EN8</strong>
            </div>
            <div>
                <span style="opacity: 0.8;">Date / التاريخ:</span>
                <strong>{{ now()->locale('ar')->translatedFormat('d F Y') }}</strong>
            </div>
            <div>
                <span style="opacity: 0.8;">Version / الإصدار:</span>
                <strong>01</strong>
            </div>
        </div>
    </div>

    <!-- Actions Table -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; font-size: 0.875rem; border: 1px solid #d1d5db;">
        <thead>
            <tr style="background: #f3f4f6;">
                <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600;">التاريخ / Date</th>
                <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600;">نوع العملية / Type of Action</th>
                <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600;">وصفها / Description</th>
                <th style="border: 1px solid #d1d5db; padding: 0.75rem; text-align: center; font-weight: 600;">ملاحظات / Notes</th>
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
                <p style="margin: 0; font-size: 0.875rem; font-weight: 600;">بتأشير مسئول الجودة / Quality Manager</p>
                <p style="margin: 0.25rem 0 0; font-size: 0.75rem; color: #666;">التاريخ / Date: _______________</p>
            </div>
            <div style="text-align: center;">
                <div style="height: 60px; border-bottom: 2px solid #000; margin-bottom: 0.5rem;"></div>
                <p style="margin: 0; font-size: 0.875rem; font-weight: 600;">مسئول التطبيق / Implementation Officer</p>
                <p style="margin: 0.25rem 0 0; font-size: 0.75rem; color: #666;">التاريخ / Date: _______________</p>
            </div>
        </div>
    </div>
</div>
