<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Permohonan;
use App\Models\SuratIzin;
use App\Models\PejabatInstansi;
use App\Models\User;
use App\Models\TembusanOpd;
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

      if (empty($surat->qr_code_link)) {
        $surat->qr_code_link = Str::random(32);
        $surat->save();
      }

      // Hapus file lama 
      if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
        Storage::disk('public')->delete($surat->file_path);
      }

      $pejabatKesbangpol = PejabatInstansi::where('instansi', 'kesbangpol')->first();
      $pejabatBrida = PejabatInstansi::where('instansi', 'brida')->first();

      $qrCode = null;
      if ($surat->status_tte_brida === 'selesai' && $surat->status_tte_kesbangpol === 'selesai') {
        $urlVerifikasi = url('/verifikasi/' . $surat->qr_code_link);
        $svg = QrCode::margin(0)->size(80)->generate($urlVerifikasi);
        $qrCode = base64_encode($svg);
      }

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

        $filename = 'surat_izin_final_' . $surat->qr_code_link . '_' . time() . '.pdf';
        $path = 'surat_izin/final/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());

        // Update cukup 1 kolom: file_path
        $surat->update([
          'file_path' => $path,
        ]);

        $targetOpdId = $permohonan->opdChild->id_opd;
        $adminOpdList = User::where('role', 'opd')->where('id_opd', $targetOpdId)->get();

        foreach ($adminOpdList as $adminOpd) {
          TembusanOpd::firstOrCreate([
            'permohonan_id' => $permohonan->id,
            'user_id' => $adminOpd->id,
          ], [
            'level_distribusi' => 'opd',
            'is_read' => false
          ]);
        }
      } else {

        $filename = 'draft_surat_izin_' . $surat->qr_code_link . '_' . time() . '.pdf';
        $path = 'surat_izin/draft/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());

        // Update cukup 1 kolom: file_path
        $surat->update([
          'file_path' => $path,
        ]);
      }
    }
  }
}