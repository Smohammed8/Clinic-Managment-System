@php $editing = isset($itemsInPharmacy) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="item_id" label="Item">
            @php $selected = old('item_id', ($editing ? $itemsInPharmacy->item_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Item</option>
            @foreach($items as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="count"
            label="Count"
            :value="old('count', ($editing ? $itemsInPharmacy->count : ''))"
            max="255"
            placeholder="Count"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="pharmacy_id" label="Pharmacy" required>
            @php $selected = old('pharmacy_id', ($editing ? $itemsInPharmacy->pharmacy_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Pharmacy</option>
            @foreach($pharmacies as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
