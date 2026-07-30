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
}