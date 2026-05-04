<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKK Petshop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .logo-wrapper { display: flex; align-items: center; justify-content: center; background-color: white; border: 1px solid #eee; }
        .dropdown-toggle::after { display: none; }
        .sticky-top { box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .navbar-toggler { display: block !important; }
        .offcanvas-title { line-height: 1; display: flex; align-items: center; }
    </style>
</head>
<body class="bg-light">

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header border-bottom">
            <div class="offcanvas-title" id="offcanvasNavbarLabel">
                <div class="logo-wrapper rounded-circle overflow-hidden shadow-sm me-2" style="width: 40px; height: 40px;">
                    <img src="{{ asset('img/logopetshop.png') }}" class="w-100 h-100 object-fit-contain" onerror="this.src='https://ui-avatars.com/api/?name=KKK+Petshop&background=0D6EFD&color=fff&rounded=true'">
                </div>
                <span class="fw-bold text-dark fs-6">Menu KKK Petshop</span>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav flex-grow-1 pe-3">
                <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/profile"></i> Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="/produk">Semua Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="/keranjang">Keranjang</a></li>
            </ul>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3">
        <div class="container"> 
            <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <i class="fas fa-bars fs-4 text-primary"></i>
            </button>

            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <div class="logo-wrapper rounded-circle overflow-hidden shadow-sm" style="width: 85px; height: 85px;">
                    <img src="{{ asset('img/logopetshop.png') }}" class="w-100 h-100 object-fit-contain" onerror="this.src='https://ui-avatars.com/api/?name=KKK+Petshop&background=0D6EFD&color=fff&rounded=true'">
                </div>
                <div class="lh-1 ms-3">
                    <span class="fw-bold text-primary d-block fs-3">KKK PETSHOP</span>
                </div>
            </a>

            <div class="d-flex align-items-center ms-auto">
                <div class="dropdown me-4">
                    <a href="#" class="text-dark text-decoration-none dropdown-toggle d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->check() && auth()->user()->photo)
                            <img src="{{ asset('storage/photos/' . auth()->user()->photo) }}" 
                                 class="rounded-circle border" 
                                 style="width: 35px; height: 35px; object-fit: cover; margin-right: 8px;">
                        @else
                            <i class="fas fa-user-circle fs-4 me-2"></i>
                        @endif
                        <span class="fw-bold">{{ auth()->user()->name ?? 'Akun' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-2" aria-labelledby="userDropdown">
                        <li><div class="dropdown-header fw-bold text-dark">Akun Saya</div></li>
                        <li><a class="dropdown-item" href="/profile">Profil Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 rounded text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                
                <a href="/wishlist" class="text-dark me-4 text-decoration-none position-relative">
                    <i class="far fa-heart fs-4"></i>
                    <span class="badge rounded-pill bg-primary">{{ $countWishlist ?? 0 }}</span>
                </a>

                <a href="/keranjang" class="text-dark text-decoration-none position-relative">
                    <i class="fas fa-shopping-cart fs-4"></i>
                    <span class="badge rounded-pill bg-primary">{{ $countKeranjang ?? 0 }}</span>
                </a>
            </div>
        </div> 
    </nav>

    <main class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>