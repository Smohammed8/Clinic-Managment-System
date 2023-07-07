@php $editing = isset($supplier) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $supplier->name : ''))"
            maxlength="255"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="contact"
            label="Contact"
            :value="old('contact', ($editing ? $supplier->contact : ''))"
            maxlength="255"
            placeholder="Contact"
        ></x-inputs.text>
    </x-inputs.group>
</div>
