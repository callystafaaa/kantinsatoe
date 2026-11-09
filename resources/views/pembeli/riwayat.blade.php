@extends('layouts.pembeli')
@section('judul', 'Pesanan Saya')
@section('isi')
    <h4 class="mb-3">Pesanan Saya</h4>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kantin</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanan as $p)
                        <tr>
                            <td>{{ $p->tanggal_pesan->format('d-m-Y H:i') }}</td>
                            <td>{{ $p->kantin->nama_kantin }}</td>
                            <td>Rp{{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if ($p->status == 'menunggu')
                                    <span class="badge text-bg-warning">Menunggu</span>
                                @elseif ($p->status == 'diproses')
                                    <span class="badge text-bg-info">Diproses</span>
                                @elseif ($p->status == 'siap')
                                    <span class="badge text-bg-success">Siap diambil</span>
                                @else
                                    <span class="badge text-bg-secondary">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pembeli.pesanan.detail', $p->id_pesanan) }}"
                                   class="btn btn-sm btn-outline-primary">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection