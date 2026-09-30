<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Membatasi akses hanya untuk user dengan role 'admin'.
     * Kalau bukan admin, dikembalikan ke Dashboard dengan pesan error.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || $request->user()->role !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak punya akses ke halaman ini. Hanya admin yang bisa membuka Laporan Admin.');
        }

        return $next($request);
    }
}