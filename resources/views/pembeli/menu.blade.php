@extends('layouts.pembeli')
@section('judul', 'Menu')
@section('isi')
    <style>
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
        .kartu-produk {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        .inisial {
            width: 48px;
            height: 48px;
            line-height: 48px;
            border-radius: 12px;
            background: #F1E4D8;
            color: #8B5E3C;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .harga {
            color: #8B5E3C;
        }
        .bar-pesan {
            background: white;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
    </style>

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Mau makan apa hari ini?</h3>
        <p class="text-muted mb-0">Pilih menu, atur jumlahnya, lalu tekan Pesan.</p>
    </div>

    @forelse ($kantin as $k)
        <form method="POST" action="{{ route('pembeli.pesanan.store') }}" class="form-pesan mb-5">
            @csrf
            <input type="hidden" name="id_kantin" value="{{ $k->id_kantin }}">

            <h5 class="fw-bold mb-3">{{ $k->nama_kantin }}</h5>

            <div class="row g-3">
                @forelse ($k->produk as $p)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card kartu-produk h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="inisial">{{ strtoupper(substr($p->nama_produk, 0, 1)) }}</div>
                                    <div>
                                        <h6 class="mb-1">{{ $p->nama_produk }}</h6>
                                        <p class="text-muted small mb-0">{{ $p->deskripsi }}</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                                    <strong class="harga">Rp{{ number_format($p->harga, 0, ',', '.') }}</strong>

                                    <div class="input-group input-group-sm" style="width: 120px;">
                                        <button type="button" class="btn btn-outline-secondary kurang">-</button>
                                        <input type="number" name="jumlah[{{ $p->id_produk }}]"
                                               class="form-control text-center jumlah"
                                               data-harga="{{ $p->harga }}" value="0" min="0">
                                        <button type="button" class="btn btn-outline-secondary tambah">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border">Kantin ini belum punya menu.</div>
                    </div>
                @endforelse
            </div>

            @if ($k->produk->count() > 0)
                <div class="bar-pesan d-flex justify-content-between align-items-center p-3 mt-3">
                    <div>
                        <small class="text-muted d-block">Total</small>
                        <strong class="fs-5 total-harga">Rp0</strong>
                    </div>
                    <button class="btn btn-coklat px-4">Pesan</button>
                </div>
            @endif
        </form>
    @empty
        <div class="alert alert-light border">Belum ada kantin yang terdaftar.</div>
    @endforelse

    <script>
        // hitung total tiap kantin dan atur tombol + dan -
        document.querySelectorAll('.form-pesan').forEach(function (form) {
            var total = form.querySelector('.total-harga');
            var inputs = form.querySelectorAll('.jumlah');

            function hitung() {
                var jumlah_total = 0;
                inputs.forEach(function (input) {
                    var jumlah = parseInt(input.value) || 0;
                    jumlah_total = jumlah_total + jumlah * parseInt(input.dataset.harga);
                });
                if (total) {
                    total.textContent = 'Rp' + jumlah_total.toLocaleString('id-ID');
                }
            }

            form.querySelectorAll('.tambah').forEach(function (tombol) {
                tombol.addEventListener('click', function () {
                    var input = tombol.parentElement.querySelector('.jumlah');
                    input.value = (parseInt(input.value) || 0) + 1;
                    hitung();
                });
            });

            form.querySelectorAll('.kurang').forEach(function (tombol) {
                tombol.addEventListener('click', function () {
                    var input = tombol.parentElement.querySelector('.jumlah');
                    var nilai = (parseInt(input.value) || 0) - 1;
                    input.value = nilai < 0 ? 0 : nilai;
                    hitung();
                });
            });

            inputs.forEach(function (input) {
                input.addEventListener('input', hitung);
            });
        });
    </script>
@endsection