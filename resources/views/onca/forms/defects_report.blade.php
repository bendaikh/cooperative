<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <!-- Defects Report Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">تقرير العيوب / Defects Report</h3>
        
        <!-- Reference Information -->
        <div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 1rem;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">ملف رقم / File Number:</label>
                <input type="text" name="content[file_number]" value="{{ $content['file_number'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">فتح بتاريخ / Date Opened:</label>
                <input type="date" name="content[opened_date]" value="{{ $content['opened_date'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right;">
            </div>
        </div>

        <!-- Survey Period -->
        <div style="border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 1.5rem; overflow: hidden;">
            <div style="background: #f3f4f6; padding: 0.75rem 1rem; border-bottom: 1px solid #d1d5db; font-weight: 600; direction: rtl; text-align: right; font-size: 0.9rem;">فترة الاستقصاء</div>
            <div style="padding: 1rem; direction: rtl; text-align: right;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.85rem;">تاريخ بداية الاستقصاء:</label>
                        <input type="date" name="content[survey_start_date]" value="{{ $content['survey_start_date'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.85rem;">تاريخ نهاية الاستقصاء:</label>
                        <input type="date" name="content[survey_end_date]" value="{{ $content['survey_end_date'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem;">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.85rem;">الساعة (البداية):</label>
                        <input type="time" name="content[survey_start_time]" value="{{ $content['survey_start_time'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.85rem;">الساعة (النهاية):</label>
                        <input type="time" name="content[survey_end_time]" value="{{ $content['survey_end_time'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 1: Product Defects -->
        <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border-radius: 0.375rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; font-size: 0.9rem; direction: rtl; text-align: right;">1. العيوب المتعلقة بالمنتج (المنتجات):</label>
            <textarea name="content[question_1_product_defects]" style="width: 100%; min-height: 100px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="اكتب العيوب المتعلقة بالمنتجات...">{{ $content['question_1_product_defects'] ?? '' }}</textarea>
        </div>

        <!-- Question 2: What Happened -->
        <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border-radius: 0.375rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; font-size: 0.9rem; direction: rtl; text-align: right;">2. ما الذي حدث لشرح مثل هذا الوضع؟</label>
            <textarea name="content[question_2_what_happened]" style="width: 100%; min-height: 100px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="وضح ما حدث...">{{ $content['question_2_what_happened'] ?? '' }}</textarea>
        </div>

        <!-- Question 3: Internal or External Source -->
        <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border-radius: 0.375rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; font-size: 0.9rem; direction: rtl; text-align: right;">3. هل حدثت العيوب بالمنتج (المنتجات) من داخل مؤسستنا أم أنها ناتجة عن مادة أولية أو مادة تعبئة أو مادة أخرى من مزود؟</label>
            <textarea name="content[question_3_source]" style="width: 100%; min-height: 100px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="اختر الخيار المناسب وأضف التفاصيل...">{{ $content['question_3_source'] ?? '' }}</textarea>
        </div>

        <!-- Question 4: Other Products Affected -->
        <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border-radius: 0.375rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; font-size: 0.9rem; direction: rtl; text-align: right;">4. هل يمكن أن تمس هذه العيوب منتجات أخرى من منتجاتنا؟</label>
            <textarea name="content[question_4_other_products]" style="width: 100%; min-height: 100px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="وضح الإجابة...">{{ $content['question_4_other_products'] ?? '' }}</textarea>
        </div>

        <!-- Question 5: Other Customers -->
        <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border-radius: 0.375rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; font-size: 0.9rem; direction: rtl; text-align: right;">5. زبائن آخرون تزودوا بنفس المنتج (المنتجات) وحالة المحزونات لديهم (انظر التسجيل PR-R-EN4):</label>
            <textarea name="content[question_5_other_customers]" style="width: 100%; min-height: 100px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="اذكر تفاصيل العملاء الآخرين...">{{ $content['question_5_other_customers'] ?? '' }}</textarea>
        </div>

        <!-- Question 6: Recall or Collection Required -->
        <div style="border-right: 4px solid #0066cc; background: #f9fafb; padding: 1rem; margin-bottom: 1rem; border-radius: 0.375rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; font-size: 0.9rem; direction: rtl; text-align: right;">6. هل تتطلب العيوب المذكورة السحب أو التجميع؟</label>
            <textarea name="content[question_6_recall_required]" style="width: 100%; min-height: 100px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="اختر الخيار المناسب...">{{ $content['question_6_recall_required'] ?? '' }}</textarea>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; direction: rtl; text-align: right;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">التوقيع / Signature</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
            <div>
                <label class="onca-form-label" style="direction: rtl; text-align: right;">الاسم / Name</label>
                <input type="text" name="content[signature_name]" value="{{ $content['signature_name'] ?? '' }}" class="onca-form-input" style="border: 1px solid #d1d5db; direction: rtl; text-align: right; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.85rem;">
            </div>
            <div>
                <label class="onca-form-label" style="direction: rtl; text-align: right;">التاريخ / Date</label>
                <input type="date" name="content[signature_date]" value="{{ $content['signature_date'] ?? '' }}" class="onca-form-input" style="border: 1px solid #d1d5db; direction: rtl; text-align: right; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.85rem;">
            </div>
            <div>
                <label class="onca-form-label" style="direction: rtl; text-align: right;">التوقيع / Signature</label>
                <input type="text" name="content[signature_signature]" value="{{ $content['signature_signature'] ?? '' }}" class="onca-form-input" style="border: 1px solid #d1d5db; direction: rtl; text-align: right; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.85rem; min-height: 60px;">
            </div>
        </div>
    </div>
</div>
