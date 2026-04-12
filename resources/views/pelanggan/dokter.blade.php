@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <h3 class="fw-bold text-dark">Konsultasi Dokter Ahli 🩺</h3>
        <p class="text-muted">Pilih dokter yang tersedia untuk mendiskusikan kesehatan anabulmu.</p>
    </div>
</div>

<div class="row g-4">
    @forelse($dokter as $d)
    <div class="col-md-4 col-lg-3">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-3 text-center card-dokter">
            <div class="d-flex justify-content-center mb-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($d->name) }}&background=E3F2FD&color=0D6EFD&size=128&bold=true" 
                     class="rounded-circle shadow-sm" alt="Avatar Dokter" width="80">
            </div>
            
            <div class="card-body p-0">
                <h6 class="fw-bold mb-1 text-dark">{{ $d->name }}</h6>
                <p class="text-primary small mb-3">
                    <i class="fas fa-certificate me-1"></i> Dokter Hewan Berpengalaman
                </p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small">Online</span>
                    <span class="badge bg-light text-muted border rounded-pill small"><i class="fas fa-star text-warning"></i> 4.9</span>
                </div>

                <a href="{{ route('pelanggan.konsultasi', $d->id) }}" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                    Mulai Konsultasi
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <i class="fas fa-user-md fa-4x text-muted mb-3 opacity-25"></i>
        <h5 class="text-muted">Maaf, saat ini belum ada dokter yang bertugas.</h5>
    </div>
    @endforelse
</div>

<style>
    .card-dokter {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-dokter:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .bg-success-subtle { background-color: #e8f5e9 !important; }
</style>
@endsection