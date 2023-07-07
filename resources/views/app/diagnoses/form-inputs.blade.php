@php $editing = isset($diagnosis) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $diagnosis->name : ''))"
            maxlength="255"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="desc" label="Desc" maxlength="255"
            >{{ old('desc', ($editing ? $diagnosis->desc : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
