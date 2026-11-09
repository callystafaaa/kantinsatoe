<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - KantinSatoe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* lapisan gelap biar tulisan tetap jelas */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .isi-halaman {
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        .navbar-coklat {
            background-color: rgba(92, 64, 51, 0.95);
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

        .card {
            border: none;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.96);
        }

        .table thead th {
            background: #F1E4D8;
            color: #5C4033;
            border-bottom: none;
        }

        .form-control:focus {
            border-color: #8B5E3C;
            box-shadow: 0 0 0 0.25rem rgba(139, 94, 60, 0.25);
        }
    </style>
</head>
<body style="background-image: url({{ asset('images/bg-kantin.jpg') }});">

<div class="isi-halaman">

    <nav class="navbar navbar-expand navbar-dark navbar-coklat">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('kantin.dashboard') }}">KantinSatoe</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="{{ route('kantin.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('kantin.produk.index') }}">Produk</a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm">Keluar</button>
            </form>
        </div>
    </nav>

    <div class="container py-4">
        @if (session('sukses'))
            <div class="alert alert-success">{{ session('sukses') }}</div>
        @endif
        @if (session('gagal'))
            <div class="alert alert-danger">{{ session('gagal') }}</div>
        @endif

        @yield('isi')
    </div>

</div>

</body>
</html>