<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SlipController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProcedureController;

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