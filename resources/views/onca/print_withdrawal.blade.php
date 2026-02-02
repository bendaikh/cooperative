<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استمارة اشعار بالسحب - {{ $document->reference }}</title>
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

        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 8px; }
        .right-box img { max-height: 70px; }
        .center-box { width: 60%; text-align: center; padding: 8px; }
        .center-box .title { font-size: 22px; font-weight: bold; }
        .center-box .subtitle { font-size: 18px; margin-top: 5px; }
        .left-box { width: 20%; text-align: center; padding: 0; }
        .left-box .label { font-size: 14px; text-align: right; font-weight: normal; }

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
            border: 1px solid #999;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #fff;
            background: #dc2626;
            margin-bottom: 0;
            padding: 8px;
            text-align: right;
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
            border-right: 2px solid #999;
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
            background: #dc2626;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        table td {
            border: 1px solid #999;
            padding: 5px;
            font-size: 10px;
            text-align: right;
        }

        table td.label {
            font-weight: bold;
            background: #f0f0f0;
            width: 35%;
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
        <table class="header-table" style="page-break-after: avoid;">
            <tr>
                <td class="right-box">
                    <img src="{{ asset('logo.svg') }}" alt="Logo">
                </td>
                <td class="center-box">
                    <div class="title">تسجيل:</div>
                    <div class="subtitle">{{ $document->title ?? 'استمارة اشعار بالسحب' }}</div>
                </td>
                <td class="left-box">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="border-bottom:1px solid #000; padding:6px;">
                                <div class="label">الرمز:</div>
                                <div>{{ $document->reference ?? '' }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:6px;">
                                <div class="label">الإصدار:</div>
                                <div>{{ $document->version ?? '' }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Metadata -->
        <div class="meta-info">
            <div class="meta-item">
                <span class="meta-label">ملف رقم :</span>
                <span class="meta-value">{{ $document->file_number ?? '' }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">فتح بتاريخ:</span>
                <span class="meta-value">{{ $document->date->format('d/m/Y') }}</span>
            </div>
        </div>

        <!-- Section 1: Product Information -->
        @if(isset($document->content['product']))
        <div class="section">
            <div class="section-title">1. معلومات المنتج المسحوب</div>
            <div class="section-content">
                @if($document->content['product']['name'] ?? null)
                <div class="field">
                    <span class="field-label">اسم المنتج</span>
                    <div class="field-value">{{ $document->content['product']['name'] }}</div>
                </div>
                @endif
                
                @if($document->content['product']['brand'] ?? null)
                <div class="field">
                    <span class="field-label">ماركة المنتج</span>
                    <div class="field-value">{{ $document->content['product']['brand'] }}</div>
                </div>
                @endif
                
                @if($document->content['product']['batch_number'] ?? null)
                <div class="field">
                    <span class="field-label">رقم الدفعة</span>
                    <div class="field-value">{{ $document->content['product']['batch_number'] }}</div>
                </div>
                @endif
                
                @if($document->content['product']['expiry_date'] ?? null)
                <div class="field">
                    <span class="field-label">صلاحية المنتج</span>
                    <div class="field-value">{{ \Carbon\Carbon::parse($document->content['product']['expiry_date'])->format('d/m/Y') }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 2: Reason for Withdrawal -->
        @if(isset($document->content['reason']))
        <div class="section">
            <div class="section-title">2. سبب السحب من السوق</div>
            <div class="section-content">
                @if($document->content['reason']['category'] ?? null)
                <div class="field">
                    <span class="field-label">تصنيف السبب</span>
                    <div class="field-value">
                        @php
                            $categories = [
                                'quality_issue' => 'مشكلة جودة',
                                'contamination' => 'تلوث',
                                'safety_concern' => 'مخاوف سلامة',
                                'expired' => 'انتهاء الصلاحية',
                                'regulatory' => 'مخالفة تنظيمية',
                                'other' => 'أخرى'
                            ];
                        @endphp
                        {{ $categories[$document->content['reason']['category']] ?? $document->content['reason']['category'] }}
                    </div>
                </div>
                @endif
                
                @if($document->content['reason']['description'] ?? null)
                <div class="field">
                    <span class="field-label">وصف مفصل للسبب</span>
                    <div class="field-value">{{ nl2br(e($document->content['reason']['description'])) }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 3: Scope -->
        @if(isset($document->content['scope']))
        <div class="section">
            <div class="section-title">3. نطاق السحب</div>
            <div class="section-content">
                @if($document->content['scope']['quantity'] ?? null)
                <div class="field">
                    <span class="field-label">الكمية المسحوبة</span>
                    <div class="field-value">{{ $document->content['scope']['quantity'] }} {{ $document->content['scope']['unit'] ?? '' }}</div>
                </div>
                @endif
                
                @if($document->content['scope']['distribution'] ?? null)
                <div class="field">
                    <span class="field-label">نطاق التوزيع</span>
                    <div class="field-value">{{ $document->content['scope']['distribution'] }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 4: Actions Taken -->
        @if(isset($document->content['actions']))
        <div class="section">
            <div class="section-title">4. الإجراءات المتخذة</div>
            <div class="section-content">
                @if($document->content['actions']['measures_taken'] ?? null)
                <div class="field">
                    <span class="field-label">الإجراءات المتخذة</span>
                    <div class="field-value">{{ nl2br(e($document->content['actions']['measures_taken'])) }}</div>
                </div>
                @endif
                
                @if($document->content['actions']['investigation_result'] ?? null)
                <div class="field">
                    <span class="field-label">نتيجة التحقيق</span>
                    <div class="field-value">{{ nl2br(e($document->content['actions']['investigation_result'])) }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Section 5: Signature -->
        <div class="section">
            <div class="section-title">5. توقيع مدير المؤسسة</div>
            <div class="section-content">
                @if(isset($document->content['signature']))
                    @if($document->content['signature']['manager_name'] ?? null)
                    <div class="field">
                        <span class="field-label">اسم مدير المؤسسة</span>
                        <div class="field-value">{{ $document->content['signature']['manager_name'] }}</div>
                    </div>
                    @endif
                    
                    @if($document->content['signature']['date'] ?? null)
                    <div class="field">
                        <span class="field-label">التاريخ</span>
                        <div class="field-value">{{ \Carbon\Carbon::parse($document->content['signature']['date'])->format('d/m/Y') }}</div>
                    </div>
                    @endif
                @endif

                <div class="signature-block">
                    <div class="signature-line"></div>
                    <p style="margin-top: 3px;">توقيع مدير المؤسسة</p>
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
