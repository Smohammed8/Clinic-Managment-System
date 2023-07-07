@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('clinics.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.clinics.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.name')</h5>
                    <span>{{ $clinic->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.code_clinic')</h5>
                    <span>{{ $clinic->code_clinic ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.description')</h5>
                    <span>{{ $clinic->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.lat')</h5>
                    <span>{{ $clinic->lat ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.long')</h5>
                    <span>{{ $clinic->long ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.campus_id')</h5>
                    <span>{{ optional($clinic->campus)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.collage_id')</h5>
                    <span>{{ optional($clinic->collage)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.status')</h5>
                    <span>{{ $clinic->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clinics.inputs.is_active')</h5>
                    <span>{{ $clinic->is_active ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('clinics.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Clinic::class)
                <a href="{{ route('clinics.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
