<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $fillable = ['id_pembeli', 'id_kantin', 'tanggal_pesan', 'status', 'total_harga'];
    protected $casts = ['tanggal_pesan' => 'datetime'];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli', 'id_pembeli');
    }

    public function kantin()
    {
        return $this->belongsTo(Kantin::class, 'id_kantin', 'id_kantin');
    }

    public function detail()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
