<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemohon extends Model
{
    use HasFactory;

    protected $table = 'pemohon';

    protected $fillable = [
        'user_id',
        'nik',
        'no_hp',
        'kewarganegaraan',
        'instansi',
        'nim_nip',
        'provinsi',
        'kota_kabupaten',
        'kecamatan',
        'kelurahan_desa',
        'alamat',
        'path_identitas',
        'status_verifikasi',
        'catatan_verifikasi',
    ];

    /**
     * Relasi balik ke tabel Users (Belongs To)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke tabel Permohonan (One-to-Many)
     * Satu pemohon bisa memiliki banyak permohonan izin
     */
    public function permohonan(): HasMany
    {
        return $this->hasMany(Permohonan::class);
    }
}