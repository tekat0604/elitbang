<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratIzin extends Model
{
    use HasFactory;

    protected $table = 'surat_izin';

    protected $fillable = [
        'permohonan_id',
        'nomor_surat',
        'file_path',
        'status_tte_kesbangpol',
        'status_tte_brida',
        'qr_code_link',
    ];

    /**
     * Relasi Balik ke Permohonan
     */
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }
}