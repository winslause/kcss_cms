<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CaseManagementController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AuthController;

// General routes
Route::resource('client', ClientController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('report', ReportingController::class);
Route::resource('roles', RolesController::class);
Route::resource('case', CaseManagementController::class);
Route::resource('admin', AdminSettingsController::class);
Route::post('/admin/storeUser', [AdminSettingsController::class, 'storeUser'])->name('admin.storeUser');
Route::put('/admin/updateUser/{id}', [AdminSettingsController::class, 'updateUser'])->name('admin.updateUser');
Route::delete('/admin/deleteUser/{id}', [AdminSettingsController::class, 'deleteUser'])->name('admin.deleteUser');

// Authentication routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Role-based routes
Route::middleware(['auth', 'role:normal'])->group(function () {
    // Routes for normal users
    Route::get('/normal-dashboard', function () {
        return 'Normal User Dashboard';
    })->name('normal.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes for admin users
    Route::get('/admin-dashboard', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');
});