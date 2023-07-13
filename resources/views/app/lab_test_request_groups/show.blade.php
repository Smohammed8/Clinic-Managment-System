@extends('layouts.app')

@section('content')
 
<div class="card  sborder-primary-left-5  border border-primary">
 

        {{-- <div class="card  collapsed-card border-primary-left-5  border border-primary">
  --}}

            <div class="card-header">
       
                <b>  <i  class="fas fa-list"></i> Incounter Information  </b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus   "></i>
                    </button>
        
                </div>
             
            </div>

        <div class="card">
            <div class="card-body">
                {{-- <h4 class="card-title">
                    <a href="{{ route('lab-test-request-groups.index') }}" class="mr-4"><i
                            class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.lab_test_request_groups.show_title')
                </h4> --}}

                        <div class="row m-2">
                
                   
                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter Status </span>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp; {{ $labTestRequestGroup->status ?? '-' }} </span>
                
                            </div>
                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter priority </span>
                                <span>{{ $labTestRequestGroup->priority ?? '-' }}</span>
                
                            </div>

                            {{-- <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter Status </span>
                                <span>{{ $labTestRequestGroup->notification ?? '-' }}</span>
                
                            </div> --}}


                       


    


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter call status </span>
                                <span>{{ $labTestRequestGroup->call_status ?? '-' }}</span>
                
                            </div>

                      

                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Date of request  </span>
                                <span>{{ $labTestRequestGroup->requested_at ?? '-' }}</span>
                            </div>


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Doctor </span>
                                <span>{{ optional($labTestRequestGroup->Requestedby)->id ?? '-' }}</span>
                            </div>


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">patient  </span>
                                <span>{{  optional($labTestRequestGroup->encounter)->student->fullName ?? '-' }}</span>
                            </div>




                          
                        </div>
                    
            

                <div class="mt-4">
                    <a href="{{ route('lab-test-request-groups.index') }}" class="btn btn-sm btn-outline-primary float-right mx-1">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\LabTestRequestGroup::class)
                        <a href="{{ route('lab-test-request-groups.create') }}" class="btn btn-sm btn-outline-primary float-right mx-1">
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

                    <livewire:lab-test-request-group-lab-test-requests-detail :labTestRequestGroup="$labTestRequestGroup" />
                </div>
            </div>
        @endcan
    </div>
@endsection
