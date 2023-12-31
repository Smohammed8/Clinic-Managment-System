@extends('layouts.app')

@section('content')
    <div class="">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="input-group">
                            <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                                value="{{ $search ?? '' }}" class="form-control" autocomplete="off" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon ion-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Stock::class)
                        <a href="{{ route('stocks.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.stocks.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover  table-sm table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.quantitiy_recived')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.quantity_despensed')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.bach_no')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.expire_date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.pack')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.quantity_per_pack')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.basic_unit_quantity')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.pack_price')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.stock_category_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.stock_unit_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.stocks.inputs.supplier_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stocks as $key => $stock)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>{{ $stock->name ?? '-' }}</td>
                                    <td>{{ $stock->quantitiy_recived ?? '-' }}</td>
                                    <td>{{ $stock->quantity_despensed ?? '-' }}</td>
                                    <td>{{ $stock->bach_no ?? '-' }}</td>
                                    <td>{{ $stock->expire_date ?? '-' }}</td>
                                    <td>{{ $stock->pack ?? '-' }}</td>
                                    <td>{{ $stock->quantity_per_pack ?? '-' }}</td>
                                    <td>{{ $stock->basic_unit_quantity ?? '-' }}</td>
                                    <td>{{ $stock->pack_price ?? '-' }}</td>
                                    <td>
                                        {{ optional($stock->stockCategory)->id ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($stock->stockUnit)->unit_name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($stock->supplier)->name ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $stock)
                                                <a href="{{ route('stocks.edit', $stock) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                                @endcan @can('view', $stock)
                                                <a href="{{ route('stocks.show', $stock) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="icon ion-md-eye"></i> Show
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $stock)
                                                <form action="{{ route('stocks.destroy', $stock) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger mx-1">
                                                        <i class="icon ion-md-trash"></i> Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="13">{!! $stocks->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
