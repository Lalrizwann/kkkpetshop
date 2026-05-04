@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Wishlist Saya ❤️</h4>
                
                @forelse($wishlists as $item)
                <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                    <img src="{{ asset('storage/'.$item->produk->foto) }}" class="rounded-3" width="80" height="80" style="object-fit: cover;">
                    
                    <div class="ms-3 flex-grow-1">
                        <h6 class="fw-bold mb-0 text-dark">{{ $item->produk->nama_produk }}</h6>
                        <small class="text-primary fw-bold">
                            Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                        </small>
                    </div>

                    <div class="text-end d-flex gap-3">
                        <form action="{{ route('pelanggan.keranjang.tambah', $item->produk->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary rounded-pill">
                                <i class="fas fa-cart-plus me-1"></i> Masukkan Keranjang
                            </button>
                        </form>

                        <form action="{{ route('pelanggan.wishlist.tambah', $item->produk->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-heart fa-4x text-muted opacity-25"></i>
                    </div>
                    <p class="text-muted">Wishlist Anda masih kosong.</p>
                    <a href="{{ route('pelanggan.produk') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">Cari Produk</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection