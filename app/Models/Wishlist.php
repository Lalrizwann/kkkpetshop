<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produk_id'];
    
    // Tambahkan relasi jika perlu
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}

// public function tambahWishlist($id)
// {
//     $userId = auth()->id();

//     // Cek apakah sudah ada di wishlist
//     $exists = DB::table('wishlists')->where('user_id', $userId)->where('produk_id', $id)->first();

//     if ($exists) {
//         // Jika sudah ada, hapus (Toggle)
//         DB::table('wishlists')->where('user_id', $userId)->where('produk_id', $id)->delete();
//         $pesan = 'Dihapus dari favorit.';
//     } else {
//         // Jika belum ada, tambah
//         DB::table('wishlists')->insert([
//             'user_id' => $userId,
//             'produk_id' => $id,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//         $pesan = 'Berhasil ditambah ke favorit!';
//     }

//     return redirect()->back()->with('success', $pesan);
// }
// }
