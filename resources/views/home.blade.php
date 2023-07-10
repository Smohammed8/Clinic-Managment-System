@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="alert alert-default" role="alert">
                      Welcome,  @if (session('status'))    {{ session('status') }}   @endif    {{ __('You are logged in!') }}
                    </div>


                </div>

                <div class="card-body">
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <br><br><br><br><br><br>
            
                     
                   

               

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
