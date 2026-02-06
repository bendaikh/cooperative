<div style="margin-bottom: 1.5rem;">
    @php
        $formContent = old('content', $content ?? []);
    @endphp

    <style>
        .pest-int-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            direction: rtl;
            margin-bottom: 25px;
        }

        .pest-int-table th,
        .pest-int-table td {
            border: 1.5px solid #003366;
            padding: 8px;
            font-size: 14px;
            vertical-align: middle;
        }

        .pest-int-table th {
            font-weight: bold;
            text-align: center;
            background-color: #f5f5f5;
        }

        .pest-int-table td {
            text-align: right;
        }

        .input-cell input,
        .input-cell textarea {
            width: 100%;
            padding: 6px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 13px;
            font-family: Arial, sans-serif;
        }

        .input-cell textarea {
            resize: vertical;
            min-height: 40px;
        }

        .row-height {
            height: 50px;
        }

        .col-name { width: 14%; }
        .col-product { width: 14%; }
        .col-usage { width: 18%; }
        .col-material { width: 18%; }
        .col-concentration { width: 18%; }
        .col-frequency { width: 18%; }
    </style>

    <h6 style="margin-bottom: 15px;">الاحتياطات المرتبطة بمكافحة الآفات</h6>

    <div style="overflow-x: auto;">
        <table class="pest-int-table" id="table-pest-intervention">
            <thead>
                <tr>
                    <th class="col-name">الاسم</th>
                    <th class="col-product">نوع المنتج</th>
                    <th class="col-usage">طريقة الاستخدام</th>
                    <th class="col-material">المادة الفعالة</th>
                    <th class="col-concentration">التركيز المطلوب</th>
                    <th class="col-frequency">الوتيرة</th>
                    <th style="width: 2.5rem;"></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($formContent['interventions']) && is_array($formContent['interventions']))
                    @foreach($formContent['interventions'] as $index => $row)
                        <tr class="row-height">
                            <td class="input-cell"><input type="text" name="content[interventions][{{ $index }}][name]" value="{{ $row['name'] ?? '' }}" placeholder="الاسم"></td>
                            <td class="input-cell"><input type="text" name="content[interventions][{{ $index }}][product_type]" value="{{ $row['product_type'] ?? '' }}" placeholder="نوع المنتج"></td>
                            <td class="input-cell"><textarea name="content[interventions][{{ $index }}][usage_method]" placeholder="طريقة الاستخدام">{{ $row['usage_method'] ?? '' }}</textarea></td>
                            <td class="input-cell"><input type="text" name="content[interventions][{{ $index }}][active_material]" value="{{ $row['active_material'] ?? '' }}" placeholder="المادة الفعالة"></td>
                            <td class="input-cell"><input type="text" name="content[interventions][{{ $index }}][concentration]" value="{{ $row['concentration'] ?? '' }}" placeholder="التركيز المطلوب"></td>
                            <td class="input-cell"><input type="text" name="content[interventions][{{ $index }}][frequency]" value="{{ $row['frequency'] ?? '' }}" placeholder="الوتيرة"></td>
                            <td style="text-align: center;">
                                <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="row-height">
                        <td class="input-cell"><input type="text" name="content[interventions][0][name]" value="" placeholder="الاسم"></td>
                        <td class="input-cell"><input type="text" name="content[interventions][0][product_type]" value="" placeholder="نوع المنتج"></td>
                        <td class="input-cell"><textarea name="content[interventions][0][usage_method]" placeholder="طريقة الاستخدام"></textarea></td>
                        <td class="input-cell"><input type="text" name="content[interventions][0][active_material]" value="" placeholder="المادة الفعالة"></td>
                        <td class="input-cell"><input type="text" name="content[interventions][0][concentration]" value="" placeholder="التركيز المطلوب"></td>
                        <td class="input-cell"><input type="text" name="content[interventions][0][frequency]" value="" placeholder="الوتيرة"></td>
                        <td style="text-align: center;">
                            <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div style="margin-top: 0.75rem;">
        <button type="button" onclick="addPestInterventionRow()" class="onca-btn-add" style="display: inline-flex; align-items: center; gap: 0.25rem;">
            <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Row
        </button>
    </div>

    <template id="tpl-pest-intervention">
        <tr class="row-height">
            <td class="input-cell"><input type="text" name="content[interventions][new_{index}][name]" placeholder="الاسم"></td>
            <td class="input-cell"><input type="text" name="content[interventions][new_{index}][product_type]" placeholder="نوع المنتج"></td>
            <td class="input-cell"><textarea name="content[interventions][new_{index}][usage_method]" placeholder="طريقة الاستخدام"></textarea></td>
            <td class="input-cell"><input type="text" name="content[interventions][new_{index}][active_material]" placeholder="المادة الفعالة"></td>
            <td class="input-cell"><input type="text" name="content[interventions][new_{index}][concentration]" placeholder="التركيز المطلوب"></td>
            <td class="input-cell"><input type="text" name="content[interventions][new_{index}][frequency]" placeholder="الوتيرة"></td>
            <td style="text-align: center;">
                <button type="button" onclick="removeRow(this)" class="onca-btn-remove">
                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </td>
        </tr>
    </template>

    <script>
        function addPestInterventionRow() {
            const ms = Date.now();
            const rand = Math.floor(Math.random() * 1000);
            const uniqueId = ms + '_' + rand;
            
            const table = document.getElementById('table-pest-intervention').querySelector('tbody');
            const template = document.getElementById('tpl-pest-intervention').innerHTML;
            
            const tr = document.createElement('tr');
            tr.className = 'row-height';
            tr.innerHTML = template.replace(/{index}/g, uniqueId);
            table.appendChild(tr);
        }

        function removeRow(btn) {
            btn.closest('tr').remove();
        }
    </script>
</div>
