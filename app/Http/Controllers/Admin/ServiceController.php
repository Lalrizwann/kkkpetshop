<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\File; // Tambahkan ini untuk hapus file lama

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all(); 
        return view('admin.layanan.index', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        Service::create($data);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambah!');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.layanan.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048' // foto opsional saat edit
        ]);

        $service = Service::findOrFail($id);
        
        // Ambil semua input kecuali foto
        $data = $request->except('foto');

        // Logika simpan foto jika ada file baru yang diunggah
        if ($request->hasFile('foto')) {
            // 1. Hapus foto lama dari folder public/img jika ada
            if ($service->foto && File::exists(public_path('img/' . $service->foto))) {
                File::delete(public_path('img/' . $service->foto));
            }

            // 2. Upload foto baru
            $file = $request->file('foto');
            $nama_foto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $nama_foto);
            
            // 3. Set nama foto baru ke array data
            $data['foto'] = $nama_foto;
        }

        $service->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Hapus file fisik foto sebelum data di DB dihapus
        if ($service->foto && File::exists(public_path('img/' . $service->foto))) {
            File::delete(public_path('img/' . $service->foto));
        }

        $service->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }
}