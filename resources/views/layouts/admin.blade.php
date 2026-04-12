<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | KKK Petshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; transition: all 0.3s; position: fixed; }
        .sidebar .nav-link { color: #bdc3c7; padding: 12px 20px; border-radius: 8px; margin: 5px 15px; cursor: pointer; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #34495e; color: white; }
        .sidebar .nav-link i { width: 25px; }
        .main-content { padding: 30px; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; }
        .card-custom:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar shadow">
            <div class="text-center py-4">
                <h4 class="fw-bold text-white">KKK <span class="text-info">Petshop</span></h4>
            </div>
            <div class="nav flex-column">
                <a href="/admin/dashboard" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"><i class="fas fa-th-large"></i> Dashboard</a>
                
                
                <a href="/admin/produk" class="nav-link"><i class="fas fa-box"></i> Stok Produk</a>
                <a href="/admin/layanan" class="nav-link"><i class="fas fa-concierge-bell"></i> Layanan</a>
                <a href="/admin/transaksi" class="nav-link"><i class="fas fa-shopping-cart"></i> Transaksi</a>
                
                <a class="nav-link text-info fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahDokter">
                    <i class="fas fa-user-md"></i> Tambah Dokter
                </a>
                <hr class="mx-3">
                
                <form action="{{ route('logout') }}" method="POST" class="px-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 border-0 text-start nav-link">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </div>
        </nav>

        <main class="col-md-10 ms-sm-auto main-content">
            <nav class="navbar navbar-expand-lg navbar-light rounded-4 mb-4 px-4">
                <span class="navbar-brand fw-semibold">Selamat Datang, {{ Auth::user()->name }}</span>
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3 badge bg-primary">{{ ucfirst(Auth::user()->role) }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" class="rounded-circle" width="40">
                </div>
            </nav>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<div class="modal fade" id="modalTambahDokter" tabindex="-1" aria-labelledby="modalTambahDokterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="modalTambahDokterLabel">Registrasi Dokter Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.dokter.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Nama Dokter</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Email Login</label>
                        <input type="email" name="email" class="form-control" placeholder="dokter@petshop.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Password Sementara</label>
                        <input type="text" name="password" class="form-control" placeholder="Tentukan password" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Akun Dokter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>