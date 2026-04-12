@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="bg-primary p-4 text-white text-center">
                <h5 class="fw-bold mb-0">Form Konsultasi</h5>
                <small class="opacity-75">Sampaikan keluhan anabulmu kepada ahli kami</small>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=0D6EFD&color=fff" class="rounded-circle me-3" width="50">
                    <div>
                        <p class="mb-0 small text-muted">Dokter yang dipilih:</p>
                        <h6 class="fw-bold mb-0">{{ $dokter->name }}</h6>
                    </div>
                </div>

                <form action="{{ route('pelanggan.konsultasi.simpan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="dokter_id" value="{{ $dokter->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Apa keluhan anabulmu?</label>
                        <textarea name="keluhan" class="form-control rounded-3 @error('keluhan') is-invalid @enderror" 
                                  rows="5" placeholder="Contoh: Kucing saya lemas dan tidak mau makan sejak pagi tadi..."></textarea>
                        @error('keluhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info border-0 small">
                        <i class="fas fa-info-circle me-1"></i> Dokter akan segera memeriksa keluhanmu dan memberikan diagnosa di halaman Riwayat.
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm">
                        Kirim Sekarang <i class="fas fa-paper-plane ms-1"></i>
                    </button>
                    <a href="{{ route('pelanggan.dokter') }}" class="btn btn-link w-100 text-muted mt-2 text-decoration-none small">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection