<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // Pastikan Model Produk sudah dibuat
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // 1. Menampilkan semua produk di halaman Admin
    public function indexAdmin()
{
    $produk = Produk::all();
    // Mengarah ke resources/views/admin/produkad.blade.php
    return view('admin.produkad', compact('produk'));
}

    // 2. Menampilkan Form Tambah Produk
    public function create()
    {
        return view('admin.tambah_produk');
    }

    // 3. Menyimpan data produk baru ke Database
    public function store(Request $request)
{
    // 1. Tambahkan validasi agar stok wajib diisi
    $request->validate([
        'nama_produk' => 'required',
        'kategori'    => 'required',
        'harga'       => 'required|numeric',
        'stok'        => 'required|numeric|min:0', // Validasi stok
        'foto'        => 'required|image',
    ]);

    // 2. Proses upload foto...
    $file = $request->file('foto');
    $nama_foto = time() . "_" . $file->getClientOriginalName();
    $file->move(public_path('storage'), $nama_foto);

    // 3. Simpan ke database
    Produk::create([
        'nama_produk' => $request->nama_produk,
        'kategori'    => $request->kategori,
        'harga'       => $request->harga,
        'stok'        => $request->stok, // <--- Pastikan baris ini ada
        'foto'        => $nama_foto,
    ]);

    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambah!');
}

// HANYA TULIS SATU KALI DI DALAM CLASS ProdukController

public function edit($id)
{
    $produk = Produk::findOrFail($id);
    // Sesuaikan dengan struktur folder di image_91ec07.png
    return view('admin.edit', compact('produk'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required',
        'kategori' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
        'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $produk = Produk::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('foto')) {
        if ($produk->foto) {
            Storage::delete('public/' . $produk->foto);
        }
        $data['foto'] = $request->file('foto')->store('produk', 'public');
    }

    $produk->update($data);
    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate!');
}

public function destroy($id)
{
    $produk = Produk::findOrFail($id);
    if ($produk->foto) {
        Storage::delete('public/' . $produk->foto);
    }
    $produk->delete();
    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
}


}