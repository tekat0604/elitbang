<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggotaPermohonan extends Model
{
    use HasFactory;

    protected $table = 'anggota_permohonan';

    protected $fillable = [
        'permohonan_id',
        'nama_anggota',
        'nik',
    ];

    /**
     * Relasi balik ke Permohonan induknya (Belongs To)
     */
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }
}