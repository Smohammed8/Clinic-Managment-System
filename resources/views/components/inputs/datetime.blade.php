@props(['name', 'label', 'value'])

{{-- <input type="date" class="form-control" name="a_date" id="appointment_a_date"> --}}

<x-inputs.basic type="date" :name="$name" label="{{ $label ?? '' }}" :value="$value ?? ''"
    :attributes="$attributes"></x-inputs.basic>
