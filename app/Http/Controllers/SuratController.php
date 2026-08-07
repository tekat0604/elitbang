<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratIzin;
use App\Models\SuratSelesai;

class SuratController extends Controller
{
    // untuk surat izin rekomendasi
    public function preview($token)
    {
        $user = Auth::user();

        $isPenandatangan = ($user->role === 'tanda_tangan');

        $isVerifikatorBrida = ($user->role === 'verifikator' && $user->instansi === 'brida');

        if (!$isPenandatangan && !$isVerifikatorBrida) {
            abort(403, 'Akses Ditolak: Hanya Verifikator BRIDA dan Pejabat Penandatangan yang diizinkan melihat dokumen ini.');
        }

        // Cari berdasarkan qr_code_link
        $surat = SuratIzin::where('qr_code_link', $token)->firstOrFail();

        // Gunakan kolom file_path yang baru
        $path = $surat->file_path;

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File PDF tidak ditemukan di server.');
        }

        return Storage::disk('public')->response($path);
    }

    // untuk surat selesai
    public function previewSelesai($token)
    {
        $user = Auth::user();

        $isPenandatangan = ($user->role === 'tanda_tangan');
        $isVerifikatorBrida = ($user->role === 'verifikator' && $user->instansi === 'brida');

        if (!$isPenandatangan && (!$isVerifikatorBrida && $user->role !== 'verifikator')) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk melihat dokumen ini.');
        }

        // Cari berdasarkan qr_code_link di tabel surat_selesai
        $surat = SuratSelesai::where('qr_code_link', $token)->firstOrFail();

        $path = $surat->file_path;

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File PDF tidak ditemukan di server.');
        }

        return Storage::disk('public')->response($path);
    }

    public function unduh($token)
    {
        $user = Auth::user();

        // Cari berdasarkan qr_code_link
        $surat = SuratIzin::whereHas('permohonan', function ($query) use ($user) {
            $query->where('pemohon_id', $user->pemohon?->id);
        })->where('qr_code_link', $token)->firstOrFail();

        // Gunakan kolom file_path yang baru
        $path = $surat->file_path;

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'Surat rekomendasi final belum tersedia atau tidak ditemukan di server.');
        }

        return Storage::disk('public')->response($path);
    }

    public function unduhSelesai($token)
    {
        $user = Auth::user();

        // Cari berdasarkan qr_code_link dan pastikan laporan tersebut milik user yang sedang login
        $surat = SuratSelesai::whereHas('laporanAkhir.permohonan', function ($query) use ($user) {
            $query->where('pemohon_id', $user->pemohon?->id);
        })->where('qr_code_link', $token)->firstOrFail();

        // Gunakan kolom file_path
        $path = $surat->file_path;

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'Surat Keterangan Selesai final belum tersedia atau tidak ditemukan di server.');
        }

        return Storage::disk('public')->response($path);
    }

    public function verifikasi($token)
    {
        // Bagian ini sudah menggunakan qr_code_link, jadi dibiarkan saja
        $surat = SuratIzin::with(['permohonan.pemohon', 'permohonan.layanan'])
            ->where('qr_code_link', $token)
            ->first();

        if (!$surat) {
            abort(404, 'Dokumen tidak valid, dipalsukan, atau tidak ditemukan di sistem kami.');
        }

        return view('publik.verifikasi-dokumen', compact('surat'));
    }
}