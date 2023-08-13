@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card card-primary card-outline">
            <div class="container mt-4">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Display the list of medical sick leaves -->
            </div>
            <div class="card-header">
                @if (isset($danger_message))
                    <div class="alert alert-danger">
                        {{ $danger_message }}
                    </div>
                @endif

                <span class="badge badge-info"> <i class="fas fa-list"></i><span style="font-size: 15px;"> Ongoing encounter
                    </span> </span>
                <div class="card-tools">
                    <div class="row ">

                        <div class="small-1 float-right d-inline-block">
                            {{-- @can('update', $encounter) --}}
                            {{-- <a href="{{ route('medical-sick-leaves.show', $encounter) }}"> --}}
                            <button type="button" class="btn btn-sm btn-outline-primary mx-1" data-toggle="modal"
                                data-target="#medicalSickLeaveModal">
                                <i class="fa fa-print"></i> Sick Leave
                            </button>
                            {{-- </a> --}}
                            {{-- @endcan  --}}
                            <form action="{{ route('encounters.callNext', ['encounter' => $encounter]) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <input type="hidden" name="status" value="{{ $encounter->status }}">
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i
                                        class="fas fa-step-forward"></i>Call Next</button>
                            </form>

                            <button type="button" class="btn btn-sm d-inline-block btn-outline-primary" data-toggle="modal"
                                data-target="#roomChangeModal">
                                <i class="fas fa-door-open"></i></i>&nbsp;Change Room
                            </button>
                            {{-- @dd($encounter->Doctor->rooms) --}}

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
                            <a href="{{ route('encounters.index') }}"
                                class="btn btn-sm d-inline-block btn-outline-primary mr-3">
                                <i class="icon ion-md-arrow-back"></i>
                                Back</a>

                        </div>
                    </div>

                </div>

            </div>

            <!-- Change Room Modal Start-->
            <div class="modal fade" id="roomChangeModal" tabindex="-1" role="dialog"
                aria-labelledby="roomChangeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="roomChangeModallLabel">Select a Room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('encounters.room', ['encounter' => $encounter->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="encounter_id" value="{{ $encounter->id }}">
                            <div class="modal-body">

                                <ul class="list-group">
                                    <select id="doctorSelect" class="form-control" style="width: 100%;" name="room_id">
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </ul>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Choose Room</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Change Room Modal end-->

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
                                {{-- @foreach ($doctors as $doctor) --}}
                                {{-- <li class="list-group-item">
                                        <input type="radio" name="doctor_id" value="{{ $doctor->id }}" />
                                        {{ $doctor->name }}
                                    </li> --}}
                                <select id="doctorSelect" class="form-control" style="width: 100%;">
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                                {{-- @endforeach --}}
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="assignDoctor()">Assign
                                Doctor</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Referral Modal end-->

            <!-- Medical Sick Leave Modal Start-->
            <div class="modal fade" id="medicalSickLeaveModal" tabindex="-1" role="dialog"
                aria-labelledby="medicalSickLeaveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="medicalSickLeaveModalLabel">Create and print medical sick leave
                                latter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="content">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <form action="{{ route('medical-sick-leaves.store') }}" method="POST">
                                        @csrf

                                        <!-- Hidden inputs for student_id, doctor_id, and encounter_id -->
                                        <input type="hidden" name="student_id" id="student_id"
                                            value="{{ $encounter->student->id }}">
                                        <input type="hidden" name="doctor_id" id="doctor_id"
                                            value="{{ Auth::user()->clinicUsers->id }}">
                                        <input type="hidden" name="encounter_id" id="encounter_id"
                                            value="{{ $encounter->id }}">
                                        <div class="form-group">
                                            <label for="reason">Reason:</label>
                                            <input type="text" name="reason" id="reason" class="form-control"
                                                value="Medical Condition" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Note:</label>
                                            <textarea name="note" id="note" class="form-control" rows="3">Medical note for the sick leave.</textarea>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="medical_certificate">Medical Certificate:</label>
                                            <input type="file" name="medical_certificate" id="medical_certificate"
                                                class="form-control-file">
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control"
                                                value="2023-07-23" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="end_date">End Date:</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control"
                                                value="2023-07-28" required>
                                        </div>

                                        <div class="text-center">
                                            <!-- Submit Button with Icon -->
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-check"></i> Submit
                                            </button>

                                            <!-- Print Button with Icon -->
                                            <button type="button" class="btn btn-primary" onclick="printSickLeave()">
                                                <i class="fas fa-print"></i> Print
                                            </button>

                                            <!-- Cancel Button (using Bootstrap's "data-dismiss" attribute) -->
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Place this script in your HTML file or in a separate JS file -->

            <script>
                // Function to handle form submission
                function submitForm() {
                    // Get form data
                    var formData = {
                        reason: $('#reason').val(),
                        note: $('#note').val(),
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val(),
                        // Add any additional data that you need (student_id, doctor_id, encounter_id)
                    };

                    // Send AJAX request
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('medical-sick-leaves.store') }}', // Replace with the actual route URL
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // Handle success response, if needed
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Handle error response, if needed
                            console.error(error);
                        }
                    });
                }

                // Function to print the form (you can implement this separately if needed)
                function printSickLeave() {
                    // Implement your printing logic here
                }
            </script>

            <!-- Medical Sick Leave Modal end-->

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
                        <span>&nbsp;&nbsp;&nbsp;{{ optional($encounter)->student->fullName ?? '-' }}</span>
                    </div>

                    <div class="input-group mb-3 col-md-4">
                        <i class="fa fa-caret-right"> </i>&nbsp;
                        <span title=""> Clinic </span>

                        <span>&nbsp;&nbsp;&nbsp;&nbsp; {{ $encounter->clinic->name ?? '-' }} </span>

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
                                                href="#vert-tabs-profile" role="tab"
                                                aria-controls="vert-tabs-profile" aria-selected="false"> <i
                                                    class="fa fa-caret-right nav-icon"></i><b>
                                                    Clinical Note </b></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="vert-tabs-sign-tab" data-toggle="pill"
                                                href="#vert-tabs-sign" role="tab" aria-controls="vert-tabs-sign"
                                                aria-selected="false"> <i class="fa fa-caret-right nav-icon"></i>
                                                <b> Vital Sign</b> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="vert-tabs-main-dignosis-tab" data-toggle="pill"
                                                href="#vert-tabs-main-dignosis" role="tab"
                                                aria-controls="vert-tabs-main-dignosis" aria-selected="false"> <i
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
                                            <a class="nav-link" id="vert-tabs-medication-tab" data-toggle="pill"
                                                href="#vert-tabs-medication" role="tab"
                                                aria-controls="vert-tabs-medication" aria-selected="false"> <i
                                                    class="fa fa-caret-right nav-icon"></i><b> Prescription </b> </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link " id="vert-tabs-home-tab" data-toggle="pill"
                                                href="#vert-tabs-appointment" role="tab"
                                                aria-controls="vert-tabs-home" aria-selected="true"> <i
                                                    class="fa fa-caret-right nav-icon"></i><b>
                                                    Appointments </b> <span
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
                                                    class="fa fa-caret-right nav-icon"></i><b> Visit
                                                    History </b> </a>
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
                                                    <h4 class="card-title w-100 mb-2">Clinic Notes</h4>

                                                    <livewire:encounter-medical-records-detail :encounter="$encounter" />
                                                </div>
                                            </div>
                                        @endcan

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

                                    <div class="tab-pane fade" id="vert-tabs-main-dignosis" role="tabpanel"
                                        aria-labelledby="vert-tabs-main-dignosis-tab">
                                        @can('view-any', App\Models\MainDiagnosis::class)
                                            <div class="card mt-4">
                                                <div class="card-body">
                                                    <h4 class="card-title w-100 mb-2">Main Diagnoses</h4>

                                                    <livewire:encounter-main-diagnoses-detail :encounter="$encounter" />
                                                </div>
                                            </div>
                                        @endcan
                                    </div>

                                    <div class="tab-pane fade" id="vert-tabs-diagnosis" role="tabpanel"
                                        aria-labelledby="vert-tabs-diagnosis-tab">

                                        <div class="card mt-4">
                                            {{-- @can('view-any', App\Models\LabTestRequestGroup::class)
                                     
                                                <div class="card-body">
                                                    <h4 class="card-title w-100 mb-2"> Lab Test Group </h4>

                                                    <livewire:encounter-lab-test-request-groups-detail :encounter="$encounter" />

                                                </div>
                                                @endcan    --}}

                                            @can('view-any', App\Models\LabTestRequest::class)
                                                <div class="card-body">
                                                    <h4 class="card-title w-100 mb-2"> Lab Test Requests </h4>
                                                    <livewire:encounter-lab-test-requests-detail :encounter="$encounter" />
                                                </div>
                                            @endcan

                                            <style>
                                                select.form-control[multiple],
                                                select.form-control[size] {
                                                    height: 400px !important;
                                                }
                                            </style>

                                            <form id="demoform" method="POST" name="lab"
                                                action="{{ route('labTest.insert') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="encounter" value="{{ $encounter->id }}">

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <select multiple="multiple" size="72"
                                                                    max-height="500px" overflow-y="auto"
                                                                    name="duallistbox_demo1[]"
                                                                    title="duallistbox_demo1[]">
                                                                    @foreach ($labCategories as $labCategory)
                                                                        <optgroup id="label"
                                                                            label="{{ $labCategory->lab_name }}">
                                                                            @foreach ($labCategory->labTests as $lab)
                                                                                <option value="{{ $lab->id }}">
                                                                                    {{ $lab->labCatagory->lab_name }}-{{ $lab->test_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    @endforeach
                                                                </select>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-6 offset-md-6">
                                                                        <button type="submit"
                                                                            class="btn btn-primary w-100">Send lab
                                                                            request</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="vert-tabs-medication" role="tabpanel"
                                        aria-labelledby="vert-tabs-medication-tab">
                                        @can('view-any', App\Models\Prescription::class)
                                            <div class="card mt-4">
                                                {{-- <div class="card-body">
                                                    <h4 class="card-title w-100 mb-2">Medicine Prescription</h4>

                                                    <livewire:encounter-prescriptions-detail :encounter="$encounter" />
                                                </div> --}}

                                                <div class="p-3">
                                                    <div class="prescription-view">
                                                        <h3>Medicine Prescription</h3>
                                                        <div class="prescription-info">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p>
                                                                        <strong>Patient Name:</strong>
                                                                        <span>&nbsp;<u>{{ optional($encounter)->student->fullName ?? '-' }}
                                                                            </u></span>
                                                                    </p>
                                                                    <p>
                                                                        <strong>Date:</strong>
                                                                        <span> &nbsp;{{ $encounter->created_at ?? '-' }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p>
                                                                        <strong>Doctor Name:</strong>
                                                                        {{ $encounter->Doctor ? $encounter->Doctor->user->name : '-' }}

                                                                    </p>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="prescription-details">
                                                            <table class="table table-bordered">
                                                                <livewire:encounter-prescriptions-detail :encounter="$encounter" />
                                                            </table>
                                                            <div class="signature-section">
                                                                <p>
                                                                    <strong>Doctor's Signature:</strong>
                                                                    ________________________
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
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

                                    <div class="tab-pane fade" id="vert-tabs-sign-tab" role="tabpanel"
                                        aria-labelledby="vert-tabs-sign">

                                        @can('view-any', App\Models\VitalSign::class)
                                            <div class="card mt-4">
                                                <div class="card-body">
                                                    <h4 class="card-title w-100 mb-2">Vital Sign</h4>
                                                    <livewire:encounter-vital-signs-detail :encounter="$encounter" />
                                                </div>
                                            </div>
                                        @endcan

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
                                        <div class="tab-pane fade" id="vert-tabs-history" role="tabpanel"
                                            aria-labelledby="vert-tabs-history-tab">
                                            Tab 6 Visit history
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
        <script
            src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


            //  $("#demoform").submit(function(event) {
            //   event.preventDefault();

            $("#demoform").submit(function() {


                alert('Are you sure to send all selected labs?\n' + $('[name="duallistbox_demo1[]"]').val());
                //   Swal.fire({
                //   title: 'Error!',
                //   text: 'Do you want to continue',
                //   icon: 'error',
                //   confirmButtonText: 'Cool'
                // })

                return true


            });
        </script>
    @endsection
