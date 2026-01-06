<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لائحة المشاركين في التكوين - {{ $document->reference }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', 'Traditional Arabic', sans-serif;
            color: #333;
            line-height: 1.4;
            background: #f5f5f5;
            direction: rtl;
        }

        .container {
            width: 8.5in;
            height: auto;
            background: white;
            margin: 10px auto;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            direction: rtl;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border: 2px solid #333;
            border-bottom: 3px solid #333;
            padding: 15px;
        }

        .logo {
            font-size: 16px;
            font-weight: bold;
            color: #2d7a52;
            margin-bottom: 8px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 11px;
            color: #6b7280;
        }

        .meta-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 18px;
            padding: 12px;
            border: 1px solid #333;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            text-align: right;
        }

        .meta-label {
            font-size: 10px;
            font-weight: bold;
            color: #333;
            margin-bottom: 2px;
        }

        .meta-value {
            font-size: 11px;
            color: #1f2937;
            border-bottom: 1px solid #ccc;
            padding-bottom: 2px;
            min-height: 16px;
        }

        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 1.5px solid #333;
        }

        .section-content {
            padding: 10px;
            font-size: 11px;
            color: #4b5563;
            line-height: 1.5;
        }

        .field {
            margin-bottom: 8px;
            text-align: right;
        }

        .field-label {
            font-weight: bold;
            color: #1f2937;
            font-size: 11px;
            margin-bottom: 2px;
            display: block;
        }

        .field-value {
            color: #4b5563;
            font-size: 10px;
            word-wrap: break-word;
            white-space: normal;
            padding-right: 10px;
        }

        .list-items {
            padding-right: 20px;
        }

        .list-item {
            font-size: 10px;
            margin-bottom: 4px;
            text-align: right;
        }

        .list-item::before {
            content: "• ";
            margin-left: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
            font-size: 10px;
        }

        table th {
            background: #0ea5e9;
            color: white;
            padding: 8px;
            border: 1px solid #333;
            text-align: right;
            font-weight: bold;
        }

        table td {
            border: 1px solid #999;
            padding: 6px;
            text-align: right;
            height: 25px;
        }

        .footer {
            margin-top: 20px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }

        .signature-block {
            margin-top: 15px;
            text-align: center;
            font-size: 10px;
            padding-top: 15px;
            border-top: 1px solid #999;
        }

        .signature-line {
            width: 120px;
            height: 0.5px;
            background: #333;
            margin: 8px auto 3px;
        }

        .document-link {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            background: #0ea5e9;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 10px;
        }

        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }
            .container {
                margin: 0;
                padding: 20px;
                box-shadow: none;
                width: 100%;
            }
            .document-link {
                display: none;
            }
            @page {
                margin: 0.5in;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">تعاونية أنرار نتقادرين</div>
            <div class="title">لائحة المشاركين في التكوين</div>
            <div class="subtitle">Liste des Participants à la Formation</div>
        </div>

        <!-- Metadata -->
        <div class="meta-info">
            <div class="meta-item">
                <span class="meta-label">الرمز:</span>
                <span class="meta-value">{{ $document->reference }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">الإصدار:</span>
                <span class="meta-value">{{ $document->version }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">التاريخ:</span>
                <span class="meta-value">{{ $document->date->format('d/m/Y') }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">المسؤول:</span>
                <span class="meta-value">{{ $document->responsible ?? '' }}</span>
            </div>
        </div>

        <!-- Section 1: Training Subject -->
        @if($document->content['training_subject'] ?? null)
        <div class="section">
            <div class="section-title">1. موضوع التكوين</div>
            <div class="section-content">
                <div class="field">
                    <div class="field-value">{{ $document->content['training_subject'] }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Section 2: Objectives -->
        @if(isset($document->content['objectives']) && !empty(array_filter($document->content['objectives'])))
        <div class="section">
            <div class="section-title">2. أهداف التكوين</div>
            <div class="section-content list-items">
                @foreach($document->content['objectives'] as $objective)
                    @if($objective)
                    <div class="list-item">{{ $objective }}</div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Section 3: Training Body -->
        @if($document->content['training_body']['name'] ?? null)
        <div class="section">
            <div class="section-title">3. الهيئة المكلفة بتقديم التكوين</div>
            <div class="section-content">
                <div class="field">
                    <div class="field-value">{{ $document->content['training_body']['name'] }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Section 4: Trainers -->
        @if(isset($document->content['trainers']) && !empty(array_filter($document->content['trainers'])))
        <div class="section">
            <div class="section-title">4. المكونون</div>
            <div class="section-content list-items">
                @foreach($document->content['trainers'] as $trainer)
                    @if($trainer)
                    <div class="list-item">{{ $trainer }}</div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Section 5: Training Details -->
        @if(isset($document->content['training_dates']))
        <div class="section">
            <div class="section-title">5. تفاصيل التكوين</div>
            <div class="section-content">
                @if($document->content['training_dates']['start_date'] ?? null)
                <div class="field">
                    <span class="field-label">يوم البدء:</span>
                    <div class="field-value">{{ \Carbon\Carbon::parse($document->content['training_dates']['start_date'])->format('d/m/Y') }}</div>
                </div>
                @endif
                
                @if($document->content['training_dates']['end_date'] ?? null)
                <div class="field">
                    <span class="field-label">يوم الانتهاء:</span>
                    <div class="field-value">{{ \Carbon\Carbon::parse($document->content['training_dates']['end_date'])->format('d/m/Y') }}</div>
                </div>
                @endif
                
                @if($document->content['training_dates']['number_of_days'] ?? null)
                <div class="field">
                    <span class="field-label">عدد أيام التكوين:</span>
                    <div class="field-value">{{ $document->content['training_dates']['number_of_days'] }}</div>
                </div>
                @endif
                
                @if($document->content['training_dates']['number_of_hours'] ?? null)
                <div class="field">
                    <span class="field-label">عدد ساعات التكوين:</span>
                    <div class="field-value">{{ $document->content['training_dates']['number_of_hours'] }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 6: Training Location -->
        @if($document->content['training_location'] ?? null)
        <div class="section">
            <div class="section-title">مكان التكوين</div>
            <div class="section-content">
                <div class="field">
                    <div class="field-value">{{ $document->content['training_location'] }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Section 7: Participants Table -->
        @if(isset($document->content['participants']) && !empty(array_filter($document->content['participants'])))
        <div class="section">
            <div class="section-title">6. لائحة المشاركين في التكوين</div>
            <table>
                <thead>
                    <tr>
                        <th>التأشير</th>
                        <th>الاسم الكامل</th>
                        <th>النطاق الزمني</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($document->content['participants'] as $participant)
                        @if($participant['full_name'] ?? null)
                        <tr>
                            <td>{{ $participant['signature'] ?? '' }}</td>
                            <td>{{ $participant['full_name'] ?? '' }}</td>
                            <td>{{ $participant['time_range'] ?? '' }}</td>
                            <td>{{ $participant['date'] ? \Carbon\Carbon::parse($participant['date'])->format('d/m/Y') : '' }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Section 8: Signature -->
        <div class="section">
            <div class="section-title">7. تأشير مسؤول الجودة</div>
            <div class="section-content">
                @if($document->content['quality_officer_name'] ?? null)
                <div class="field">
                    <span class="field-label">اسم مسؤول الجودة:</span>
                    <div class="field-value">{{ $document->content['quality_officer_name'] }}</div>
                </div>
                @endif
                
                @if($document->content['signature_date'] ?? null)
                <div class="field">
                    <span class="field-label">التاريخ:</span>
                    <div class="field-value">{{ \Carbon\Carbon::parse($document->content['signature_date'])->format('d/m/Y') }}</div>
                </div>
                @endif

                <div class="signature-block">
                    <div class="signature-line"></div>
                    <p style="margin-top: 3px;">توقيع مسؤول الجودة</p>
                </div>
            </div>
        </div>

        <!-- Document Link if available -->
        @if($document->document_url)
        <div style="text-align: center; margin-top: 12px;">
            <a href="{{ $document->document_url }}" target="_blank" class="document-link">
                📎 المستند الأصلي
            </a>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>تم توليد المستند في {{ now()->format('d/m/Y H:i') }} | تعاونية أنرار نتقادرين</p>
        </div>
    </div>
</body>
</html>
