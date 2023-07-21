@php $editing = isset($labCatagory) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="lab_name"
            label="Lab Name"
            :value="old('lab_name', ($editing ? $labCatagory->lab_name : ''))"
            maxlength="255"
            placeholder="Lab Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="lab_desc"
            label="Lab Desc"
            maxlength="255"
            required
            >{{ old('lab_desc', ($editing ? $labCatagory->lab_desc : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
