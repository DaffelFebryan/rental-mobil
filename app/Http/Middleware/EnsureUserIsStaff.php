<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsStaff
{
    /**
     * Membatasi akses panel admin hanya untuk role 'admin' atau 'staff'.
     * User dengan role 'customer' akan ditolak dan diarahkan ke halaman utama.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, ['admin', 'staff'])) {
            return redirect()->route('home')
                ->with('error', 'Halaman ini khusus untuk admin/staff. Silakan login dengan akun yang sesuai.');
        }

        return $next($request);
    }
}