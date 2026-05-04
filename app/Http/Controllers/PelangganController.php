<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Transaksi;
use App\Models\Pemeriksaan;
use App\Models\DetailTransaksi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;

class PelangganController extends Controller
{
    // 1. Halaman Dashboard Utama Pelanggan
    public function index()
    {
        $userId = Auth::id();
        
        // Mengambil data ringkasan untuk ditampilkan di dashboard
        $totalKeranjang = Keranjang::where('user_id', $userId)->count();
        $totalTransaksi = Transaksi::where('user_id', $userId)->count();
        $pemeriksaanTerakhir = Pemeriksaan::where('user_id', $userId)->latest()->first();

        // Mengarahkan ke file view dashboard.blade.php sesuai struktur folder Anda
        return view('pelanggan.dashboard', compact('totalKeranjang', 'totalTransaksi', 'pemeriksaanTerakhir'));
    }

    // 2. Halaman Etalase Produk (dengan fitur Search & Filter Kategori)
    public function produk(Request $request)
    {
        $kategori = $request->query('kategori');
        $search = $request->query('search');

        $produk = Produk::query()
            ->when($kategori, function ($query) use ($kategori) {
                return $query->where('kategori', $kategori);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('nama_produk', 'like', '%' . $search . '%');
            })
            ->get();

        // Ambil ID produk yang sudah difavoritkan
        $wishlistIds = [];
        if (auth()->check()) {
            $wishlistIds = DB::table('wishlists')
                ->where('user_id', auth()->id())
                ->pluck('produk_id')
                ->toArray();
        }

        return view('pelanggan.produk', compact('produk', 'wishlistIds'));
    }

    public function wishlist() {
        // Sesuaikan logika pengambilan data wishlist sesuai kebutuhan Anda
        $wishlists = Wishlist::where('user_id', auth()->id())->get();
        return view('pelanggan.wishlist', compact('wishlists'));
    }

    // 3. Fitur Keranjang Belanja
    public function tambahKeKeranjang(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $item = Keranjang::where('user_id', Auth::id())->where('produk_id', $id)->first();

        if ($item) {
            $item->increment('jumlah');
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $id,
                'jumlah' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Produk berhasil masuk keranjang! 🛒');
    }

    public function keranjang()
    {
        $items = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        $total = $items->sum(function($i) {
            return $i->produk->harga * $i->jumlah;
        });
        return view('pelanggan.keranjang', compact('items', 'total'));
    }

    public function updateJumlah(Request $request, $id)
    {
        $item = Keranjang::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        if ($request->aksi == 'tambah') {
            if ($item->jumlah < $item->produk->stok) {
                $item->increment('jumlah');
            } else {
                return redirect()->back()->with('error', 'Stok pakan tidak mencukupi!');
            }
        } elseif ($request->aksi == 'kurang' && $item->jumlah > 1) {
            $item->decrement('jumlah');
        }
        return redirect()->back();
    }

    public function hapusItem($id)
    {
        Keranjang::where('id', $id)->where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    // 4. Fitur Checkout & Transaksi
    public function checkout(Request $request)
    {
        $userId = auth()->id();
        $items = Keranjang::where('user_id', $userId)->get();

        if ($items->isEmpty()) return redirect()->back()->with('error', 'Keranjang kosong!');

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'user_id' => $userId,
                'kode_transaksi' => 'KKK-' . strtoupper(Str::random(8)),
                'total_harga' => $items->sum(fn($i) => $i->produk->harga * $i->jumlah),
                'status' => 'Menunggu Pembayaran',
            ]);

            foreach ($items as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id'    => $item->produk_id,
                    'jumlah'       => $item->jumlah,
                    'harga_satuan' => $item->produk->harga,
                    'subtotal'     => $item->produk->harga * $item->jumlah,
                ]);
                DB::table('produks')->where('id', $item->produk_id)->decrement('stok', $item->jumlah);
            }

            Keranjang::where('user_id', $userId)->delete();
            DB::commit();
            return redirect()->route('pelanggan.transaksi.detail', $transaksi->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal checkout: ' . $e->getMessage());
        }
    }

    public function detailTransaksi($id)
    {
        $transaksi = Transaksi::with('detail.produk')->findOrFail($id);
        if ($transaksi->user_id !== auth()->id()) abort(403);
        return view('pelanggan.transaksi_detail', compact('transaksi'));
    }

    public function riwayat()
    {
        $transaksi = Transaksi::where('user_id', auth()->id())->latest()->get();
        $pemeriksaan = Pemeriksaan::with('service')->where('user_id', auth()->id())->get();
        return view('pelanggan.riwayat', compact('transaksi', 'pemeriksaan'));
    }

    // 5. Fitur Layanan & Konsultasi Dokter
    public function layanan()
    {
        $services = Service::all(); 
        return view('pelanggan.layanan', compact('services'));
    }

    public function daftarDokter()
    {
        $dokter = \App\Models\User::where('role', 'dokter')->get();
        return view('pelanggan.dokter', compact('dokter'));
    }

    public function formKonsultasi($id)
    {
        $dokter = \App\Models\User::findOrFail($id);
        return view('pelanggan.form_konsultasi', compact('dokter'));
    }

    public function simpanKonsultasi(Request $request)
    {
        $request->validate(['keluhan' => 'required|min:10']);
        Pemeriksaan::create([
            'user_id'   => auth()->id(),
            'dokter_id' => $request->dokter_id,
            'keluhan'   => $request->keluhan,
            'status'    => 'Pending',
        ]);
        return redirect()->route('pelanggan.riwayat')->with('success', 'Konsultasi berhasil dikirim!');
    }

    // 6. Fitur Wishlist (Toggle)
    public function tambahWishlist($id)
    {
        $userId = auth()->id();
        $wishlist = Wishlist::where('user_id', $userId)->where('produk_id', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Dihapus dari favorit.');
        } else {
            Wishlist::create([
                'user_id' => $userId, 
                'produk_id' => $id
            ]);
            return redirect()->back()->with('success', 'Ditambah ke favorit!');
        }
    }
}