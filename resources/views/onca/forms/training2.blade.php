<!-- PR-S-EN2 Document Form -->
<input type="hidden" name="type" value="training2">
<input type="hidden" name="reference" value="{{ $meta['ref'] ?? 'PR-S-EN2' }}">
<input type="hidden" name="title" value="{{ $meta['title'] ?? 'لائحة المشاركين في التكوين' }}">
<input type="hidden" name="version" value="{{ $meta['ver'] ?? '01' }}">

<div style="margin-bottom: 1.5rem; direction: rtl; text-align: right;">
    <!-- Training Subject -->
    <div style="background: #f9fafb; padding: 1rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
        <label class="onca-form-label">موضوع التكوين / Sujet de formation</label>
        <input type="text" name="content[training_subject]" value="{{ $content['training_subject'] ?? '' }}" class="onca-form-input" style="max-width: 100%;">
    </div>

    <!-- Training Objectives Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">أهداف التكوين / Objectifs de formation</h3>
        <div>
            @php
                $objectives = $content['objectives'] ?? ['', '', ''];
            @endphp
            @for($i = 0; $i < 3; $i++)
                <div style="margin-bottom: 0.75rem;">
                    <label class="onca-form-label">الهدف {{ $i + 1 }} / Objectif {{ $i + 1 }}</label>
                    <input type="text" name="content[objectives][{{ $i }}]" value="{{ $objectives[$i] ?? '' }}" class="onca-form-input">
                </div>
            @endfor
        </div>
    </div>

    <!-- Training Body Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">الهيئة المكلفة والمكونون / Organisme et formateurs</h3>
        <div style="margin-bottom: 1.5rem;">
            <label class="onca-form-label">الهيئة المكلفة بتقديم التكوين / Organisme de formation</label>
            <input type="text" name="content[training_body]" value="{{ $content['training_body'] ?? '' }}" class="onca-form-input">
        </div>
        <div>
            <label class="onca-form-label">المكونون / Formateurs</label>
            @php
                $trainers = $content['trainers'] ?? ['', '', ''];
            @endphp
            @for($i = 0; $i < 3; $i++)
                <div style="margin-bottom: 0.75rem;">
                    <label class="onca-form-label" style="font-size: 0.9rem;">المكون {{ $i + 1 }} / Formateur {{ $i + 1 }}</label>
                    <input type="text" name="content[trainers][{{ $i }}]" value="{{ $trainers[$i] ?? '' }}" class="onca-form-input">
                </div>
            @endfor
        </div>
    </div>

    <!-- Training Dates Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">تاريخ وفترة التكوين / Dates et durée</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label class="onca-form-label">يوم البدء / Date de début</label>
                <input type="date" name="content[start_date]" value="{{ $content['start_date'] ?? '' }}" class="onca-form-input">
            </div>
            <div>
                <label class="onca-form-label">يوم الانتهاء / Date de fin</label>
                <input type="date" name="content[end_date]" value="{{ $content['end_date'] ?? '' }}" class="onca-form-input">
            </div>
            <div>
                <label class="onca-form-label">عدد أيام التكوين / Nombre de jours</label>
                <input type="number" name="content[training_days]" value="{{ $content['training_days'] ?? '' }}" class="onca-form-input">
            </div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
            <div>
                <label class="onca-form-label">عدد ساعات التكوين / Nombre d'heures</label>
                <input type="number" name="content[training_hours]" value="{{ $content['training_hours'] ?? '' }}" class="onca-form-input">
            </div>
        </div>
    </div>

    <!-- Training Location Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">مكان التكوين / Lieu de formation</h3>
        <div>
            <label class="onca-form-label">مكان التكوين / Lieu</label>
            <input type="text" name="content[training_location]" value="{{ $content['training_location'] ?? '' }}" class="onca-form-input">
        </div>
    </div>

    <!-- Participants Table Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">المشاركون والفترات الزمنية / Participants et périodes</h3>
        <div style="overflow-x: auto;">
            <table class="onca-form-table" id="table-training2" style="min-width: 800px;">
                <thead>
                    <tr>
                        <th style="border-left: 1px solid #e5e7eb; padding: 0.75rem; width: 12%; text-align: right;">التاريخ / Date</th>
                        <th style="border-left: 1px solid #e5e7eb; padding: 0.75rem; width: 28%; text-align: right;">الاسم الكامل / Nom complet</th>
                        <th style="border-left: 1px solid #e5e7eb; padding: 0.75rem; width: 20%; text-align: right;">النطاق الزمني / Plage horaire</th>
                        <th style="border-left: 1px solid #e5e7eb; padding: 0.75rem; width: 25%; text-align: right;">فترة التكوين / Période formation</th>
                        <th style="border-left: 1px solid #e5e7eb; text-align: center; padding: 0.75rem; width: 10%;">التأشير / Signature</th>
                        <th style="width: 2.5rem; vertical-align: bottom;"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($content['participants']) && is_array($content['participants']))
                        @foreach($content['participants'] as $index => $row)
                            <tr>
                                <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="date" name="content[participants][{{ $index }}][date]" value="{{ $row['date'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[participants][{{ $index }}][name]" value="{{ $row['name'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[participants][{{ $index }}][time_range]" value="{{ $row['time_range'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[participants][{{ $index }}][period]" value="{{ $row['period'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
                                <td style="border-left: 1px solid #e5e7eb; text-align: center;"><input type="checkbox" name="content[participants][{{ $index }}][signature]" value="yes" {{ ($row['signature'] ?? '') === 'yes' ? 'checked' : '' }}></td>
                                <td style="text-align: center;"><button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div style="margin-top: 0.75rem;">
            <button type="button" onclick="addTraining2Row()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajouter une ligne
            </button>
        </div>
    </div>

    <!-- Quality Officer Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">تأشير مسؤول الجودة / Signature du Responsable QA</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div>
                <label class="onca-form-label">الاسم / Nom</label>
                <input type="text" name="content[quality_officer_name]" value="{{ $content['quality_officer_name'] ?? Auth::user()->name }}" class="onca-form-input">
            </div>
            <div>
                <label class="onca-form-label">التاريخ / Date</label>
                <input type="date" name="content[signature_date]" value="{{ $content['signature_date'] ?? date('Y-m-d') }}" class="onca-form-input">
            </div>
        </div>
    </div>
</div>

<template id="tpl-training2">
    <tr>
        <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="date" name="content[participants][new_{index}][date]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[participants][new_{index}][name]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[participants][new_{index}][time_range]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: right;"><input type="text" name="content[participants][new_{index}][period]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;"></td>
        <td style="border-left: 1px solid #e5e7eb; text-align: center;"><input type="checkbox" name="content[participants][new_{index}][signature]" value="yes"></td>
        <td style="text-align: center;"><button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button></td>
    </tr>
</template>

<script>
    function addTraining2Row() {
        const uniqueId = Date.now();
        const table = document.getElementById('table-training2').querySelector('tbody');
        const template = document.getElementById('tpl-training2').innerHTML;
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        table.appendChild(tr);
    }
</script>
