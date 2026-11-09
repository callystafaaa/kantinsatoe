@extends('layouts.kantin')
@section('judul', 'Ubah Produk')
@section('isi')
    <h4 class="text-white fw-bold mb-3">Ubah Produk</h4>

    <div class="card shadow" style="max-width: 500px;">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('kantin.produk.update', $produk->id_produk) }}">
                @csrf
                @method('PUT')
                @include('kantin.produk._form')
            </form>
        </div>
    </div>
@endsection