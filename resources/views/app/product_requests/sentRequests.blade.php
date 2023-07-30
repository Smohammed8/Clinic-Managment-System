@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">
                        @lang('crud.product_requests.index_title')
                    </h4>
                </div>

                <div class="searchbar mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <form>
                                <div class="input-group">
                                    <input id="indexSearch" type="text" name="search"
                                        placeholder="{{ __('crud.common.search') }}" value="{{ $RejectedSearch ?? '' }}"
                                        class="form-control" autocomplete="off" />
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            @can('create', App\Models\ProductRequest::class)
                                <a href="{{ route('product-requests.create') }}" class="btn btn-primary">
                                    <i class="icon ion-md-add"></i>
                                    @lang('crud.common.create')
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.product_requests.inputs.amount')
                                </th>
                                {{-- <th class="text-left">
                                @lang('crud.product_requests.inputs.clinic_id')
                            </th> --}}
                                <th class="text-left">
                                    @lang('crud.product_requests.inputs.product_id')
                                </th>
                                @if (Auth::user()->hasRole(App\Constants::STORE_USER_ROLE))
                                <th class="text-left">
                                   Pharmacy
                                </th>

                                @elseif (Auth::user()->hasRole(App\Constants::PHARMACY_USER))
                                <th class="text-left">
                                    @lang('crud.product_requests.inputs.store_id')
                                </th>
                                @endif
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($RequestedProductRequests as $requestedProductRequest)
                                <tr>
                                    <td>{{ $requestedProductRequest->amount ?? '-' }}</td>
                                    {{-- <td>
                                {{ optional($productRequest->clinic)->name ??
                                '-' }}
                            </td> --}}
                                    <td>
                                        {{ optional($requestedProductRequest->product)->name ?? '-' }}
                                    </td>
                                    @if (Auth::user()->hasRole(App\Constants::PHARMACY_USER))
                                    <td>
                                        {{ optional($requestedProductRequest->store)->name ?? '-' }}
                                    </td>
                                @elseif (Auth::user()->hasRole(App\Constants::STORE_USER_ROLE))
                                    <td>
                                        {{ optional($requestedProductRequest->pharmacy)->name ?? '-' }}
                                    </td>
                                @endif
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            {{-- @can('update', $productRequest) --}}
                                            {{-- <a
                                        href="{{ route('product-requests.edit', $productRequest) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a> --}}
                                            {{-- @endcan @can('view', $productRequest) --}}
                                            {{-- <a
                                        href="{{ route('product-requests.show', $productRequest) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a> --}}

                                            {{-- @endcan @can('delete', $productRequest) --}}
                                            @if (Auth::user()->hasRole(App\Constants::PHARMACY_USER))
                                                <form action="{{ route('product-requests.destroy', $requestedProductRequest) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
                                            {{-- @endcan --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    {!! $RequestedProductRequests->render() !!}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
