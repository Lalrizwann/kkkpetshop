@extends('layouts.app')

@section('content')
<div class="hero-section mb-5 shadow-sm rounded-4 overflow-hidden" style="background-color: #00BAF2; color: white;">
    <div class="container py-5 px-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fw-bold display-5 mb-3">Selamat Datang di KKK Petshop! 🐾</h1>
                <p class="lead opacity-90 fs-5">Penuhi kebutuhan anabul kesayanganmu dengan produk dan layanan terbaik kami.</p>
            </div>
            <div class="col-md-4 text-center d-none d-md-block">
                <i class="fas fa-cat fa-8x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h4 class="fw-bold mb-4 text-dark">Menu Utama</h4>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="/produk" class="card border-0 p-4 text-center bg-white shadow-sm h-100 text-decoration-none">
                <div class="rounded-circle bg-primary text-white mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-shopping-bag fa-lg"></i>
                </div>
                <h5 class="fw-bold text-dark">Belanja Produk</h5>
                <p class="text-muted small">Cari pakan, mainan, dan aksesori untuk hewan peliharaanmu.</p>
            </a>
        </div>

        <div class="col-md-4">
            <a href="/layanan" class="card border-0 p-4 text-center bg-white shadow-sm h-100 text-decoration-none">
                <div class="rounded-circle bg-success text-white mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-hand-holding-heart fa-lg"></i>
                </div>
                <h5 class="fw-bold text-dark">Layanan Medis</h5>
                <p class="text-muted small">Grooming, konsultasi dokter, dan vaksinasi anabul.</p>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('pelanggan.riwayat') }}" class="card border-0 p-4 text-center bg-white shadow-sm h-100 text-decoration-none">
                <div class="rounded-circle bg-warning text-white mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-history fa-lg"></i>
                </div>
                <h5 class="fw-bold text-dark">Riwayat Transaksi</h5>
                <p class="text-muted small">Cek status pesanan dan riwayat pemeriksaan medis.</p>
            </a>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm p-4 text-white" style="background-color: #00BAF2;">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Butuh bantuan darurat?</h4>
                        <p class="mb-0 opacity-75">Konsultasikan kondisi anabulmu segera dengan dokter hewan ahli kami.</p>
                    </div>
                    <a href="{{ route('pelanggan.dokter') }}" class="btn btn-light rounded-pill px-4 fw-bold text-info shadow-sm">Chat Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection