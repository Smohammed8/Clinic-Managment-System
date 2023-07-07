@php $editing = isset($stockUnit) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="unit_name"
            label="Unit Name"
            :value="old('unit_name', ($editing ? $stockUnit->unit_name : ''))"
            maxlength="255"
            placeholder="Unit Name"
        ></x-inputs.text>
    </x-inputs.group>
</div>
