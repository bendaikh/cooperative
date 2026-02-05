<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لائحة المشاركين في التكوين - {{ $document->reference }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @page { size: A4 portrait; margin: 10mm; }
        @media print {
            body { margin: 0; padding: 0; background-color: white; }
            .print-container { box-shadow: none; margin: 0; padding: 0; width: 100%; max-width: 100%; }
        }
        body {
            font-family: 'Arial', 'Helvetica Neue', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background-color: #f5f5f5;
            direction: rtl;
            text-align: right;
            padding: 20px;
        }
        .print-container {
            background-color: white;
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; page-break-after: avoid; direction: rtl; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 8px; }
        .right-box img { max-height: 70px; }
        .center-box { width: 60%; text-align: center; padding: 8px; }
        .center-box .title { font-size: 22px; font-weight: bold; }
        .center-box .subtitle { font-size: 15px; color: #444; margin-top: 2px; }
        .left-box { width: 20%; text-align: center; padding: 0; }
        .left-box .label { font-size: 14px; text-align: right; font-weight: normal; }
        .meta-info { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 18px; padding: 12px; border: 1px solid #333; }
        .meta-item { display: flex; flex-direction: column; text-align: right; }
        .meta-label { font-size: 10px; font-weight: bold; color: #333; margin-bottom: 2px; }
        .meta-value { font-size: 11px; color: #1f2937; border-bottom: 1px solid #ccc; padding-bottom: 2px; min-height: 16px; }
        .section { margin-bottom: 15px; page-break-inside: avoid; }
        .section-title { font-size: 12px; font-weight: bold; color: #1f2937; margin-bottom: 8px; padding-bottom: 5px; border-bottom: 1.5px solid #333; }
        .section-content { padding: 10px; font-size: 11px; color: #4b5563; line-height: 1.5; }
        .field { margin-bottom: 8px; text-align: right; }
        .field-label { font-weight: bold; color: #1f2937; font-size: 11px; margin-bottom: 2px; display: block; }
        .field-value { color: #4b5563; font-size: 10px; word-wrap: break-word; white-space: normal; padding-right: 10px; }
        .list-items { padding-right: 20px; }
        .list-item { font-size: 10px; margin-bottom: 4px; text-align: right; }
        .list-item::before { content: "• "; margin-left: 8px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 8px; font-size: 10px; }
        table th { background: #0ea5e9; color: white; padding: 8px; border: 1px solid #333; text-align: right; font-weight: bold; }
        table td { border: 1px solid #999; padding: 6px; text-align: right; height: 25px; }
        .footer { margin-top: 20px; padding-top: 12px; border-top: 1px solid #e5e7eb; text-align: center; font-size: 10px; color: #6b7280; }
        .signature-block { margin-top: 15px; text-align: center; font-size: 10px; padding-top: 15px; border-top: 1px solid #999; }
        .signature-line { width: 120px; height: 0.5px; background: #333; margin: 8px auto 3px; }
        .document-link { display: inline-block; margin-top: 10px; padding: 6px 12px; background: #0ea5e9; color: white; text-decoration: none; border-radius: 3px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="print-container">
        <!-- Unified ONCA Header -->
        <table class="header-table">
            <tr>
                <td class="right-box">
                    <img src="{{ asset('logo.svg') }}" alt="Logo" style="max-height: 70px;">
                </td>
                <td class="center-box">
                    <div class="title">لائحة المشاركين في التكوين</div>
                </td>
                <td class="left-box">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="border-bottom:1px solid #000; padding:6px;">
                                <div class="label">الرمز:</div>
                                <div>{{ $document->reference ?? 'PR-S-EN2' }}</div>
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

        <!-- Training Info -->
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">موضوع التكوين:</span>
                <span class="info-value">{{ $document->content['training_subject'] ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">مكان التكوين:</span>
                <span class="info-value">{{ $document->content['training_location'] ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">الهيئة المكلفة:</span>
                <span class="info-value">{{ $document->content['training_body']['name'] ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">تاريخ التكوين:</span>
                <span class="info-value">
                    @if($document->content['training_dates']['start_date'] ?? null)
                        {{ \Carbon\Carbon::parse($document->content['training_dates']['start_date'])->format('d/m/Y') }}
                        إلى
                        {{ \Carbon\Carbon::parse($document->content['training_dates']['end_date'])->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </span>
            </div>
        </div>

        <!-- Objectives Section -->
        <div class="section-title">أهداف التكوين</div>
        <div class="section-content">
            @php $objectives = $document->content['objectives'] ?? []; @endphp
            @forelse($objectives as $i => $objective)
                @if($objective)
                    <div class="content-item">
                        <span class="content-label">الهدف {{ $i + 1 }}:</span>
                        <span class="content-value">{{ $objective }}</span>
                    </div>
                @endif
            @empty
                <div style="color: #999; text-align: center;">لا توجد أهداف محددة</div>
            @endforelse
        </div>

        <!-- Trainers Section -->
        <div class="section-title">المكونون</div>
        <div class="section-content">
            @php $trainers = $document->content['trainers'] ?? []; @endphp
            @forelse($trainers as $i => $trainer)
                @if($trainer)
                    <div class="content-item">
                        <span class="content-label">المكون {{ $i + 1 }}:</span>
                        <span class="content-value">{{ $trainer }}</span>
                    </div>
                @endif
            @empty
                <div style="color: #999; text-align: center;">لم يتم تحديد مكونين</div>
            @endforelse
        </div>

        <!-- Training Duration Section -->
        <div class="section-title">معلومات التكوين</div>
        <div class="section-content">
            <div class="content-item">
                <span class="content-label">عدد أيام التكوين:</span>
                <span class="content-value">{{ $document->content['training_dates']['number_of_days'] ?? '-' }} أيام</span>
            </div>
            <div class="content-item">
                <span class="content-label">عدد ساعات التكوين:</span>
                <span class="content-value">{{ $document->content['training_dates']['number_of_hours'] ?? '-' }} ساعة</span>
            </div>
        </div>

        <!-- Participants Table -->
        <div class="section-title">المشاركون والفترات الزمنية</div>
        <table class="participants-table">
            <thead>
                <tr>
                    <th style="width: 12%;">التاريخ</th>
                    <th style="width: 28%;">الاسم الكامل</th>
                    <th style="width: 20%;">النطاق الزمني</th>
                    <th style="width: 25%;">فترة التكوين</th>
                    <th style="width: 10%; text-align: center;">التأشير</th>
                </tr>
            </thead>
            <tbody>
                @php $participants = $document->content['participants'] ?? []; @endphp
                @forelse($participants as $participant)
                    <tr>
                        <td>
                            @if($participant['date'] ?? null)
                                {{ \Carbon\Carbon::parse($participant['date'])->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $participant['full_name'] ?? '-' }}</td>
                        <td>{{ $participant['time_range'] ?? '-' }}</td>
                        <td>{{ $participant['period'] ?? '-' }}</td>
                        <td class="checkbox-cell">{{ ($participant['signature'] ?? '') === 'yes' ? '✓' : '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #999;">لا يوجد مشاركون</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-block">
                <div class="signature-name">{{ $document->content['quality_officer_name'] ?? 'مسؤول الجودة' }}</div>
                <div class="signature-line"></div>
            </div>
            <div class="signature-block">
                <div class="signature-name">
                    @if($document->content['signature_date'] ?? null)
                        {{ \Carbon\Carbon::parse($document->content['signature_date'])->format('d/m/Y') }}
                    @else
                        التاريخ
                    @endif
                </div>
                <div class="signature-line"></div>
            </div>
        </div>

        <!-- Footer -->
        <div class="print-footer">
            <p>تم طباعة هذا المستند في {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</body>
</html>
