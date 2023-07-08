@extends('layouts.app')

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('stocks.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.stocks.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.name')</h5>
                    <span>{{ $stock->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.quantitiy_recived')</h5>
                    <span>{{ $stock->quantitiy_recived ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.quantity_despensed')</h5>
                    <span>{{ $stock->quantity_despensed ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.bach_no')</h5>
                    <span>{{ $stock->bach_no ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.expire_date')</h5>
                    <span>{{ $stock->expire_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.pack')</h5>
                    <span>{{ $stock->pack ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.quantity_per_pack')</h5>
                    <span>{{ $stock->quantity_per_pack ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.basic_unit_quantity')</h5>
                    <span>{{ $stock->basic_unit_quantity ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.pack_price')</h5>
                    <span>{{ $stock->pack_price ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.stock_category_id')</h5>
                    <span
                        >{{ optional($stock->stockCategory)->id ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.stock_unit_id')</h5>
                    <span
                        >{{ optional($stock->stockUnit)->unit_name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.stocks.inputs.supplier_id')</h5>
                    <span>{{ optional($stock->supplier)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('stocks.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Stock::class)
                <a href="{{ route('stocks.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
