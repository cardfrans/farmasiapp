<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan baris ini

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika sudah login dan role-nya adalah 'admin', silakan lewat
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin (atau belum login), lempar kembali ke halaman katalog
        return redirect('/katalog');
    }
}