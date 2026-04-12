@extends('admin.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Edit Layanan</h5>
        </div>
        <div class="card-body">
            {{-- Tambahkan enctype agar bisa upload file --}}
            <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control" value="{{ $service->nama_layanan }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="{{ $service->harga }}" required>
                </div>

                {{-- Penambahan Input Foto --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Foto Layanan</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    
                    @if($service->foto)
                        <div class="mt-3">
                            <p class="small text-muted mb-1">Foto saat ini:</p>
                            <img src="{{ asset('img/' . $service->foto) }}" alt="Foto Layanan" class="rounded shadow-sm" style="width: 150px; height: 100px; object-fit: cover;">
                        </div>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-light px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection