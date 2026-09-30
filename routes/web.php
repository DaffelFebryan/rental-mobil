<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// =====================================================
// HALAMAN PUBLIK (bisa diakses SIAPA SAJA, tanpa login)
// =====================================================
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/katalog', [PublicController::class, 'katalog'])->name('public.katalog');
Route::get('/mobil/{mobil}', [PublicController::class, 'detail'])->name('public.detail');
Route::get('/booking-online', [PublicController::class, 'bookingForm'])->name('public.booking.form');
Route::post('/booking-online', [PublicController::class, 'bookingStore'])->name('public.booking.store');
Route::get('/booking-berhasil', [PublicController::class, 'bookingSuccess'])->name('public.booking.success');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('public.tentang');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('public.kontak');

// =====================================================
// LOGIN (SATU HALAMAN untuk admin/staff DAN user/pelanggan)
// =====================================================
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('daftar', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
    Route::post('daftar', [CustomerAuthController::class, 'register'])->name('customer.register.submit');
});

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// =====================================================
// PROFIL — untuk SEMUA role yang sudah login (admin/staff/customer)
// =====================================================
Route::middleware('auth')->group(function () {
    Route::get('profil', [ProfileController::class, 'index'])->name('profile');
    Route::put('profil/info', [ProfileController::class, 'updateInfo'])->name('profile.update-info');
    Route::put('profil/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    Route::get('akun/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});

// =====================================================
// PANEL ADMIN (prefix /admin) — wajib login SEBAGAI admin/staff
// =====================================================
Route::prefix('admin')->middleware(['auth', 'staff'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('mobil', MobilController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('pelanggan', PelangganController::class);

    Route::get('pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::delete('pengembalian/{pengembalian}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');

    Route::get('laporan', [LaporanController::class, 'index'])
        ->middleware('admin')
        ->name('laporan.index');
});