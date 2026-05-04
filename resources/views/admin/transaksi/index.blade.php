@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <h3 class="fw-bold mb-4">Daftar Transaksi KKK Petshop</h3>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $t)
                    <tr>
                        <td class="px-4 fw-semibold">{{ $t->user->name ?? 'User Tidak Ditemukan' }}</td>
                        <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-warning text-dark px-3 py-2">
                                {{ $t->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.transaksi.show', $t->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection