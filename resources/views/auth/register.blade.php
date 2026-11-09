<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - KantinSatoe</title>
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

        a {
            color: #8B5E3C;
        }

        .form-check-input:checked {
            background-color: #8B5E3C;
            border-color: #8B5E3C;
        }

        .form-control:focus {
            border-color: #8B5E3C;
            box-shadow: 0 0 0 0.25rem rgba(139, 94, 60, 0.25);
        }
    </style>
</head>
<body style="background-image: url({{ asset('images/bg-kantin.jpg') }});">

<div class="wadah">
    <div class="card kartu-login shadow-lg">
        <div class="card-body p-4">
            <h3 class="text-center fw-bold mb-1">Daftar Akun</h3>
            <p class="text-center text-muted mb-4">Buat akun KantinSatoe</p>

            <form method="POST" action="{{ route('register.proses') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label d-block">Daftar sebagai</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="peran" id="peran-pembeli" value="pembeli"
                               {{ old('peran', 'pembeli') == 'pembeli' ? 'checked' : '' }}>
                        <label class="form-check-label" for="peran-pembeli">Pembeli</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="peran" id="peran-kantin" value="kantin"
                               {{ old('peran') == 'kantin' ? 'checked' : '' }}>
                        <label class="form-check-label" for="peran-kantin">Kantin</label>
                    </div>
                </div>

                <div id="bagian-pembeli">
                    <div class="mb-3">
                        <label for="nama_pembeli" class="form-label">Nama lengkap</label>
                        <input type="text" name="nama_pembeli" id="nama_pembeli"
                               class="form-control @error('nama_pembeli') is-invalid @enderror"
                               value="{{ old('nama_pembeli') }}">
                        @error('nama_pembeli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div id="bagian-kantin" class="d-none">
                    <div class="mb-3">
                        <label for="nama_kantin" class="form-label">Nama kantin</label>
                        <input type="text" name="nama_kantin" id="nama_kantin"
                               class="form-control @error('nama_kantin') is-invalid @enderror"
                               value="{{ old('nama_kantin') }}">
                        @error('nama_kantin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_penjual" class="form-label">Nama penjual</label>
                        <input type="text" name="nama_penjual" id="nama_penjual"
                               class="form-control @error('nama_penjual') is-invalid @enderror"
                               value="{{ old('nama_penjual') }}">
                        @error('nama_penjual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username"
                           class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Ulangi password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control">
                </div>

                <button type="submit" class="btn btn-coklat w-100">Daftar</button>
            </form>

            <p class="text-center mt-3 mb-0">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </p>

            <a href="{{ route('beranda') }}" class="btn btn-outline-coklat w-100 mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>

<script>
    function tampilkanKolom() {
        var peran = document.querySelector('input[name="peran"]:checked').value;

        document.getElementById('bagian-pembeli').classList.toggle('d-none', peran != 'pembeli');
        document.getElementById('bagian-kantin').classList.toggle('d-none', peran != 'kantin');
    }

    document.querySelectorAll('input[name="peran"]').forEach(function (radio) {
        radio.addEventListener('change', tampilkanKolom);
    });

    tampilkanKolom();
</script>

</body>
</html>