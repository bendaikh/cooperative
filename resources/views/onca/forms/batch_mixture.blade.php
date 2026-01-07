<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <!-- Batch Mixture Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">قائمة ترميز الدفعة (الخلطات) / Batch Mixture Coding List</h3>
        <div id="mixture-entries-container" style="direction: rtl;">
            @if(isset($content['mixture_records']) && is_array($content['mixture_records']))
                @foreach($content['mixture_records'] as $index => $row)
                    <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                        <!-- Batch Header Info -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #dbeafe;">
                            <div>
                                <label style="display: block; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem; font-size: 14px;">ترميز رقم الدفعة (M)</label>
                                <input type="text" name="content[mixture_records][{{ $index }}][batch_code]" value="{{ $row['batch_code'] ?? '' }}" style="width: 100%; padding: 0.75rem; border: 2px solid #3b82f6; border-radius: 0.375rem; font-size: 14px; text-align: right; font-weight: 500;">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem; font-size: 14px;">تاريخ الخلط</label>
                                <input type="date" name="content[mixture_records][{{ $index }}][mixing_date]" value="{{ $row['mixing_date'] ?? '' }}" style="width: 100%; padding: 0.75rem; border: 2px solid #3b82f6; border-radius: 0.375rem; font-size: 14px; text-align: right;">
                            </div>
                        </div>

                        <!-- Ingredient Section -->
                        <div style="background: white; padding: 1rem; border-radius: 0.375rem; border-left: 4px solid #8b5cf6; margin-bottom: 1rem;">
                            <h4 style="margin: 0 0 1rem 0; color: #4f46e5; font-size: 13px; font-weight: 600;">المكون الأساسي / Main Ingredient</h4>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                                <div>
                                    <label style="display: block; font-weight: 500; color: #374151; margin-bottom: 0.375rem; font-size: 13px;">اسم المكون</label>
                                    <input type="text" name="content[mixture_records][{{ $index }}][ingredient_1_name]" value="{{ $row['ingredient_1_name'] ?? '' }}" placeholder="مثال: السكر الأبيض" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 13px; text-align: right;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 500; color: #374151; margin-bottom: 0.375rem; font-size: 13px;">رقم الدفعة</label>
                                    <input type="text" name="content[mixture_records][{{ $index }}][ingredient_1_batch]" value="{{ $row['ingredient_1_batch'] ?? '' }}" placeholder="مثال: B2024001" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 13px; text-align: right;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 500; color: #374151; margin-bottom: 0.375rem; font-size: 13px;">الكمية (كلغ)</label>
                                    <input type="number" step="0.01" name="content[mixture_records][{{ $index }}][ingredient_1_qty]" value="{{ $row['ingredient_1_qty'] ?? '' }}" placeholder="0.00" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 13px; text-align: right;">
                                </div>
                            </div>
                        </div>

                        <!-- Total Qty & Actions -->
                        <div style="display: grid; grid-template-columns: 1fr auto; gap: 1rem; align-items: flex-end;">
                            <div>
                                <label style="display: block; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem; font-size: 14px;">إجمالي كمية الخليط (كلغ)</label>
                                <input type="number" step="0.01" name="content[mixture_records][{{ $index }}][total_mix_qty]" value="{{ $row['total_mix_qty'] ?? '' }}" placeholder="0.00" style="width: 100%; padding: 0.75rem; border: 2px solid #10b981; border-radius: 0.375rem; font-size: 14px; text-align: right; font-weight: 500; background: #ecfdf5;">
                            </div>
                            <button type="button" onclick="removeMixtureRow(this)" class="onca-btn-remove" style="padding: 0.75rem 1rem; background: #fee2e2; color: #dc2626; border: none; border-radius: 0.375rem; cursor: pointer; font-size: 14px; font-weight: 500; transition: all 0.2s;">حذف الدفعة</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div style="margin-top: 1rem; text-align: right;">
            <button type="button" onclick="addMixtureRow()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #3b82f6; color: white; border: none; border-radius: 0.5rem; cursor: pointer; font-size: 15px; font-weight: 600; transition: all 0.2s;">
                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                إضافة دفعة جديدة
            </button>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; direction: rtl; text-align: right;">
        <h3 class="onca-form-section-title" style="direction: rtl; text-align: right;">التوقيع / Signature</h3>
        <div>
            <label class="onca-form-label" style="direction: rtl; text-align: right;">تأشير مسؤول الإنتاج / Production Manager Signature</label>
            <input type="text" name="content[signature]" value="{{ $content['signature'] ?? '' }}" class="onca-form-input" style="min-height: 40px; border: 1px solid #d1d5db; direction: rtl; text-align: right;">
        </div>
    </div>
