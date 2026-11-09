@extends('layouts.pembeli')
@section('judul', 'Detail Pesanan')
@section('isi')
    <h4 class="mb-3">Detail Pesanan #{{ $pesanan->id_pesanan }}</h4>

    <div class="card mb-3">
        <div class="card-body">
            <p class="mb-1">Kantin: <strong>{{ $pesanan->kantin->nama_kantin }}</strong></p>
            <p class="mb-1">Tanggal: {{ $pesanan->tanggal_pesan->format('d-m-Y H:i') }}</p>
            <p class="mb-0">
                Status:
                @if ($pesanan->status == 'menunggu')
                    <span class="badge text-bg-warning">Menunggu</span>
                @elseif ($pesanan->status == 'diproses')
                    <span class="badge text-bg-info">Diproses</span>
                @elseif ($pesanan->status == 'siap')
                    <span class="badge text-bg-success">Siap diambil</span>
                @else
                    <span class="badge text-bg-secondary">Selesai</span>
                @endif
            </p>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan->detail as $d)
                        <tr>
                            <td>{{ $d->produk->nama_produk }}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td class="text-end">Rp{{ number_format($d->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th class="text-end">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <p class="text-muted mt-3">Pembayaran dilakukan tunai di kantin saat mengambil pesanan.</p>
    <a href="{{ route('pembeli.pesanan.riwayat') }}" class="btn btn-secondary">Kembali</a>

    <script>
        // halaman refresh sendiri tiap 15 detik supaya status selalu terbaru
        setTimeout(function () {
            location.reload();
        }, 15000);
    </script>
@endsection
