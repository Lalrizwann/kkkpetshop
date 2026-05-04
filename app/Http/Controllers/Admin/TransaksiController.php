<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // 1. Menampilkan semua transaksi (untuk Admin)
    public function index()
    {
        // Mengambil semua transaksi beserta data user yang memesan
        $transaksis = Transaksi::latest()->get(); 
        return view('admin.transaksi.index', compact('transaksis'));
    }

    // 2. Menampilkan form tambah transaksi
    public function create()
    {
        $users = User::all(); // Untuk dropdown pilih pelanggan
        return view('admin.transaksi.create', compact('users'));
    }

    // 3. Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        Transaksi::create([
            'user_id' => $request->user_id,
            'total_harga' => $request->total_harga,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending', // Default status
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
    }

    // 4. Menampilkan detail transaksi (bisa digunakan Admin dan Pelanggan)
    public function show($id)
    {
        $transaksi = Transaksi::with('user')->findOrFail($id);
    return view('admin.transaksi.show', compact('transaksi'));
    }

    // 5. Update status transaksi (misal: dari pending ke selesai)
    public function updateStatus(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => $request->status]);

        return back()->with('success', 'Status transaksi diperbarui!');
    }

    public function upload($id)
{
    $transaksi = Transaksi::findOrFail($id);
    return view('admin.transaksi.upload', compact('transaksi'));
}

public function storeUpload(Request $request, $id)
{
    $request->validate([
        'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $transaksi = Transaksi::findOrFail($id);
    $path = $request->file('bukti')->store('bukti_pembayaran', 'public');
    
    $transaksi->update([
        'bukti_pembayaran' => $path,
        'status' => 'Waiting Verification' 
    ]);

    // Arahkan ke rute yang benar sesuai daftar route:list
    return redirect()->route('admin.transaksi.show', $id)->with('success', 'Bukti berhasil diupload!');
}

public function verifikasi(Request $request, $id)
{
    $transaksi = Transaksi::findOrFail($id);
    // Update status berdasarkan tombol yang ditekan admin
    $transaksi->update(['status' => $request->status]); 

    return redirect()->route('admin.transaksi.index')->with('success', 'Status berhasil diperbarui!');
}


}