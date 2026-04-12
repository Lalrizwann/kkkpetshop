@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Keranjang Belanja 🛒</h4>
                
                @forelse($items as $item)
                <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                    <img src="{{ asset('storage/'.$item->produk->foto) }}" class="rounded-3" width="80" height="80" style="object-fit: cover;">
                    
                    <div class="ms-3 flex-grow-1">
                        <h6 class="fw-bold mb-0 text-dark">{{ $item->produk->nama_produk }}</h6>
                        <small class="text-muted d-block mb-2">
                            Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                        </small>

                        <div class="d-flex align-items-center">
                            <form action="{{ route('pelanggan.keranjang.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="aksi" value="kurang">
                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-circle shadow-sm" 
                                        style="width: 30px; height: 30px;" {{ $item->jumlah <= 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-minus small"></i>
                                </button>
                            </form>

                            <span class="mx-3 fw-bold">{{ $item->jumlah }}</span>

                            <form action="{{ route('pelanggan.keranjang.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="aksi" value="tambah">
                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-circle shadow-sm" 
                                        style="width: 30px; height: 30px;" {{ $item->jumlah >= $item->produk->stok ? 'disabled' : '' }}>
                                    <i class="fas fa-plus small"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="text-end">
                        <p class="fw-bold mb-0 text-primary">
                            Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                        </p>
                        <form action="{{ route('pelanggan.keranjang.hapus', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn text-danger small p-0 decoration-none mt-2 shadow-none">
                                <i class="fas fa-trash-alt me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-shopping-basket fa-4x text-muted opacity-25"></i>
                    </div>
                    <p class="text-muted">Wah, keranjangmu masih kosong nih.</p>
                    <a href="{{ route('pelanggan.produk') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">Mulai Belanja</a>
                </div>
                @endforelse
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>
                <div class="d-flex justify-content-between mb-4">
                    <span class="text-muted">Total Harga</span>
                    <span class="fw-bold text-primary fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                
                <form action="{{ route('pelanggan.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm" {{ $items->isEmpty() ? 'disabled' : '' }}>
                        Lanjut ke Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection