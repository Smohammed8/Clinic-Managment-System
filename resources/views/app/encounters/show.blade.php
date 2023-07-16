@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card">

            <div class="card collapsed-card p-3">
                <div class="card-header">
                    <h3 class="card-title w-full">
                        <a href="{{ route('encounters.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                        Current Encounter statu
                    </h3>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <span class="badge badge-info">Ongoing</span>
                        </div>
                        <div class="col-12 col-md-6 text-md-right">
                            <form method="post" action="" class="d-inline-block">
                                <input hidden="" name="call_next" value="true">
                                <button class="btn btn-sm btn-outline-primary">Call Next</button>
                            </form>
                            <button class="btn btn-sm btn-outline-primary ml-md-2" data-toggle="modal" data-target="#refer">
                                <span class="fal fa-user-plus"></span>&nbsp;Refer
                            </button>
                            <button id="finish" class="btn btn-sm btn-outline-primary ml-md-2">
                                <span class="fa fa-check"></span>&nbsp;Close Encounter
                            </button>
                            {{-- <button type="button" class="btn btn-tool card-tools" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button> --}}
                        </div>
                    </div>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: none;">
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

        </div>

        <div class="card">
            <ul class="nav nav-pills">
                @can('view-any', App\Models\MedicalRecord::class)
                    <li class="nav-item">
                        <a class="nav-link active" href="#medical-records" data-toggle="tab">Medical Records</a>
                    </li>
                @endcan

                @can('view-any', App\Models\VitalSign::class)
                    <li class="nav-item">
                        <a class="nav-link" href="#vital-signs" data-toggle="tab">Vital Signs</a>
                    </li>
                @endcan

                @can('view-any', App\Models\MainDiagnosis::class)
                    <li class="nav-item">
                        <a class="nav-link" href="#main-diagnoses" data-toggle="tab">Main Diagnoses</a>
                    </li>
                @endcan

                @can('view-any', App\Models\Appointment::class)
                    <li class="nav-item">
                        <a class="nav-link" href="#appointments" data-toggle="tab">Appointments</a>
                    </li>
                @endcan
            </ul>

            <div class="tab-content mt-4">
                @can('view-any', App\Models\MedicalRecord::class)
                    <div class="tab-pane fade show active" id="medical-records">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title w-100 mb-2">Medical Records</h4>
                                <livewire:encounter-medical-records-detail :encounter="$encounter" />
                            </div>
                        </div>
                    </div>
                @endcan

                @can('view-any', App\Models\MainDiagnosis::class)
                    <div class="tab-pane fade" id="main-diagnoses">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title w-100 mb-2">Main Diagnoses</h4>
                                <livewire:encounter-main-diagnoses-detail :encounter="$encounter" />
                            </div>
                        </div>
                    </div>
                @endcan

                @can('view-any', App\Models\VitalSign::class)
                    <div class="tab-pane fade" id="vital-signs">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title w-100 mb-2">Vital Signs</h4>
                                <livewire:encounter-vital-signs-detail :encounter="$encounter" />
                            </div>
                        </div>
                    </div>
                @endcan

                @can('view-any', App\Models\Appointment::class)
                    <div class="tab-pane fade" id="appointments">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title w-100 mb-2">Appointments</h4>
                                <livewire:encounter-appointments-detail :encounter="$encounter" />
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>

    </div>
@endsection
