@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary py-3 text-white border-0">
                    <h5 class="fw-bold mb-0 text-center">Form Input Hasil Pemeriksaan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4 p-3 bg-light rounded-3 border-start border-primary border-4">
                        <label class="small text-muted text-uppercase fw-bold">Keluhan dari {{ $pemeriksaan->user->name }}:</label>
                        <p class="mb-0 mt-1 fs-5 italic">"{{ $pemeriksaan->keluhan }}"</p>
                    </div>

                    <form action="{{ route('dokter.simpan_hasil', $pemeriksaan->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Diagnosa Medis</label>
                            <textarea name="diagnosa" class="form-control rounded-3 @error('diagnosa') is-invalid @enderror" 
                                      rows="4" placeholder="Tuliskan hasil diagnosa di sini..." required></textarea>
                            @error('diagnosa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Saran & Resep</label>
                            <textarea name="saran" class="form-control rounded-3 @error('saran') is-invalid @enderror" 
                                      rows="3" placeholder="Contoh: Beri obat tetes telinga 2x sehari..." required></textarea>
                            @error('saran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan & Kirim Diagnosa
                            </button>
                            <a href="{{ route('dokter.dashboard') }}" class="btn btn-link text-muted text-decoration-none">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection