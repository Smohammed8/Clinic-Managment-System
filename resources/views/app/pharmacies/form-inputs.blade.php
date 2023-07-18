@php $editing = isset($pharmacy) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $pharmacy->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="admin_id"
            label="Admin Id"
            :value="old('admin_id', ($editing ? $pharmacy->admin_id : ''))"
            maxlength="255"
            placeholder="Admin Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="campus_id" label="Campus" required>
            @php $selected = old('campus_id', ($editing ? $pharmacy->campus_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Campus</option>
            @foreach($campuses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="status"
            label="Status"
            :checked="old('status', ($editing ? $pharmacy->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $pharmacy->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
