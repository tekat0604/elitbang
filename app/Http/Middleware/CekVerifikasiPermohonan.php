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
            $adaIzinAktif = $pemohon->permohonan()
                ->where(function ($query) {
                    // Permohonan baru diajukan atau sedang diproses
                    $query->whereIn('status_permohonan', ['diajukan', 'proses_verifikasi'])

                        // Permohonan disetujui, tapi laporan akhir belum tuntas
                        ->orWhere(function ($q) {
                        $q->where('status_permohonan', 'disetujui')
                            ->where(function ($subQ) {
                                // Belum punya laporan akhir sama sekali
                                $subQ->doesntHave('laporanAkhir')
                                    // sudah punya laporan akhir, tapi statusnya belum disetujui (misal: pending/revisi)
                                    ->orWhereHas('laporanAkhir', function ($laporanQ) {
                                    $laporanQ->where('status_laporan', '!=', 'disetujui');
                                });
                            });
                    });
                })->exists();

            if ($adaIzinAktif) {
                session()->flash('error', 'Akses ditolak, anda tidak dapat mengajukan izin');
                return redirect()->route('permohonan');
            }
        }
        return $next($request);
    }
}
