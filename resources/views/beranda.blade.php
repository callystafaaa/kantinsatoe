<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KantinSatoe - Pesan Makanan Kantin Tanpa Antre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* lapisan gelap biar tulisan putih tetap jelas */
        .gelap {
            background: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
        }

        .kartu-langkah {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 16px;
        }

        .nomor {
            width: 44px;
            height: 44px;
            line-height: 44px;
            border-radius: 50%;
            background: #6F4E37;
            color: white;
            font-weight: bold;
            margin: 0 auto 12px;
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
    </style>
</head>
<body style="background-image: url({{ asset('images/bg-kantin.jpg') }});">

<div class="gelap text-white">

    <nav class="container py-3">
    <span class="fs-5 fw-bold">KantinSatoe</span>
</nav>

    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold">Lapar? Pesan dulu,<br>ambil nanti.</h1>
        <p class="lead mt-3 mx-auto" style="max-width: 600px;">
            Lapar? tapi malas antre? Kenalan Yuk sama KantinSatoe!
        </p>
        <div class="mt-4">
            <a href="{{ route('register') }}" class="btn btn-coklat btn-lg me-2">Mulai Pesan</a>
        </div>
    </div>

    <div class="container pb-5">
        <h4 class="text-center mb-4">Gimana cara pakainya?</h4>

        <div class="row g-3 justify-content-center">
            <div class="col-md-4">
                <div class="card kartu-langkah text-dark h-100">
                    <div class="card-body text-center p-4">
                        <div class="nomor">1</div>
                        <h5>Pilih menu</h5>
                        <p class="text-muted mb-0">Lihat daftar menu kantin lengkap dengan harga dan deskripsinya.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card kartu-langkah text-dark h-100">
                    <div class="card-body text-center p-4">
                        <div class="nomor">2</div>
                        <h5>Pesan</h5>
                        <p class="text-muted mb-0">Pilih makanan dan jumlahnya, total harga langsung dihitung otomatis.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card kartu-langkah text-dark h-100">
                    <div class="card-body text-center p-4">
                        <div class="nomor">3</div>
                        <h5>Ambil dan bayar ditempat.</h5>
                        <p class="text-muted mb-0">Pantau status pesananmu. Kalau sudah siap, ambil di kantin dan bayar tunai.</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-center mt-5 mb-0 text-white-50">
            KantinSatoe - Sistem Pemesanan Kantin Sekolah
        </p>
    </div>

</div>

</body>
</html>

