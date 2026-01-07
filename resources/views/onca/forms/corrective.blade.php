<div style="margin-bottom: 1.5rem;">
    <!-- Corrective and Preventive Actions Form -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white; margin-bottom: 1.5rem;">
        <h3 class="onca-form-section-title">سجل الإجراءات التصحيحية والوقائية / Corrective & Preventive Actions</h3>
        <div style="overflow-x: auto;">
            <table class="onca-form-table" id="table-actions" style="min-width: 900px;">
                <thead>
                    <tr style="background: #f2f2f2;">
                        <th style="width: 12%;">التاريخ / Date</th>
                        <th style="width: 25%;">نوع العملية / Type of Action</th>
                        <th style="width: 35%;">وصفها / Description</th>
                        <th style="width: 25%;">ملاحظات / Notes</th>
                        <th style="width: 2.5rem;"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($content['actions']) && is_array($content['actions']))
                        @foreach($content['actions'] as $index => $row)
                            <tr>
                                <td>
                                    <input type="date" name="content[actions][{{ $index }}][date]" value="{{ $row['date'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
                                </td>
                                <td>
                                    <input type="text" name="content[actions][{{ $index }}][type]" value="{{ $row['type'] ?? '' }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;" placeholder="تصحيحية / وقائية">
                                </td>
                                <td>
                                    <textarea name="content[actions][{{ $index }}][description]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem; min-height: 60px;">{{ $row['description'] ?? '' }}</textarea>
                                </td>
                                <td>
                                    <textarea name="content[actions][{{ $index }}][notes]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem; min-height: 60px;">{{ $row['notes'] ?? '' }}</textarea>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div style="margin-top: 0.75rem;">
            <button type="button" onclick="addActionRow()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajouter une ligne
            </button>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="onca-form-section" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: white;">
        <h3 class="onca-form-section-title">التوقيع / Signature</h3>
        <div>
            <label class="onca-form-label">تأشير مسؤول الجودة / Quality Manager Signature</label>
            <input type="text" name="content[signature]" value="{{ $content['signature'] ?? '' }}" class="onca-form-input" style="min-height: 40px; border: 1px solid #d1d5db;">
        </div>
    </div>
</div>

<template id="tpl-actions">
    <tr>
        <td>
            <input type="date" name="content[actions][new_{index}][date]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;">
        </td>
        <td>
            <input type="text" name="content[actions][new_{index}][type]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem;" placeholder="تصحيحية / وقائية">
        </td>
        <td>
            <textarea name="content[actions][new_{index}][description]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem; min-height: 60px;"></textarea>
        </td>
        <td>
            <textarea name="content[actions][new_{index}][notes]" style="width: 100%; padding: 0.375rem 0.5rem; border: 1px solid #d1d5db; border-radius: 0.25rem; font-size: 0.875rem; min-height: 60px;"></textarea>
        </td>
        <td style="text-align: center;">
            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">&times;</button>
        </td>
    </tr>
</template>

<script>
    function addActionRow() {
        const uniqueId = Date.now();
        const table = document.getElementById('table-actions').querySelector('tbody');
        const template = document.getElementById('tpl-actions').innerHTML;
        const tr = document.createElement('tr');
        tr.innerHTML = template.replace(/{index}/g, uniqueId);
        table.appendChild(tr);
    }
</script>
