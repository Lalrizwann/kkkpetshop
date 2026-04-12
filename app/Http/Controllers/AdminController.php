<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Halaman Dashboard Admin
    public function index()
    {
        return view('admin.dashboard');
    }

    // Tampilkan Form Tambah Dokter
    public function createDokter()
    {
        return view('admin.tambah-dokter');
    }

    // Proses Simpan Akun Dokter
    public function storeDokter(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|min:5',
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'role' => 'dokter',
    ]);

    // PAKSA PINDAH KE DASHBOARD
    return redirect('/admin/dashboard')->with('success', 'Akun dokter berhasil didaftarkan!');
}
}