@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm p-4">
        <h4 class="fw-bold mb-4">Data Profil Admin</h4>
        
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 text-center border-end">
                    <div class="mb-3">
                        @if(Auth::user()->photo)
                            <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" class="rounded-circle border" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&size=150" class="rounded-circle">
                        @endif
                    </div>
                    <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
                    <p class="text-muted"><i class="fas fa-user-shield me-2"></i>Administrator</p>
                </div>

                <div class="col-md-8 ps-md-4">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ubah Foto Profil</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection