@extends('layouts.app')

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('students.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.students.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.first_name')</h5>
                    <span>{{ $student->first_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.middle_name')</h5>
                    <span>{{ $student->middle_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.last_name')</h5>
                    <span>{{ $student->last_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.sex')</h5>
                    <span>{{ $student->sex ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.photo')</h5>
                    <x-partials.thumbnail
                        src="{{ $student->photo ? \Storage::url($student->photo) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.id_number')</h5>
                    <span>{{ $student->id_number ?? '-' }}</span>
                </div>
                {{-- <div class="mb-4">
                    <h5>@lang('crud.students.inputs.encounter_id')</h5>
                    <span>{{ optional($student->encounter)->id ?? '-' }}</span>
                </div> --}}
            </div>

            <div class="mt-4">
                <a href="{{ route('students.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Student::class)
                <a href="{{ route('students.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\VitalSign::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Vital Signs</h4>

            <livewire:student-vital-signs-detail :student="$student" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\MainDiagnosis::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Main Diagnoses</h4>

            <livewire:student-main-diagnoses-detail :student="$student" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Appointment::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Appointments</h4>

            <livewire:student-appointments-detail :student="$student" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\MedicalRecord::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Medical Records</h4>

            <livewire:student-medical-records-detail :student="$student" />
        </div>
    </div>
    @endcan
</div>
@endsection
