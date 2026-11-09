<?php

namespace App\Http\Controllers;

use App\Models\Kantin;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // halaman daftar menu
    public function menu()
    {
        $query = Kantin::with('produk');

        // kalau yang login juga penjual, sembunyikan kantinnya sendiri
        if (Auth::guard('kantin')->check()) {
            $query->where('id_kantin', '!=', Auth::guard('kantin')->id());
        }

        $kantin = $query->get();

        return view('pembeli.menu', compact('kantin'));
    }

    // simpan pesanan
    public function store(Request $request)
    {
        $request->validate([
            'id_kantin' => 'required|exists:kantin,id_kantin',
            'jumlah' => 'required|array',
        ]);

        // penjual tidak boleh memesan dari kantinnya sendiri
        if (Auth::guard('kantin')->check() && Auth::guard('kantin')->id() == $request->id_kantin) {
            return back()->with('gagal', 'Kamu tidak bisa memesan dari kantinmu sendiri');
        }

        $total = 0;
        $items = [];

        foreach ($request->jumlah as $id_produk => $jumlah) {
            $jumlah = (int) $jumlah;

            if ($jumlah < 1) {
                continue;
            }

            // pastikan produknya memang milik kantin yang dipilih
            $produk = Produk::where('id_kantin', $request->id_kantin)->find($id_produk);

            if ($produk == null) {
                continue;
            }

            $subtotal = $produk->harga * $jumlah;
            $total = $total + $subtotal;

            $items[] = [
                'id_produk' => $produk->id_produk,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        if (count($items) == 0) {
            return back()->with('gagal', 'Pilih minimal satu produk dulu');
        }

        // simpan pesanan dan detailnya sekaligus
        $pesanan = DB::transaction(function () use ($request, $items, $total) {
            $pesanan = Pesanan::create([
                'id_pembeli' => Auth::guard('pembeli')->id(),
                'id_kantin' => $request->id_kantin,
                'tanggal_pesan' => now(),
                'status' => 'menunggu',
                'total_harga' => $total,
            ]);

            foreach ($items as $item) {
                $pesanan->detail()->create($item);
            }

            return $pesanan;
        });

        return redirect()->route('pembeli.pesanan.detail', $pesanan->id_pesanan)
            ->with('sukses', 'Pesanan berhasil dibuat');
    }

    // riwayat pesanan milik pembeli yang login
    public function riwayat()
    {
        $pesanan = Pesanan::with('kantin')
            ->where('id_pembeli', Auth::guard('pembeli')->id())
            ->latest('tanggal_pesan')
            ->get();

        return view('pembeli.riwayat', compact('pesanan'));
    }

    // detail dan status satu pesanan
    public function detail($id)
{
    $pesanan = Pesanan::with('kantin', 'detail.produk')
        ->where('id_pembeli', Auth::guard('pembeli')->id())
        ->find($id);

    if ($pesanan == null) {
        return redirect()->route('pembeli.pesanan.riwayat')
            ->with('gagal', 'Pesanan tidak ditemukan');
    }

    return view('pembeli.detail', compact('pesanan'));
}
}