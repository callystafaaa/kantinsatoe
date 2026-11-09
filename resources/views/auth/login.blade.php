<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - KantinSatoe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        /* lapisan gelap tipis biar tulisan di kartu tetap jelas */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 0;
        }

        .wadah {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .kartu-login {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 16px;
        }

        .btn-coklat {
        background-color: #8B5E3C;
        border-color: #8B5E3C;
        color: white;
        }

        .btn-coklat:hover {
        background-color: #6F4A2E;
        border-color: #6F4A2E;
        color: white;
        }
        .btn-outline-coklat {
        border-color: #8B5E3C;
        color: #8B5E3C;
        background: transparent;
        }

        .btn-outline-coklat:hover {
        background-color: #8B5E3C;
        border-color: #8B5E3C;
        color: white;
}

    </style>
</head>
<body style="background-image: url({{ asset('images/bg-kantin.jpg') }});">
<div class="wadah">
    <div class="card kartu-login shadow-lg">
        <div class="card-body p-4">
            <h3 class="text-center fw-bold mb-1">KantinSatoe</h3>
            <p class="text-center text-muted mb-4">Pesan makanan kantin tanpa antre</p>

            <form method="POST" action="{{ route('login.proses') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username"
                           class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}" autofocus>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <button type="submit" class="btn btn-coklat w-100">Masuk</button>
            </form>
            <p class="text-center mt-3 mb-0">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
            </p>
            <a href="{{ route('beranda') }}" class="btn btn-outline-coklat w-100 mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>

</body>
</html>