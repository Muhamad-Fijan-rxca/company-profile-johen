<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KontenDigitalController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\PelamarController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\KontenDigitalController as AdminKontenDigitalController;
use App\Http\Controllers\Admin\SosmedController;
use App\Http\Controllers\Admin\PartnerController;

// ─── PUBLIC ROUTES ───────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', fn() => view('tentang'))->name('tentang');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/produk/top-up', [ProdukController::class, 'topUp'])->name('produk.top-up');
Route::get('/produk/joki-ml', [ProdukController::class, 'jokiMl'])->name('produk.joki-ml');
Route::get('/produk/jual-beli-akun', [ProdukController::class, 'jualBeliAkun'])->name('produk.jual-beli-akun');
Route::get('/produk/live-commerce', [ProdukController::class, 'liveCommerce'])->name('produk.live-commerce');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/karir', [KarirController::class, 'index'])->name('karir');
Route::post('/karir/lamar', [KarirController::class, 'lamar'])->name('karir.lamar');
Route::get('/partner', [KontenDigitalController::class, 'index'])->name('partner');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak/kirim', [KontakController::class, 'kirim'])->name('kontak.kirim');

// ─── ADMIN ROUTES ─────────────────────────────────────────────────────────────
Route::prefix('johen-admin-secret')->name('admin.')->group(function () {

    // Auth (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Produk
        Route::resource('produk', AdminProdukController::class)->except(['show']);

        // Berita
        Route::resource('berita', AdminBeritaController::class)->except(['show']);

        // Lowongan
        Route::resource('lowongan', LowonganController::class)->except(['show']);

        // Konten Digital
        Route::resource('konten-digital', AdminKontenDigitalController::class)->except(['show']);

        // Partner
        Route::resource('partner', PartnerController::class)->except(['show']);

        // Sosial Media
        Route::resource('sosmed', SosmedController::class)->except(['show']);

        // Pelamar
        Route::get('/pelamar', [PelamarController::class, 'index'])->name('pelamar.index');
        Route::delete('/pelamar/{pelamar}', [PelamarController::class, 'destroy'])->name('pelamar.destroy');

        // Pesan Kontak
        Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
        Route::get('/pesan/{pesan}', [PesanController::class, 'show'])->name('pesan.show');
        Route::delete('/pesan/{pesan}', [PesanController::class, 'destroy'])->name('pesan.destroy');
    });
});
