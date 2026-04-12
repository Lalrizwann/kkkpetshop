<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index()
    {
        // Ambil data pemeriksaan yang ditujukan ke dokter ini
        // Eager load 'user' agar kita bisa panggil nama pelanggannya
        $antrean = Pemeriksaan::with('user')
            ->where('dokter_id', Auth::id())
            ->orderBy('status', 'asc') // 'Pending' akan muncul di atas
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dokter.dashboard', compact('antrean'));
    }

    // Menampilkan form input diagnosa
public function editPemeriksaan($id)
{
    // Cari data pemeriksaan berdasarkan ID, pastikan hanya dokter yang dituju yang bisa akses
    $pemeriksaan = \App\Models\Pemeriksaan::with('user')->findOrFail($id);
    
    return view('dokter.input_hasil', compact('pemeriksaan'));
}

// Menyimpan hasil diagnosa ke database
public function simpanHasil(Request $request, $id)
{
    $request->validate([
        'diagnosa' => 'required|min:5',
        'saran'    => 'required|min:5',
    ]);

    $pemeriksaan = \App\Models\Pemeriksaan::findOrFail($id);
    
    // Update data sesuai alur di diagrammu
    $pemeriksaan->update([
        'diagnosa' => $request->diagnosa,
        'saran'    => $request->saran,
        'status'   => 'Selesai', // Otomatis berubah jadi Selesai
    ]);

    return redirect()->route('dokter.dashboard')->with('success', 'Diagnosa berhasil dikirim ke pelanggan!');
}
}