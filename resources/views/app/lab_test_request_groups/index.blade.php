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
                    <b>  Lab request Group -[ First come first Served(FCFS)] </b>
                    </h4>
                </div>
<br>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                  Patient Name
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.status')
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.priority')
                                </th>
                                <th class="text-left">
                                  Total Requests
                                </th>
                                <th class="text-left">
                                    @lang('crud.lab_test_request_groups.inputs.call_status')
                                </th>
                                <th class="text-left">
                                    Date of sent
                                </th>
                                <th class="text-left">
                                    Doctor 
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
                                    <td>{{ optional($labTestRequestGroup->encounter)->student->fullName ?? '-' }}</td>
                                    <td>{{$labTestRequestGroup->status ? 'Pending' : 'Closed'}} </td>

                                    


                                    <td>
                                    
                                        {{$labTestRequestGroup->priority ? 'FCFS' : 'High'}} 
                                    
                                    </td>
                                    <td>{{ $labTestRequestGroup->labTestRequests->count() }}</td>
                                    <td>{{$labTestRequestGroup->call_status  ? 'Waiting' : 'Called'}} 
                                        
                                    
                                    </td>
                                    <td>{{ $labTestRequestGroup->requested_at ?? '-' }}</td>
                                    <td>{{ $labTestRequestGroup->clinic_user_id->user->name ?? '-' }}</td>
                                  
                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                                @can('update', $labTestRequestGroup)
                                                <a href="{{ route('lab-test-request-groups.edit', $labTestRequestGroup) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                      <i class="fa fa-plus"></i> Take Sample
                                                    </button>
                                                  </button>
                                              </a>
                                              @endcan

                                               @can('view', $labTestRequestGroup)
                                                <a href="{{ route('lab-test-request-groups.show', $labTestRequestGroup) }}">
                                                      <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-list"></i> Add Result
                                                    </button>
                                                </a>
                                                @endcan
                                                @can('update', $labTestRequestGroup)
                                                <a href="{{ route('lab-test-request-groups.edit', $labTestRequestGroup) }}">
                                                      <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                                @endcan

                                            
                                                 @can('delete', $labTestRequestGroup)
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
