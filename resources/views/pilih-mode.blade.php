<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Mode - KantinSatoe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

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
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .wadah {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .kartu-mode {
            background: rgba(255, 255, 255, 0.96);
            border: none;
            border-radius: 16px;
            text-decoration: none;
            color: #333;
            transition: transform 0.15s;
        }

        .kartu-mode:hover {
            transform: translateY(-4px);
            color: #333;
        }

        .ikon {
            width: 64px;
            height: 64px;
            line-height: 64px;
            border-radius: 16px;
            background: #F1E4D8;
            color: #8B5E3C;
            font-weight: bold;
            font-size: 28px;
            margin: 0 auto 12px;
        }

        .btn-outline-terang {
            border-color: white;
            color: white;
        }

        .btn-outline-terang:hover {
            background: white;
            color: #5C4033;
        }
    </style>
</head>
<body style="background-image: url({{ asset('images/bg-kantin.jpg') }});">

<div class="wadah text-white">
    <h3 class="fw-bold mb-1">Halo, {{ auth('kantin')->user()->nama_penjual }}</h3>
    <p class="mb-4">Mau ngapain hari ini?</p>

    <div class="row g-3 justify-content-center" style="max-width: 560px; width: 100%;">
        <div class="col-6">
            <a href="{{ route('pembeli.menu') }}" class="card kartu-mode h-100 shadow">
                <div class="card-body text-center p-4">
                    <div class="ikon"><i class="bi bi-bag-fill"></i></div>
                    <h5 class="mb-1">Belanja</h5>
                    <p class="text-muted small mb-0">Pesan makanan dari kantin</p>
                </div>
            </a>
        </div>

        <div class="col-6">
            <a href="{{ route('kantin.dashboard') }}" class="card kartu-mode h-100 shadow">
                <div class="card-body text-center p-4">
                    <div class="ikon"><i class="bi bi-shop"></i></div>
                    <h5 class="mb-1">Menjual</h5>
                    <p class="text-muted small mb-0">Kelola produk dan pesanan masuk</p>
                </div>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button class="btn btn-outline-terang btn-sm">Keluar</button>
    </form>
</div>

</body>
</html>
