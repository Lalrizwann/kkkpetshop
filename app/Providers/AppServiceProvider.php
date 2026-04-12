<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengirim data ke semua halaman yang pakai layout app
        View::composer('layouts.app', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                
                // Hitung jumlah baris di tabel masing-masing
                $view->with([
                    'countKeranjang' => DB::table('keranjangs')->where('user_id', $userId)->count(),
                    'countWishlist'  => DB::table('wishlists')->where('user_id', $userId)->count()
                ]);
            } else {
                $view->with(['countKeranjang' => 0, 'countWishlist' => 0]);
            }
        });
    }

}
