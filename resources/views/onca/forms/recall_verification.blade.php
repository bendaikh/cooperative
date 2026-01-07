<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <!-- Recall Verification Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">التحقق من عملية السحب أو التجميع / Recall/Collection Verification</h3>
        
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

        <!-- Customer Notification Section -->
        <div style="border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 1.5rem; overflow: hidden;">
            <div style="background: #f3f4f6; padding: 0.75rem 1rem; border-bottom: 1px solid #d1d5db; font-weight: 600; direction: rtl; text-align: right; font-size: 0.9rem;">إشعار العملاء</div>
            <div style="padding: 1rem; direction: rtl; text-align: right;">
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.85rem;">عدد الزبائن الذين تم إشعارهم:</label>
                    <input type="number" name="content[customers_notified]" value="{{ $content['customers_notified'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; text-align: center;">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.85rem;">عدد الزبائن الذين تم التحقق من استلامهم للإشعار:</label>
                    <input type="number" name="content[customers_verified_receipt]" value="{{ $content['customers_verified_receipt'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; text-align: center;">
                </div>
                <div style="margin-bottom: 0;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.85rem;">عدد الزبائن الذين أكدوا استلام الإشعار:</label>
                    <input type="number" name="content[customers_confirmed_receipt]" value="{{ $content['customers_confirmed_receipt'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; text-align: center;">
                </div>
            </div>
        </div>

        <!-- Notification Verification Method -->
        <div style="border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 1.5rem; overflow: hidden;">
            <div style="background: #f3f4f6; padding: 0.75rem 1rem; border-bottom: 1px solid #d1d5db; font-weight: 600; direction: rtl; text-align: right; font-size: 0.9rem;">كيفية التأكد من أن الزبائن أشعروا</div>
            <div style="padding: 1rem;">
                <textarea name="content[notification_verification_method]" style="width: 100%; min-height: 100px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="اشرح الطرق المستخدمة للتأكد من إشعار الزبائن...">{{ $content['notification_verification_method'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Effectiveness Determination -->
        <div style="border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 1.5rem; overflow: hidden;">
            <div style="background: #f3f4f6; padding: 0.75rem 1rem; border-bottom: 1px solid #d1d5db; font-weight: 600; direction: rtl; text-align: right; font-size: 0.9rem;">كيف تم تحديد فعالية السحب/التجميع</div>
            <div style="padding: 1rem;">
                <textarea name="content[effectiveness_determination_method]" style="width: 100%; min-height: 100px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="اشرح الطرق المستخدمة لتحديد الفعالية...">{{ $content['effectiveness_determination_method'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Effectiveness Evaluation -->
        <div style="border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 1.5rem; overflow: hidden;">
            <div style="background: #f3f4f6; padding: 0.75rem 1rem; border-bottom: 1px solid #d1d5db; font-weight: 600; direction: rtl; text-align: right; font-size: 0.9rem;">تقييم الفعالية</div>
            <div style="padding: 1rem; direction: rtl; text-align: right;">
                <!-- Recall/Collection Effectiveness with Percentage -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.75rem; font-size: 0.85rem;">فعالية السحب/التجميع:</label>
                    <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem;">
                        <div style="flex: 1;">
                            <label style="display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.85rem;">
                                <input type="radio" name="content[effectiveness_yes_no]" value="yes" @if(($content['effectiveness_yes_no'] ?? '') === 'yes') checked @endif style="cursor: pointer;">
                                <span>نعم</span>
                            </label>
                        </div>
                        <div style="flex: 1;">
                            <label style="display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.85rem;">
                                <input type="radio" name="content[effectiveness_yes_no]" value="no" @if(($content['effectiveness_yes_no'] ?? '') === 'no') checked @endif style="cursor: pointer;">
                                <span>لا</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.8rem;">النسبة (%):</label>
                        <input type="number" step="0.01" min="0" max="100" name="content[effectiveness_percentage]" value="{{ $content['effectiveness_percentage'] ?? '' }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; text-align: center;" placeholder="%">
                    </div>
                </div>

                <!-- Is it Satisfactory -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.75rem; font-size: 0.85rem;">هل هو مُرضٍ:</label>
                    <div style="display: flex; gap: 2rem;">
                        <label style="display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.85rem;">
                            <input type="radio" name="content[is_satisfactory]" value="yes" @if(($content['is_satisfactory'] ?? '') === 'yes') checked @endif style="cursor: pointer;">
                            <span>نعم</span>
                        </label>
                        <label style="display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.85rem;">
                            <input type="radio" name="content[is_satisfactory]" value="no" @if(($content['is_satisfactory'] ?? '') === 'no') checked @endif style="cursor: pointer;">
                            <span>لا</span>
                        </label>
                    </div>
                </div>

                <!-- Corrective Actions if Not Satisfactory -->
                <div>
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.85rem;">إن كان "لا"، ما هي الإجراءات التصحيحية المتخذة؟</label>
                    <textarea name="content[corrective_actions]" style="width: 100%; min-height: 80px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif;" placeholder="اشرح الإجراءات التصحيحية...">{{ $content['corrective_actions'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; direction: rtl; text-align: right;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">التوقيع / Signature</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label class="onca-form-label" style="direction: rtl; text-align: right;">الاسم / Name</label>
                <input type="text" name="content[signature_name]" value="{{ $content['signature_name'] ?? '' }}" class="onca-form-input" style="border: 1px solid #d1d5db; direction: rtl; text-align: right; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.85rem;">
            </div>
            <div>
                <label class="onca-form-label" style="direction: rtl; text-align: right;">التاريخ / Date</label>
                <input type="date" name="content[signature_date]" value="{{ $content['signature_date'] ?? '' }}" class="onca-form-input" style="border: 1px solid #d1d5db; direction: rtl; text-align: right; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.85rem;">
            </div>
        </div>
        <div style="margin-top: 1rem;">
            <label class="onca-form-label" style="direction: rtl; text-align: right;">تأشير مسئول الجودة / Quality Manager Signature</label>
            <input type="text" name="content[quality_signature]" value="{{ $content['quality_signature'] ?? '' }}" class="onca-form-input" style="min-height: 60px; border: 1px solid #d1d5db; direction: rtl; text-align: right; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.85rem;">
        </div>
    </div>
</div>
