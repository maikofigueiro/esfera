<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;

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

Route::get('/', function () {
    if (auth()->check()) {
        return view('companies');
    }
    return redirect('login');
});


Route::group(['middleware' => 'auth'], function () {

    // Rotas empresas
    Route::get('companies', [CompaniesController::class, 'list'])->name('companies');
    Route::get('companies/create', function () {return view('newCompany');})->name('companyCreat');
    Route::post('companies/save', [CompaniesController::class, 'save'])->name('companySave');
    Route::get('companies/edit/{id}', [CompaniesController::class, 'edit'])->name('companyEdit');
    Route::get('companies/delete/{id}', [CompaniesController::class, 'delete'])->name('companyDelete');


    // Rotas funcionarios
    Route::get('employees', [EmployeesController::class, 'list'])->name('employees');
    Route::get('employees/create', [EmployeesController::class, 'edit'])->name('employeeCreat');
    //Route::get('employees/create', function () {return view('newEmployee');})->name('employeeCreat');
    Route::post('employees/save', [EmployeesController::class, 'save'])->name('employeeSave');
    Route::get('employees/edit/{id}', [EmployeesController::class, 'edit'])->name('employeeEdit');
    Route::get('employees/delete/{id}', [EmployeesController::class, 'delete'])->name('employeeDelete');
});



require __DIR__.'/auth.php';
