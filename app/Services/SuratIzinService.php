<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Permohonan;
use App\Models\SuratIzin;
use App\Models\PejabatInstansi;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class SuratIzinService
{
  public static function generateAndSave(Permohonan $permohonan, $nomorSurat)
  {
    $surat = SuratIzin::where('permohonan_id', $permohonan->id)->first();

    if ($surat) {

      // Token ini akan dipakai untuk URL QR Code dan nama file PDF
      if (empty($surat->qr_code_link)) {
        $surat->qr_code_link = Str::random(32);
        $surat->save();
      }

      // Hapus file draft yang lama (jika ada)
      if ($surat->file_surat_draft && Storage::disk('public')->exists($surat->file_surat_draft)) {
        Storage::disk('public')->delete($surat->file_surat_draft);
      }

      $pejabatKesbangpol = PejabatInstansi::where('instansi', 'kesbangpol')->first();
      $pejabatBrida = PejabatInstansi::where('instansi', 'brida')->first();

      $qrCode = null;
      // cek apakah brida dan kesbangpol selesai tanda tangan
      if ($surat->status_tte_brida === 'selesai' && $surat->status_tte_kesbangpol === 'selesai') {
        $urlVerifikasi = url('/verifikasi/' . $surat->qr_code_link);
        $svg = QrCode::margin(0)->size(80)->generate($urlVerifikasi);
        $qrCode = base64_encode($svg);
      }

      // Render PDF-nya
      $pdf = Pdf::loadView('pdf.surat-izin', [
        'permohonan' => $permohonan,
        'surat' => $surat,
        'nomor_surat' => $nomorSurat,
        'tanggal_cetak' => Carbon::now()->locale('id')->isoFormat('D MMMM Y'),
        'pejabat_kesbangpol' => $pejabatKesbangpol,
        'pejabat_brida' => $pejabatBrida,
        'qr_code' => $qrCode,
      ])->setPaper('a4', 'portrait');

      if ($surat->status_tte_brida === 'selesai' && $surat->status_tte_kesbangpol === 'selesai') {

        // Simpan ke folder FINAL menggunakan token acak
        $filename = 'surat_izin_final_' . $surat->qr_code_link . '_' . time() . '.pdf';
        $path = 'surat_izin/final/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());

        $surat->update([
          'file_surat_draft' => null,
          'file_surat_final' => $path,
        ]);

      } else {

        // Simpan ke folder DRAFT menggunakan token acak
        $filename = 'draft_surat_izin_' . $surat->qr_code_link . '_' . time() . '.pdf';
        $path = 'surat_izin/draft/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());

        $surat->update([
          'file_surat_draft' => $path,
        ]);

      }
    }
  }
}