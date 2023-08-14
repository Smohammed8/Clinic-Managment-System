@php $editing = isset($storesToPharmacy) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="pharmacy_id" label="Pharmacy" required>
            @php $selected = old('pharmacy_id', ($editing ? $storesToPharmacy->pharmacy_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Pharmacy</option>
            @foreach($pharmacies as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="store_id" label="Store" required>
            @php $selected = old('store_id', ($editing ? $storesToPharmacy->store_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Store</option>
            @foreach($stores as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
