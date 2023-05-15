<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AdminController;
use App\http\Controllers\DoctorController;
use App\http\Controllers\PatientController;
use App\http\Controllers\SlipController;
use App\http\Controllers\BedController;
use App\http\Controllers\DepartmentController;
use App\http\Controllers\ProcedureController;

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

Route::get('/admin', [AdminController::class, 'dashboard']);
Route::resource('/doctors', DoctorController::class);
Route::resource('/patients', PatientController::class);
Route::resource('/departments', DepartmentController::class);
Route::resource('/beds', BedController::class);
Route::resource('/procedures', ProcedureController::class);
Route::resource('/slips', SlipController::class);


Route::get('/slip/{slip}', [SlipController::class, 'view']);