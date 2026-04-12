@extends('admin.dashboard') {{-- Sesuaikan dengan lokasi dashboard admin Anda --}}

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i>Tambah Produk Baru (Panel Admin)</h5>
        </div>
        <div class="card-body p-4">
            {{-- Pastikan route ini sudah terdaftar di web.php --}}
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control rounded-pill" placeholder="Nama Produk" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select rounded-pill">
                            <option value="Makanan">Makanan</option>
                            <option value="Aksesori">Aksesori</option>
                            <option value="Obat-obatan">Obat-obatan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control rounded-pill" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Stok</label>
                    <input type="number" name="stok" class="form-control rounded-pill" placeholder="0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Foto Produk</label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                    <small class="text-muted">Gunakan file gambar (jpg, png, jpeg)</small>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Produk</button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection