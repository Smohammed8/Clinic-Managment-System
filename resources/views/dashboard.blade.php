@extends('layouts.app')

@section('content')
    {{-- @dd(Auth::user()->roles) --}}
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>






                    <div class="card-body">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>


                        <section class="content">
                            <div class="container-fluid">

                                <!-- Info boxes -->
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info elevation-1"><i
                                                    class="fas fa-users"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">Users</span>
                                                <span class="info-box-number">
                                                    {{ $users }}

                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-danger elevation-1"><i
                                                    class="fas fa-graduation-cap"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text"> Students </span>
                                                <span class="info-box-number"> {{ $students }} </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->

                                    <!-- fix for small devices only -->
                                    <div class="clearfix hidden-md-up"></div>

                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-success elevation-1"><i
                                                    class="fas fa-home"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text"> Clinics </span>
                                                <span class="info-box-number"> {{ $clinics }} </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-warning elevation-1"><i
                                                    class="fas fa-tasks"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text"> Programs </span>
                                                <span class="info-box-number"> {{ $programs }} </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Info boxes -->
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info elevation-1"><i
                                                    class="fas fa-book"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text"> Active cases</span>
                                                <span class="info-box-number">
                                                    0

                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-danger elevation-1"><i
                                                    class="fas fa-user-tie"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text"> Health worker
                                                    <span class="info-box-number"> {{ $clinic_users }} </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->

                                    <!-- fix for small devices only -->
                                    <div class="clearfix hidden-md-up"></div>

                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-success elevation-1"><i
                                                    class="fas fa-graduation-cap"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text"> Encounters </span>
                                                <span class="info-box-number">{{ $encounters }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="info-box mb-3">
                                            <span class="info-box-icon bg-warning elevation-1"><i
                                                    class="fas fa-bed"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text"> This yr cases </span>
                                                <span class="info-box-number">0</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('assets/js/canvasjs.min.js') }}"></script>

    <script>
        window.onload = function () {
            // Assuming $dataPoints contains data for each month, and months are represented as numbers (1 to 12)
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Number of Visitors by Month (Current Year)"
                },
                axisY: {
                    title: "Number of Visitors",
                    valueFormatString: "#0",
                    suffix: ""
                },
                axisX: {
                    title: "Month",
                    interval: 1,
                    intervalType: "month",
                    valueFormatString: "MMMM",
                    labelFormatter: function (e) {
                        // Convert month number to month name
                        var monthNames = [
                            "January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"
                        ];
                        return monthNames[e.value - 1]; // Months are zero-indexed
                    }
                },
                data: [{
                    type: "spline",
                    markerSize: 5,
                    yValueFormatString: "#0",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
    
            chart.render();
        }
    </script>
    
    
    
    
    
    
@endsection
