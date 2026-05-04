@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4 p-5">
        <h5 class="text-muted mb-4">Data Profil</h5>
        <hr>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row">
            
            <div class="col-md-4 border-end">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ $user->photo ? asset('storage/photos/'.$user->photo) : asset('img/default-avatar.png') }}" 
                         class="rounded-circle shadow" width="150" height="150" style="object-fit: cover;">
                    
                    <h4 class="fw-bold mt-3">{{ $user->name }}</h4>
                    <p class="text-muted"><i class="fas fa-phone"></i> {{ $user->phone ?? 'Belum ada nomor' }}</p>
                </div>
            </div>

            <div class="col-md-8 ps-md-5">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ubah Foto Profil</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Simpan Perubahan</button>
                </form>
            </div>
            
        </div> </div>
</div>
@endsection