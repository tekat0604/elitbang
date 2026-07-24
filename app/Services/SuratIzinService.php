<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Permohonan;
use App\Models\SuratIzin;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SuratIzinService
{
  public static function generateAndSave(Permohonan $permohonan, $nomorSurat)
  {
    // Cari data surat yang nomornya sudah diinput oleh verifikator
    $surat = SuratIzin::where('permohonan_id', $permohonan->id)->first();

    if ($surat) {
      $pdf = Pdf::loadView('pdf.surat-izin', [
        'permohonan' => $permohonan,
        'nomor_surat' => $nomorSurat,
        'tanggal_cetak' => Carbon::now()->translatedFormat('d F Y')
      ])->setPaper('a4', 'portrait');

      $filename = 'draft_surat_izin_' . $permohonan->id . '_' . time() . '.pdf';
      $path = 'surat_izin/draft/' . $filename;
      Storage::disk('public')->put($path, $pdf->output());

      // Update tabel dengan file PDF-nya
      $surat->update([
        'file_surat_draft' => $path,
        'status_tte_kesbangpol' => 'pending',
        'status_tte_brida' => 'pending',
      ]);
    }
  }
}