</div>

<template id="tpl-mixture">
    <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
        <!-- Batch Header Info -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #dbeafe;">
            <div>
                <label style="display: block; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem; font-size: 14px;">ترميز رقم الدفعة (M)</label>
                <input type="text" name="content[mixture_records][new_{index}][batch_code]" style="width: 100%; padding: 0.75rem; border: 2px solid #3b82f6; border-radius: 0.375rem; font-size: 14px; text-align: right; font-weight: 500;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem; font-size: 14px;">تاريخ الخلط</label>
                <input type="date" name="content[mixture_records][new_{index}][mixing_date]" style="width: 100%; padding: 0.75rem; border: 2px solid #3b82f6; border-radius: 0.375rem; font-size: 14px; text-align: right;">
            </div>
        </div>

        <!-- Ingredient Section -->
        <div style="background: white; padding: 1rem; border-radius: 0.375rem; border-left: 4px solid #8b5cf6; margin-bottom: 1rem;">
            <h4 style="margin: 0 0 1rem 0; color: #4f46e5; font-size: 13px; font-weight: 600;">المكون الأساسي / Main Ingredient</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div>
                    <label style="display: block; font-weight: 500; color: #374151; margin-bottom: 0.375rem; font-size: 13px;">اسم المكون</label>
                    <input type="text" name="content[mixture_records][new_{index}][ingredient_1_name]" placeholder="مثال: السكر الأبيض" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 13px; text-align: right;">
                </div>
                <div>
                    <label style="display: block; font-weight: 500; color: #374151; margin-bottom: 0.375rem; font-size: 13px;">رقم الدفعة</label>
                    <input type="text" name="content[mixture_records][new_{index}][ingredient_1_batch]" placeholder="مثال: B2024001" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 13px; text-align: right;">
                </div>
                <div>
                    <label style="display: block; font-weight: 500; color: #374151; margin-bottom: 0.375rem; font-size: 13px;">الكمية (كلغ)</label>
                    <input type="number" step="0.01" name="content[mixture_records][new_{index}][ingredient_1_qty]" placeholder="0.00" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 13px; text-align: right;">
                </div>
            </div>
        </div>

        <!-- Total Qty & Actions -->
        <div style="display: grid; grid-template-columns: 1fr auto; gap: 1rem; align-items: flex-end;">
            <div>
                <label style="display: block; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem; font-size: 14px;">إجمالي كمية الخليط (كلغ)</label>
                <input type="number" step="0.01" name="content[mixture_records][new_{index}][total_mix_qty]" placeholder="0.00" style="width: 100%; padding: 0.75rem; border: 2px solid #10b981; border-radius: 0.375rem; font-size: 14px; text-align: right; font-weight: 500; background: #ecfdf5;">
            </div>
            <button type="button" onclick="removeMixtureRow(this)" class="onca-btn-remove" style="padding: 0.75rem 1rem; background: #fee2e2; color: #dc2626; border: none; border-radius: 0.375rem; cursor: pointer; font-size: 14px; font-weight: 500; transition: all 0.2s;">حذف الدفعة</button>
        </div>
    </div>
</template>

<script>
    function addMixtureRow() {
        const uniqueId = Date.now();
        const container = document.getElementById('mixture-entries-container');
        const template = document.getElementById('tpl-mixture').innerHTML;
        const div = document.createElement('div');
        div.innerHTML = template.replace(/{index}/g, uniqueId);
        container.appendChild(div.firstElementChild);
    }

    function removeMixtureRow(btn) {
        btn.closest('div').remove();
    }
</script>
