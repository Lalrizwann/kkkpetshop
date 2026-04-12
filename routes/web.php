<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;

// 1. Pintu Masuk Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Auth System (Login, Logout, Register)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// 3. Central Dashboard (Pengalihan Role Otomatis)
Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    if ($role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role == 'dokter') {
        return redirect()->route('dokter.dashboard');
    } else {
        // Menggunakan name route agar lebih aman
        return redirect()->route('pelanggan.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// 4. Halaman khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/produk', [ProdukController::class, 'indexAdmin'])->name('admin.produk.index');

    Route::get('/admin/tambah-dokter', [AdminController::class, 'createDokter'])->name('admin.dokter.create');
    Route::post('/admin/tambah-dokter', [AdminController::class, 'storeDokter'])->name('admin.dokter.store');

    // CRUD Produk
    Route::get('/admin/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/admin/produk/simpan', [ProdukController::class, 'store'])->name('produk.store');
    
    // Fitur Edit & Update (Sesuai folder admin/edit.blade.php)
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/admin/produk/{id}/update', [ProdukController::class, 'update'])->name('produk.update');

        Route::get('/admin/layanan', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('admin.layanan');
        // Tambahkan route resource jika ingin CRUD lengkap
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->names([
            'index' => 'admin.layanan.index']);
    // Fitur Delete
    Route::delete('/admin/produk/{id}/hapus', [ProdukController::class, 'destroy'])->name('produk.destroy');

});

// 5. Halaman khusus Dokter
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
    Route::get('/dokter/pemeriksaan', [PemeriksaanController::class, 'create']);
    Route::get('/dokter/input-hasil/{id}', [DokterController::class, 'editPemeriksaan'])->name('dokter.input_hasil');
    Route::post('/dokter/simpan-hasil/{id}', [DokterController::class, 'simpanHasil'])->name('dokter.simpan_hasil');
});

// 6. Halaman khusus Pelanggan
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    // PERBAIKAN: Menambahkan ->name('pelanggan.dashboard')
    Route::get('/pelanggan/dashboard', [PelangganController::class, 'index'])->name('pelanggan.dashboard');
    Route::get('/pelanggan/transaksi', [TransaksiController::class, 'store']);

    // Belanja & Keranjang
    Route::get('/produk', [PelangganController::class, 'produk'])->name('pelanggan.produk');
    Route::get('/keranjang', [PelangganController::class, 'keranjang'])->name('pelanggan.keranjang');
    Route::post('/keranjang/tambah/{id}', [PelangganController::class, 'tambahKeKeranjang'])->name('pelanggan.keranjang.tambah');
    Route::post('/checkout', [PelangganController::class, 'checkout'])->name('pelanggan.checkout');
    Route::delete('/keranjang/{id}', [PelangganController::class, 'hapusItem'])->name('pelanggan.keranjang.hapus');
    Route::patch('/keranjang/update/{id}', [PelangganController::class, 'updateJumlah'])->name('pelanggan.keranjang.update');
    Route::post('/wishlist/tambah/{id}', [PelangganController::class, 'tambahWishlist'])->name('pelanggan.wishlist.tambah');

    // Riwayat & Layanan
    Route::get('/transaksi/{id}', [PelangganController::class, 'detailTransaksi'])->name('pelanggan.transaksi.detail');
    Route::get('/layanan', [PelangganController::class, 'layanan'])->name('pelanggan.layanan');
    Route::get('/riwayat', [PelangganController::class, 'riwayat'])->name('pelanggan.riwayat');

    // Konsultasi Dokter
    Route::get('/pilih-dokter', [PelangganController::class, 'daftarDokter'])->name('pelanggan.dokter');
    Route::get('/konsultasi/{id}', [PelangganController::class, 'formKonsultasi'])->name('pelanggan.konsultasi');
    Route::post('/konsultasi/simpan', [PelangganController::class, 'simpanKonsultasi'])->name('pelanggan.konsultasi.simpan');
});