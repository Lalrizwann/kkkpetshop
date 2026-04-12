@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white py-3 text-center">
                    <h5 class="mb-0 fw-bold">Menunggu Pembayaran ⏳</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <p class="text-muted mb-1">Total yang harus dibayar:</p>
                    <h2 class="fw-bold text-primary mb-4">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</h2>
                    
                    <div class="bg-light p-3 rounded-4 mb-4 border">
                        <p class="small text-muted mb-2">Silakan transfer ke rekening berikut:</p>
                        <h5 class="fw-bold mb-1">Bank BCA - KKK Petshop</h5>
                        <h4 class="text-dark fw-bold">123-456-7890</h4>
                        <p class="small text-muted mb-0">a.n. KKK Petshop Indonesia</p>
                    </div>

                    <div class="text-start border-top pt-4">
                        <h6 class="fw-bold mb-3">Rincian Pesanan:</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Kode Transaksi:</span>
                            <span class="fw-bold text-dark">{{ $transaksi->kode_transaksi }}</span>
                        </div>
                        <hr class="opacity-50">
                        @foreach($transaksi->detail as $item)
                        <div class="d-flex justify-content-between mb-2 small">
                            <span>{{ $item->produk->nama_produk }} (x{{ $item->jumlah }})</span>
                            <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('pelanggan.produk') }}" class="btn btn-outline-primary rounded-pill px-4 me-2">Belanja Lagi</a>
                        <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" onclick="window.print()">
                            <i class="fas fa-download me-2"></i>Cetak Bukti
                        </button>
                    </div>
                </div>
            </div>
            <p class="text-center mt-4 text-muted small">Pesanan Anda akan otomatis dibatalkan jika tidak dibayar dalam 24 jam.</p>
        </div>
    </div>
</div>
@endsection