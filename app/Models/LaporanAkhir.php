<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LaporanAkhir extends Model
{
    use HasFactory;

    protected $table = 'laporan_akhir';

    protected $fillable = [
        'permohonan_id',
        'file_laporan',
        'tanggal_upload',
        'status_laporan',
        'catatan_revisi',
        'file_surat_selesai',
        'nomor_surat',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_upload' => 'datetime',
        ];
    }

    /**
     * Relasi balik ke Permohonan (Belongs To)
     */
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }

    public function suratSelesai(): HasOne
    {
        return $this->hasOne(SuratSelesai::class);
    }
}