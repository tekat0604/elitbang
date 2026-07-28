<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class CekRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $role = strtolower(trim($user->role ?? ''));

        // Jika rolenya bukan admin, blokir aksesnya
        if ($role !== 'admin') {
            // Arahkan kembali ke dashboard dengan pesan error
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Halaman ini khusus untuk admin.');
        }

        return $next($request);
    }
}
