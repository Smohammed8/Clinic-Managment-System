<div>
    <div class="mb-4">
        @can('create', App\Models\Stock::class)
        <button class="btn btn-primary" wire:click="newStock">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Stock::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="icon ion-md-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="stock-unit-stocks-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="stock.name"
                            label="Name"
                            wire:model="stock.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="stock.quantitiy_recived"
                            label="Quantitiy Recived"
                            wire:model="stock.quantitiy_recived"
                            maxlength="255"
                            placeholder="Quantitiy Recived"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="stock.quantity_despensed"
                            label="Quantity Despensed"
                            wire:model="stock.quantity_despensed"
                            maxlength="255"
                            placeholder="Quantity Despensed"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="stock.bach_no"
                            label="Bach No"
                            wire:model="stock.bach_no"
                            maxlength="255"
                            placeholder="Bach No"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.datetime
                            name="stock.expire_date"
                            label="Expire Date"
                            wire:model="stock.expire_date"
                            max="255"
                        ></x-inputs.datetime>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="stock.pack"
                            label="Pack"
                            wire:model="stock.pack"
                            maxlength="255"
                            placeholder="Pack"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="stock.quantity_per_pack"
                            label="Quantity Per Pack"
                            wire:model="stock.quantity_per_pack"
                            maxlength="255"
                            placeholder="Quantity Per Pack"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="stock.basic_unit_quantity"
                            label="Basic Unit Quantity"
                            wire:model="stock.basic_unit_quantity"
                            maxlength="255"
                            placeholder="Basic Unit Quantity"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="stock.pack_price"
                            label="Pack Price"
                            wire:model="stock.pack_price"
                            maxlength="255"
                            placeholder="Pack Price"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="stock.stock_category_id"
                            label="Stock Category"
                            wire:model="stock.stock_category_id"
                        >
                            <option value="null" disabled>Please select the Stock Category</option>
                            @foreach($stockCategoriesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="stock.supplier_id"
                            label="Supplier"
                            wire:model="stock.supplier_id"
                        >
                            <option value="null" disabled>Please select the Supplier</option>
                            @foreach($suppliersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.quantitiy_recived')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.quantity_despensed')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.bach_no')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.expire_date')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.pack')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.quantity_per_pack')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.basic_unit_quantity')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.pack_price')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.stock_category_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.stock_unit_stocks.inputs.supplier_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($stocks as $stock)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $stock->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $stock->name ?? '-' }}</td>
                    <td class="text-left">
                        {{ $stock->quantitiy_recived ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $stock->quantity_despensed ?? '-' }}
                    </td>
                    <td class="text-left">{{ $stock->bach_no ?? '-' }}</td>
                    <td class="text-left">{{ $stock->expire_date ?? '-' }}</td>
                    <td class="text-left">{{ $stock->pack ?? '-' }}</td>
                    <td class="text-left">
                        {{ $stock->quantity_per_pack ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $stock->basic_unit_quantity ?? '-' }}
                    </td>
                    <td class="text-left">{{ $stock->pack_price ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($stock->stockCategory)->id ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($stock->supplier)->name ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $stock)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editStock({{ $stock->id }})"
                            >
                                <i class="fa fa-edit"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="12">{{ $stocks->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
