@extends('layouts.app')
@section('content')
    <div class="">
        <div class="col-md-12">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile row">
                    <div class="col-5">
                        <div class="text-center">
                            <img src="https://sis.ju.edu.et/student/5e006ad8b57c5.jpg"
                                class=" img-fluid img-circle
                                img-bordered" alt="user"
                                width="200" ,height="200">
                        </div>
                        <h3 class="profile-username text-center ">
                            {{ $student->first_name ?? '-' }}
                            {{ $student->middle_name ?? '-' }}
                            {{ $student->last_name ?? '-' }}

                        </h3>
                        <p class="text-muted text-center">MRN:
                            {{ $student->id_number ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-7">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>ID Number</b>
                                <a class="float-right">{{ $student->id_number ?? '-' }}</a>
                            </li>
                            </li>
                            <li class="list-group-item">
                                <b>Program</b>
                                <a class="float-right">{{ $student->program->name ?? '-' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Campus</b>
                                <a class="float-right">{{ $student->campus->name ?? '-' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender</b>
                                <a class="float-right">{{ $student->sex ?? '-' }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card">
                @can('view-any', App\Models\MedicalRecord::class)
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4 class="card-title w-100 mb-2">Medical Records</h4>
                            <livewire:student-medical-records-detail :student="$student" />
                        </div>
                    </div>
                @endcan
            </div>
            @can('view-any', App\Models\VitalSign::class)
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title w-100 mb-2">Vital Signs</h4>
                        <livewire:student-vital-signs-detail :student="$student" />
                    </div>
                </div>
            @endcan
            @can('view-any', App\Models\MainDiagnosis::class)
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title w-100 mb-2">Main Diagnoses</h4>
                        <livewire:student-main-diagnoses-detail :student="$student" />
                    </div>
                </div>
            @endcan
            @can('view-any', App\Models\Appointment::class)
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title w-100 mb-2">Appointments</h4>
                        <livewire:student-appointments-detail :student="$student" />
                    </div>
                </div>
            @endcan

        </div>
    </div>
@endsection
