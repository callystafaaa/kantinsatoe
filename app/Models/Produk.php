<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['id_kantin', 'nama_produk', 'deskripsi', 'harga'];

    public function kantin()
    {
        return $this->belongsTo(Kantin::class, 'id_kantin', 'id_kantin');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_produk', 'id_produk');
    }
}