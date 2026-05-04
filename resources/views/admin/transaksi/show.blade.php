@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow p-4">
        <h3 class="mb-4">Detail Transaksi #{{ $transaksi->id }}</h3>
        
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nama Pelanggan:</strong> {{ $transaksi->user->name }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                <p><strong>Status Saat Ini:</strong> 
                    <span class="badge bg-info">{{ $transaksi->status }}</span>
                </p>
            </div>
            
            <div class="col-md-6">
                <strong>Bukti Pembayaran:</strong>
                @if($transaksi->bukti_pembayaran)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$transaksi->bukti_pembayaran) }}" 
                             class="img-fluid border" style="max-width: 300px;">
                    </div>
                @else
                    <p class="text-danger">Belum ada bukti pembayaran.</p>
                @endif
            </div>
        </div>

        <hr>

        <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mt-3">
                <button name="status" value="Paid" class="btn btn-success">Approve (Paid)</button>
                <button name="status" value="Rejected" class="btn btn-danger">Reject</button>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection