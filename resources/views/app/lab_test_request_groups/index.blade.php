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
                    @can('create', App\Models\LabTestRequestGroup::class)
                        <a href="{{ route('lab-test-request-groups.create') }}" class="btn btn-primary">
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
                        @lang('crud.lab_test_request_groups.index_title')
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.status')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.priority')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.notification')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.call_status')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.requested_at')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.clinic_user_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.encounter_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($labTestRequestGroups  as $key =>  $labTestRequestGroup)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>{{ $labTestRequestGroup->status ?? '-' }}</td>
                                    <td>{{ $labTestRequestGroup->priority ?? '-' }}</td>
                                    <td>
                                        {{ $labTestRequestGroup->notification ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $labTestRequestGroup->call_status ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $labTestRequestGroup->requested_at ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($labTestRequestGroup->Requestedby)->id ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($labTestRequestGroup->encounter)->id ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $labTestRequestGroup)
                                                <a href="{{ route('lab-test-request-groups.edit', $labTestRequestGroup) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                                @endcan @can('view', $labTestRequestGroup)
                                                <a href="{{ route('lab-test-request-groups.show', $labTestRequestGroup) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="icon ion-md-eye"></i> Show
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $labTestRequestGroup)
                                                <form
                                                    action="{{ route('lab-test-request-groups.destroy', $labTestRequestGroup) }}"
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
                                    <td colspan="8">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    {!! $labTestRequestGroups->render() !!}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
