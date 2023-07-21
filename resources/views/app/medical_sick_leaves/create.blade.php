@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">
                        Medical Sick Leave
                    </h4>
                </div>

                <div class="table-responsive">

                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Medical Sick Leave</h2>
                                <div class="form-group">
                                    <label for="reason">Reason:</label>
                                    <div class="form-control" id="reason">Illness</div>
                                </div>
                                <div class="form-group">
                                    <label for="note">Note:</label>
                                    <div class="form-control" id="note">Flu symptoms</div>
                                </div>
                                <div class="form-group">
                                    <label for="medical_certificate">Medical Certificate:</label>
                                    <div class="form-control" id="medical_certificate">Yes</div>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <div class="form-control" id="start_date">2023-07-21</div>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <div class="form-control" id="end_date">2023-07-28</div>
                                </div>
                                <div class="form-group">
                                    <label for="created_at">Created At:</label>
                                    <div class="form-control" id="created_at">2023-07-21 08:00:00</div>
                                </div>
                                <div class="form-group">
                                    <label for="updated_at">Updated At:</label>
                                    <div class="form-control" id="updated_at">2023-07-21 08:00:00</div>
                                </div>
                                <div class="form-group">
                                    <label for="student_id">Student ID:</label>
                                    <div class="form-control" id="student_id">123456789</div>
                                </div>
                                <div class="form-group">
                                    <label for="doctor_id">Doctor ID:</label>
                                    <div class="form-control" id="doctor_id">987654321</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
