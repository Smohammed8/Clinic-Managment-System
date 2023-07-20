<nav class="navbar navbar-expand navbar-light layout-navbar-fixed " style="background-color:#3c8dbc;">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"> </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="icon ion-md-menu"></i>
                </a>

            </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">

            @if (Auth::user()->hasRole('Lab_technician'))
              <li class="nav-item">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">2</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <span class="dropdown-item dropdown-header"><i class="far fa-bell mr-1"></i>Lab request Result </span>

                    <div class="dropdown-divider"></div>

                      <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                          <img src="{{ asset('user_photo/user.png') }}"  width="30px;" class="img-circle elevation-2" alt="">

                          <div class="media-body">
                            <h3 class="dropdown-item-title">
                              Seid Mohammed
                              <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">-</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 5 lab results </p>
                          </div>
                        </div>
                        <!-- Message End -->
                      </a>
            </li>

            @endif
            <li class="nav-item">

                       <a class="nav-link" data-toggle="dropdown" style="color:white; href="#">
                        <i class="nav-icon icon fa fa-user"></i>
                        {{-- <img src="{{ asset('user_photo/user.png') }}"  width="30px;" class="img-circle elevation-2" alt="">
                     --}}
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>



                       <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="background-color:#3c8dbc; color;white;">



                          <a href="#" class="dropdown-item"">
                            <!-- Message Start -->
                            <div class="media">

                              <div class="media-body">
                                <h3 class="dropdown-item-title">
                                  Profile
                                  <span class="float-right">
                                    Change room</span>
                                </h3>
                                <hr>
                               </div>
                            </div>

                          </a>

            </li>
            <div class="dropdown-divider"></div>
            <li class="nav-item">

                <span>
                   <a href="{{ route('logout') }}" class="nav-link" style="color:white;">
                       <i class="nav-icon icon fa fa-sign-out-alt"></i>

                           Logout


                   </a>

               </span>
               </li>

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @endguest
        </ul>
    </div>
</nav>
