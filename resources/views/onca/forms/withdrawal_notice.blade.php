<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <!-- Withdrawal Notice Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">إشعار بالسحب / Withdrawal Notice</h3>
        
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

        <!-- Notification Content -->
        <div style="border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 1.5rem; overflow: hidden;">
            <div style="background: #f3f4f6; padding: 0.75rem 1rem; border-bottom: 1px solid #d1d5db; font-weight: 600; direction: rtl; text-align: right; font-size: 0.9rem;">نص الإشعار</div>
            <div style="padding: 1rem;">
                <textarea name="content[notification_text]" style="width: 100%; min-height: 350px; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.85rem; direction: rtl; text-align: right; font-family: Arial, sans-serif; resize: vertical;" placeholder="أدخل نص الإشعار بالسحب هنا...">{{ $content['notification_text'] ?? '' }}</textarea>
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
            <label class="onca-form-label" style="direction: rtl; text-align: right;">توقيع مدير المؤسسة / Manager Signature</label>
            <input type="text" name="content[manager_signature]" value="{{ $content['manager_signature'] ?? '' }}" class="onca-form-input" style="min-height: 60px; border: 1px solid #d1d5db; direction: rtl; text-align: right; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.85rem;">
        </div>
    </div>
</div>
