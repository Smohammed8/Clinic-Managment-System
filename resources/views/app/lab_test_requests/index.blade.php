@extends('layouts.app')

@section('content')
    <div class="">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="input-group">
                            <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                                value="{{ $search ?? '' }}" class="form-control" autocomplete="off" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon ion-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\LabTestRequest::class)
                        <a href="{{ route('lab-test-requests.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">
                        @lang('crud.lab_test_requests.index_title')
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover  table-sm table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.sample_collected_at')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.sample_analyzed_at')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.status')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.notification')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.note')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.result')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.comment')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.analyser_result')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.approved_at')
                                </th>
                                <th class="text-right">
                                    @lang('crud.lab_test_requests.inputs.price')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.sample_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.ordered_on')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.lab_test_request_group_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.sample_collected_by_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.sample_analyzed_by_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.lab_catagory_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_requests.inputs.approved_by_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($labTestRequests  as $key =>  $labTestRequest)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>
                                        {{ $labTestRequest->sample_collected_at ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $labTestRequest->sample_analyzed_at ?? '-' }}
                                    </td>
                                    <td>{{ $labTestRequest->status ?? '-' }}</td>
                                    <td>{{ $labTestRequest->notification ?? '-' }}</td>
                                    <td>{{ $labTestRequest->note ?? '-' }}</td>
                                    <td>{{ $labTestRequest->result ?? '-' }}</td>
                                    <td>{{ $labTestRequest->comment ?? '-' }}</td>
                                    <td>
                                        {{ $labTestRequest->analyser_result ?? '-' }}
                                    </td>
                                    <td>{{ $labTestRequest->approved_at ?? '-' }}</td>
                                    <td>{{ $labTestRequest->price ?? '-' }}</td>
                                    <td>{{ $labTestRequest->sample_id ?? '-' }}</td>
                                    <td>{{ $labTestRequest->ordered_on ?? '-' }}</td>
                                    <td>
                                        {{ optional($labTestRequest->labTestRequestGroup)->id ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($labTestRequest->sampleCcollectedBy)->id ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($labTestRequest->sampleAnalyzedBy)->id ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($labTestRequest->labCatagory)->lab_name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($labTestRequest->approvedBy)->id ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $labTestRequest)
                                                <a href="{{ route('lab-test-requests.edit', $labTestRequest) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                                @endcan @can('view', $labTestRequest)
                                                <a href="{{ route('lab-test-requests.show', $labTestRequest) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="icon ion-md-eye"></i> Show
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $labTestRequest)
                                                <form action="{{ route('lab-test-requests.destroy', $labTestRequest) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger mx-1">
                                                        <i class="icon ion-md-trash"></i> Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="18">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="18">
                                    {!! $labTestRequests->render() !!}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
