@php $editing = isset($encounter) @endphp

<div class="row">
    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.select name="student_id" label="Student">
            @php $selected = old('student_id', ($editing ? $encounter->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Student</option>
            @foreach ($student as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group> --}}
    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime name="check_in_time" label="Check In Time"
            value="{{ old('check_in_time', $editing ? optional($encounter->check_in_time)->format('Y-m-d\TH:i:s') : '') }}"
            max="255"></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="status" label="Status" :value="old('status', $editing ? $encounter->status : '')" maxlength="255" placeholder="Status">
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime name="closed_at" label="Closed At"
            value="{{ old('closed_at', $editing ? optional($encounter->closed_at)->format('Y-m-d\TH:i:s') : '') }}"
            max="255"></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="priority" label="Priority" :value="old('priority', $editing ? $encounter->priority : '')" maxlength="255" placeholder="Priority">
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="clinic_id" label="Clinic">
            @php $selected = old('clinic_id', ($editing ? $encounter->clinic_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Clinic</option>
            @foreach ($clinics as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
