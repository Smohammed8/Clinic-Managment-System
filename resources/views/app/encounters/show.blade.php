@extends('layouts.app')

@section('content')
 <!-- Bootstrap4 Duallistbox -->
 <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

    <div class="">
        {{-- <div class="card">

            <div class="card collapsed-card p-3">
                <div class="card-header">
                    <h3 class="card-title w-full">
                        <a href="{{ route('encounters.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                        Current Encounter statu
                    </h3>
                    <div class="row ">
                        <span class="badge badge-info">Ongoing</span>
                        <div class="small-1 float-right d-inline-block">
                            <form method="post" action="" class="d-inline-block">
                                <input hidden="" name="call_next" value="true">
                                <button class="btn btn-sm btn-outline-primary">Call Next</button>
                            </form>

                            <button class="btn btn-sm d-inline-block btn-outline-primary" data-toggle="modal"
                                data-target="#refer">
                                <span class="fal fa-user-plus"></span>&nbsp;Refer</button>
                            <button id="finish" class="btn btn-sm d-inline-block btn-outline-primary">
                                <span class="fa fa-check d-inline-block"></span>&nbsp;Close Encounter</button>

                        </div>
                    </div>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: none;">
                    <div class="mt-4">
                        <div class="mb-4">
                            <h5>@lang('crud.encounters.inputs.check_in_time')</h5>
                            <span>{{ $encounter->check_in_time ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.encounters.inputs.status')</h5>
                            <span>{{ $encounter->status ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.encounters.inputs.student_id')</h5>
                            <span>{{ $encounter->student->id_number ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.encounters.inputs.closed_at')</h5>
                            <span>{{ $encounter->closed_at ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.encounters.inputs.priority')</h5>
                            <span>{{ $encounter->priority ?? '-' }}</span>
                        </div>
                        <div class="mb-4">
                            <h5>@lang('crud.encounters.inputs.clinic_id')</h5>
                            <span>{{ optional($encounter->clinic)->name ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('encounters.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left"></i>
                            @lang('crud.common.back')
                        </a>

                        @can('create', App\Models\Encounter::class)
                            <a href="{{ route('encounters.create') }}" class="btn btn-light">
                                <i class="icon ion-md-add"></i> @lang('crud.common.create')
                            </a>
                        @endcan
                    </div>
                </div>

            </div>

        </div> --}}



        <div class="card">

            <div class="card-header">
       
      
                <span class="badge badge-info"> <i  class="fas fa-list"></i><span style="font-size: 15px;"> Ongoing encounter </span>  </span>
                <div class="card-tools">
              
                    <div class="row ">
                      
                        <div class="small-1 float-right d-inline-block">
                            <form method="post" action="" class="d-inline-block">
                                <input hidden="" name="call_next" value="true">
                                <button class="btn btn-sm btn-outline-primary"><i class="fa fa-user"> </i> Call Next</button>
                            </form>

                            <button class="btn btn-sm d-inline-block btn-outline-primary" data-toggle="modal"
                                data-target="#refer">
                                <i class="fa fa-book"> </i>&nbsp;Refer</button>
                          
                                <button id="finish" class="btn btn-sm d-inline-block btn-outline-primary">
                                <span class="fa fa-check d-inline-block"></span>&nbsp;Close Encounter</button>


                                    <a href="{{ route('encounters.index') }}"
                                     class="btn btn-sm d-inline-block btn-outline-primary">
                                      <i class="icon ion-md-arrow-back"></i> 
                                        Back</a>
                             

                        </div>
                    </div>

        
                </div>
             
            </div>


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
                                <span>&nbsp;<u>{{  optional($encounter)->student->fullName ?? '-' }} </u></span>
                            </div>

                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Encounter Priority </span>
                                <span>
                                    @if($encounter->status  == 0) &nbsp;&nbsp;&nbsp;<span style= "color:green;">: FCFS</span> @else  &nbsp;&nbsp;&nbsp;<span style= "color:red;">: High </span>  @endif    
                                    
                                 
                                
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
                                    &nbsp;&nbsp;&nbsp; @if($encounter->priority == 0) <span style= "color:red;"> waiting </span> @else Called  @endif
                                
                                </span>
                
                            </div>

                      

                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Date of request:  </span>
                                <span> &nbsp;{{ $encounter->created_at  ?? '-' }}</span>
                            </div>


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title="">Doctor: </span>
                                <span>&nbsp;&nbsp;&nbsp;{{ optional($encounter)->student->fullName }}</span>
                            </div>


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title=""> Clinic </span>

                                <span>&nbsp;&nbsp;&nbsp;&nbsp; {{ $encounter->clinic->name }}  </span>
                
                            </div>


                            <div class="input-group mb-3 col-md-4">
                                <i class="fa fa-caret-right"> </i>&nbsp;
                                <span title=""> Receiptionist </span>

                                <span>&nbsp;&nbsp;&nbsp;&nbsp; -  </span>
                
                            </div>


                          
                        </div>
                
                       <div class="card  sborder-primary-left-5  border border-primary">

                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fas fa-list"></i>
                           <b> Patient Information </b>
                          </h3>
                        </div>
               
                            <div class="card-body">
                        
                          <div class="row">

                            <div class="col-5 col-sm-3">

                              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            
                          <ul class="nav nav-pills flex-column">  
                            <li class="nav-item">
                                <a class="nav-link active" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b> Clinical Note </b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="vert-tabs-sign-tab" data-toggle="pill" href="#vert-tabs-sign" role="tab" aria-controls="vert-tabs-sign" aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b> Vital Sign</b> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b> Main Diagnoses </b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-diagnosis" role="tab" aria-controls="vert-tabs-diagnosis" aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b> Invistigation </b> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-medication" role="tab" aria-controls="vert-tabs-medication" aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b> Prescription </b> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-appointment" role="tab" aria-controls="vert-tabs-home" aria-selected="true">  <i class="fa fa-caret-right nav-icon"></i><b> Appointments </b>  <span class="badge bg-primary float-right">12</span></a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="vert-tabs-history-tab" data-toggle="pill" href="#vert-tabs-history" role="tab" aria-controls="vert-tabs-history" aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b> Visit History </b> </a>
                            </li>
                        </ul>
                            </div>
                            </div>
                            <div class="col-7 col-sm-9">
                              <div class="tab-content" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade show active " id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                    @can('view-any', App\Models\MedicalRecord::class)
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h4 class="card-title w-100 mb-2">Medical Records</h4>
                        
                                            <livewire:encounter-medical-records-detail :encounter="$encounter" />
                                        </div>
                                    </div>
                                    @endcan


                                    <div class="row">
                                        <div class="col-md-12">
                                          <div class="card card-default">
                                            <div class="card-header">
                                              <h3 class="card-title">
                                                <i class="fas fa-book"></i>
                                                Clinical Note
                                              </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="callout callout-danger">
                                                  <h5> <b>Subjective </b></h5>
                                
                                                  <p>
                                                    Keffiyeh blog actually fashion axe vegan, irony biodiesel. 
                                                    Cold-pressed hoodie chillwave put a bird on it aesthetic, 
                                                    bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester 
                                                    mlkshk. Ethical master cleanse Bushwick, occupy 
                                                    Thundercats banjo cliche ennui farm-to-table mlkshk fanny pack gluten-free. 

                                                </p>
                                                </div>
                                                <div class="callout callout-info">
                                                  <h5><b> Objective</b></h5>
                                
                                                  <p> {{ '-' }}</p>
                                                </div>
                                                <div class="callout callout-warning">
                                                  <h5><b> Assessment </b></h5>
                                
                                                  <p>{{ '-' }}</p>
                                                </div>
                                                <div class="callout callout-success">
                                                  <h5> <b>Plan </b></h5>
                                
                                                  <p> {{'-' }}</p>
                                                </div>
                                              </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="vert-tabs-appointment" role="tabpanel" aria-labelledby="vert-tabs-appointment-tab">
                                  
                                    @can('view-any', App\Models\Appointment::class)
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h4 class="card-title w-100 mb-2">Appointments</h4>
                        
                                            <livewire:encounter-appointments-detail :encounter="$encounter" />
                                        </div>
                                    </div>
                                    @endcan 

                                </div>
                           
                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                    @can('view-any', App\Models\MainDiagnosis::class)
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h4 class="card-title w-100 mb-2">Main Diagnoses</h4>
                        
                                            <livewire:encounter-main-diagnoses-detail :encounter="$encounter" />
                                        </div>
                                    </div>
                                @endcan
                                </div>

                                <div class="tab-pane fade" id="vert-tabs-diagnosis" role="tabpanel" aria-labelledby="vert-tabs-diagnosis-tab">
                                 
                                    @can('view-any', App\Models\LabTestRequestGroup::class)
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h4 class="card-title w-100 mb-2"> Lab Test Requests </h4>
                                

                                            <livewire:encounter-lab-test-request-groups-detail :encounter="$encounter"/>

                                        </div>
                                    </div>
                                    @endcan



                                    <div class="card card-default">
                                        <div class="card-header">
                                          <h3 class="card-title"> Lab Request lists</h3>
                              
                                          <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                              <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                              <i class="fas fa-times"></i>
                                            </button>
                                          </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                          <div class="row">
                                            <div class="col-12">
                                              <div class="form-group">
                                            
                                                <select class="duallistbox" multiple="multiple">
                                                  <option selected>CBC</option>
                                                  <option>AFT</option>
                                                  <option>Fluid Analysis</option>
                                                  <option> Urine Analysis</option>
                                                  <option> WBC</option>
                                                  <option> Stool Exam </option>
                                               
                                                </select>
                                              </div>
                                              <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- /.row -->
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary float-right">Send</button>
                                              </div>
                                        </div>
                                      </div>
                                      <!-- /.card -->


                                </div>

                                <div class="tab-pane fade" id="vert-tabs-medication" role="tabpanel" aria-labelledby="vert-tabs-medication-tab">
                                   Tab 5 Prescription

                                   {{-- @can('view-any', App\Models\Prescription::class)
                                   <div class="card mt-4">
                                       <div class="card-body">
                                           <h4 class="card-title w-100 mb-2"> Prescriptions </h4>
                             

                                           <livewire:main-diagnosis-prescriptions-detail :main-diagnosis="$mainDiagnosis"/>
                                     
                                        </div>
                                   </div>
                                   @endcan --}}


                                </div>
                                <div class="tab-pane fade" id="vert-tabs-history" role="tabpanel" aria-labelledby="vert-tabs-history-tab">
                                   Tab 6 Visit history
                                </div>

                                <div class="tab-pane fade" id="vert-tabs-sign" role="tabpanel" aria-labelledby="vert-tabs-sign-tab">
                                   
                                    @can('view-any', App\Models\VitalSign::class)
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h4 class="card-title w-100 mb-2">Vital Sign</h4>
                                            <livewire:encounter-vital-signs-detail :encounter="$encounter"/>
                                        </div>
                                    </div>
                                @endcan

                                 </div>

                             
                              </div>
                            </div>
                          </div>
                     
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.card -->




            </div>
        </div>



    </div>

<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

    <script>

           //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    </script>
@endsection
