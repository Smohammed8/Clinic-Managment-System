@extends('layouts.app')

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-clinic-services.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_clinic_services.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.all_clinic_services.inputs.service_name')
                    </h5>
                    <span>{{ $clinicServices->service_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.all_clinic_services.inputs.service_description')
                    </h5>
                    <span
                        >{{ $clinicServices->service_description ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-clinic-services.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ClinicServices::class)
                <a
                    href="{{ route('all-clinic-services.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\clinic_clinic_services::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Clinics</h4>

            <livewire:clinic-services-clinics-detail
                :clinicServices="$clinicServices"
            />
        </div>
    </div>
    @endcan
</div>
@endsection
