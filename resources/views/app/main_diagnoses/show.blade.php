@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('main-diagnoses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.main_diagnoses.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.main_diagnoses.inputs.clinic_user_id')</h5>
                    <span
                        >{{ optional($mainDiagnosis->Doctor)->id ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.main_diagnoses.inputs.student_id')</h5>
                    <span
                        >{{ optional($mainDiagnosis->student)->first_name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.main_diagnoses.inputs.encounter_id')</h5>
                    <span
                        >{{ optional($mainDiagnosis->encounter)->id ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.main_diagnoses.inputs.diagnosis_id')</h5>
                    <span
                        >{{ optional($mainDiagnosis->diagnosis)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('main-diagnoses.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\MainDiagnosis::class)
                <a
                    href="{{ route('main-diagnoses.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\Prescription::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Prescriptions</h4>

            <livewire:main-diagnosis-prescriptions-detail
                :mainDiagnosis="$mainDiagnosis"
            />
        </div>
    </div>
    @endcan
</div>
@endsection
