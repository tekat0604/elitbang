<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenSyarat extends Model
{
    use HasFactory;

    protected $table = 'dokumen_syarat';

    protected $fillable = [
        'permohonan_id',
        'jenis_dokumen',
        'tautan_dokumen',
        'status_validasi',
        'catatan_revisi',
    ];

    /**
     * Relasi balik ke Permohonan (Belongs To)
     */
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }
}