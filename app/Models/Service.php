<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk memberi izin pengisian data
    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga',
        'foto'
    ];
}
