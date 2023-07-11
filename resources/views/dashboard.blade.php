@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}

                    
                    <section class="content">
                        <div class="container-fluid">
                    
                            <!-- Info boxes -->
                            <div class="row">
                              <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box">
                                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                      
                                  <div class="info-box-content">
                                    <span class="info-box-text">Users</span>
                                    <span class="info-box-number">
                                      1
                                  
                                    </span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>
                              <!-- /.col -->
                              <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-graduation-cap"></i></span>
                      
                                  <div class="info-box-content">
                                    <span class="info-box-text"> Students </span>
                                    <span class="info-box-number">3</span>
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
                                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-home"></i></span>
                      
                                  <div class="info-box-content">
                                    <span class="info-box-text"> Clinics </span>
                                    <span class="info-box-number">4</span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>
                              <!-- /.col -->
                              <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tasks"></i></span>
                      
                                  <div class="info-box-content">
                                    <span class="info-box-text"> Programs  </span>
                                    <span class="info-box-number">40</span>
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
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>
                    
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
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>
                    
                                <div class="info-box-content">
                                  <span class="info-box-text"> Health worker
                                  <span class="info-box-number">0</span>
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
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-graduation-cap"></i></span>
                    
                                <div class="info-box-content">
                                  <span class="info-box-text"> Queue list </span>
                                  <span class="info-box-number">0</span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                              <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bed"></i></span>
                    
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
@endsection
