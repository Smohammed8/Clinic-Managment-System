@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('lab-test-requests.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.lab_test_requests.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_requests.inputs.sample_collected_at')
                    </h5>
                    <span
                        >{{ $labTestRequest->sample_collected_at ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_requests.inputs.sample_analyzed_at')
                    </h5>
                    <span
                        >{{ $labTestRequest->sample_analyzed_at ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.status')</h5>
                    <span>{{ $labTestRequest->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.notification')</h5>
                    <span>{{ $labTestRequest->notification ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.note')</h5>
                    <span>{{ $labTestRequest->note ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.result')</h5>
                    <span>{{ $labTestRequest->result ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.comment')</h5>
                    <span>{{ $labTestRequest->comment ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_requests.inputs.analyser_result')
                    </h5>
                    <span>{{ $labTestRequest->analyser_result ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.approved_at')</h5>
                    <span>{{ $labTestRequest->approved_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.price')</h5>
                    <span>{{ $labTestRequest->price ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.sample_id')</h5>
                    <span>{{ $labTestRequest->sample_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lab_test_requests.inputs.ordered_on')</h5>
                    <span>{{ $labTestRequest->ordered_on ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_requests.inputs.lab_test_request_group_id')
                    </h5>
                    <span
                        >{{ optional($labTestRequest->labTestRequestGroup)->id
                        ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_requests.inputs.sample_collected_by_id
                        ')
                    </h5>
                    <span
                        >{{ optional($labTestRequest->sampleCcollectedBy)->id ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_requests.inputs.sample_analyzed_by_id
                        ')
                    </h5>
                    <span
                        >{{ optional($labTestRequest->sampleAnalyzedBy)->id ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_requests.inputs.lab_catagory_id')
                    </h5>
                    <span
                        >{{ optional($labTestRequest->labCatagory)->lab_name ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.lab_test_requests.inputs.approved_by_id ')
                    </h5>
                    <span
                        >{{ optional($labTestRequest->approvedBy)->id ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('lab-test-requests.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\LabTestRequest::class)
                <a
                    href="{{ route('lab-test-requests.create') }}"
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
