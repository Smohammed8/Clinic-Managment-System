@php $editing = isset($vitalSign) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="temp"
            label="Temp"
            :value="old('temp', ($editing ? $vitalSign->temp : ''))"
            max="255"
            step="0.01"
            placeholder="Temp"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="blood_pressure "
            label="Blood Pressure"
            :value="old('blood_pressure ', ($editing ? $vitalSign->blood_pressure  : ''))"
            max="255"
            step="0.01"
            placeholder="Blood Pressure"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="pulse_rate"
            label="Pulse Rate"
            :value="old('pulse_rate', ($editing ? $vitalSign->pulse_rate : ''))"
            max="255"
            step="0.01"
            placeholder="Pulse Rate"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="rr"
            label="Rr"
            :value="old('rr', ($editing ? $vitalSign->rr : ''))"
            max="255"
            step="0.01"
            placeholder="Rr"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="weight"
            label="Weight"
            :value="old('weight', ($editing ? $vitalSign->weight : ''))"
            max="255"
            step="0.01"
            placeholder="Weight"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="height"
            label="Height"
            :value="old('height', ($editing ? $vitalSign->height : ''))"
            max="255"
            step="0.01"
            placeholder="Height"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="muac"
            label="Muac"
            :value="old('muac', ($editing ? $vitalSign->muac : ''))"
            max="255"
            step="0.01"
            placeholder="Muac"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="encounter_id" label="Encounter" required>
            @php $selected = old('encounter_id', ($editing ? $vitalSign->encounter_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Encounter</option>
            @foreach($encounters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="clinic_user_id" label="Doctor" required>
            @php $selected = old('clinic_user_id', ($editing ? $vitalSign->clinic_user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Clinic User</option>
            @foreach($clinicUsers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="student_id" label="Student" required>
            @php $selected = old('student_id', ($editing ? $vitalSign->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Student</option>
            @foreach($students as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
