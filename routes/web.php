<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// 1. Pintu Masuk Utama
Route::get('/', function () { return redirect()->route('login'); });

// 2. Auth System
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Central Dashboard
Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    if ($role == 'admin') return redirect()->route('admin.dashboard');
    if ($role == 'dokter') return redirect()->route('dokter.dashboard');
    return redirect()->route('pelanggan.dashboard');
})->middleware(['auth'])->name('dashboard');

// 4. Rute Profil (Ditempatkan di luar grup role agar bisa diakses semua role)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// 5. Halaman khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/produk', [ProdukController::class, 'indexAdmin'])->name('admin.produk.index');
    Route::get('/admin/tambah-dokter', [AdminController::class, 'createDokter'])->name('admin.dokter.create');
    Route::post('/admin/tambah-dokter', [AdminController::class, 'storeDokter'])->name('admin.dokter.store');
    
    // Produk
    Route::get('/admin/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/admin/produk/simpan', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/admin/produk/{id}/update', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{id}/hapus', [ProdukController::class, 'destroy'])->name('produk.destroy');
    
    // Layanan & Transaksi
    Route::get('/admin/layanan', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('admin.layanan');
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->names(['index' => 'admin.layanan.index']);
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/admin/transaksi/{id}', [TransaksiController::class, 'show'])->name('admin.transaksi.show');
    
});

// 6. Halaman khusus Dokter
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
    Route::get('/dokter/pemeriksaan', [PemeriksaanController::class, 'create']);
    Route::get('/dokter/input-hasil/{id}', [DokterController::class, 'editPemeriksaan'])->name('dokter.input_hasil');
    Route::post('/dokter/simpan-hasil/{id}', [DokterController::class, 'simpanHasil'])->name('dokter.simpan_hasil');
});

// 7. Halaman khusus Pelanggan
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/pelanggan/dashboard', [PelangganController::class, 'index'])->name('pelanggan.dashboard');
    Route::get('/pelanggan/transaksi', [TransaksiController::class, 'store']);
    Route::get('/produk', [PelangganController::class, 'produk'])->name('pelanggan.produk');
    Route::get('/keranjang', [PelangganController::class, 'keranjang'])->name('pelanggan.keranjang');
    Route::post('/keranjang/tambah/{id}', [PelangganController::class, 'tambahKeKeranjang'])->name('pelanggan.keranjang.tambah');
    Route::post('/checkout', [PelangganController::class, 'checkout'])->name('pelanggan.checkout');
    Route::delete('/keranjang/{id}', [PelangganController::class, 'hapusItem'])->name('pelanggan.keranjang.hapus');
    Route::patch('/keranjang/update/{id}', [PelangganController::class, 'updateJumlah'])->name('pelanggan.keranjang.update');
    Route::post('/wishlist/tambah/{id}', [PelangganController::class, 'tambahWishlist'])->name('pelanggan.wishlist.tambah');
    Route::get('/wishlist', [PelangganController::class, 'wishlist'])->name('wishlist.index');
    Route::get('/transaksi/{id}', [PelangganController::class, 'detailTransaksi'])->name('pelanggan.transaksi.detail');
    Route::get('/layanan', [PelangganController::class, 'layanan'])->name('pelanggan.layanan');
    Route::get('/riwayat', [PelangganController::class, 'riwayat'])->name('pelanggan.riwayat');
    Route::get('/pilih-dokter', [PelangganController::class, 'daftarDokter'])->name('pelanggan.dokter');
    Route::get('/konsultasi/{id}', [PelangganController::class, 'formKonsultasi'])->name('pelanggan.konsultasi');
    Route::post('/konsultasi/simpan', [PelangganController::class, 'simpanKonsultasi'])->name('pelanggan.konsultasi.simpan');
    Route::get('/transaksi/{id}/upload', [App\Http\Controllers\TransaksiController::class, 'upload'])->name('transaksi.upload');
    Route::get('/transaksi/{id}/upload', [TransaksiController::class, 'upload'])->name('transaksi.upload');
    Route::post('/transaksi/{id}/upload-bukti', [TransaksiController::class, 'storeUpload'])->name('transaksi.store_upload');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::put('/transaksi/{id}/update-status', [TransaksiController::class, 'updateStatus'])->name('transaksi.update');
});