<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\CampusController;
use App\Http\Controllers\Api\ClinicController;
use App\Http\Controllers\Api\CollageController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\LabTestController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ReligionController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\EncounterController;
use App\Http\Controllers\Api\VitalSignController;
use App\Http\Controllers\Api\DiagnosisController;
use App\Http\Controllers\Api\StockUnitController;
use App\Http\Controllers\Api\ClinicUserController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ClinicRoomsController;
use App\Http\Controllers\Api\LabCatagoryController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\CampusClinicsController;
use App\Http\Controllers\Api\MedicalRecordController;
use App\Http\Controllers\Api\MainDiagnosisController;
use App\Http\Controllers\Api\StockCategoryController;
use App\Http\Controllers\Api\CampusCollagesController;
use App\Http\Controllers\Api\CampusProgramsController;
use App\Http\Controllers\Api\CollageClinicsController;
use App\Http\Controllers\Api\ClinicServicesController;
use App\Http\Controllers\Api\LabTestRequestController;
use App\Http\Controllers\Api\SupplierStocksController;
use App\Http\Controllers\Api\CollageProgramsController;
use App\Http\Controllers\Api\RoomClinicUsersController;
use App\Http\Controllers\Api\ClinicUserRoomsController;
use App\Http\Controllers\Api\StockUnitStocksController;
use App\Http\Controllers\Api\UserClinicUsersController;
use App\Http\Controllers\Api\ClinicEncountersController;
use App\Http\Controllers\Api\clinic_user_roomController;
use App\Http\Controllers\Api\ClinicClinicUsersController;
use App\Http\Controllers\Api\ClinicUserClinicsController;
use App\Http\Controllers\Api\StudentVitalSignsController;
use App\Http\Controllers\Api\clinic_clinic_userController;
use App\Http\Controllers\Api\EncounterVitalSignsController;
use App\Http\Controllers\Api\LabTestRequestGroupController;
use App\Http\Controllers\Api\LabCatagoryLabTestsController;
use App\Http\Controllers\Api\StockCategoryStocksController;
use App\Http\Controllers\Api\StudentAppointmentsController;
use App\Http\Controllers\Api\ClinicUserVitalSignsController;
use App\Http\Controllers\Api\StudentMainDiagnosesController;
use App\Http\Controllers\Api\EncounterAppointmentsController;
use App\Http\Controllers\Api\ClinicServicesClinicsController;
use App\Http\Controllers\Api\StudentMedicalRecordsController;
use App\Http\Controllers\Api\EncounterMainDiagnosesController;
use App\Http\Controllers\Api\clinic_clinic_servicesController;
use App\Http\Controllers\Api\ClinicUserAppointmentsController;
use App\Http\Controllers\Api\DiagnosisMainDiagnosesController;
use App\Http\Controllers\Api\ClinicAllClinicServicesController;
use App\Http\Controllers\Api\EncounterMedicalRecordsController;
use App\Http\Controllers\Api\ClinicUserMainDiagnosesController;
use App\Http\Controllers\Api\ClinicUserMedicalRecordsController;
use App\Http\Controllers\Api\ClinicUserLabTestRequestsController;
use App\Http\Controllers\Api\MainDiagnosisPrescriptionsController;
use App\Http\Controllers\Api\LabCatagoryLabTestRequestsController;
use App\Http\Controllers\Api\EncounterLabTestRequestGroupsController;
use App\Http\Controllers\Api\ClinicUserLabTestRequestGroupsController;
use App\Http\Controllers\Api\LabTestRequestGroupLabTestRequestsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('appointments', AppointmentController::class);

        Route::apiResource('campuses', CampusController::class);

        // Campus Collages
        Route::get('/campuses/{campus}/collages', [
            CampusCollagesController::class,
            'index',
        ])->name('campuses.collages.index');
        Route::post('/campuses/{campus}/collages', [
            CampusCollagesController::class,
            'store',
        ])->name('campuses.collages.store');

        // Campus Clinics
        Route::get('/campuses/{campus}/clinics', [
            CampusClinicsController::class,
            'index',
        ])->name('campuses.clinics.index');
        Route::post('/campuses/{campus}/clinics', [
            CampusClinicsController::class,
            'store',
        ])->name('campuses.clinics.store');

        // Campus Programs
        Route::get('/campuses/{campus}/programs', [
            CampusProgramsController::class,
            'index',
        ])->name('campuses.programs.index');
        Route::post('/campuses/{campus}/programs', [
            CampusProgramsController::class,
            'store',
        ])->name('campuses.programs.store');

        Route::apiResource('clinics', ClinicController::class);

        // Clinic Rooms
        Route::get('/clinics/{clinic}/rooms', [
            ClinicRoomsController::class,
            'index',
        ])->name('clinics.rooms.index');
        Route::post('/clinics/{clinic}/rooms', [
            ClinicRoomsController::class,
            'store',
        ])->name('clinics.rooms.store');

        // Clinic Encounters
        Route::get('/clinics/{clinic}/encounters', [
            ClinicEncountersController::class,
            'index',
        ])->name('clinics.encounters.index');
        Route::post('/clinics/{clinic}/encounters', [
            ClinicEncountersController::class,
            'store',
        ])->name('clinics.encounters.store');

        // Clinic All Clinic Services
        Route::get('/clinics/{clinic}/all-clinic-services', [
            ClinicAllClinicServicesController::class,
            'index',
        ])->name('clinics.all-clinic-services.index');
        Route::post('/clinics/{clinic}/all-clinic-services/{clinicServices}', [
            ClinicAllClinicServicesController::class,
            'store',
        ])->name('clinics.all-clinic-services.store');
        Route::delete(
            '/clinics/{clinic}/all-clinic-services/{clinicServices}',
            [ClinicAllClinicServicesController::class, 'destroy']
        )->name('clinics.all-clinic-services.destroy');

        // Clinic Clinic Users
        Route::get('/clinics/{clinic}/clinic-users', [
            ClinicClinicUsersController::class,
            'index',
        ])->name('clinics.clinic-users.index');
        Route::post('/clinics/{clinic}/clinic-users/{clinicUser}', [
            ClinicClinicUsersController::class,
            'store',
        ])->name('clinics.clinic-users.store');
        Route::delete('/clinics/{clinic}/clinic-users/{clinicUser}', [
            ClinicClinicUsersController::class,
            'destroy',
        ])->name('clinics.clinic-users.destroy');

        Route::apiResource(
            'all-clinic-services',
            ClinicServicesController::class
        );

        // ClinicServices Clinics
        Route::get('/all-clinic-services/{clinicServices}/clinics', [
            ClinicServicesClinicsController::class,
            'index',
        ])->name('all-clinic-services.clinics.index');
        Route::post('/all-clinic-services/{clinicServices}/clinics/{clinic}', [
            ClinicServicesClinicsController::class,
            'store',
        ])->name('all-clinic-services.clinics.store');
        Route::delete(
            '/all-clinic-services/{clinicServices}/clinics/{clinic}',
            [ClinicServicesClinicsController::class, 'destroy']
        )->name('all-clinic-services.clinics.destroy');

        Route::apiResource('clinic-users', ClinicUserController::class);

        // ClinicUser Appointments
        Route::get('/clinic-users/{clinicUser}/appointments', [
            ClinicUserAppointmentsController::class,
            'index',
        ])->name('clinic-users.appointments.index');
        Route::post('/clinic-users/{clinicUser}/appointments', [
            ClinicUserAppointmentsController::class,
            'store',
        ])->name('clinic-users.appointments.store');

        // ClinicUser Vital Signs
        Route::get('/clinic-users/{clinicUser}/vital-signs', [
            ClinicUserVitalSignsController::class,
            'index',
        ])->name('clinic-users.vital-signs.index');
        Route::post('/clinic-users/{clinicUser}/vital-signs', [
            ClinicUserVitalSignsController::class,
            'store',
        ])->name('clinic-users.vital-signs.store');

        // ClinicUser Medical Records
        Route::get('/clinic-users/{clinicUser}/medical-records', [
            ClinicUserMedicalRecordsController::class,
            'index',
        ])->name('clinic-users.medical-records.index');
        Route::post('/clinic-users/{clinicUser}/medical-records', [
            ClinicUserMedicalRecordsController::class,
            'store',
        ])->name('clinic-users.medical-records.store');

        // ClinicUser Lab Test Request Groups
        Route::get('/clinic-users/{clinicUser}/lab-test-request-groups', [
            ClinicUserLabTestRequestGroupsController::class,
            'index',
        ])->name('clinic-users.lab-test-request-groups.index');
        Route::post('/clinic-users/{clinicUser}/lab-test-request-groups', [
            ClinicUserLabTestRequestGroupsController::class,
            'store',
        ])->name('clinic-users.lab-test-request-groups.store');

        // ClinicUser Lab Test Requests
        Route::get('/clinic-users/{clinicUser}/lab-test-requests', [
            ClinicUserLabTestRequestsController::class,
            'index',
        ])->name('clinic-users.lab-test-requests.index');
        Route::post('/clinic-users/{clinicUser}/lab-test-requests', [
            ClinicUserLabTestRequestsController::class,
            'store',
        ])->name('clinic-users.lab-test-requests.store');

        // ClinicUser Lab Test Requests2
        Route::get('/clinic-users/{clinicUser}/lab-test-requests', [
            ClinicUserLabTestRequestsController::class,
            'index',
        ])->name('clinic-users.lab-test-requests.index');
        Route::post('/clinic-users/{clinicUser}/lab-test-requests', [
            ClinicUserLabTestRequestsController::class,
            'store',
        ])->name('clinic-users.lab-test-requests.store');

        // ClinicUser Lab Test Requests3
        Route::get('/clinic-users/{clinicUser}/lab-test-requests', [
            ClinicUserLabTestRequestsController::class,
            'index',
        ])->name('clinic-users.lab-test-requests.index');
        Route::post('/clinic-users/{clinicUser}/lab-test-requests', [
            ClinicUserLabTestRequestsController::class,
            'store',
        ])->name('clinic-users.lab-test-requests.store');

        // ClinicUser Main Diagnoses
        Route::get('/clinic-users/{clinicUser}/main-diagnoses', [
            ClinicUserMainDiagnosesController::class,
            'index',
        ])->name('clinic-users.main-diagnoses.index');
        Route::post('/clinic-users/{clinicUser}/main-diagnoses', [
            ClinicUserMainDiagnosesController::class,
            'store',
        ])->name('clinic-users.main-diagnoses.store');

        // ClinicUser Clinics
        Route::get('/clinic-users/{clinicUser}/clinics', [
            ClinicUserClinicsController::class,
            'index',
        ])->name('clinic-users.clinics.index');
        Route::post('/clinic-users/{clinicUser}/clinics/{clinic}', [
            ClinicUserClinicsController::class,
            'store',
        ])->name('clinic-users.clinics.store');
        Route::delete('/clinic-users/{clinicUser}/clinics/{clinic}', [
            ClinicUserClinicsController::class,
            'destroy',
        ])->name('clinic-users.clinics.destroy');

        // ClinicUser Rooms
        Route::get('/clinic-users/{clinicUser}/rooms', [
            ClinicUserRoomsController::class,
            'index',
        ])->name('clinic-users.rooms.index');
        Route::post('/clinic-users/{clinicUser}/rooms/{room}', [
            ClinicUserRoomsController::class,
            'store',
        ])->name('clinic-users.rooms.store');
        Route::delete('/clinic-users/{clinicUser}/rooms/{room}', [
            ClinicUserRoomsController::class,
            'destroy',
        ])->name('clinic-users.rooms.destroy');

        Route::apiResource('collages', CollageController::class);

        // Collage Clinics
        Route::get('/collages/{collage}/clinics', [
            CollageClinicsController::class,
            'index',
        ])->name('collages.clinics.index');
        Route::post('/collages/{collage}/clinics', [
            CollageClinicsController::class,
            'store',
        ])->name('collages.clinics.store');

        // Collage Programs
        Route::get('/collages/{collage}/programs', [
            CollageProgramsController::class,
            'index',
        ])->name('collages.programs.index');
        Route::post('/collages/{collage}/programs', [
            CollageProgramsController::class,
            'store',
        ])->name('collages.programs.store');

        Route::apiResource('diagnoses', DiagnosisController::class);

        // Diagnosis Main Diagnoses
        Route::get('/diagnoses/{diagnosis}/main-diagnoses', [
            DiagnosisMainDiagnosesController::class,
            'index',
        ])->name('diagnoses.main-diagnoses.index');
        Route::post('/diagnoses/{diagnosis}/main-diagnoses', [
            DiagnosisMainDiagnosesController::class,
            'store',
        ])->name('diagnoses.main-diagnoses.store');

        Route::apiResource('encounters', EncounterController::class);

        // Encounter Appointments
        Route::get('/encounters/{encounter}/appointments', [
            EncounterAppointmentsController::class,
            'index',
        ])->name('encounters.appointments.index');
        Route::post('/encounters/{encounter}/appointments', [
            EncounterAppointmentsController::class,
            'store',
        ])->name('encounters.appointments.store');

        // Encounter Vital Signs
        Route::get('/encounters/{encounter}/vital-signs', [
            EncounterVitalSignsController::class,
            'index',
        ])->name('encounters.vital-signs.index');
        Route::post('/encounters/{encounter}/vital-signs', [
            EncounterVitalSignsController::class,
            'store',
        ])->name('encounters.vital-signs.store');

        // Encounter Medical Records
        Route::get('/encounters/{encounter}/medical-records', [
            EncounterMedicalRecordsController::class,
            'index',
        ])->name('encounters.medical-records.index');
        Route::post('/encounters/{encounter}/medical-records', [
            EncounterMedicalRecordsController::class,
            'store',
        ])->name('encounters.medical-records.store');

        // Encounter Lab Test Request Groups
        Route::get('/encounters/{encounter}/lab-test-request-groups', [
            EncounterLabTestRequestGroupsController::class,
            'index',
        ])->name('encounters.lab-test-request-groups.index');
        Route::post('/encounters/{encounter}/lab-test-request-groups', [
            EncounterLabTestRequestGroupsController::class,
            'store',
        ])->name('encounters.lab-test-request-groups.store');

        // Encounter Main Diagnoses
        Route::get('/encounters/{encounter}/main-diagnoses', [
            EncounterMainDiagnosesController::class,
            'index',
        ])->name('encounters.main-diagnoses.index');
        Route::post('/encounters/{encounter}/main-diagnoses', [
            EncounterMainDiagnosesController::class,
            'store',
        ])->name('encounters.main-diagnoses.store');

        Route::apiResource('lab-catagories', LabCatagoryController::class);

        // LabCatagory Lab Tests
        Route::get('/lab-catagories/{labCatagory}/lab-tests', [
            LabCatagoryLabTestsController::class,
            'index',
        ])->name('lab-catagories.lab-tests.index');
        Route::post('/lab-catagories/{labCatagory}/lab-tests', [
            LabCatagoryLabTestsController::class,
            'store',
        ])->name('lab-catagories.lab-tests.store');

        // LabCatagory Lab Test Requests
        Route::get('/lab-catagories/{labCatagory}/lab-test-requests', [
            LabCatagoryLabTestRequestsController::class,
            'index',
        ])->name('lab-catagories.lab-test-requests.index');
        Route::post('/lab-catagories/{labCatagory}/lab-test-requests', [
            LabCatagoryLabTestRequestsController::class,
            'store',
        ])->name('lab-catagories.lab-test-requests.store');

        Route::apiResource('lab-tests', LabTestController::class);

        Route::apiResource(
            'lab-test-requests',
            LabTestRequestController::class
        );

        Route::apiResource(
            'lab-test-request-groups',
            LabTestRequestGroupController::class
        );

        // LabTestRequestGroup Lab Test Requests
        Route::get(
            '/lab-test-request-groups/{labTestRequestGroup}/lab-test-requests',
            [LabTestRequestGroupLabTestRequestsController::class, 'index']
        )->name('lab-test-request-groups.lab-test-requests.index');
        Route::post(
            '/lab-test-request-groups/{labTestRequestGroup}/lab-test-requests',
            [LabTestRequestGroupLabTestRequestsController::class, 'store']
        )->name('lab-test-request-groups.lab-test-requests.store');

        Route::apiResource('main-diagnoses', MainDiagnosisController::class);

        // MainDiagnosis Prescriptions
        Route::get('/main-diagnoses/{mainDiagnosis}/prescriptions', [
            MainDiagnosisPrescriptionsController::class,
            'index',
        ])->name('main-diagnoses.prescriptions.index');
        Route::post('/main-diagnoses/{mainDiagnosis}/prescriptions', [
            MainDiagnosisPrescriptionsController::class,
            'store',
        ])->name('main-diagnoses.prescriptions.store');

        Route::apiResource('medical-records', MedicalRecordController::class);

        Route::apiResource('prescriptions', PrescriptionController::class);

        Route::apiResource('programs', ProgramController::class);

        Route::apiResource('religions', ReligionController::class);

        Route::apiResource('rooms', RoomController::class);

        // Room Clinic Users
        Route::get('/rooms/{room}/clinic-users', [
            RoomClinicUsersController::class,
            'index',
        ])->name('rooms.clinic-users.index');
        Route::post('/rooms/{room}/clinic-users/{clinicUser}', [
            RoomClinicUsersController::class,
            'store',
        ])->name('rooms.clinic-users.store');
        Route::delete('/rooms/{room}/clinic-users/{clinicUser}', [
            RoomClinicUsersController::class,
            'destroy',
        ])->name('rooms.clinic-users.destroy');

        Route::apiResource('stocks', StockController::class);

        Route::apiResource('stock-categories', StockCategoryController::class);

        // StockCategory Stocks
        Route::get('/stock-categories/{stockCategory}/stocks', [
            StockCategoryStocksController::class,
            'index',
        ])->name('stock-categories.stocks.index');
        Route::post('/stock-categories/{stockCategory}/stocks', [
            StockCategoryStocksController::class,
            'store',
        ])->name('stock-categories.stocks.store');

        Route::apiResource('stock-units', StockUnitController::class);

        // StockUnit Stocks
        Route::get('/stock-units/{stockUnit}/stocks', [
            StockUnitStocksController::class,
            'index',
        ])->name('stock-units.stocks.index');
        Route::post('/stock-units/{stockUnit}/stocks', [
            StockUnitStocksController::class,
            'store',
        ])->name('stock-units.stocks.store');

        Route::apiResource('students', StudentController::class);

        // Student Vital Signs
        Route::get('/students/{student}/vital-signs', [
            StudentVitalSignsController::class,
            'index',
        ])->name('students.vital-signs.index');
        Route::post('/students/{student}/vital-signs', [
            StudentVitalSignsController::class,
            'store',
        ])->name('students.vital-signs.store');

        // Student Medical Records
        Route::get('/students/{student}/medical-records', [
            StudentMedicalRecordsController::class,
            'index',
        ])->name('students.medical-records.index');
        Route::post('/students/{student}/medical-records', [
            StudentMedicalRecordsController::class,
            'store',
        ])->name('students.medical-records.store');

        // Student Main Diagnoses
        Route::get('/students/{student}/main-diagnoses', [
            StudentMainDiagnosesController::class,
            'index',
        ])->name('students.main-diagnoses.index');
        Route::post('/students/{student}/main-diagnoses', [
            StudentMainDiagnosesController::class,
            'store',
        ])->name('students.main-diagnoses.store');

        // Student Appointments
        Route::get('/students/{student}/appointments', [
            StudentAppointmentsController::class,
            'index',
        ])->name('students.appointments.index');
        Route::post('/students/{student}/appointments', [
            StudentAppointmentsController::class,
            'store',
        ])->name('students.appointments.store');

        Route::apiResource('suppliers', SupplierController::class);

        // Supplier Stocks
        Route::get('/suppliers/{supplier}/stocks', [
            SupplierStocksController::class,
            'index',
        ])->name('suppliers.stocks.index');
        Route::post('/suppliers/{supplier}/stocks', [
            SupplierStocksController::class,
            'store',
        ])->name('suppliers.stocks.store');

        Route::apiResource('users', UserController::class);

        // User Clinic Users
        Route::get('/users/{user}/clinic-users', [
            UserClinicUsersController::class,
            'index',
        ])->name('users.clinic-users.index');
        Route::post('/users/{user}/clinic-users', [
            UserClinicUsersController::class,
            'store',
        ])->name('users.clinic-users.store');

        Route::apiResource('vital-signs', VitalSignController::class);
    });
