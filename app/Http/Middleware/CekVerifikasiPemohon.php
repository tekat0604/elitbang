<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekVerifikasiPemohon
{
  public function handle(Request $request, Closure $next): Response
  {
    $user = Auth::user();

    // Cek apakah user punya data pemohon dan statusnya 'terverifikasi'
    if (!$user->pemohon || $user->pemohon->status_verifikasi !== 'terverifikasi') {

      // Cek spesifik jika masih ditolak/revisi
      if ($user->pemohon && $user->pemohon->status_verifikasi === 'revisi') {
        return redirect()->route('identitas')->with('error', 'Harap perbaiki data identitas Anda terlebih dahulu.');
      }

      return redirect()->route('identitas')->with('error', 'Anda harus melengkapi profil dan menunggu verifikasi Kesbangpol sebelum dapat membuat permohonan.');
    }

    return $next($request);
  }
}