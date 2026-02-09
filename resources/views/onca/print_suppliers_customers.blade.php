<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $document->title }}</title>
    <style>
        @page { size: A4 landscape; margin: 10mm; }
        * { margin: 0; padding: 0; }
        body { 
            font-family: Arial, sans-serif; 
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
            direction: rtl;
        }
        
        .container { width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        td, th { border: 1px solid #000; padding: 6px; font-size: 9px; text-align: center; vertical-align: middle; }
        
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .header-table td { border: 1px solid #000; vertical-align: middle; }
        .right-box { width: 20%; text-align: center; padding: 8px; }
        .right-box img { max-height: 70px; }
        .center-box { width: 60%; text-align: center; padding: 8px; }
        .center-box .title { font-size: 22px; font-weight: bold; }
        .center-box .subtitle { font-size: 18px; margin-top: 5px; }
        .left-box { width: 20%; text-align: center; padding: 0; }
        .left-box .label { font-size: 14px; text-align: right; font-weight: normal; }
        
        .data-table th {
            background: #e5e7eb;
            font-weight: 600;
            padding: 6px;
        }

        .data-table td {
            padding: 4px 6px;
            font-size: 9px;
            height: 40px;
        }
    </style>
</head>
<body>

    @php $c = $document->content ?? []; @endphp

    <div class="container">
        <!-- Header Table: Logo right, Title center, Code/version left -->
        <table class="header-table" style="page-break-after: avoid;">
            <tr>
                <!-- Right: Logo -->
                <td class="right-box">
                    <img src="{{ asset('logo.svg') }}" alt="Logo">
                </td>
                <!-- Center: Title -->
                <td class="center-box">
                    <div class="title">{{ $document->title }}</div>
                    <div class="subtitle">لائحة الزبناء المعنيين بالإنذار</div>
                </td>
                <!-- Left: Code & Version -->
                <td class="left-box">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="border-bottom:1px solid #000; padding:6px;">
                                <div class="label">الرمز:</div>
                                <div>{{ $document->reference ?? 'PR-R-EN4' }}</div>
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

        <!-- Customers Table -->
        @php
            $customers = is_array($c['customers'] ?? null) ? $c['customers'] : [];
        @endphp

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 10%;">اسم الزبون</th>
                    <th style="width: 7%;">نوعه</th>
                    <th style="width: 12%;">عنوانه</th>
                    <th style="width: 10%;">الأشخاص المكلفون بالتواصل</th>
                    <th style="width: 8%;">الهاتف</th>
                    <th style="width: 8%;">الفاكس</th>
                    <th style="width: 10%;">البريد الإلكتروني</th>
                    <th style="width: 10%;">تسمية المنتج</th>
                    <th style="width: 7%;">رقم الدفعة</th>
                    <th style="width: 8%;">الكمية المسلمة (كلغ)</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($customers))
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer['name'] ?? '-' }}</td>
                            <td>{{ $customer['type'] ?? '-' }}</td>
                            <td>{{ $customer['address'] ?? '-' }}</td>
                            <td>{{ $customer['contact_person'] ?? '-' }}</td>
                            <td>{{ $customer['phone'] ?? '-' }}</td>
                            <td>{{ $customer['fax'] ?? '-' }}</td>
                            <td>{{ $customer['email'] ?? '-' }}</td>
                            <td>{{ $customer['product_name'] ?? '-' }}</td>
                            <td>{{ $customer['batch_number'] ?? '-' }}</td>
                            <td>{{ $customer['quantity'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                @else
                    @for($i = 0; $i < 10; $i++)
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    @endfor
                @endif
            </tbody>
        </table>
    </div>

</body>
</html>
