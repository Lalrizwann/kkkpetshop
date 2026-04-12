<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKK Petshop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border: 1px solid #eee;
        }
        .dropdown-toggle::after {
            display: none;
        }
        .sticky-top {
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3">
        <div class="container"> 
            
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <div class="logo-wrapper rounded-circle overflow-hidden shadow-sm" style="width: 85px; height: 85px;">
                    <img src="{{ asset('img/logopetshop.png') }}" 
                         alt="Logo" 
                         class="w-100 h-100 object-fit-contain"
                         onerror="this.src='https://ui-avatars.com/api/?name=KKK+Petshop&background=0D6EFD&color=fff&rounded=true'">
                </div>
                <div class="lh-1 ms-3">
                    <span class="fw-bold text-primary d-block fs-3">KKK PETSHOP</span>
                    <small class="text-muted" style="font-size: 11px; letter-spacing: 0.5px;">Pusat Kebutuhan Hewan Terlengkap</small>
                </div>
            </a>

            <div class="mx-auto d-none d-lg-block" style="width: 35%;">
                <form action="/produk" method="GET" class="input-group">
                    <input type="text" name="search" class="form-control border-end-0 bg-light rounded-start-pill ps-4" placeholder="Cari produk kesayangan anabul...">
                    <button class="btn btn-light border border-start-0 rounded-end-pill pe-4 text-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown me-4">
                    <a href="#" class="text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-user fs-4"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-2" aria-labelledby="userDropdown">
                        <li><div class="dropdown-header fw-bold text-dark">Akun Saya</div></li>
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
                
                <a href="#" class="text-dark me-4 text-decoration-none position-relative">
                    <i class="far fa-heart fs-4"></i>
                    <span class="badge rounded-pill bg-primary">{{ $countWishlist }}</span>
                </a>

                <a href="/keranjang" class="text-dark text-decoration-none position-relative">
                    <i class="fas fa-shopping-cart fs-4"></i>
                    <span class="badge rounded-pill bg-primary">{{ $countKeranjang }}</span>
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