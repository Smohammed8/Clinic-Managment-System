@extends('layouts.app_queue')

@section('content')
    <div class="container-fluid" style="height: 100vh;">
        <div class="row h-100">
            <div class="col-md-12" style="height: 65%;">
                <!-- Content for the top section -->
                <div class="m-2">
                    <h1>Queue</h1>

                    {{ Widget::run('opdQueueCard') }}
                    {{-- @widget('opdQueueCard') --}}

                </div>
            </div>
            <div class="col-md-12 bg-warning" style="height: 35%;">
                <!-- Content for the bottom section -->
                <div class="m-2">

                    {{ Widget::run('opdQueueTable') }}
                    {{-- @widget('opdQueueCard') --}}

                </div>
            </div>
        </div>
    </div>
@endsection
