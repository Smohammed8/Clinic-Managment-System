@php $editing = isset($clinic) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $clinic->name : ''))"
            maxlength="255"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code_clinic"
            label="Code Clinic"
            :value="old('code_clinic', ($editing ? $clinic->code_clinic : ''))"
            maxlength="255"
            placeholder="Code Clinic"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            >{{ old('description', ($editing ? $clinic->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="lat"
            label="Lat"
            :value="old('lat', ($editing ? $clinic->lat : ''))"
            max="255"
            step="0.01"
            placeholder="Lat"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="long"
            label="Long"
            :value="old('long', ($editing ? $clinic->long : ''))"
            max="255"
            step="0.01"
            placeholder="Long"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="campus_id" label="Campus">
            @php $selected = old('campus_id', ($editing ? $clinic->campus_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Campus</option>
            @foreach($campuses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="collage_id" label="Collage">
            @php $selected = old('collage_id', ($editing ? $clinic->collage_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Collage</option>
            @foreach($collages as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $clinic->status : ''))"
            maxlength="255"
            placeholder="Status"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="is_active"
            label="Is Active"
            :value="old('is_active', ($editing ? $clinic->is_active : ''))"
            maxlength="255"
            placeholder="Is Active"
        ></x-inputs.text>
    </x-inputs.group>
</div>
