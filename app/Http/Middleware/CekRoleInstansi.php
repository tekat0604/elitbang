<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekRoleInstansi
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $role = strtolower(trim($user->role ?? ''));

        if (in_array($role, ['opd', 'uptd'])) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Halaman ini khusus untuk Instansi (OPD/UPTD).');
    }
}