@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Kelola Produk KKK Petshop 🐾</h4>
        <a href="{{ route('produk.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i>Tambah Produk Baru
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Foto</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $p)
                        <tr>
                            <td class="ps-4">
                                <img src="{{ asset('storage/' . $p->foto) }}" class="rounded-3" width="50" height="50" style="object-fit: cover;">
                            </td>
                            <td class="fw-bold">{{ $p->nama_produk }}</td>
                            <td><span class="badge bg-info text-dark rounded-pill">{{ $p->kategori }}</span></td>
                            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>{{ $p->stok }} pcs</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $p->nama_produk }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection