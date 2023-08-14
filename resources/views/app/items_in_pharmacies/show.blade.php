@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('items-in-pharmacies.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.items_in_pharmacies.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.items_in_pharmacies.inputs.item_id')</h5>
                    <span
                        >{{ optional($itemsInPharmacy->item)->batch_number ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.items_in_pharmacies.inputs.count')</h5>
                    <span>{{ $itemsInPharmacy->count ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.items_in_pharmacies.inputs.pharmacy_id')
                    </h5>
                    <span
                        >{{ optional($itemsInPharmacy->pharmacy)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('items-in-pharmacies.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ItemsInPharmacy::class)
                <a
                    href="{{ route('items-in-pharmacies.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
