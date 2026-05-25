<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
// ── PUBLIC PAGES ──────────────────────────────────────
Route::get('/',          [PageController::class, 'home'])->name('home');
Route::get('/services',  [PageController::class, 'services'])->name('services');
Route::get('/services/{slug}', [PageController::class, 'serviceDetail'])->name('service.detail');
Route::get('/contact',   [PageController::class, 'contact'])->name('contact');
Route::post('/appointment', [PageController::class, 'storeAppointment'])->name('appointment.store');

// ── ADMIN AUTH ────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {

        // Dashboard (stats only)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Appointments CRUD (new dedicated controller)
        Route::get('/appointments',              [AppointmentController::class, 'index'])->name('appointments');
        Route::get('/appointments/create',       [AppointmentController::class, 'create'])->name('appointments.create');
        Route::post('/appointments',             [AppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/{appointment}',         [AppointmentController::class, 'show'])->name('appointments.show');
        Route::get('/appointments/{appointment}/edit',    [AppointmentController::class, 'edit'])->name('appointments.edit');
        Route::put('/appointments/{appointment}',         [AppointmentController::class, 'update'])->name('appointments.update');
        Route::delete('/appointments/{appointment}',      [AppointmentController::class, 'destroy'])->name('appointments.destroy');
        Route::get('/appointments/{appointment}/status/{status}',
            [AppointmentController::class, 'updateStatus'])->name('appointment.status');

        // Admin Users Management
        Route::get('/users',                    [AdminUserController::class, 'index'])->name('users');
        Route::post('/users',                   [AdminUserController::class, 'store'])->name('users.store');
        Route::put('/users/{admin}',            [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{admin}',         [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{admin}/toggle',     [AdminUserController::class, 'toggleStatus'])->name('users.toggle');

        // Change Password
        Route::get('/change-password',  [AdminUserController::class, 'showChangePassword'])->name('change.password');
        Route::post('/change-password', [AdminUserController::class, 'updatePassword'])->name('change.password.post');

// Doctors / Staff
Route::get('/doctors',                  [DoctorController::class, 'index'])->name('doctors');
Route::post('/doctors',                 [DoctorController::class, 'store'])->name('doctors.store');
Route::put('/doctors/{doctor}',         [DoctorController::class, 'update'])->name('doctors.update');
Route::delete('/doctors/{doctor}',      [DoctorController::class, 'destroy'])->name('doctors.destroy');
Route::get('/doctors/{doctor}/toggle',  [DoctorController::class, 'toggleStatus'])->name('doctors.toggle');
Route::get('/patients',                  [PatientController::class, 'index'])->name('patients');
Route::post('/patients',                 [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/{patient}',        [PatientController::class, 'show'])->name('patients.show');
Route::put('/patients/{patient}',        [PatientController::class, 'update'])->name('patients.update');
Route::delete('/patients/{patient}',     [PatientController::class, 'destroy'])->name('patients.destroy');
Route::get('/patients/{patient}/toggle', [PatientController::class, 'toggleStatus'])->name('patients.toggle');
    });
});
