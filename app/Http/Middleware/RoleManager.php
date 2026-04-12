<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan baris ini!

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
{
    // Cek apakah user sudah login dan apakah rolenya sesuai
    if (!Auth::check() || Auth::user()->role !== $role) {
        // Jika bukan rolenya, lempar ke dashboard utama atau error 403
        return redirect('/dashboard')->with('error', 'Anda tidak punya akses ke halaman ini.');
    }

    return $next($request);
}
}
