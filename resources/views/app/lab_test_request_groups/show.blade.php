@extends('layouts.app')

@section('content')
 
<div class="card  sborder-primary-left-5  border border-primary">
 

        {{-- <div class="card  collapsed-card border-primary-left-5  border border-primary">
  --}}

            <div class="card-header">
       
                <b>  <i  class="fas fa-list"></i> Encounter Information  </b>
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
                                <span title=""> Patient Name: &nbsp; </span>
                                <span>&nbsp;<u>{{  optional($labTestRequestGroup->encounter)->student->fullName ?? '-' }} </u></span>
                            </div>

                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter Priority </span>
                                <span>
                                    @if($labTestRequestGroup->priority == 0) &nbsp;&nbsp;&nbsp;<span style= "color:green;">: FCFS</span> @else  &nbsp;&nbsp;&nbsp;<span style= "color:red;">: High </span>  @endif    
                                    
                                 
                                
                                </span>
                
                            </div>

                            {{-- <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter Status </span>
                                <span>{{ $labTestRequestGroup->notification ?? '-' }}</span>
                
                            </div> --}}


                       


    


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter call status: </span>
                                <span>                                
                                    &nbsp;&nbsp;&nbsp; @if($labTestRequestGroup->call_status == 0) <span style= "color:red;"> waiting </span> @else Called  @endif
                                
                                </span>
                
                            </div>

                      

                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Date of request  </span>
                                <span>{{ $labTestRequestGroup->requested_at ?? '-' }}</span>
                            </div>


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Doctor: </span>
                                <span>&nbsp;&nbsp;&nbsp;{{ optional($labTestRequestGroup->requestedby)->user->name }}</span>
                            </div>


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter Status </span>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp; @if($labTestRequestGroup->status == 0) <span style= "color:red;"> Pending </span> @else <i class="fa fa-check"> </i>  @endif </span>
                
                            </div>


                          
                        </div>
                    
            

                <div class="mt-4">
                

                    <a href="{{ route('lab-test-request-groups.index') }}" class="btn btn-sm btn-outline-primary float-right mx-1">
                        <i class="icon fa fa-user"></i>
                        Call now
                    </a>
                    <a href="{{ route('lab-test-request-groups.index') }}" class="btn btn-sm btn-outline-primary float-right mx-1">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>


                    {{-- @can('create', App\Models\LabTestRequestGroup::class)
                        <a href="{{ route('lab-test-request-groups.create') }}" class="btn btn-sm btn-outline-primary float-right mx-1">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan --}}
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
