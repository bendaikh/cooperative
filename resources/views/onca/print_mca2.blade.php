<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سجل التحاليل المكروبيولوجية - MCA-EN2</title>
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
            border-bottom: 2px solid #0284c7;
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
            color: #0284c7;
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
            border-right: 3px solid #0284c7;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
        }

        .info-label {
            font-weight: bold;
            color: #1f2937;
            flex: 0 0 30%;
        }

        .info-value {
            color: #4b5563;
            flex: 1;
            text-align: left;
            padding-left: 10px;
            border-bottom: 1px dotted #d1d5db;
        }

        /* Table Styles */
        .analysis-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            background-color: white;
            border: 1px solid #d1d5db;
            font-size: 11px;
        }

        .analysis-table thead {
            background-color: #0284c7;
        }

        .analysis-table thead th {
            color: white;
            padding: 8px;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #0284c7;
            text-align: center;
        }

        .analysis-table tbody td {
            padding: 6px 8px;
            border: 1px solid #d1d5db;
            text-align: center;
        }

        .analysis-table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .analysis-date,
        .analysis-type,
        .analysis-result,
        .analysis-actions {
            text-align: right;
            font-weight: 500;
        }

        /* Section Title */
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: white;
            background-color: #0284c7;
            padding: 8px 12px;
            margin-bottom: 10px;
            border-radius: 3px;
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
            <div class="print-title">سجل التحاليل المكروبيولوجية للمنتج النهائي</div>
            <div class="doc-code">MCA-EN2 | الإصدار: 01</div>
        </div>

        <!-- Product Info -->
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">المنتج (رقم الدفعة):</span>
                <span class="info-value">{{ $document->content['product_batch'] ?? '-' }}</span>
            </div>
        </div>

        <!-- Analysis Results -->
        <div>
            <div class="section-title">سجل التحاليل المكروبيولوجية</div>
            <table class="analysis-table">
                <thead>
                    <tr style="border-bottom: 1px solid #d1d5db;">
                        <th rowspan="2" style="border-right: 1px solid #d1d5db; padding: 8px; vertical-align: bottom;">المنتج (رقم الدفعة)</th>
                        <th rowspan="2" style="border-right: 1px solid #d1d5db; padding: 8px; vertical-align: bottom;">تاريخ التحاليل</th>
                        <th rowspan="2" style="border-right: 1px solid #d1d5db; padding: 8px; vertical-align: bottom;">رقم تقرير التحاليل</th>
                        <th colspan="2" style="border-right: 1px solid #d1d5db; padding: 8px; text-align: center;">خلاصة التحاليل (مطابق)</th>
                        <th rowspan="2" style="border-right: 1px solid #d1d5db; padding: 8px; vertical-align: bottom;">التدابير التصحيحية (تاريخ الإتلاف)</th>
                    </tr>
                    <tr>
                        <th style="border-right: 1px solid #d1d5db; padding: 8px; text-align: center; font-size: 10px;">نعم</th>
                        <th style="border-right: 1px solid #d1d5db; padding: 8px; text-align: center; font-size: 10px;">لا</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $analyses = $document->content['analyses'] ?? [];
                    @endphp
                    @forelse($analyses as $analysis)
                        <tr>
                            <td style="border-right: 1px solid #d1d5db; padding: 6px 8px; text-align: right;">{{ $analysis['product'] ?? '-' }}</td>
                            <td style="border-right: 1px solid #d1d5db; padding: 6px 8px; text-align: right;">
                                @if($analysis['date'] ?? null)
                                    {{ \Carbon\Carbon::parse($analysis['date'])->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td style="border-right: 1px solid #d1d5db; padding: 6px 8px; text-align: right;">{{ $analysis['report_number'] ?? '-' }}</td>
                            <td style="border-right: 1px solid #d1d5db; padding: 6px 8px; text-align: center;">{{ ($analysis['compliant'] ?? '') === 'yes' ? '✓' : '' }}</td>
                            <td style="border-right: 1px solid #d1d5db; padding: 6px 8px; text-align: center;">{{ ($analysis['non_compliant'] ?? '') === 'yes' ? '✓' : '' }}</td>
                            <td style="border-right: 1px solid #d1d5db; padding: 6px 8px; text-align: right;">{{ $analysis['actions'] ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #999; padding: 10px;">لا توجد بيانات</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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
