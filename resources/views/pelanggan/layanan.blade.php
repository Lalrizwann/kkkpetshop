@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Layanan Medis & Perawatan 🐾</h2>
        <p class="text-muted">Pilih perawatan terbaik untuk kenyamanan dan kesehatan anabulmu.</p>
    </div>

    <div class="row g-4">
        @forelse($services as $s)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow transition">
                {{-- PERUBAHAN DI SINI: Menggunakan foto dari folder public/img --}}
                @if($s->foto)
                    <img src="{{ asset('img/' . $s->foto) }}" 
                         class="card-img-top rounded-top-4" alt="{{ $s->nama_layanan }}" style="height: 180px; object-fit: cover;">
                @else
                    {{-- Fallback jika foto kosong, tetap menggunakan inisial --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($s->nama_layanan) }}&background=0D6EFD&color=fff&size=128" 
                         class="card-img-top rounded-top-4" alt="{{ $s->nama_layanan }}" style="height: 180px; object-fit: cover;">
                @endif
                
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title fw-bold mb-0">{{ $s->nama_layanan }}</h5>
                        <span class="badge bg-primary-subtle text-primary rounded-pill">Baru</span>
                    </div>
                    
                    <p class="card-text text-muted small mb-4">
                        {{ Str::limit($s->deskripsi, 100) }}
                    </p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <div>
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Mulai dari</small>
                            <span class="fw-bold text-primary fs-5">Rp {{ number_format($s->harga, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('pelanggan.dokter') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            Pilih <i class="fas fa-chevron-right ms-1 small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada layanan yang tersedia.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .rounded-4 { border-radius: 1.25rem !important; }
    .hover-shadow:hover { 
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
    .transition { transition: all 0.3s ease; }
</style>
@endsection