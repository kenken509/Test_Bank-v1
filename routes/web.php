<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return inertia('Index/Index');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'create')->name('login.show');
    Route::post('/login', 'store')->name('login.store');
    Route::delete('/logout', 'destroy')->name('logout');
});


Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'showDashboard')->name('dashboard.show');
});

Route::controller(UserManagementController::class)->group(function(){
    Route::get('/users-all', 'showUser')->name('users.show');
});

Route::controller(DepartmentController::class)->group(function(){
    Route::get('/departments', 'showDepartment')->name('departments.show');
    Route::delete('/test_bank/departments/delete/{id}','destroy')->name('department.delete');
});

Route::controller(DivisionController::class)->group(function(){
    Route::get('/test_bank/divisions', 'showDivision')->name('division.show');
});