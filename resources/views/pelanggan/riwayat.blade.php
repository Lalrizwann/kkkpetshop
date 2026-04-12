@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <h3 class="fw-bold text-dark">Aktivitas Saya 📑</h3>
        <p class="text-muted">Pantau belanjaan dan kesehatan anabul dalam satu tempat.</p>
    </div>
</div>

<ul class="nav nav-pills nav-justified mb-4 bg-white p-2 shadow-sm rounded-pill" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active rounded-pill fw-bold" id="pills-transaksi-tab" data-bs-toggle="pill" data-bs-target="#pills-transaksi" type="button" role="tab">
            <i class="fas fa-shopping-bag me-2"></i> Belanja & Layanan
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-pill fw-bold" id="pills-medis-tab" data-bs-toggle="pill" data-bs-target="#pills-medis" type="button" role="tab">
            <i class="fas fa-file-medical me-2"></i> Catatan Medis
        </button>
    </li>
</ul>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-transaksi" role="tabpanel">
        @forelse($transaksi as $t)
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary-subtle text-primary mb-2">#TRX-{{ $t->id }}</span>
                            <h5 class="fw-bold mb-0">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</h5>
                            <small class="text-muted">{{ $t->created_at->format('d M Y') }}</small>
                        </div>
                        <div class="text-end">
                            <span class="badge {{ $t->status == 'Selesai' ? 'bg-success' : 'bg-warning' }} rounded-pill px-3">
                                {{ $t->status }}
                            </span>
                            <br>
                            <button class="btn btn-sm btn-outline-primary mt-2 rounded-pill">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <p class="text-muted">Belum ada riwayat transaksi.</p>
            </div>
        @endforelse
    </div>

    <div class="tab-pane fade" id="pills-medis" role="tabpanel">
        @forelse($pemeriksaan as $p)
            <div class="card border-0 shadow-sm rounded-4 mb-3 border-start border-4 border-info">
                <div class="card-body p-4">
                    <div class="row align-items-start">
                        <div class="col-md-8">
                            <h5 class="fw-bold text-info mb-1"><i class="fas fa-stethoscope me-2"></i> {{ $p->service->nama_layanan ?? 'Pemeriksaan Umum' }}</h5>
                            <p class="mb-2 text-dark"><strong>Hasil Diagnosa:</strong> <br> {{ $p->diagnosa }}</p>
                            <p class="mb-0 text-muted small"><strong>Saran Dokter:</strong> {{ $p->saran ?? '-' }}</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <small class="text-muted d-block mb-2">{{ $p->created_at->format('d M Y') }}</small>
                            <div class="bg-light p-2 rounded-3 small">
                                <i class="fas fa-user-md me-1 text-secondary"></i> Dokter: <strong>{{ $p->user->name ?? 'Staf Ahli' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted">
                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                <p>Belum ada catatan medis untuk anabulmu.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: white;
    }
    .nav-link {
        color: #6c757d;
    }
    .border-info {
        border-color: #0dcaf0 !important;
    }
</style>
@endsection