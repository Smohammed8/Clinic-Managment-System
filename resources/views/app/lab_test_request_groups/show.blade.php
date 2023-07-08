@extends('layouts.app')

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a
                    href="{{ route('lab-test-request-groups.index') }}"
                    class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.lab_test_request_groups.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_request_groups.inputs.status')</h5>
                    <span>{{ $labTestRequestGroup->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_request_groups.inputs.priority')
                    </h5>
                    <span>{{ $labTestRequestGroup->priority ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_request_groups.inputs.notification')
                    </h5>
                    <span>{{ $labTestRequestGroup->notification ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_request_groups.inputs.call_status')
                    </h5>
                    <span>{{ $labTestRequestGroup->call_status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_request_groups.inputs.requested_at')
                    </h5>
                    <span>{{ $labTestRequestGroup->requested_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_request_groups.inputs.clinic_user_id')
                    </h5>
                    <span
                        >{{ optional($labTestRequestGroup->Requestedby)->id ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_request_groups.inputs.encounter_id')
                    </h5>
                    <span
                        >{{ optional($labTestRequestGroup->encounter)->id ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('lab-test-request-groups.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\LabTestRequestGroup::class)
                <a
                    href="{{ route('lab-test-request-groups.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\LabTestRequest::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Lab Test Requests</h4>

            <livewire:lab-test-request-group-lab-test-requests-detail
                :labTestRequestGroup="$labTestRequestGroup"
            />
        </div>
    </div>
    @endcan
</div>
@endsection
