@extends('layouts.kantin')

@section('judul', 'Dashboard')

@section('isi')
    <style>
        .kotak-angka {
            border-radius: 14px;
            padding: 16px;
            background: rgba(255, 255, 255, 0.96);
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .ikon-angka {
            width: 46px;
            height: 46px;
            line-height: 46px;
            border-radius: 12px;
            text-align: center;
            font-size: 22px;
            flex-shrink: 0;
        }
        .angka {
            font-size: 26px;
            font-weight: bold;
            line-height: 1;
        }
    </style>

    <div class="mb-4 text-white">
        <h3 class="fw-bold mb-1">Halo, {{ auth('kantin')->user()->nama_kantin }}</h3>
        <p class="mb-0 text-white-50">Berikut pesanan yang perlu kamu siapkan hari ini.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="kotak-angka shadow-sm">
                <div class="ikon-angka" style="background: #FFF3CD; color: #997404;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="angka">{{ $jumlah['menunggu'] }}</div>
                    <small class="text-muted">Menunggu</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="kotak-angka shadow-sm">
                <div class="ikon-angka" style="background: #CFF4FC; color: #087990;">
                    <i class="bi bi-fire"></i>
                </div>
                <div>
                    <div class="angka">{{ $jumlah['diproses'] }}</div>
                    <small class="text-muted">Diproses</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="kotak-angka shadow-sm">
                <div class="ikon-angka" style="background: #D1E7DD; color: #0f5132;">
                    <i class="bi bi-bag-check-fill"></i>
                </div>
                <div>
                    <div class="angka">{{ $jumlah['siap'] }}</div>
                    <small class="text-muted">Siap diambil</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="kotak-angka shadow-sm">
                <div class="ikon-angka" style="background: #F1E4D8; color: #8B5E3C;">
                    <i class="bi bi-check2-all"></i>
                </div>
                <div>
                    <div class="angka">{{ $jumlah['selesai'] }}</div>
                    <small class="text-muted">Selesai</small>
                </div>
            </div>
        </div>
    </div>

    <h5 class="text-white fw-bold mb-3">Pesanan Masuk</h5>

    @forelse ($pesanan as $p)
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center" style="border-radius: 14px 14px 0 0;">
                <div>
                    <strong>Pesanan #{{ $p->id_pesanan }}</strong>
                    <span class="text-muted">- {{ $p->pembeli->nama_pembeli }}</span>
                    <small class="text-muted ms-2">
                        <i class="bi bi-clock"></i> {{ $p->tanggal_pesan->format('H:i') }}
                    </small>
                </div>
                <div>
                    @if ($p->status == 'menunggu')
                        <span class="badge text-bg-warning">Menunggu</span>
                    @elseif ($p->status == 'diproses')
                        <span class="badge text-bg-info">Diproses</span>
                    @else
                        <span class="badge text-bg-success">Siap diambil</span>
                    @endif
                </div>
            </div>

            <ul class="list-group list-group-flush">
                @foreach ($p->detail as $d)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $d->produk->nama_produk }} <span class="text-muted">x {{ $d->jumlah }}</span></span>
                        <span>Rp{{ number_format($d->subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="card-footer bg-white d-flex justify-content-between align-items-center" style="border-radius: 0 0 14px 14px;">
                <strong style="color: #8B5E3C;">Total: Rp{{ number_format($p->total_harga, 0, ',', '.') }}</strong>

                <form method="POST" action="{{ route('kantin.pesanan.status', $p->id_pesanan) }}">
                    @csrf
                    @if ($p->status == 'menunggu')
                        <button class="btn btn-coklat btn-sm">Proses pesanan</button>
                    @elseif ($p->status == 'diproses')
                        <button class="btn btn-success btn-sm">Tandai siap</button>
                    @else
                        <button class="btn btn-outline-secondary btn-sm">Tandai selesai (sudah diambil)</button>
                    @endif
                </form>
            </div>
        </div>
    @empty
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 48px; color: #8B5E3C;"></i>
                <h5 class="mt-2 mb-1">Belum ada pesanan masuk</h5>
                <p class="text-muted mb-0">Pesanan baru akan muncul di sini otomatis.</p>
            </div>
        </div>
    @endforelse

    <script>
        // refresh tiap 15 detik biar pesanan baru langsung muncul
        setTimeout(function () {
            location.reload();
        }, 15000);
    </script>
@endsection