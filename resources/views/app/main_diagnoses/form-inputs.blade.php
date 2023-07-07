@php $editing = isset($mainDiagnosis) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="clinic_user_id" label="Doctor">
            @php $selected = old('clinic_user_id', ($editing ? $mainDiagnosis->clinic_user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Clinic User</option>
            @foreach($clinicUsers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="student_id" label="Student">
            @php $selected = old('student_id', ($editing ? $mainDiagnosis->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Student</option>
            @foreach($students as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="encounter_id" label="Encounter">
            @php $selected = old('encounter_id', ($editing ? $mainDiagnosis->encounter_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Encounter</option>
            @foreach($encounters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="diagnosis_id" label="Diagnosis" required>
            @php $selected = old('diagnosis_id', ($editing ? $mainDiagnosis->diagnosis_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Diagnosis</option>
            @foreach($diagnoses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
