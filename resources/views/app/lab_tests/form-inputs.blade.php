@php $editing = isset($labTest) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="test_name"
            label="Test Name"
            :value="old('test_name', ($editing ? $labTest->test_name : ''))"
            maxlength="255"
            placeholder="Test Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="test_desc" label="Test Desc" maxlength="255"
            >{{ old('test_desc', ($editing ? $labTest->test_desc : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="lab_catagory_id" label="Lab Catagory">
            @php $selected = old('lab_catagory_id', ($editing ? $labTest->lab_catagory_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Lab Catagory</option>
            @foreach($labCatagories as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $labTest->status : ''))"
            maxlength="255"
            placeholder="Status"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="is_available "
            label="Is Available"
            :checked="old('is_available ', ($editing ? $labTest->is_available  : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="price"
            label="Price"
            :value="old('price', ($editing ? $labTest->price : ''))"
            max="255"
            step="0.01"
            placeholder="Price"
        ></x-inputs.number>
    </x-inputs.group>
</div>
