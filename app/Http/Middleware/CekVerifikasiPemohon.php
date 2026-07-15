<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekVerifikasiPemohon
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user->pemohon || $user->pemohon->status_verifikasi !== 'terverifikasi') {
            if ($user->pemohon && $user->pemohon->status_verifikasi === 'revisi') {
                return redirect()->route('dashboard')->with('error', 'Harap perbaiki data identitas Anda terlebih dahulu');

            }
            ;

            return redirect()->route('identitas')->with('error', 'Anda harus melengkapi profil dan menunggu verifikasi Kesbangpol sebelum membuat permohonan');
        }
        ;
        return $next($request);
    }
}
