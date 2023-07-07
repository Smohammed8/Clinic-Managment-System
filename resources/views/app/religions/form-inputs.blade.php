@php $editing = isset($religion) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="religion_name"
            label="Religion Name"
            :value="old('religion_name', ($editing ? $religion->religion_name : ''))"
            maxlength="255"
            placeholder="Religion Name"
        ></x-inputs.text>
    </x-inputs.group>
</div>
