<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratSelesai extends Model
{
    use HasFactory;

    protected $table = 'surat_selesai';

    protected $fillable = [
        'laporan_akhir_id',
        'nomor_surat',
        'file_path',
        'qr_code_link',
        'status_tte_brida',
    ];

    // Relasi balik ke Laporan Akhir
    public function laporanAkhir(): BelongsTo
    {
        return $this->belongsTo(LaporanAkhir::class);
    }
}