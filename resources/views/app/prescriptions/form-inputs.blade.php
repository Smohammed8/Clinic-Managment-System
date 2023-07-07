@php $editing = isset($prescription) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="drug_name" label="Drug Name" maxlength="255"
            >{{ old('drug_name', ($editing ? $prescription->drug_name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="dose"
            label="Dose"
            :value="old('dose', ($editing ? $prescription->dose : ''))"
            maxlength="255"
            placeholder="Dose"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="frequency"
            label="Frequency"
            :value="old('frequency', ($editing ? $prescription->frequency : ''))"
            maxlength="255"
            placeholder="Frequency"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="duration"
            label="Duration"
            :value="old('duration', ($editing ? $prescription->duration : ''))"
            maxlength="255"
            placeholder="Duration"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="other_info" label="Other Info" maxlength="255"
            >{{ old('other_info', ($editing ? $prescription->other_info : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="main_diagnosis_id" label="Main Diagnosis">
            @php $selected = old('main_diagnosis_id', ($editing ? $prescription->main_diagnosis_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Main Diagnosis</option>
            @foreach($mainDiagnoses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
