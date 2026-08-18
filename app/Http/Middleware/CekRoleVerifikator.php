<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRoleVerifikator
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Pastikan hurufnya disamakan menjadi kecil semua dan tanpa spasi
        $role = strtolower(trim($user->role ?? ''));

        // Jika rolenya bukan verifikator, blokir aksesnya
        if ($role !== 'verifikator') {
            // Arahkan kembali ke dashboard dengan pesan error
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Halaman ini khusus untuk Verifikator Kesbangpol/BRIDA.');
        }

        // Jika rolenya benar verifikator, silakan masuk
        return $next($request);
    }
}