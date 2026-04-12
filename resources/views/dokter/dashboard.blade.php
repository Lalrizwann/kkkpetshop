@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Dashboard Dokter 🩺</h3>
            <p class="text-muted">Halo, dr. {{ Auth::user()->name }}. Kelola konsultasi anabul hari ini.</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-primary text-white text-center">
                <h6 class="mb-1 opacity-75">Total Pasien</h6>
                <h3 class="fw-bold mb-0">{{ $antrean->count() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-warning text-dark text-center">
                <h6 class="mb-1 opacity-75">Perlu Respon</h6>
                <h3 class="fw-bold mb-0">{{ $antrean->where('status', 'Pending')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Antrean Konsultasi Masuk</h5>
        </div>
        <div class="table-responsive p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light text-uppercase small fw-bold">
                    <tr>
                        <th>Pelanggan</th>
                        <th>Keluhan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($antrean as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->name) }}&background=random" class="rounded-circle me-2" width="30">
                                <div>
                                    <span class="fw-bold d-block">{{ $item->user->name }}</span>
                                    <small class="text-muted">{{ $item->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td style="max-width: 250px;" class="text-truncate">
                            {{ $item->keluhan }}
                        </td>
                        <td class="small">{{ $item->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            @if($item->status == 'Pending')
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 rounded-pill">Pending</span>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 rounded-pill">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status == 'Pending')
                                <a href="{{ route('dokter.input_hasil', $item->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                    Beri Diagnosa
                                </a>
                            @else
                                <span class="text-muted small italic">Sudah diperiksa</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <img src="https://illustrations.popsy.co/blue/doctor-investigating-the-stomach.svg" width="150" class="mb-3 opacity-50">
                            <p class="text-muted">Belum ada pasien yang mengirim keluhan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection