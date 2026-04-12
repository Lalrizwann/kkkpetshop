<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi (Mass Assignment)
     * Tambahkan 'role' agar saat register otomatis tidak ditolak Laravel.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat data ditampilkan (misal dalam API)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Pengaturan casting tipe data
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Menghash password secara otomatis
        ];
    }
}