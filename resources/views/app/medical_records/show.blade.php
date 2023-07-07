@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('medical-records.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.medical_records.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.medical_records.inputs.subjective')</h5>
                    <span>{{ $medicalRecord->subjective ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_records.inputs.objective')</h5>
                    <span>{{ $medicalRecord->objective ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_records.inputs.assessment')</h5>
                    <span>{{ $medicalRecord->assessment ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_records.inputs.plan')</h5>
                    <span>{{ $medicalRecord->plan ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_records.inputs.encounter_id')</h5>
                    <span
                        >{{ optional($medicalRecord->encounter)->id ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_records.inputs.clinic_user_id')</h5>
                    <span
                        >{{ optional($medicalRecord->Doctor)->id ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_records.inputs.student_id')</h5>
                    <span
                        >{{ optional($medicalRecord->student)->first_name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('medical-records.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\MedicalRecord::class)
                <a
                    href="{{ route('medical-records.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
