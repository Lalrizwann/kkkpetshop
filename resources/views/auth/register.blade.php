<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | KKK Petshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; }
        .register-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .btn-register { background: #764ba2; border: none; color: white; transition: 0.3s; }
        .btn-register:hover { background: #5a3782; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card register-card p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Daftar Akun</h3>
                        <p class="text-muted">Bergabung dengan KKK Petshop</p>
                    </div>

                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="********" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
                        </div>
                        
                        <button type="submit" class="btn btn-register w-100 py-2 fw-bold mb-3">Daftar Sekarang</button>
                        <div class="text-center">
                            <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>