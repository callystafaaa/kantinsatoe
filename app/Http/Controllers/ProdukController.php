<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $id_kantin = Auth::guard('kantin')->id();
        $produk = Produk::where('id_kantin', $id_kantin)->get();

        return view('kantin.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('kantin.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|max:100',
            'harga' => 'required|numeric|min:0',
        ]);

        Produk::create([
            'id_kantin' => Auth::guard('kantin')->id(),
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('kantin.produk.index')->with('sukses', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::where('id_kantin', Auth::guard('kantin')->id())->findOrFail($id);

        return view('kantin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|max:100',
            'harga' => 'required|numeric|min:0',
        ]);

        $produk = Produk::where('id_kantin', Auth::guard('kantin')->id())->findOrFail($id);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('kantin.produk.index')->with('sukses', 'Produk berhasil diubah');
    }

    public function destroy($id)
{
    $produk = Produk::where('id_kantin', Auth::guard('kantin')->id())->findOrFail($id);
    $produk->delete();

    return back()->with('sukses', 'Produk berhasil dihapus');
}
}