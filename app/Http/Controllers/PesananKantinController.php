<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PesananKantinController extends Controller
{
    // dashboard: ringkasan dan daftar pesanan masuk
    public function index()
    {
        $id_kantin = Auth::guard('kantin')->id();

        $pesanan = Pesanan::with('pembeli', 'detail.produk')
            ->where('id_kantin', $id_kantin)
            ->where('status', '!=', 'selesai')
            ->orderBy('tanggal_pesan')
            ->get();

        $jumlah = [
            'menunggu' => Pesanan::where('id_kantin', $id_kantin)->where('status', 'menunggu')->count(),
            'diproses' => Pesanan::where('id_kantin', $id_kantin)->where('status', 'diproses')->count(),
            'siap'     => Pesanan::where('id_kantin', $id_kantin)->where('status', 'siap')->count(),
            'selesai'  => Pesanan::where('id_kantin', $id_kantin)->where('status', 'selesai')->count(),
        ];

        return view('kantin.dashboard', compact('pesanan', 'jumlah'));
    }

    // naikkan status ke tahap berikutnya
    public function ubahStatus($id)
    {
        $pesanan = Pesanan::where('id_kantin', Auth::guard('kantin')->id())->findOrFail($id);

        if ($pesanan->status == 'menunggu') {
            $pesanan->status = 'diproses';
        } elseif ($pesanan->status == 'diproses') {
            $pesanan->status = 'siap';
        } elseif ($pesanan->status == 'siap') {
            $pesanan->status = 'selesai';
        }

        $pesanan->save();

        return back()->with('sukses', 'Status pesanan #' . $pesanan->id_pesanan . ' diubah menjadi ' . $pesanan->status);
    }
}