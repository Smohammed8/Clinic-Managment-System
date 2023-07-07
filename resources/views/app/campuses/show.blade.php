@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('campuses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.campuses.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.campuses.inputs.name')</h5>
                    <span>{{ $campus->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.campuses.inputs.description')</h5>
                    <span>{{ $campus->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('campuses.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Campus::class)
                <a href="{{ route('campuses.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\Clinic::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Clinics</h4>

            <livewire:campus-clinics-detail :campus="$campus" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Collage::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Collages</h4>

            <livewire:campus-collages-detail :campus="$campus" />
        </div>
    </div>
    @endcan
</div>
@endsection
