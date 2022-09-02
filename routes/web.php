<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\EmployeesController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {

    Route::controller(CompaniesController::class)->group(function () {
        Route::get('companies', 'index')->name('companies');
        Route::get('companies/create', 'create')->name('company.create');
        Route::post('companies', 'store')->name('company.store');
        Route::get('companies/{company}/edit', 'edit')->name('company.edit');
        Route::PATCH('companies/{company}/update', 'update')->name('company.update');
        Route::delete('companies/{company}/delete', 'destroy')->name('company.destroy');
    });

    Route::controller(EmployeesController::class)->group(function () {
        Route::get('/employees', 'index')->name('employees');
        Route::get('/employees/create', 'create')->name('employee.create');
        Route::post('employees', 'store')->name('employee.store');
        Route::get('employees/{employee}/edit', 'edit')->name('employee.edit');
        Route::put('employees/{employee}/update', 'update')->name('employee.update');
        Route::delete('employees/{employee}/delete', 'destroy')->name('employee.destroy');
        // Route::post('/employees', 'store');
    });

});
require __DIR__.'/auth.php';
