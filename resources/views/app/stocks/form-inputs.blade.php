@php $editing = isset($stock) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $stock->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="quantitiy_recived"
            label="Quantitiy Recived"
            :value="old('quantitiy_recived', ($editing ? $stock->quantitiy_recived : ''))"
            maxlength="255"
            placeholder="Quantitiy Recived"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="quantity_despensed"
            label="Quantity Despensed"
            :value="old('quantity_despensed', ($editing ? $stock->quantity_despensed : ''))"
            maxlength="255"
            placeholder="Quantity Despensed"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="bach_no"
            label="Bach No"
            :value="old('bach_no', ($editing ? $stock->bach_no : ''))"
            maxlength="255"
            placeholder="Bach No"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime
            name="expire_date"
            label="Expire Date"
            value="{{ old('expire_date', ($editing ? optional($stock->expire_date)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="pack"
            label="Pack"
            :value="old('pack', ($editing ? $stock->pack : ''))"
            maxlength="255"
            placeholder="Pack"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="quantity_per_pack"
            label="Quantity Per Pack"
            :value="old('quantity_per_pack', ($editing ? $stock->quantity_per_pack : ''))"
            maxlength="255"
            placeholder="Quantity Per Pack"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="basic_unit_quantity"
            label="Basic Unit Quantity"
            :value="old('basic_unit_quantity', ($editing ? $stock->basic_unit_quantity : ''))"
            maxlength="255"
            placeholder="Basic Unit Quantity"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="pack_price"
            label="Pack Price"
            :value="old('pack_price', ($editing ? $stock->pack_price : ''))"
            maxlength="255"
            placeholder="Pack Price"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="stock_category_id" label="Stock Category">
            @php $selected = old('stock_category_id', ($editing ? $stock->stock_category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Stock Category</option>
            @foreach($stockCategories as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="stock_unit_id" label="Stock Unit">
            @php $selected = old('stock_unit_id', ($editing ? $stock->stock_unit_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Stock Unit</option>
            @foreach($stockUnits as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="supplier_id" label="Supplier">
            @php $selected = old('supplier_id', ($editing ? $stock->supplier_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Supplier</option>
            @foreach($suppliers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
