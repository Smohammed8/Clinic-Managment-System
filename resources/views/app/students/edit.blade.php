@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('students.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.students.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('students.update', $student) }}"
                has-files
                class="mt-4"
            >
                @include('app.students.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('students.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('students.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
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
