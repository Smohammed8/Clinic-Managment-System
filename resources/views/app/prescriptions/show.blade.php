@extends('layouts.app')

@section('content')
    <div class="container prescription-paper">
        <div class="row prescription-header">
            <div class="col-2">
                <img src="{{ asset('your-logo.png') }}" alt="Logo" class="logo-img">
            </div>
            <div class="col-10">
                <h4 class="prescription-title">Medical Prescription</h4>
            </div>
        </div>

        <div class="row prescription-body">
            <div class="col-md-6">
                <div class="prescription-details">
                    <div class="mb-4">
                        <span class="prescription-label">Patient Name:</span>
                        <span class="prescription-value">{{ $prescription->patient_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="prescription-label">Date:</span>
                        <span class="prescription-value">{{ $prescription->date ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="prescription-details">
                    <div class="mb-4">
                        <span class="prescription-label">Doctor Name:</span>
                        <span class="prescription-value">{{ $prescription->doctor_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="prescription-label">Doctor Specialization:</span>
                        <span class="prescription-value">{{ $prescription->doctor_specialization ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row prescription-medicines">
            <div class="col-12">
                <h5 class="prescription-subtitle">Prescribed Medicines:</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Drug Name</th>
                            <th>Dose</th>
                            <th>Frequency</th>
                            <th>Duration</th>
                            <th>Instructions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prescription->medicines as $medicine)
                            <tr>
                                <td>{{ $medicine->drug_name }}</td>
                                <td>{{ $medicine->dose }}</td>
                                <td>{{ $medicine->frequency }}</td>
                                <td>{{ $medicine->duration }}</td>
                                <td>{{ $medicine->instructions }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row prescription-doctor-info">
            <div class="col-12">
                <p class="prescription-label">Doctor's Information:</p>
                <ul class="prescription-doctor-details">
                    <li><strong>Doctor Name:</strong> {{ $prescription->doctor_name ?? '-' }}</li>
                    <li><strong>Doctor Specialization:</strong> {{ $prescription->doctor_specialization ?? '-' }}</li>
                    <li><strong>Date:</strong> {{ $prescription->date ?? '-' }}</li>
                    <!-- Add more necessary details here -->
                </ul>
            </div>
        </div>

        <div class="row prescription-footer mt-4">
            <div class="col-12">
                <p class="prescription-signature">Doctor's Signature: ________________________</p>
            </div>
        </div>
    </div>
@endsection
