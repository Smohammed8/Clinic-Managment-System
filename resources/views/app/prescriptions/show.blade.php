@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('prescriptions.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.prescriptions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.prescriptions.inputs.drug_name')</h5>
                    <span>{{ $prescription->drug_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.prescriptions.inputs.dose')</h5>
                    <span>{{ $prescription->dose ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.prescriptions.inputs.frequency')</h5>
                    <span>{{ $prescription->frequency ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.prescriptions.inputs.duration')</h5>
                    <span>{{ $prescription->duration ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.prescriptions.inputs.other_info')</h5>
                    <span>{{ $prescription->other_info ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.prescriptions.inputs.main_diagnosis_id')
                    </h5>
                    <span
                        >{{ optional($prescription->mainDiagnosis)->id ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('prescriptions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Prescription::class)
                <a
                    href="{{ route('prescriptions.create') }}"
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
