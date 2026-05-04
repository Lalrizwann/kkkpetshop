@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-sm p-4">
        <h4 class="fw-bold">Upload Bukti Pembayaran</h4>
        <div class="alert alert-warning">
            Silakan upload bukti pembayaran Anda. Setelah diupload, pesanan akan diverifikasi oleh admin.
        </div>
        
        <div class="mb-3">
            <p><strong>No. Pesanan:</strong> {{ $transaksi->kode_transaksi }}</p>
            <p><strong>Total Pembayaran:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> <span class="badge bg-info">{{ $transaksi->status }}</span></p>
        </div>

        <form action="{{ route('transaksi.store_upload', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Upload Bukti Transfer</label>
                <input type="file" name="bukti" class="form-control" required>
                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
            </div>
            <button type="submit" class="btn btn-success w-100">Upload Bukti</button>
        </form>
    </div>
</div>
@endsection