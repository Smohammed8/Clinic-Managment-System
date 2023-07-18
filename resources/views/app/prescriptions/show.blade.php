@extends('layouts.app')

@section('content')
    <div class="container prescription-paper">
        <div class="row prescription-header">
            {{-- <div class="col-2">
                <img src="{{ asset('your-logo.png') }}" alt="Logo" class="logo-img">
            </div> --}}
            <div class="col-10">
                <h4 class="prescription-title">Medical Prescription</h4>
            </div>
        </div>

        <div class="row prescription-body">
            <div class="col-md-6">
                <div class="prescription-details">
                    <div class="mb-4">
                        <span class="prescription-label">Patient Name:</span>
                        <span class="prescription-value">{{ $prescription->encounter->student->first_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="prescription-label">Date:</span>
                        <span class="prescription-value">{{ $prescription->created_at ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="prescription-details">
                    <div class="mb-4">
                        <span class="prescription-label">Doctor Name:</span>
                        {{-- <span class="prescription-value">{{ $prescription->encounter->Doctor->user->name ?? '-' }}</span> --}}
                    </div>

                </div>
            </div>
        </div>

        <div class="row prescription-details">
            <div class="col-12">
                <h5 class="prescription-subtitle">Prescription Details:</h5>
                <div class="mb-4">
                    <span class="prescription-label">Drug Name:</span>
                    <span class="prescription-value">{{ $prescription->drug_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <span class="prescription-label">Dose:</span>
                    <span class="prescription-value">{{ $prescription->dose ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <span class="prescription-label">Frequency:</span>
                    <span class="prescription-value">{{ $prescription->frequency ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <span class="prescription-label">Duration:</span>
                    <span class="prescription-value">{{ $prescription->duration ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <span class="prescription-label">Other Info:</span>
                    <span class="prescription-value">{{ $prescription->other_info ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <span class="prescription-label">Main Diagnosis ID:</span>
                    <span class="prescription-value">{{ optional($prescription->mainDiagnosis)->id ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="row prescription-footer mt-4">
            <div class="col-12">
                <p class="prescription-signature">Doctor's Signature: ________________________</p>
            </div>
        </div>
    </div>
@endsection
