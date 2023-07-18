@extends('layouts.app')

@section('content')

<!-- common libraries -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">

<style>
.moveall,
.removeall {
  border: 1px solid #ccc !important;
  
  &:hover {
    background: #efefef;
  }
}
.moveall::after {
  content: attr(title);
  
}

.removeall::after {
  content: attr(title);
}
.form-control option {
    padding: 10px;
    border-bottom: 1px solid #efefef;
}
</style>
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

        <div class="card card-primary card-outline">

            <div class="card-header">

                <span class="badge badge-info"> <i class="fas fa-list"></i><span style="font-size: 15px;"> Ongoing encounter
                    </span> </span>
                <div class="card-tools">

                    <div class="row ">

                        <div class="small-1 float-right d-inline-block">
                            <form action="{{ route('encounters.callNext', ['encounter' => $encounter]) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <input type="hidden" name="status" value="{{ $encounter->status }}">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Call Next</button>
                            </form>

                            <button type="button" class="btn btn-sm d-inline-block btn-outline-primary" data-toggle="modal"
                                data-target="#referModal">
                                <i class="fa fa-book"> </i>&nbsp;Refer
                            </button>
                            <form action="{{ route('encounters.closeEencounter', ['encounter' => $encounter]) }}"
                                method="POST" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="status" value="{{ $encounter->status }}">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Close Encounter</button>
                            </form>
                            <a href="{{ route('encounters.index') }}" class="btn btn-sm d-inline-block btn-outline-primary">
                                <i class="icon ion-md-arrow-back"></i>
                                Back</a>

                        </div>
                    </div>

                </div>

            </div>

            <!-- Referral Modal Start-->
            <div class="modal fade" id="referModal" tabindex="-1" role="dialog" aria-labelledby="referModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="referModalLabel">Select a Doctor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                @foreach ($doctors as $doctor)
                                    {{-- <li class="list-group-item">
                                        <input type="radio" name="doctor_id" value="{{ $doctor->id }}" />
                                        {{ $doctor->name }}
                                    </li> --}}
                                    <select id="doctorSelect" class="form-control" style="width: 100%;">
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="assignDoctor()">Assign Doctor</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <script>
                $(document).ready(function() {
                    $('#doctorSelect').select2();
                });

                function assignDoctor() {
                    var selectedDoctorId = $('#doctorSelect').val();

                    // Send an AJAX request to update the encounter with the selected doctor ID
                    $.ajax({
                        url: '{{ route('encounters.refer', $encounter) }}',
                        type: 'POST',
                        data: {
                            doctor_id: selectedDoctorId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Handle success response, e.g., show a success message
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Handle error response, e.g., show an error message
                            console.log(error);
                        }
                    });
                }
            </script> --}}
            <!-- Referral Modal End-->

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
                        <span>&nbsp;<u>{{ optional($encounter)->student->fullName ?? '-' }} </u></span>
                    </div>

                    <div class="input-group mb-3 col-md-4">
                        <i class="fa fa-caret-right"> </i>&nbsp;
                        <span title="">Encounter Priority </span>
                        <span>
                            @if ($encounter->status == 0)
                                &nbsp;&nbsp;&nbsp;<span style="color:green;">: FCFS</span>
                            @else
                                &nbsp;&nbsp;&nbsp;<span style="color:red;">: High </span>
                            @endif

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
                            &nbsp;&nbsp;&nbsp; @if ($encounter->priority == 0)
                                <span style="color:red;"> waiting </span>
                            @else
                                Called
                            @endif

                        </span>

                    </div>

                    <div class="input-group mb-3 col-md-4">
                        <i class="fa fa-caret-right"> </i>&nbsp;
                        <span title="">Date of request: </span>
                        <span> &nbsp;{{ $encounter->created_at ?? '-' }}</span>
                    </div>

                    <div class="input-group mb-3 col-md-4">
                        <i class="fa fa-caret-right"> </i>&nbsp;
                        <span title="">Doctor: </span>
                        <span>&nbsp;&nbsp;&nbsp;{{ optional($encounter)->student->fullName }}</span>
                    </div>

                    <div class="input-group mb-3 col-md-4">
                        <i class="fa fa-caret-right"> </i>&nbsp;
                        <span title=""> Clinic </span>

                        <span>&nbsp;&nbsp;&nbsp;&nbsp; {{ $encounter->clinic->name }} </span>

                    </div>

                    <div class="input-group mb-3 col-md-4">
                        <i class="fa fa-caret-right"> </i>&nbsp;
                        <span title=""> Receiptionist </span>

                        <span>&nbsp;&nbsp;&nbsp;&nbsp; - </span>

                    </div>

                </div>

                <div class="card  border-warning-left-5  border border-warning">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-list"></i>
                            <b> Patient Information </b>
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-5 col-sm-3">

                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                    aria-orientation="vertical">

                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="vert-tabs-profile-tab" data-toggle="pill"
                                                href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile"
                                                aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b>
                                                    Clinical Note </b></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="vert-tabs-sign-tab" data-toggle="pill"
                                                href="#vert-tabs-sign" role="tab" aria-controls="vert-tabs-sign"
                                                aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b> Vital
                                                    Sign</b> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill"
                                                href="#vert-tabs-messages" role="tab"
                                                aria-controls="vert-tabs-messages" aria-selected="false"> <i
                                                    class="fa fa-caret-right nav-icon"></i><b> Main
                                                    Diagnoses </b></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                href="#vert-tabs-diagnosis" role="tab"
                                                aria-controls="vert-tabs-diagnosis" aria-selected="false"> <i
                                                    class="fa fa-caret-right nav-icon"></i><b> Invistigation </b> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                                href="#vert-tabs-medication" role="tab"
                                                aria-controls="vert-tabs-medication" aria-selected="false"> <i
                                                    class="fa fa-caret-right nav-icon"></i><b> Prescription </b> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="vert-tabs-home-tab" data-toggle="pill"
                                                href="#vert-tabs-appointment" role="tab"
                                                aria-controls="vert-tabs-home" aria-selected="true"> <i
                                                    class="fa fa-caret-right nav-icon"></i><b> Appointments </b> <span
                                                    class="badge bg-primary float-right">12</span></a>

                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="vert-tabs-refer-tab" data-toggle="pill"
                                                href="#vert-tabs-refer" role="tab" aria-controls="vert-tabs-refer"
                                                aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i><b>
                                                    Referral Service</b> </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="vert-tabs-history-tab" data-toggle="pill"
                                                href="#vert-tabs-history" role="tab"
                                                aria-controls="vert-tabs-history" aria-selected="false"> <i
                                                    class="fa fa-caret-right nav-icon"></i><b> Visit History </b> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane text-left fade show active " id="vert-tabs-profile"
                                        role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
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
                                                                bitters brunch meggings vegan iPhone. Dreamcatcher vegan
                                                                scenester
                                                                mlkshk. Ethical master cleanse Bushwick, occupy
                                                                Thundercats banjo cliche ennui farm-to-table mlkshk fanny
                                                                pack gluten-free.

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

                                                            <p> {{ '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                            <!-- /.col -->

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="vert-tabs-appointment" role="tabpanel"
                                        aria-labelledby="vert-tabs-appointment-tab">

                                        @can('view-any', App\Models\Appointment::class)
                                            <div class="card mt-4">
                                                <div class="card-body">
                                                    <h4 class="card-title w-100 mb-2">Appointments</h4>

                                                    <livewire:encounter-appointments-detail :encounter="$encounter" />
                                                </div>
                                            </div>
                                        @endcan

                                    </div>

                                    <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                                        aria-labelledby="vert-tabs-messages-tab">
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

                                                    <livewire:encounter-lab-test-request-groups-detail :encounter="$encounter" />

                                                </div>
                                                <style>
                                                    select.form-control[multiple], select.form-control[size] {
                                                    height: 400px !important;
                                                    }
                                                        </style>
                                               
                                                    <form id="demoform" method="POST" name="lab" action="{{ route('labTest.insert') }}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="encounter" value="{{ $encounter->id }}">
                                                        
                                                        <div class="card-body">
                                                            <div class="row">
                                                             <div class="col-12">
                                                              <div class="form-group">
                                                        
                                                        <select multiple="multiple"  size="72" max-height="500px" overflow-y="auto"  name="duallistbox_demo1[]" title="duallistbox_demo1[]">
                                                        @foreach($labCategories as $labCategory)
                                                        <optgroup id="label" label="{{ $labCategory->lab_name }}">
                                                            @foreach($labCategory->labTests as $lab)
                                                            <option value="{{ $lab->id }}"> {{ $lab->labCatagory->lab_name }}-{{ $lab->test_name }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                        @endforeach
                                                        </select>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6 offset-md-6">
                                                                <button type="submit" class="btn btn-primary w-100">Send lab request</button>
                                                                </div>
                                                            </div>
                                                        
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                    </form>
                                 </div>
                                 @endcan              
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
                                            <h4 class="card-title w-100 mb-2">Main Diagnosis</h4>
                        
                                            <livewire:encounter-main-diagnoses-detail :encounter="$encounter" />
                                        </div>
                                    </div>
                                @endcan
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
                                    <div class="tab-pane fade" id="vert-tabs-history" role="tabpanel"
                                        aria-labelledby="vert-tabs-history-tab">
                                        Tab 6 Visit history
                                    </div>

                                    <div class="tab-pane fade" id="vert-tabs-sign" role="tabpanel"
                                        aria-labelledby="vert-tabs-sign-tab">

                                        @can('view-any', App\Models\VitalSign::class)
                                            <div class="card mt-4">
                                                <div class="card-body">
                                                    <h4 class="card-title w-100 mb-2">Vital Sign</h4>
                                                    <livewire:encounter-vital-signs-detail :encounter="$encounter" />
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
{{-- <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script> --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- plugin -->
<script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js"></script>

    {{-- <script>

           //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    </script> --}}

    <script>
        var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({
          nonSelectedListLabel: 'Available labs',
          selectedListLabel: 'Selected labs',
          preserveSelectionOnMove: 'moved',
          moveAllLabel: '>>',
          removeAllLabel: '<<'

        });

        $("#demoform").submit(function() {
  
          alert('Are you sure to send all selected labs?\n' + $('[name="duallistbox_demo1[]"]').val());
        //   $("#demoform").submit(insertData);
          return true

  
        });

  



      </script>






@endsection
