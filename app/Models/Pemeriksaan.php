<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    // 1. Beritahu Laravel nama tabelnya (tadi di gambar pHPMyAdmin: pemeriksaans)
    protected $table = 'pemeriksaans';

    // 2. Beritahu Laravel bahwa primary key-nya BUKAN 'id'
    // protected $primaryKey = 'pemeriksaan_id';

    // 3. Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'user_id', 
        'dokter_id', 
        'keluhan', 
        'diagnosa', 
        'saran', 
        'status'
    ];

    // 4. Relasi ke Service (karena di DB ada service_id)
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // 5. Relasi ke User (Pelanggan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}