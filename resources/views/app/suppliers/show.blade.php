@extends('layouts.app')

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('suppliers.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.suppliers.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.suppliers.inputs.name')</h5>
                    <span>{{ $supplier->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.suppliers.inputs.contact')</h5>
                    <span>{{ $supplier->contact ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('suppliers.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Supplier::class)
                <a href="{{ route('suppliers.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\Stock::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Stocks</h4>

            <livewire:supplier-stocks-detail :supplier="$supplier" />
        </div>
    </div>
    @endcan
</div>
@endsection
