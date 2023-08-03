<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SlipController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\ReceptionistController;

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

Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=> ['auth']], function(){

    Route::get('/', [AdminController::class, 'dashboard']);
    Route::resource('slips', SlipController::class);
    Route::get('slips/cross-match/{slip}', [SlipController::class, 'crossMatchSlip']);
    Route::group(['middleware' => ['check.admin']], function(){
        Route::resource('doctors', DoctorController::class);
        Route::resource('patients', PatientController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('beds', BedController::class);
        Route::resource('procedures', ProcedureController::class);
        Route::resource('receptionists', ReceptionistController::class);
    });
    
    // Get MR Numbers by phone
    Route::get('/get_mr_numers/{phone}', [SlipController::class, 'getMrNumbers']);
});



