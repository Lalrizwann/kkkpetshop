<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KKK Petshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #00BAF2 100%); min-height: 100vh; display: flex; align-items: center; }
        .login-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .btn-login { background: #00BAF2; border: none; color: white; transition: 0.3s; }
        .btn-login:hover { background: #00BAF2; }
        .register-link { color: #00BAF2; text-decoration: none; font-weight: 600; }
        .register-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card login-card p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">KKK Petshop</h3>
                        <p class="text-muted">Silakan login ke akun Anda</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success py-2 small">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@mail.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="********" required>
                        </div>
                        <button type="submit" class="btn btn-login w-100 py-2 fw-bold mb-3">Masuk</button>
                        
                        <div class="text-center">
                            <p class="text-muted small mb-0">Belum punya akun?</p>
                            <a href="{{ route('register') }}" class="register-link small">Daftar Akun Baru</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>