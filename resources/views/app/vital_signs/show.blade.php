@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('vital-signs.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.vital_signs.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.temp')</h5>
                    <span>{{ $vitalSign->temp ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.blood_pressure ')</h5>
                    <span>{{ $vitalSign->blood_pressure ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.pulse_rate')</h5>
                    <span>{{ $vitalSign->pulse_rate ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.rr')</h5>
                    <span>{{ $vitalSign->rr ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.weight')</h5>
                    <span>{{ $vitalSign->weight ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.height')</h5>
                    <span>{{ $vitalSign->height ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.muac')</h5>
                    <span>{{ $vitalSign->muac ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.encounter_id')</h5>
                    <span
                        >{{ optional($vitalSign->encounter)->id ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.clinic_user_id')</h5>
                    <span>{{ optional($vitalSign->Doctor)->id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.vital_signs.inputs.student_id')</h5>
                    <span
                        >{{ optional($vitalSign->student)->first_name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('vital-signs.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\VitalSign::class)
                <a
                    href="{{ route('vital-signs.create') }}"
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
