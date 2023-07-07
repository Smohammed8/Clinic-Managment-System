@php $editing = isset($clinicServices) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="service_name"
            label="Service Name"
            :value="old('service_name', ($editing ? $clinicServices->service_name : ''))"
            maxlength="255"
            placeholder="Service Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="service_ description"
            label="Service Description"
            :value="old('service_ description', ($editing ? $clinicServices->service_ description : ''))"
            maxlength="255"
            placeholder="Service Description"
        ></x-inputs.text>
    </x-inputs.group>

    @if($editing)
    <div class="form-group col-sm-12 mt-4">
        <h4>Assign @lang('crud.clinics.name')</h4>

        @foreach ($clinics as $clinic)
        <div>
            <x-inputs.checkbox
                id="clinic{{ $clinic->id }}"
                name="clinics[]"
                label="{{ ucfirst($clinic->name) }}"
                value="{{ $clinic->id }}"
                :checked="isset($clinicServices) ? $clinicServices->clinics()->where('id', $clinic->id)->exists() : false"
                :add-hidden-value="false"
            ></x-inputs.checkbox>
        </div>
        @endforeach
    </div>
    @endif
</div>
