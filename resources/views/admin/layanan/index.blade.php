@extends('admin.dashboard') {{-- PERBAIKAN: Karena file dashboard ada di folder admin --}}

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manajemen Layanan</h2>
        <a href="{{ route('services.create') }}" class="btn btn-primary rounded-pill">+ Tambah Layanan</a>
    </div>

    {{-- Pesan Sukses jika ada --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $s->nama_layanan }}</strong></td>
                        <td>Rp {{ number_format($s->harga, 0, ',', '.') }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('services.edit', $s->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>

                                <form action="{{ route('services.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan {{ $s->nama_layanan }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
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
@endsection