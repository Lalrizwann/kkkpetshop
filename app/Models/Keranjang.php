<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    // Tambahkan user_id, produk_id, dan jumlah ke fillable
    protected $fillable = [
        'user_id',
        'produk_id',
        'jumlah',
    ];

    // Relasi ke Produk agar bisa menampilkan nama/foto di halaman keranjang
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}