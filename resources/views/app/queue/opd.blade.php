@extends('layouts.app_queue')

@section('content')
    <div class="m-2">
        <h1>Queue</h1>

        {{ Widget::run('opdQueueCard') }}
        {{-- @widget('opdQueueCard') --}}

    </div>
@endsection
