<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-dark" style="background-color: #0067ba;">
        <img src="https://upload.wikimedia.org/wikipedia/en/f/fe/Current_Logo_of_Jimma_University.png" alt="JU Logo"
            class="brand-image">
        <span class="brand-text font-weight-light" style="color: white"><strong style="font-size:20px;">JU
                SIS</strong></span>
        <a href="{{ url('/') }}" class="brand-link text-dark" style="background-color:#3c8dbc;">
            <img src="https://upload.wikimedia.org/wikipedia/en/f/fe/Current_Logo_of_Jimma_University.png"
                alt="JU Logo" class="brand-image">
            <span class="brand-text font-weight-light" style="color: white"><strong style="font-size:20px;">JU
                    SIS</strong></span>
        </a>
        <style>
            .nav-pills .nav-link.active {
                color: #fff;
                background-color: gray !important;


            }
        </style>
        <!-- Sidebar -->
        <div class="sidebar" style="overflow-y: auto; max-height: calc(100vh - 84px);">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                    role="menu">
                    @auth
                    @if(Auth::user()->hasRole('store_user'))
                    <li>
                        <a href="{{ route('products.index') }}"
                        class="nav-link {{ Request::is('store*') ? 'active' : '' }}"                        >
                            <i class="nav-icon icon fas fa-home"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>


                    @endif
                        <li class="nav-item {{ Request::is('home*') ? 'menu-open' : '' }}">
                            <a href="{{ route('home') }}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
                                <i class="nav-icon icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('dashboard*') ? 'menu-open' : '' }}">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                                <i class="nav-icon icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                                Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                            <li class="nav-item has-treeview {{ Request::is('roles*', 'permissions*', 'clinic-users*', 'users*') ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ Request::is('roles*', 'permissions*', 'clinic-users*', 'users*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        User Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('view-any', Spatie\Permission\Models\Role::class)
                                        <li class="nav-item">
                                            <a href="{{ route('roles.index') }}"
                                                class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                                <p>Roles</p>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('view-any', Spatie\Permission\Models\Permission::class)
                                        <li class="nav-item">
                                            <a href="{{ route('permissions.index') }}"
                                                class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
                                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                                <p>Permissions</p>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('view-any', App\Models\User::class)
                                        <li class="nav-item">
                                            <a href="{{ route('users.index') }}"
                                                class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                                                <i class="fas fa-user"></i>
                                                <p>Users</p>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('view-any', App\Models\ClinicUser::class)
                                        <li class="nav-item">
                                            <a href="{{ route('clinic-users.index') }}"
                                                class="nav-link {{ Request::is('clinic-users*') ? 'active' : '' }}">
                                                <i class="fas fa-user-md"></i>
                                                <p>Clinic Users</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endif
                    @endauth




                    <li class="nav-item has-treeview {{ Request::is( 'lab-test-requests*', 'lab-test-request-groups*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="fas fa-flask"></i>
                            <p>
                                &nbsp;Laboratory
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>


                    <ul class="nav nav-treeview">


                        @can('view-any', App\Models\LabTestRequest::class)
                        <li class="nav-item">
                            <a href="{{ route('lab-test-requests.index') }}"
                                class="nav-link {{ Request::is('lab-test-requests*') ? 'active' : '' }}">
                                <i class="fa fa-caret-right nav-icon"></i>
                                <p> Lab Test Requests</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\LabTestRequestGroup::class)
                        <li class="nav-item">
                            <a href="{{ route('lab-test-request-groups.index') }}"
                                class="nav-link {{ Request::is('lab-test-request-groups*') ? 'active' : '' }}">
                                <i class="fa fa-caret-right nav-icon"></i>
                                <p>Lab Request Groups</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\LabCatagory::class)

                    <li class="nav-item">
                            <a href="{{ route('lab-catagories.index') }}"
                                class="nav-link {{ Request::is('lab-catagories*') ? 'active' : '' }}">
                                <i class="fa fa-caret-right nav-icon"></i>
                                <p>Lab Categories</p>
                            </a>
                        </li>
                    @endcan

                    @can('view-any', App\Models\LabTest::class)
                        <li class="nav-item">
                            <a href="{{ route('lab-tests.index') }}"
                                class="nav-link {{ Request::is('lab-tests*') ? 'active' : '' }}">
                                <i class="fa fa-caret-right nav-icon"></i>
                                <p>Lab Tests</p>
                            </a>
                        </li>
                    @endcan
                    </ul>
                </li>


                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-clinic-medical"></i>
                            <p>
                                OPD & Recieption
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- @can('view-any', App\Models\Encounter::class)
                            <li class="nav-item">
                                <a href="{{ route('encounters.index') }}"
                                    class="nav-link {{ Request::is('encounters*') ? 'active' : '' }}">
                                    <i class="fad fa-watch-fitness"></i>
                                    <p>Encounters</p>
                                </a>
                            </li>
                        @endcan --}}

                            @can('view-any', App\Models\Student::class)
                                <li class="nav-item">
                                    <a href="{{ route('students.index') }}" class="nav-link">
                                        <i class="fa fa-caret-right nav-icon"></i>
                                        <p>Student List</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Student::class)
                                <li class="nav-item">
                                    <a href="{{ route('students.index') }}" class="nav-link">
                                        <i class="fa fa-caret-right nav-icon"></i>
                                        <p>Patient check-in</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Encounter::class)
                                <li class="nav-item">
                                    <a href="{{ route('encounters.index') }}"
                                        class="nav-link {{ Request::is('encounters*') ? 'active' : '' }}">
                                        <i class="fa fa-caret-right nav-icon"></i>
                                        <p>Encounter</p>
                                    </a>
                                </li>
                            @endcan


                            {{-- @can('view-any', App\Models\Appointment::class)
                                <li class="nav-item">
                                    <a href="{{ route('appointments.index') }}"
                                        class="nav-link {{ Request::is('appointments*') ? 'active' : '' }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <p>Appointments</p>
                                    </a>
                                </li>
                            @endcan --}}



                            {{-- @can('view-any', App\Models\MainDiagnosis::class)
                                <li class="nav-item">
                                    <a href="{{ route('main-diagnoses.index') }}"
                                        class="nav-link {{ Request::is('main-diagnoses*') ? 'active' : '' }}">
                                        <i class="fas fa-diagnoses"></i>
                                        <p>Main Diagnoses</p>
                                    </a>
                                </li>
                            @endcan --}}

                            {{-- @can('view-any', App\Models\MedicalRecord::class)
                                <li class="nav-item">
                                    <a href="{{ route('medical-records.index') }}"
                                        class="nav-link {{ Request::is('medical-records*') ? 'active' : '' }}">
                                        <i class="fas fa-notes-medical"></i>
                                        <p>Medical Records</p>
                                    </a>
                                </li>
                            @endcan --}}

                            {{-- @can('view-any', App\Models\Prescription::class)
                                <li class="nav-item">
                                    <a href="{{ route('prescriptions.index') }}"
                                        class="nav-link {{ Request::is('prescriptions*') ? 'active' : '' }}">
                                        <i class="fas fa-prescription-bottle-alt"></i>
                                        <p>Prescriptions</p>
                                    </a>
                                </li>
                            @endcan --}}

                            @can('view-any', App\Models\Stock::class)
                                <li class="nav-item">
                                    <a href="{{ route('stocks.index') }}"
                                        class="nav-link {{ Request::is('stocks*') ? 'active' : '' }}">
                                        <i class="fa fa-caret-right nav-icon"></i>
                                        <p> Stocks</p>
                                    </a>
                                </li>
                            @endcan

                            {{-- @can('view-any', App\Models\Student::class)
                            <li class="nav-item">
                                <a href="{{ route('students.index') }}"
                                    class="nav-link {{ Request::is('students*') ? 'active' : '' }}">
                                    <i class="fas fa-user-graduate"></i>
                                    <p>Students</p>
                                </a>
                            </li>
                        @endcan --}}

                        </ul>
                    </li>

                    <li
                        class="nav-item has-treeview {{ Request::is('campuses*', 'clinics*', 'all-clinic-services*', 'collages*', 'diagnoses*', 'religions*', 'rooms*', 'stock-categories*', 'stock-units*', 'suppliers*') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Request::is('campuses*', 'clinics*', 'all-clinic-services*', 'collages*', 'diagnoses*', 'religions*', 'rooms*', 'stock-categories*', 'stock-units*', 'suppliers*') ? 'active' : '' }}">
                            <i class="fas fa-wrench"></i>
                            <p>
                                Setting
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('view-any', App\Models\Campus::class)
                                <li class="nav-item">
                                    <a href="{{ route('campuses.index') }}"
                                        class="nav-link {{ Request::is('campuses*') ? 'active' : '' }}">
                                        <i class="fas fa-university"></i>
                                        <p>Campuses</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Clinic::class)
                                <li class="nav-item">
                                    <a href="{{ route('clinics.index') }}"
                                        class="nav-link {{ Request::is('clinics*') ? 'active' : '' }}">
                                        <i class="fas fa-clinic-medical"></i>
                                        <p>Clinics</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\ClinicServices::class)
                                <li class="nav-item">
                                    <a href="{{ route('all-clinic-services.index') }}"
                                        class="nav-link {{ Request::is('all-clinic-services*') ? 'active' : '' }}">
                                        <i class="fas fa-laptop-medical"></i>
                                        <p>All Clinic Services</p>
                                    </a>
                                </li>
                            @endcan



                            @can('view-any', App\Models\Collage::class)
                                <li class="nav-item">
                                    <a href="{{ route('collages.index') }}"
                                        class="nav-link {{ Request::is('collages*') ? 'active' : '' }}">
                                        <i class="fas fa-university"></i>
                                        <p>Collages</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Diagnosis::class)
                                <li class="nav-item">
                                    <a href="{{ route('diagnoses.index') }}"
                                        class="nav-link {{ Request::is('diagnoses*') ? 'active' : '' }}">
                                        <i class="fas fa-diagnoses"></i>
                                        <p>Diagnoses</p>
                                    </a>
                                </li>
                            @endcan


                            @can('view-any', App\Models\Program::class)
                                <li class="nav-item">
                                    <a href="{{ route('programs.index') }}"
                                        class="nav-link {{ Request::is('programs*') ? 'active' : '' }}">
                                        <i class="fas fa-graduation-cap"></i>
                                        <p>Programs</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Religion::class)
                                <li class="nav-item">
                                    <a href="{{ route('religions.index') }}"
                                        class="nav-link {{ Request::is('religions*') ? 'active' : '' }}">
                                        <i class="fas fa-praying-hands"></i>
                                        <p>Religions</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Room::class)
                                <li class="nav-item">
                                    <a href="{{ route('rooms.index') }}"
                                        class="nav-link {{ Request::is('rooms*') ? 'active' : '' }}">
                                        <i class="fas fa-door-closed"></i>
                                        <p>Rooms</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\StockCategory::class)
                                <li class="nav-item">
                                    <a href="{{ route('stock-categories.index') }}"
                                        class="nav-link {{ Request::is('stock-categories*') ? 'active' : '' }}">
                                        <i class="fas fa-tags"></i>
                                        <p>Stock Categories</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\StockUnit::class)
                                <li class="nav-item">
                                    <a href="{{ route('stock-units.index') }}"
                                        class="nav-link {{ Request::is('stock-units*') ? 'active' : '' }}">
                                        <i class="fas fa-balance-scale"></i>
                                        <p>Stock Units</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Supplier::class)
                                <li class="nav-item">
                                    <a href="{{ route('suppliers.index') }}"
                                        class="nav-link {{ Request::is('suppliers*') ? 'active' : '' }}">
                                        <i class="fas fa-truck"></i>
                                        <p>Suppliers</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon icon fa fa-sign-out-alt"></i>
                            <p>
                                Logout

                            </p>
                        </a>


                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
</aside>
