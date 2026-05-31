<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman Buku</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #0d9488 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            padding: 1.5rem;
        }
        .login-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .login-card:hover {
            transform: translateY(-5px);
        }
        .login-header {
            background-color: #0f172a;
            color: #fff;
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            border-bottom: 4px solid #14b8a6;
        }
        .login-body {
            padding: 2.5rem 2rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus {
            border-color: #14b8a6;
            box-shadow: 0 0 0 0.25rem rgba(20, 184, 166, 0.25);
        }
        .input-group-text {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }
        .btn-login {
            background-color: #0d9488;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #0f766e;
            color: white;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-book-half fs-1 mb-2 d-inline-block" style="color: #14b8a6;"></i>
            <h4 class="mb-1 fw-bold text-white">SIPEMBU Admin</h4>
            <p class="mb-0 text-white-50" style="font-size: 0.9rem;">Sistem Peminjaman Buku Sekolah</p>
        </div>
        <div class="login-body">
            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" role="alert" style="border-left: 4px solid #0d9488 !important; font-size: 0.9rem;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2" style="color: #0d9488;"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label text-muted fw-semibold" style="font-size: 0.85rem;">EMAIL</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="admin@gmail.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-muted fw-semibold" style="font-size: 0.85rem;">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk Aplikasi
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
