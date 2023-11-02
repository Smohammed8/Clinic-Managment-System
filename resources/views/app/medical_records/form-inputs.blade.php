@php $editing = isset($medicalRecord) @endphp

<div class="row">
    <div class="card-body">
        <textarea id="editor1" style="display: none;">
        </textarea>
        <script>
            CKEDITOR.replace('editor1');
        </script>
    </div>
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea id="compose-textarea" name="subjective" label="Subjective" maxlength="255">
            {{ old('subjective', $editing ? $medicalRecord->subjective : '') }}
        </x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="objective" label="Objective" maxlength="255">
            {{ old('objective', $editing ? $medicalRecord->objective : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="assessment" label="Assessment" maxlength="255">
            {{ old('assessment', $editing ? $medicalRecord->assessment : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="plan" label="Plan" maxlength="255">
            {{ old('plan', $editing ? $medicalRecord->plan : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="encounter_id" label="Encounter">
            @php $selected = old('encounter_id', ($editing ? $medicalRecord->encounter_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Encounter</option>
            @foreach ($encounters as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group> 

 <x-inputs.group class="col-sm-12">
        <x-inputs.select name="clinic_user_id" label="Doctor">
            @php $selected = old('clinic_user_id', ($editing ? $medicalRecord->clinic_user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Clinic User</option>
            @foreach ($clinicUsers as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="student_id" label="Student">
            @php $selected = old('student_id', ($editing ? $medicalRecord->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Student</option>
            @foreach ($students as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
