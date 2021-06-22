<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployessController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerusahaanController;
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
Route::get('/logout',[AuthController::class,'logout']);

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::resources(['companies' => CompaniesController::class,
                  'employees' => EmployessController::class]);

    Route::get('/table/companies',[CompaniesController::class,'datatableCompanies'])->name('table.companies');
    Route::get('/table/employees',[EmployessController::class,'datatableEmployees'])->name('table.employees');
});


