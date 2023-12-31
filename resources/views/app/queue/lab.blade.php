@extends('layouts.app_queue')
@section('content')
    <div class="container-fluid" style="height: 100vh;">
        <div class="row h-100">
            <div class="col-12" style="height: 65%;">
                <!-- Content for the top section -->
                <h1> Lab Queue</h1>

                <div class="p-2 col-6 ">

                    {{ Widget::run('labQueueCard') }}
                    {{-- @widget('opdQueueCard') --}}

                </div>
            </div>
            <div class="col-md-12 bg-info" style="height: 35%;">
                <!-- Content for the bottom section -->
                <div class="m-2">
                    {{ Widget::run('labQueueTable') }}
                    {{-- @widget('opdQueueCard') --}}

                </div>
            </div>
        </div>
    </div>
@endsection
