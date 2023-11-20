@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card m-3 p-3">
            <!-- Content Wrapper. Contains page content -->
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="">
                    <h1 class="text-center">Medical Sick Leave Letter</h1>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="card card-primary card-outline">

                    <div class="card-body">
                        <!-- Rest of your content -->
                        {{-- @dd($medicalSickLeaves) --}}
                        <div class="card-body">
                            <p class="text-right">Date: <span id="created_at">
                                    {{ optional($medicalSickLeaves)?->created_at ?? '-' }}</span></p>
                            <p>To whom it may concern,</p>
                            <p>I am writing this letter to confirm that my patient,
                                <span class="text-primary font-weight-bold ">
                                    {{ optional($medicalSickLeaves?->student)?->first_name ?? '-' }}
                                </span>, has been
                                under my care and is currently suffering from
                                <span class="text-primary font-weight-bold"> {{ $medicalSickLeaves->reason }}</span>.
                                Due to their medical
                                condition, I advise that
                                they take a medical sick leave from their academic
                                responsibilities.
                            </p>
                            <p>Based on my evaluation, I recommend that the medical leave be
                                from <span
                                    class="text-primary font-weight-bold">{{ optional($medicalSickLeaves)?->start_date ?? '-' }}
                                </span> to <span
                                    class="text-primary font-weight-bold">{{ optional($medicalSickLeaves)?->end_date ?? '-' }}</span>.
                                During this period, it is essential for the patient to rest and
                                refrain from
                                participating in any academic activities.</p>

                            <p>Your kind consideration and support for the patient during this
                                period would be
                                greatly appreciated.</p>
                            <div class="signature text-right text-primary font-weight-bold">
                                Sincerely,
                                <br>
                                By Dr. {{ optional($medicalSickLeaves?->encounter?->Doctor)?->name ?? '-' }}

                                <br>
                                {{ optional($medicalSickLeaves?->encounter?->clinic)?->name ?? '-' }}

                            </div>
                        </div>

                    </div>
                    <footer class="main-footer">
                        <div class="container text-center">
                            <?php
                            $now = Carbon\Carbon::now();
                            ?>

                            Date:[{{ $now->format('Y-m-d') }}]
                        </div>
                    </footer>
                </div>
                <!-- /.content-wrapper -->

                <!-- Main Footer -->

                <!-- Print Button -->
                <button type="button" class="btn btn-sm btn-outline-primary mx-1" onclick="printSickLeave()">
                    <i class="fas fa-print"></i> Print
                </button>

            </div>
            <!-- ./wrapper -->

            <!-- Print Button -->
            <script>
                function printSickLeave() {
                    // Hide the print button to prevent it from being included in the printed document
                    const printButton = document.querySelector('button');
                    printButton.style.display = 'none';

                    // Trigger the browser's print dialog
                    window.print();

                    // Show the print button again after printing is done (use setTimeout to ensure it shows even if the print dialog is canceled)
                    setTimeout(function() {
                        printButton.style.display = 'block';
                    }, 100);
                }
            </script>

        </div>
    </div>
@endsection
