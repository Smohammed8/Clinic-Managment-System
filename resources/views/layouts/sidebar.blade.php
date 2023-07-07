<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="https://vemto.app/favicon.png" alt="Vemto Logo" class="brand-image bg-white img-circle">
        <span class="brand-text font-weight-light"> JU-SIS-V2 [Imported]</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon icon ion-md-pulse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-apps"></i>
                        <p>
                            Apps
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            @can('view-any', App\Models\Appointment::class)
                            <li class="nav-item">
                                <a href="{{ route('appointments.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Appointments</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Campus::class)
                            <li class="nav-item">
                                <a href="{{ route('campuses.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Campuses</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Clinic::class)
                            <li class="nav-item">
                                <a href="{{ route('clinics.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Clinics</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\ClinicServices::class)
                            <li class="nav-item">
                                <a href="{{ route('all-clinic-services.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>All Clinic Services</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\ClinicUser::class)
                            <li class="nav-item">
                                <a href="{{ route('clinic-users.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Clinic Users</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Collage::class)
                            <li class="nav-item">
                                <a href="{{ route('collages.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Collages</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Diagnosis::class)
                            <li class="nav-item">
                                <a href="{{ route('diagnoses.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Diagnoses</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Encounter::class)
                            <li class="nav-item">
                                <a href="{{ route('encounters.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Encounters</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\LabCatagory::class)
                            <li class="nav-item">
                                <a href="{{ route('lab-catagories.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Lab Catagories</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\LabTest::class)
                            <li class="nav-item">
                                <a href="{{ route('lab-tests.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Lab Tests</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\LabTestRequest::class)
                            <li class="nav-item">
                                <a href="{{ route('lab-test-requests.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Lab Test Requests</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\LabTestRequestGroup::class)
                            <li class="nav-item">
                                <a href="{{ route('lab-test-request-groups.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Lab Test Request Groups</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\MainDiagnosis::class)
                            <li class="nav-item">
                                <a href="{{ route('main-diagnoses.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Main Diagnoses</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\MedicalRecord::class)
                            <li class="nav-item">
                                <a href="{{ route('medical-records.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Medical Records</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Prescription::class)
                            <li class="nav-item">
                                <a href="{{ route('prescriptions.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Prescriptions</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Program::class)
                            <li class="nav-item">
                                <a href="{{ route('programs.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Programs</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Religion::class)
                            <li class="nav-item">
                                <a href="{{ route('religions.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Religions</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Room::class)
                            <li class="nav-item">
                                <a href="{{ route('rooms.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Rooms</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Stock::class)
                            <li class="nav-item">
                                <a href="{{ route('stocks.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Stocks</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\StockCategory::class)
                            <li class="nav-item">
                                <a href="{{ route('stock-categories.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Stock Categories</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\StockUnit::class)
                            <li class="nav-item">
                                <a href="{{ route('stock-units.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Stock Units</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Student::class)
                            <li class="nav-item">
                                <a href="{{ route('students.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Students</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Supplier::class)
                            <li class="nav-item">
                                <a href="{{ route('suppliers.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Suppliers</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\User::class)
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\VitalSign::class)
                            <li class="nav-item">
                                <a href="{{ route('vital-signs.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Vital Signs</p>
                                </a>
                            </li>
                            @endcan
                    </ul>
                </li>

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-key"></i>
                        <p>
                            Access Management
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @endauth

                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.1//index.html" target="_blank" class="nav-link">
                        <i class="nav-icon icon ion-md-help-circle-outline"></i>
                        <p>Docs</p>
                    </a>
                </li>

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>