<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Kantin extends Authenticatable
{
    protected $table = 'kantin';
    protected $primaryKey = 'id_kantin';
    protected $fillable = ['nama_kantin', 'nama_penjual', 'username', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['password' => 'hashed'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kantin', 'id_kantin');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_kantin', 'id_kantin');
    }
}
