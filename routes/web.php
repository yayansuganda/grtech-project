<?php

use App\Http\Controllers\AuthController;
<<<<<<< Updated upstream
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployessController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerusahaanController;
=======
use App\Http\Controllers\BonusController;
use App\Http\Controllers\CompaniController;
use App\Http\Controllers\EmployeController;
>>>>>>> Stashed changes
use Illuminate\Support\Facades\Route;

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

Route::get('/',[AuthController::class,'index'])->name('login');
Route::post('/postlogin',[AuthController::class,'postlogin'])->name('postlogin');
Route::get('/logout',[AuthController::class,'logout'])->name('post');

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::resources(['compani' => CompaniController::class,
                  'employe' => EmployeController::class]);

<<<<<<< Updated upstream
    Route::get('/table/companies',[CompaniesController::class,'datatableCompanies'])->name('table.companies');
    Route::get('/table/employees',[EmployessController::class,'datatableEmployees'])->name('table.employees');
=======
    Route::get('/daily',[BonusController::class,'index']);
    Route::get('/table/daily',[BonusController::class,'datatableDaily'])->name('table.daily');


    Route::get('/table/compani',[CompaniController::class,'datatableCompani'])->name('table.compani');
    Route::get('/table/employe',[EmployeController::class,'datatableEmploye'])->name('table.employe');
>>>>>>> Stashed changes
});


