@extends('layouts.app')

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('collages.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.collages.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.collages.inputs.name')</h5>
                    <span>{{ $collage->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.collages.inputs.description')</h5>
                    <span>{{ $collage->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.collages.inputs.campus_id')</h5>
                    <span>{{ optional($collage->campus)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('collages.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Collage::class)
                <a href="{{ route('collages.create') }}" class="btn btn-light">
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

            <livewire:collage-clinics-detail :collage="$collage" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Program::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Programs</h4>

            <livewire:collage-programs-detail :collage="$collage" />
        </div>
    </div>
    @endcan
</div>
@endsection
