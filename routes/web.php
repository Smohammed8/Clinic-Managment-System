<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\CollageController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\EncounterController;
use App\Http\Controllers\StockUnitController;
use App\Http\Controllers\VitalSignController;
use App\Http\Controllers\ClinicUserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LabCatagoryController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\MainDiagnosisController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\StockCategoryController;
use App\Http\Controllers\ClinicServicesController;
use App\Http\Controllers\LabTestRequestController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\ItemsInPharmacyController;
use App\Http\Controllers\MedicalSickLeaveController;
use App\Http\Controllers\LabTestRequestGroupController;
use App\Http\Controllers\SRSController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('/login');
});


Auth::routes();

Route::get('/home', [SRSController::class, 'insert'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/lab-queue', [QueueController::class, 'getLabQueue']);
Route::get('/opd-queue', [QueueController::class, 'getOPDQueue']);


Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('appointments', AppointmentController::class);
        Route::resource('campuses', CampusController::class);
        Route::resource('clinics', ClinicController::class);
        Route::get('all-clinic-services', [
            ClinicServicesController::class,
            'index',
        ])->name('all-clinic-services.index');
        Route::post('all-clinic-services', [
            ClinicServicesController::class,
            'store',
        ])->name('all-clinic-services.store');
        Route::get('all-clinic-services/create', [
            ClinicServicesController::class,
            'create',
        ])->name('all-clinic-services.create');
        Route::get('all-clinic-services/{clinicServices}', [
            ClinicServicesController::class,
            'show',
        ])->name('all-clinic-services.show');
        Route::get('all-clinic-services/{clinicServices}/edit', [
            ClinicServicesController::class,
            'edit',
        ])->name('all-clinic-services.edit');
        Route::put('all-clinic-services/{clinicServices}', [
            ClinicServicesController::class,
            'update',
        ])->name('all-clinic-services.update');
        Route::delete('all-clinic-services/{clinicServices}', [
            ClinicServicesController::class,
            'destroy',
        ])->name('all-clinic-services.destroy');

        Route::resource('clinic-users', ClinicUserController::class);
        Route::resource('collages', CollageController::class);
        Route::resource('diagnoses', DiagnosisController::class);
        Route::resource('encounters', EncounterController::class);
        Route::get('/reception', [EncounterController::class, 'reception']);

        Route::resource('lab-catagories', LabCatagoryController::class);
        Route::resource('lab-tests', LabTestController::class);
        Route::resource('lab-test-requests', LabTestRequestController::class);

        Route::post('/labtest/request', [LabTestRequestController::class, 'insert'])->name('labTest.insert');

        Route::resource('lab-test-request-groups', LabTestRequestGroupController::class);
        Route::resource('main-diagnoses', MainDiagnosisController::class);
        Route::resource('medical-records', MedicalRecordController::class);
        Route::resource('prescriptions', PrescriptionController::class);
        Route::resource('programs', ProgramController::class);
        Route::resource('religions', ReligionController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('stocks', StockController::class);
        Route::resource('stock-categories', StockCategoryController::class);
        Route::resource('stock-units', StockUnitController::class);
        Route::resource('students', StudentController::class);
        Route::resource('suppliers', SupplierController::class);


        Route::post('/user/{user}/assignPharmacy', [UserController::class, 'assignPharamacyPlace'])->name('user.assignPharamacyPlace');
        Route::post('/user/{user}/assignStore', [UserController::class, 'assignStorePlace'])->name('user.assignStorePlace');

        // Route::post('/')
        Route::resource('users', UserController::class);
        Route::resource('vital-signs', VitalSignController::class);


        Route::post('/encounters/{encounter}', [EncounterController::class, 'callNext'])->name('encounters.callNext');
        // Route::post('/encounters/{encounter}/call-next', 'EncounterController@callNext')->name('encounters.callNext');
        Route::post('/encounters/{encounter}/refer', [EncounterController::class, 'refer'])->name('encounters.refer');
        Route::post('/encounters/{encounter}/room', [EncounterController::class, 'room'])->name('encounters.room');

        Route::get('/encounters/{encounter}/accept', [EncounterController::class, 'accept'])->name('encounters.accept');


        Route::post('/encounters/{encounter}/close', [EncounterController::class, 'closeEencounter'])->name('encounters.closeEencounter');

        Route::resource('medical-sick-leaves', MedicalSickLeaveController::class);


        // My routes

        Route::get('/product-requests/approve/{productRequest}', [ProductRequestController::class, 'approve'])->name('product-requests.approve');
        Route::get('/product-requests/reject/{productRequest}', [ProductRequestController::class, 'reject'])->name('product-requests.reject');
        Route::get('/product-requests/sentRequests', [ProductRequestController::class, 'sentRequests'])->name('product-requests.sentRequests');
        Route::get('/product-requests/records', [ProductRequestController::class, 'recordsOfRequests'])->name('product-requests.recordsOfRequests');


        Route::resource('stores', StoreController::class);
        Route::resource('products', ProductController::class);
        Route::resource('pharmacies', PharmacyController::class);
        Route::resource('product-requests', ProductRequestController::class);
        Route::resource(
            'items-in-pharmacies',
            ItemsInPharmacyController::class
        );


        Route::get('/submit', [SpeechController::class, 'submit'])->name('submit');
    });
