<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        // Cek role user, jika admin arahkan ke profilead, jika pelanggan ke pelanggan.profile
        if ($user->role === 'admin') {
            return view('admin.profilead', compact('user'));
        }

        return view('pelanggan.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
    
        if ($request->hasFile('photo')) {
            $filename = time() . '_' . $request->photo->getClientOriginalName();
            $request->photo->storeAs('photos', $filename, 'public'); 
            $user->photo = $filename;
        }
    
        $user->save();
    
        // Setelah simpan, arahkan kembali sesuai role-nya
        return redirect()->back()->with('success', 'Data profil berhasil diperbarui!');
    }
}