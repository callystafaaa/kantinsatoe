@extends('layouts.kantin')
@section('judul', 'Produk')
@section('isi')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-white fw-bold">Daftar Produk</h4>
        <a href="{{ route('kantin.produk.create') }}" class="btn btn-coklat">Tambah Produk</a>
    </div>

    <div class="card shadow">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $p)
                        <tr>
                            <td class="fw-semibold">{{ $p->nama_produk }}</td>
                            <td class="text-muted">{{ $p->deskripsi }}</td>
                            <td style="color: #8B5E3C;" class="fw-semibold">
                                Rp{{ number_format($p->harga, 0, ',', '.') }}
                            </td>
                            <td>
                                <a href="{{ route('kantin.produk.edit', $p->id_produk) }}"
                                   class="btn btn-sm btn-outline-secondary">Ubah</a>
                                <form method="POST" action="{{ route('kantin.produk.destroy', $p->id_produk) }}"
                                      class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection