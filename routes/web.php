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

// use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemConfigController;

Route::get('roles', [RolesController::class, 'index'])->name('roles.index');
Route::post('roles', [RolesController::class, 'store'])->name('roles.store');
Route::post('roles/assign', [RolesController::class, 'assign'])->name('roles.assign');



// General routes
Route::resource('client', ClientController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('report', ReportingController::class);
Route::resource('roles', RolesController::class);
Route::resource('case', CaseManagementController::class);
Route::resource('admin', AdminSettingsController::class);
Route::get('/admin', [AdminSettingsController::class, 'index'])->name('admin.index');
Route::post('/roles', [AdminSettingsController::class, 'storeRole'])->name('roles.store');
Route::post('/reset-password', [AdminSettingsController::class, 'resetPassword'])->name('users.resetPassword');
Route::post('/system-config', [AdminSettingsController::class, 'updateSystemConfig'])->name('system.config.update');
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