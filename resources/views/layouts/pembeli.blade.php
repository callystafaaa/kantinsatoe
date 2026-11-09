<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - KantinSatoe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark" style="background-color: #5C4033;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('pembeli.menu') }}">KantinSatoe</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="{{ route('pembeli.menu') }}">Menu</a>
            <a class="nav-link" href="{{ route('pembeli.pesanan.riwayat') }}">Pesanan Saya</a>
        </div>
        <span class="navbar-text me-3">{{ auth('pembeli')->user()->nama_pembeli }}</span>
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

</body>
</html>