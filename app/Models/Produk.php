<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan kolom diisi
    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'foto',
    ];
}