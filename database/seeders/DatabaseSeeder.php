<?php

namespace Database\Seeders;

use App\Models\Kantin;
use App\Models\Pembeli;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Password otomatis di-hash oleh model (cast 'hashed'),
        // jadi tulis password biasa saja di sini.

        $kantin = Kantin::create([
            'nama_kantin'  => 'Kantin Bu Siti',
            'nama_penjual' => 'Bu Siti',
            'username'     => 'busiti',
            'password'     => 'password',
        ]);

        $kantin->produk()->createMany([
            [
                'nama_produk' => 'Nasi Goreng',
                'deskripsi'   => 'Nasi goreng telur',
                'harga'       => 12000,
            ],
            [
                'nama_produk' => 'Mie Ayam',
                'deskripsi'   => 'Mie ayam bakso',
                'harga'       => 10000,
            ],
            [
                'nama_produk' => 'Es Teh',
                'deskripsi'   => 'Es teh manis',
                'harga'       => 3000,
            ],
        ]);

        Pembeli::create([
            'nama_pembeli' => 'Iput',
            'username'     => 'pembeli1',
            'password'     => 'password',
        ]);
    }
}