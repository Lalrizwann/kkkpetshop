@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-primary text-white p-3 rounded-top-4">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Produk: {{ $produk->nama_produk }}</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="fw-bold">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control rounded-pill" value="{{ $produk->nama_produk }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Kategori</label>
                        <select name="kategori" class="form-select rounded-pill">
                            <option value="Makanan" {{ $produk->kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Aksesori" {{ $produk->kategori == 'Aksesori' ? 'selected' : '' }}>Aksesori</option>
                            <option value="Obat-obatan" {{ $produk->kategori == 'Obat-obatan' ? 'selected' : '' }}>Obat-obatan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control rounded-pill" value="{{ $produk->harga }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Stok</label>
                    <input type="number" name="stok" class="form-control rounded-pill" value="{{ $produk->stok }}">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Foto Produk (Kosongkan jika tidak diganti)</label>
                    <input type="file" name="foto" class="form-control rounded-pill">
                    <small class="text-muted">Foto saat ini: {{ $produk->foto }}</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection