@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('appointments.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.appointments.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.appointments.inputs.a_date')</h5>
                    <span>{{ $appointment->a_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.appointments.inputs.reason')</h5>
                    <span>{{ $appointment->reason ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.appointments.inputs.status')</h5>
                    <span>{{ $appointment->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.appointments.inputs.encounter_id')</h5>
                    <span
                        >{{ optional($appointment->encounter)->id ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.appointments.inputs.clinic_user_id')</h5>
                    <span>{{ optional($appointment->Doctor)->id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.appointments.inputs.student_id')</h5>
                    <span
                        >{{ optional($appointment->student)->first_name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('appointments.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Appointment::class)
                <a
                    href="{{ route('appointments.create') }}"
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
