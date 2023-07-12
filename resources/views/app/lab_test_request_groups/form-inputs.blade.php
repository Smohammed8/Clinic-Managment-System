@php $editing = isset($labTestRequestGroup) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $labTestRequestGroup->status : ''))"
            maxlength="255"
            placeholder="Status"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="priority"
            label="Priority"
            :value="old('priority', ($editing ? $labTestRequestGroup->priority : ''))"
            maxlength="255"
            placeholder="Priority"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="notification"
            label="Notification"
            :value="old('notification', ($editing ? $labTestRequestGroup->notification : ''))"
            maxlength="255"
            placeholder="Notification"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="call_status"
            label="Call Status"
            :value="old('call_status', ($editing ? $labTestRequestGroup->call_status : ''))"
            maxlength="255"
            placeholder="Call Status"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime
            name="requested_at"
            label="Requested At"
            value="{{ old('requested_at', ($editing ? optional($labTestRequestGroup->requested_at)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="clinic_user_id" label="Requestedby">
            @php $selected = old('clinic_user_id', ($editing ? $labTestRequestGroup->clinic_user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Clinic User</option>
            @foreach($clinicUsers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="encounter_id" label="Encounter">
            @php $selected = old('encounter_id', ($editing ? $labTestRequestGroup->encounter->id	 : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Select encounter</option>
            @foreach($encounters as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
