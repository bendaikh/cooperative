<div style="direction: rtl; text-align: right; margin: 0; padding: 0; page-break-inside: avoid; width: 100vw; max-width: 100vw; overflow: hidden;">
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
        @media print {
            html, body, div[style*='direction: rtl'] {
                width: 100vw !important;
                max-width: 100vw !important;
                overflow: hidden !important;
                page-break-inside: avoid !important;
            }
            .header-table, .header-table td, table, tr, td, th, div, label {
                page-break-inside: avoid !important;
            }
        }
    </style>

    <table class="header-table" style="page-break-after: avoid;">
        <tr>
            <td class="right-box">
                <img src="{{ asset('logo.svg') }}" alt="Logo">
            </td>
            <td class="center-box">
                <div class="title">استقصاء:</div>
                <div class="subtitle">{{ $document->title }}</div>
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

    <!-- Reference Information -->
    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; padding: 0 0.5rem; page-break-inside: avoid;">
        <div style="flex: 1;">
            <label style="font-weight: bold; font-size: 0.85rem;">ملف رقم:</label>
            <div style="border-bottom: 1px solid #333; min-height: 25px; margin-top: 0.25rem;"></div>
        </div>
        <div style="flex: 1;">
            <label style="font-weight: bold; font-size: 0.85rem; text-align: left;">فتح بتاريخ:</label>
            <div style="border-bottom: 1px solid #333; min-height: 25px; margin-top: 0.25rem;"></div>
        </div>
    </div>

    <!-- Survey Period -->
    <div style="border: 1px solid #999; margin-bottom: 1.5rem; page-break-inside: avoid;">
        <div style="background-color: #f0f0f0; padding: 0.75rem; border-bottom: 1px solid #999; font-weight: bold; font-size: 0.85rem;">فترة الاستقصاء</div>
        <div style="padding: 1rem;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #999; padding: 0.75rem; font-size: 0.85rem; width: 50%;">تاريخ بداية الاستقصاء:</td>
                    <td style="border: 1px solid #999; padding: 0.75rem; font-size: 0.85rem; text-align: center; min-height: 25px;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #999; padding: 0.75rem; font-size: 0.85rem;">تاريخ نهاية الاستقصاء:</td>
                    <td style="border: 1px solid #999; padding: 0.75rem; font-size: 0.85rem; text-align: center; min-height: 25px;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #999; padding: 0.75rem; font-size: 0.85rem;">الساعة (البداية):</td>
                    <td style="border: 1px solid #999; padding: 0.75rem; font-size: 0.85rem; text-align: center; min-height: 25px;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #999; padding: 0.75rem; font-size: 0.85rem;">الساعة (النهاية):</td>
                    <td style="border: 1px solid #999; padding: 0.75rem; font-size: 0.85rem; text-align: center; min-height: 25px;"></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Question 1 -->
    <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border: 1px solid #999; page-break-inside: avoid;">
        <div style="font-weight: bold; margin-bottom: 0.75rem; font-size: 0.85rem;">1. العيوب المتعلقة بالمنتج (المنتجات):</div>
        <div style="min-height: 80px; border: 1px solid #999; padding: 0.5rem;"></div>
    </div>

    <!-- Question 2 -->
    <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border: 1px solid #999;">
        <div style="font-weight: bold; margin-bottom: 0.75rem; font-size: 0.85rem;">2. ما الذي حدث لشرح مثل هذا الوضع؟</div>
        <div style="min-height: 80px; border: 1px solid #999; padding: 0.5rem;"></div>
    </div>

    <!-- Question 3 -->
    <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border: 1px solid #999;">
        <div style="font-weight: bold; margin-bottom: 0.75rem; font-size: 0.85rem;">3. هل حدثت العيوب بالمنتج (المنتجات) من داخل مؤسستنا أم أنها ناتجة عن مادة أولية أو مادة تعبئة أو مادة أخرى من مزود؟</div>
        <div style="min-height: 80px; border: 1px solid #999; padding: 0.5rem;"></div>
    </div>

    <!-- Question 4 -->
    <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border: 1px solid #999;">
        <div style="font-weight: bold; margin-bottom: 0.75rem; font-size: 0.85rem;">4. هل يمكن أن تمس هذه العيوب منتجات أخرى من منتجاتنا؟</div>
        <div style="min-height: 80px; border: 1px solid #999; padding: 0.5rem;"></div>
    </div>

    <!-- Question 5 -->
    <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border: 1px solid #999;">
        <div style="font-weight: bold; margin-bottom: 0.75rem; font-size: 0.85rem;">5. زبائن آخرون تزودوا بنفس المنتج (المنتجات) وحالة المحزونات لديهم (انظر التسجيل PR-R-EN4):</div>
        <div style="min-height: 80px; border: 1px solid #999; padding: 0.5rem;"></div>
    </div>

    <!-- Question 6 -->
    <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border: 1px solid #999;">
        <div style="font-weight: bold; margin-bottom: 0.75rem; font-size: 0.85rem;">6. هل تتطلب العيوب المذكورة السحب أو التجميع؟</div>
        <div style="min-height: 80px; border: 1px solid #999; padding: 0.5rem;"></div>
    </div>

    <!-- Signature Section -->
    <div style="margin-top: 2rem; text-align: center;">
        <div style="font-weight: bold; margin-bottom: 1.5rem; font-size: 0.85rem;">تأشير مسئول الجودة:</div>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 33%; text-align: center; padding: 1rem; border: 1px solid #999;">
                    <div style="font-weight: bold; font-size: 0.8rem; margin-bottom: 1rem;">الاسم</div>
                    <div style="border-bottom: 1px solid #333; min-height: 40px;"></div>
                </td>
                <td style="width: 33%; text-align: center; padding: 1rem; border: 1px solid #999;">
                    <div style="font-weight: bold; font-size: 0.8rem; margin-bottom: 1rem;">التاريخ</div>
                    <div style="border-bottom: 1px solid #333; min-height: 40px;"></div>
                </td>
                <td style="width: 34%; text-align: center; padding: 1rem; border: 1px solid #999;">
                    <div style="font-weight: bold; font-size: 0.8rem; margin-bottom: 1rem;">التوقيع</div>
                    <div style="border-bottom: 1px solid #333; min-height: 40px;"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
