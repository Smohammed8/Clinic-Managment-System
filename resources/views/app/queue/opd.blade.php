@extends('layouts.app_queue')

@section('content')
    <div class="container-fluid" style="height: 100vh;">
        <div class="row h-75">
            <div class="col-6" style="height: 65%;">
                <h1>Queue</h1>
                <div class="p-2">
                    {{ Widget::run('opdQueueCard') }}
                </div>
            </div>
            <div class="col-6" style="height: 65%;">
                <div class="">
                    <!-- Content for the col-3 section -->
                    <video width="100%" controls>
                        <source src="{{ asset('videos/1.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
        <div class="col-md-12 bg-info" style="height: 35%;">
            <!-- Content for the bottom section -->
            <div class="p-2">
                {{ Widget::run('opdQueueTable') }}
            </div>
        </div>
    </div>
@endsection
