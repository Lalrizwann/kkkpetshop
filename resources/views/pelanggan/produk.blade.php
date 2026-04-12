@extends('layouts.app')

@section('content')

<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill px-4 shadow-sm border-0" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
            <i class="fas fa-check-circle me-2"></i> 
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-pill px-4 shadow-sm border-0" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> 
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<div class="container py-4"> 
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h3 class="fw-bold text-dark">Etalase Produk 🛍️</h3>
            <p class="text-muted">Temukan kebutuhan terbaik untuk anabul kesayanganmu.</p>
        </div>
        {{-- <div class="col-md-6">
            <form action="{{ route('pelanggan.produk') }}" method="GET" class="d-flex">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2 rounded-pill shadow-sm" placeholder="Cari pakan, mainan...">
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Cari</button>
            </form>
        </div> --}}
    </div>

    <div class="d-flex gap-2 mb-4 overflow-auto pb-2">
        <a href="{{ route('pelanggan.produk') }}" 
           class="btn btn-sm rounded-pill px-3 shadow-sm {{ !request('kategori') ? 'btn-primary active text-white' : 'btn-outline-primary' }}">
           Semua
        </a>
    
        <a href="{{ route('pelanggan.produk', ['kategori' => 'Makanan']) }}" 
           class="btn btn-sm rounded-pill px-3 shadow-sm {{ request('kategori') == 'Makanan' ? 'btn-primary active text-white' : 'btn-outline-primary' }}">
           Makanan
        </a>
    
        <a href="{{ route('pelanggan.produk', ['kategori' => 'Aksesori']) }}" 
           class="btn btn-sm rounded-pill px-3 shadow-sm {{ request('kategori') == 'Aksesori' ? 'btn-primary active text-white' : 'btn-outline-primary' }}">
           Aksesori
        </a>
    
        <a href="{{ route('pelanggan.produk', ['kategori' => 'Obat-obatan']) }}" 
           class="btn btn-sm rounded-pill px-3 shadow-sm {{ request('kategori') == 'Obat-obatan' ? 'btn-primary active text-white' : 'btn-outline-primary' }}">
           Obat-obatan
        </a>
    </div>

    <div class="row g-4">
        @forelse($produk as $p)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-produk">
                <div class="position-relative">
                    <form action="{{ route('pelanggan.wishlist.tambah', $p->id) }}" method="POST" class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                        @csrf
                        <button type="submit" class="btn btn-white bg-white rounded-circle shadow-sm p-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border: none;">
                            @if(isset($wishlistIds) && in_array($p->id, $wishlistIds))
                                <i class="fas fa-heart text-danger"></i> @else
                                <i class="far fa-heart text-danger"></i> @endif
                        </button>
                    </form>

                    <img src="{{ asset('storage/' . $p->foto) }}" class="card-img-top" alt="{{ $p->nama_produk }}" style="height: 200px; object-fit: cover;">
                    
                    <span class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 m-2 rounded-pill small shadow-sm">
                        {{ $p->kategori }}
                    </span>
                </div>
                
                <div class="card-body">
                    <h6 class="fw-bold mb-1 text-dark text-truncate">{{ $p->nama_produk }}</h6>
                    <p class="text-primary fw-bold mb-2">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    
                    <div class="d-flex align-items-center mb-3">
                        <small class="{{ $p->stok > 0 ? 'text-muted' : 'text-danger fw-bold' }}">
                            <i class="fas fa-box me-1"></i> Stok: {{ $p->stok > 0 ? $p->stok : 'Habis' }}
                        </small>
                    </div>

                    <form action="{{ route('pelanggan.keranjang.tambah', $p->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm" {{ $p->stok <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-cart-plus me-1"></i> {{ $p->stok > 0 ? 'Beli' : 'Stok Habis' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="fas fa-box-open fa-4x text-muted opacity-50"></i>
            </div>
            <h5 class="text-muted fw-bold">Belum ada produk yang tersedia.</h5>
            <p class="text-muted small">Coba cari dengan kata kunci lain atau kembali lagi nanti.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card-produk {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-produk:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .btn-primary {
        background: linear-gradient(45deg, #00BAF2, #0dcaf0);
        border: none;
    }
    .btn-primary.active {
        background: #00BAF2 !important;
        border: none;
    }
    .overflow-auto::-webkit-scrollbar {
        display: none;
    }
</style>
@endsection