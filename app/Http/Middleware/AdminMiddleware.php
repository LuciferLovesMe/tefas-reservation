<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Periksa apakah pengguna sudah login DAN memiliki role 'admin'.
        //    Asumsi: Di model User Anda (atau tabel users), ada kolom bernama 'role'.
        if (Auth::check() && Auth::user()->role === 'admin') {
            // 2. Jika iya, izinkan permintaan untuk melanjutkan ke controller.
            return $next($request);
        }

        // 3. Jika tidak, gagalkan permintaan dengan halaman error 403 (Forbidden).
        //    Ini memberitahu pengguna bahwa mereka tidak punya hak akses.
        abort(403, 'AKSES DITOLAK');
    }
}
