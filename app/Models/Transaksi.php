<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
        
    }

    protected $fillable = ['user_id', 'kode_transaksi', 'total_harga', 'status'];

    public function detail()
{
    return $this->hasMany(DetailTransaksi::class);
}

}

