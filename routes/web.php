<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\AdminController;
use App\http\controllers\DoctorController;
use App\http\controllers\PatientController;
use App\http\controllers\SlipController;
use App\http\controllers\BedController;
use App\http\controllers\DepartmentController;
use App\http\controllers\ProcedureController;

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