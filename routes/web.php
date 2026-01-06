<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return redirect('/login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/students', [AdminController::class, 'students'])->name('students');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/attendance', [AdminController::class, 'attendance'])->name('attendance');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});

// Reception routes
Route::middleware(['auth', 'role:reception'])->prefix('reception')->name('reception.')->group(function () {
    Route::get('/dashboard', [ReceptionController::class, 'dashboard'])->name('dashboard');
    
    // Student management
    Route::get('/register-student', [ReceptionController::class, 'registerStudent'])->name('register.student');
    Route::post('/register-student', [ReceptionController::class, 'storeStudent'])->name('store.student');
    Route::get('/students', [ReceptionController::class, 'students'])->name('students');
    
    // Payment management
    Route::get('/record-payment', [ReceptionController::class, 'recordPayment'])->name('record.payment');
    Route::post('/record-payment', [ReceptionController::class, 'storePayment'])->name('store.payment');
    Route::get('/payments', [ReceptionController::class, 'payments'])->name('payments');
    
    // QR Scanner
    Route::get('/qr-scanner', [ReceptionController::class, 'qrScanner'])->name('qr.scanner');
    Route::post('/qr-scan', [ReceptionController::class, 'processQrScan'])->name('qr.scan');
});

// Report routes (accessible by both admin and reception)
Route::middleware(['auth'])->prefix('reports')->name('reports.')->group(function () {
    Route::get('/student/{id}', [ReportController::class, 'studentReport'])->name('student');
    Route::get('/payments', [ReportController::class, 'paymentsReport'])->name('payments');
    Route::get('/attendance', [ReportController::class, 'attendanceReport'])->name('attendance');
    Route::get('/comprehensive', [ReportController::class, 'comprehensiveReport'])->name('comprehensive');
});
