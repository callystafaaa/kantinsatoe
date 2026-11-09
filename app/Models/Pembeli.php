<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pembeli extends Authenticatable
{
    protected $table = 'pembeli';
    protected $primaryKey = 'id_pembeli';
    protected $fillable = ['nama_pembeli', 'username', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['password' => 'hashed'];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_pembeli', 'id_pembeli');
    }
}