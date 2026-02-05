<div style="margin-bottom: 1.5rem;">
    <!-- Section 1: Preventive Measures -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">1. نتائج عمليات الوقاية / Preventive Results</h3>
        
        @php
            $checklist = [
                'doors' => 'مدى عدم قابلية الأبواب والنوافذ لتسريب الكائنات الضارة',
                'surfaces' => 'أسطح الأرضيات والحيطان والأسقف',
                'windows' => '"ناموسيات" النوافذ',
                'drainage' => 'بالوعات ومجاري الصرف الصحي',
                'traps_condition' => 'الحالة العامة لأماكن تواجد مصائد الفئران والحشرات ونظافتها',
                'insect_traps' => 'عمل مصائد الحشرات',
                'rodent_traps' => 'عمل مصائد الفئران',
                'animals' => 'وجود الحيوانات الأليفة أو البرية',
            ];
        @endphp

        <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
            @foreach($checklist as $key => $label)
            <div style="display: flex; flex-direction: column; gap: 1rem; padding: 0.75rem; background: #f9fafb; border-radius: 0.25rem; border: 1px solid #f3f4f6;">
                <label class="onca-form-label" style="width: 100%;">{{ $label }}</label>
                <div style="width: 100%;">
                    <input type="text" 
                        name="content[prevention][0][{{ $key }}]" 
                        value="{{ $content['prevention'][0][$key] ?? '' }}" 
                        placeholder="Observation..."
                        class="onca-form-input">
                </div>
            </div>
            @endforeach
        </div>
        
        <div style="margin-top: 1rem;">
            <label class="onca-form-label">خلاصة / Summary</label>
            <textarea name="content[prevention_summary]" rows="3" class="onca-form-textarea" placeholder="ملخص الملاحظات">{{ $content['prevention_summary'] ?? '' }}</textarea>
        </div>
    </div>

    <!-- Section 2: Treatment Measures -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">2. إجراءات المعالجة / Treatment Measures</h3>
        
        <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
            @php
                $treatment_fields = [
                    'location' => 'مكان التدخل / Location',
                    'type' => 'نوع التدخل / Type',
                    'responsible' => 'مسؤول المعالجة / Responsible',
                    'chemical' => 'المادة الكيميائية المستعملة / Chemical',
                    'concentration' => 'التركيز / Concentration',
                    'frequency' => 'وتيرة التطبيق / Frequency',
                ];
            @endphp
            
            @foreach($treatment_fields as $key => $label)
            <div style="display: flex; flex-direction: column; gap: 1rem; padding: 0.75rem; background: #f9fafb; border-radius: 0.25rem; border: 1px solid #f3f4f6;">
                <label class="onca-form-label" style="width: 100%;">{{ $label }}</label>
                <div style="width: 100%;">
                    <input type="text" 
                        name="content[treatment][0][{{ $key }}]" 
                        value="{{ $content['treatment'][0][$key] ?? '' }}" 
                        placeholder="..."
                        class="onca-form-input">
                </div>
            </div>
            @endforeach
        </div>
        
        <div style="margin-top: 1rem;">
            <label class="onca-form-label">خلاصة نتائج المعالجة / Treatment Results Summary</label>
            <textarea name="content[treatment_summary]" rows="3" class="onca-form-textarea" placeholder="ملخص نتائج المعالجة">{{ $content['treatment_summary'] ?? '' }}</textarea>
        </div>
    </div>
</div>
