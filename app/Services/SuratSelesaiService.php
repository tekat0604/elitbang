<?php

namespace App\Services;

use App\Models\LaporanAkhir;
use App\Models\SuratSelesai;
use App\Models\PejabatInstansi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SuratSelesaiService
{
  public static function generateAndSave(LaporanAkhir $laporan, $nomor_surat)
  {
    // 1. Ambil atau Buat Data di Tabel Surat Selesai
    $surat = $laporan->suratSelesai()->firstOrCreate(
      ['laporan_akhir_id' => $laporan->id],
      ['nomor_surat' => $nomor_surat]
    );

    // 2. Generate Token QR (Jika belum ada)
    if (empty($surat->qr_code_link)) {
      $surat->qr_code_link = Str::random(32);
      $surat->save();
    }

    // 3. Hapus file PDF lama jika ada (agar server tidak penuh)
    if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
      Storage::disk('public')->delete($surat->file_path);
    }

    $pejabat_brida = PejabatInstansi::where('instansi', 'brida')->first();
    $tanggal_cetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

    // 4. Buat QR Code menggunakan TOKEN
    $link_verifikasi = url('/verifikasi/selesai/' . $surat->qr_code_link);
    $qr_code = base64_encode(QrCode::margin(0)->size(80)->generate($link_verifikasi));

    $data = [
      'laporan' => $laporan,
      'permohonan' => $laporan->permohonan,
      'nomor_surat' => $nomor_surat,
      'pejabat_brida' => $pejabat_brida,
      'tanggal_cetak' => $tanggal_cetak,
      'qr_code' => $qr_code,
      'surat' => $surat // Dikirim ke blade agar ttd dinamis bisa dibaca
    ];

    // 5. Konversi ke PDF
    $pdf = Pdf::loadView('pdf.surat-selesai', $data)->setPaper('A4', 'portrait');

    // 6. Simpan File PDF ke Storage
    $fileName = 'surat_selesai_final_' . $surat->qr_code_link . '_' . time() . '.pdf';
    $filePath = 'surat_selesai/final/' . $fileName;
    Storage::disk('public')->put($filePath, $pdf->output());

    // 7. Update Path dan Status TTE di tabel Surat Selesai
    $surat->update([
      'nomor_surat' => $nomor_surat,
      'file_path' => $filePath,
      'status_tte_brida' => 'selesai'
    ]);

    return true;
  }
}