<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | KKK Petshop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .logo-wrapper { display: flex; align-items: center; justify-content: center; background-color: white; border: 1px solid #eee; }
        .dropdown-toggle::after { display: none; }
        .sticky-top { box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .navbar-toggler { display: block !important; }
        .admin-content-area { padding: 40px 0; }
    </style>
</head>
<body>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasAdmin" aria-labelledby="offcanvasAdminLabel">
        <div class="offcanvas-header border-bottom">
            <div class="offcanvas-title d-flex align-items-center" id="offcanvasAdminLabel">
                <div class="logo-wrapper rounded-circle overflow-hidden shadow-sm me-2" style="width: 40px; height: 40px;">
                    <img src="{{ asset('img/logopetshop.png') }}" class="w-100 h-100 object-fit-contain" onerror="this.src='https://ui-avatars.com/api/?name=KKK+Petshop&background=0D6EFD&color=fff&rounded=true'">
                </div>
                <span class="fw-bold text-primary fs-6">KKK Admin</span>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/admin/produk"><i class="fas fa-box me-2"></i> Stok Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/layanan"><i class="fas fa-concierge-bell me-2"></i> Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/transaksi"><i class="fas fa-shopping-cart me-2"></i> Transaksi</a></li>
                
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profile') ? 'active fw-bold' : '' }}" href="/profile">
                        <i class="fas fa-user-circle me-2"></i> Profil Saya
                    </a>
                </li>
                
                <li class="nav-item mt-3">
                    <a class="nav-link text-info fw-bold d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalTambahDokter" style="cursor: pointer;">
                        <i class="fas fa-user-md me-2"></i> Tambah Dokter
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <nav class="navbar navbar-light bg-white border-bottom sticky-top py-3">
        <div class="container-fluid px-5">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAdmin">
                <i class="fas fa-bars fs-4 text-primary"></i>
            </button>
    
            <a class="navbar-brand d-flex align-items-center ms-3" href="{{ route('admin.dashboard') }}">
                <div class="logo-wrapper rounded-circle overflow-hidden shadow-sm" style="width: 50px; height: 50px;">
                    <img src="{{ asset('img/logopetshop.png') }}" class="w-100 h-100 object-fit-contain" 
                         onerror="this.src='https://ui-avatars.com/api/?name=KKK+Petshop&background=0D6EFD&color=fff&rounded=true'">
                </div>
                <span class="fw-bold text-primary ms-3 fs-4">KKK PETSHOP</span>
            </a>

            <div class="d-flex align-items-center ms-auto">
                <div class="dropdown">
                    <a href="#" class="text-dark text-decoration-none dropdown-toggle d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::check() && Auth::user()->photo)
                            <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
                        @else
                            <i class="fas fa-user-circle fs-3 me-2"></i>
                        @endif
                        <span class="fw-semibold me-2 d-none d-md-block">{{ Auth::user()->name ?? 'Admin' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-2">
                        <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i> Profil Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
    </nav>

    <main class="admin-content-area">
        <div class="container-fluid px-5">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <div class="modal fade" id="modalTambahDokter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Registrasi Dokter Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.dokter.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label">Nama Dokter</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>