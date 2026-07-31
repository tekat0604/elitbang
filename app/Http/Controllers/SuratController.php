<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratIzin;

class SuratController extends Controller
{
    public function preview($id)
    {
        $user = Auth::user();
        $roleDiizinkan = ['verifikator', 'tanda_tangan'];

        if (!in_array($user->role, $roleDiizinkan)) {
            abort(403, 'Akses Ditolak: Hanya Verifikator dan Pejabat Instansi yang diizinkan melihat draf dokumen ini.');
        }

        $surat = SuratIzin::findOrFail($id);
        $path = $surat->file_surat_draft;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File PDF tidak ditemukan di server.');
        }

        return Storage::disk('public')->response($path);
    }

    public function unduh($id)
    {
        $user = Auth::user();

        $surat = SuratIzin::whereHas('permohonan', function ($query) use ($user) {
            $query->where('pemohon_id', $user->pemohon?->id);
        })->findOrFail($id);

        $path = $surat->file_surat_final;

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'Surat rekomendasi final belum tersedia atau tidak ditemukan di server.');
        }

        return Storage::disk('public')->response($path);
    }

    public function verifikasi($token)
    {
        // Cari surat berdasarkan token QR acak yang ada di kolom link_qr
        $surat = SuratIzin::with(['permohonan.pemohon', 'permohonan.layanan'])
            ->where('link_qr', $token)
            ->first();

        // Jika token tidak cocok atau dokumen dipalsukan
        if (!$surat) {
            abort(404, 'Dokumen tidak valid, dipalsukan, atau tidak ditemukan di sistem kami.');
        }

        // Jika dokumen asli, arahkan ke halaman detail verifikasi
        return view('publik.verifikasi-dokumen', compact('surat'));
    }
}