@extends('layouts.kantin')

@section('judul', 'Tambah Produk')

@section('isi')
    <h4 class="text-white fw-bold mb-3">Tambah Produk</h4>
    <div class="card" style="max-width: 500px;">
        <div class="card-body">
            <form method="POST" action="{{ route('kantin.produk.store') }}">
                @csrf
                @include('kantin.produk._form')
            </form>
        </div>
    </div>
@endsection
