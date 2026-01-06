<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لائحة المشاركين في التكوين - PR-S-EN2</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @media print {
            body {
                margin: 0;
                padding: 10mm;
                background-color: white;
            }
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

        /* Header */
        .print-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #2d5016;
        }

        .company-name {
            font-size: 13px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .print-title {
            font-size: 14px;
            font-weight: bold;
            color: #2d5016;
            margin-bottom: 8px;
        }

        .doc-code {
            font-size: 11px;
            color: #666;
            font-weight: 600;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8fafc;
            border-radius: 4px;
            border-right: 3px solid #2d5016;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
        }

        .info-label {
            font-weight: bold;
            color: #1f2937;
            flex: 0 0 35%;
        }

        .info-value {
            color: #4b5563;
            flex: 1;
            text-align: left;
            padding-left: 10px;
            border-bottom: 1px dotted #d1d5db;
        }

        /* Section Title */
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: white;
            background-color: #2d5016;
            padding: 8px 12px;
            margin: 15px 0 10px 0;
            border-radius: 3px;
        }

        .section-content {
            padding: 10px;
            background-color: #f8fafc;
            border-radius: 3px;
            border-right: 3px solid #2d5016;
            margin-bottom: 10px;
        }

        .content-item {
            margin-bottom: 8px;
            display: flex;
            gap: 10px;
        }

        .content-label {
            font-weight: bold;
            flex: 0 0 25%;
            color: #1f2937;
        }

        .content-value {
            flex: 1;
            color: #4b5563;
            border-bottom: 1px dotted #d1d5db;
            padding-bottom: 2px;
        }

        /* Table Styles */
        .participants-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            background-color: white;
            border: 1px solid #d1d5db;
            font-size: 11px;
        }

        .participants-table thead {
            background-color: #2d5016;
        }

        .participants-table thead th {
            color: white;
            padding: 8px;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #2d5016;
            text-align: center;
        }

        .participants-table tbody td {
            padding: 6px 8px;
            border: 1px solid #d1d5db;
            text-align: right;
        }

        .participants-table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .checkbox-cell {
            text-align: center;
        }

        /* Signature Section */
        .signature-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #d1d5db;
        }

        .signature-block {
            text-align: center;
        }

        .signature-name {
            font-weight: bold;
            margin-bottom: 10px;
            color: #1f2937;
            font-size: 12px;
        }

        .signature-line {
            border-top: 1px solid #333;
            min-height: 50px;
            margin-top: 10px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            font-size: 10px;
            color: #666;
        }

        /* Footer */
        .print-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #d1d5db;
            font-size: 10px;
            color: #999;
        }

        @media print {
            body {
                background-color: white;
            }
            .print-container {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <!-- Header -->
        <div class="print-header">
            <div class="company-name">تعاونية أرور نقادين</div>
            <div class="print-title">لائحة المشاركين في التكوين</div>
            <div class="doc-code">PR-S-EN2 | الإصدار: 01</div>
        </div>

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
                <span class="info-value">{{ $document->content['training_body'] ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">تاريخ التكوين:</span>
                <span class="info-value">
                    @if($document->content['start_date'] ?? null)
                        {{ \Carbon\Carbon::parse($document->content['start_date'])->format('d/m/Y') }}
                        إلى
                        {{ \Carbon\Carbon::parse($document->content['end_date'])->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </span>
            </div>
        </div>

        <!-- Objectives Section -->
        <div class="section-title">أهداف التكوين</div>
        <div class="section-content">
            @php
                $objectives = $document->content['objectives'] ?? [];
            @endphp
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
            @php
                $trainers = $document->content['trainers'] ?? [];
            @endphp
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
                <span class="content-value">{{ $document->content['training_days'] ?? '-' }} أيام</span>
            </div>
            <div class="content-item">
                <span class="content-label">عدد ساعات التكوين:</span>
                <span class="content-value">{{ $document->content['training_hours'] ?? '-' }} ساعة</span>
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
                @php
                    $participants = $document->content['participants'] ?? [];
                @endphp
                @forelse($participants as $participant)
                    <tr>
                        <td>
                            @if($participant['date'] ?? null)
                                {{ \Carbon\Carbon::parse($participant['date'])->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $participant['name'] ?? '-' }}</td>
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
