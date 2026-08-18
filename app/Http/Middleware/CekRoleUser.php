<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekRoleUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Kita anggap jika role kosong/null di database, dia adalah pemohon standar
        $role = strtolower(trim($user->role ?? 'user'));

        // Jika rolenya bukan user, blokir aksesnya
        if ($role !== 'user') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Halaman ini khusus untuk pengguna.');
        }

        // Jika benar pemohon, silakan masuk
        return $next($request);
    }
}
