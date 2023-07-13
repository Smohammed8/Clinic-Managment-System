@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('encounters.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.encounters.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>@lang('crud.encounters.inputs.check_in_time')</h5>
                        <span>{{ $encounter->check_in_time ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.encounters.inputs.status')</h5>
                        <span>{{ $encounter->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.encounters.inputs.student_id')</h5>
                        <span>{{ $encounter->student->id_number ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.encounters.inputs.closed_at')</h5>
                        <span>{{ $encounter->closed_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.encounters.inputs.priority')</h5>
                        <span>{{ $encounter->priority ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.encounters.inputs.clinic_id')</h5>
                        <span>{{ optional($encounter->clinic)->name ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('encounters.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Encounter::class)
                        <a href="{{ route('encounters.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        @can('view-any', App\Models\Appointment::class)
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title w-100 mb-2">Appointments</h4>

                    <livewire:encounter-appointments-detail :encounter="$encounter" />
                </div>
            </div>
            @endcan @can('view-any', App\Models\MedicalRecord::class)
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title w-100 mb-2">Medical Records</h4>

                    <livewire:encounter-medical-records-detail :encounter="$encounter" />
                </div>
            </div>
            @endcan @can('view-any', App\Models\MainDiagnosis::class)
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title w-100 mb-2">Main Diagnoses</h4>

                    <livewire:encounter-main-diagnoses-detail :encounter="$encounter" />
                </div>
            </div>
        @endcan
    </div>
@endsection
