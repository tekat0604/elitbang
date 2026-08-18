<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRoleTandaTangan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|null  $instansi
     */
    public function handle(Request $request, Closure $next, $instansi = null): Response
    {
        $user = Auth::user();

        $role = strtolower(trim($user->role ?? ''));

        // Jika rolenya bukan tanda_tangan, blokir aksesnya
        if ($role !== 'tanda_tangan') {
            // Arahkan kembali ke dashboard dengan pesan error
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Halaman ini khusus untuk Kesbangpol/BRIDA.');
        }

        return $next($request);
    }
}