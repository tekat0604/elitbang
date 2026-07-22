<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CekVerifikasiPermohonan
{
    public function handle(Request $request, Closure $next): Response
    {
        $pemohon = Auth::user()->pemohon;

        if ($pemohon) {
            $adaIzinAktif = $pemohon->permohonan()->whereIn('status_permohonan', [
                'draft',
                'diajukan',
                'proses_verifikasi',
                'revisi',
                'disetujui',

            ])->exists();

            if ($adaIzinAktif) {
                session()->flash('error', 'Akses ditolak, anda tidak dapat mengajukan izin');
                return redirect()->route('permohonan');
            }
        }
        return $next($request);
    }
}
