<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RenterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\AdminMotorController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OwnerReportController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminTarifController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('welcome');


// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    // CRUD User
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Verifikasi motor
    Route::get('/admin/motors', [AdminMotorController::class, 'index'])->name('admin.motors.index');
    Route::get('/admin/motors/{id}/edit', [AdminMotorController::class, 'edit'])->name('admin.motors.edit');
    Route::post('/admin/motors/{id}', [AdminMotorController::class, 'update'])->name('admin.motors.update');
    Route::patch('/admin/motors/{id}/approve', [AdminMotorController::class, 'approve'])->name('admin.motors.approve');
Route::patch('/admin/motors/{id}/reject', [AdminMotorController::class, 'reject'])->name('admin.motors.reject');

    // Booking
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::post('/admin/bookings/{id}/confirm', [AdminBookingController::class, 'confirm'])->name('admin.bookings.confirm');
    Route::post('/admin/bookings/{id}/finish', [AdminBookingController::class, 'finish'])->name('admin.bookings.finish');

    
// Admin laporan
     Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
     Route::get('/admin/users/export/excel', [AdminUserController::class, 'exportExcel'])->name('admin.users.export.excel');
Route::get('/admin/users/export/pdf', [AdminUserController::class, 'exportPdf'])->name('admin.users.export.pdf');
Route::get('/admin/reports/export/excel', [AdminReportController::class, 'exportExcel'])->name('admin.reports.export.excel');
Route::get('/admin/reports/export/pdf', [AdminReportController::class, 'exportPdf'])->name('admin.reports.export.pdf');
 
 Route::get('/admin/pembayaran', [AdminTransaksiController::class, 'index'])->name('admin.pembayaran.index');
    Route::get('/admin/pembayaran/{penyewaan}/create', [AdminTransaksiController::class, 'create'])->name('admin.pembayaran.create');
    Route::post('/admin/pembayaran/{penyewaan}', [AdminTransaksiController::class, 'store'])->name('admin.pembayaran.store');
    Route::get('/admin/pembayaran/{id}/edit', [AdminTransaksiController::class, 'edit'])->name('admin.pembayaran.edit');
    Route::put('/admin/pembayaran/{id}', [AdminTransaksiController::class, 'update'])->name('admin.pembayaran.update');
    Route::delete('/admin/pembayaran/{id}', [AdminTransaksiController::class, 'destroy'])->name('admin.pembayaran.destroy');

});


// Pemilik routes
Route::middleware(['auth','role:pemilik'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'index']);
    // CRUD motor
    Route::get('/owner/motors', [MotorController::class, 'index'])->name('owner.motors.index');
    Route::get('/owner/motors/create', [MotorController::class, 'create'])->name('owner.motors.create');
    Route::post('/owner/motors', [MotorController::class, 'store'])->name('owner.motors.store');
    Route::delete('/owner/motors/{motor}', [MotorController::class, 'destroy'])->name('owner.motors.destroy');
    // Owner laporan
    Route::get('/owner/reports', [OwnerReportController::class, 'index'])->name('owner.reports.index');
});

// Penyewa routes
Route::middleware(['auth','role:penyewa'])->group(function () {
    Route::get('/renter/dashboard', [RenterController::class, 'dashboard'])
    ->name('renter.dashboard');

     // Booking
    Route::get('/renter/motors', [BookingController::class, 'index'])->name('renter.motors.index');
    Route::get('/renter/motors/{motor}/book', [BookingController::class, 'create'])->name('renter.bookings.create');
    Route::post('/renter/motors/{motor}/book', [BookingController::class, 'store'])->name('renter.bookings.store');

    // Payment
    Route::get('/renter/bookings/{id}/pay', [BookingController::class, 'pay'])->name('renter.bookings.pay');
    Route::post('/renter/bookings/{id}/pay', [BookingController::class, 'processPayment'])->name('renter.bookings.processPayment');

    // History
    Route::get('/renter/bookings/history', [BookingController::class, 'history'])->name('renter.bookings.history');
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('tarifs', AdminTarifController::class);
});

