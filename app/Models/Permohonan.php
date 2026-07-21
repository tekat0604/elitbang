<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';

    protected $fillable = [
        'pemohon_id',
        'layanan_id',
        'judul',
        'lokasi',
        'tgl_mulai',
        'tgl_selesai',
        'jenjang_pendidikan',
        'bidang_penelitian',
        'rumpun_penelitian',
        'jenis_pengajuan',
        'jumlah_anggota',
        'nama_instansi',
        'alamat_instansi',
        'link_pengantar_kampus',
        'link_proposal',
        'status_permohonan',
        'status_kesbangpol',
        'catatan_kesbangpol',
        'status_brida',
        'catatan_brida',
        'file_surat_izin',
        'qr_code',
    ];

    /**
     * Relasi Induk (Belongs To)
     */
    public function pemohon(): BelongsTo
    {
        return $this->belongsTo(Pemohon::class);
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    /**
     * Relasi Anak (One-to-Many / Has Many)
     */
    public function anggota(): HasMany
    {
        return $this->hasMany(AnggotaPermohonan::class);
    }

    public function dokumenSyarat(): HasMany
    {
        return $this->hasMany(DokumenSyarat::class);
    }

    public function pembimbing(): HasMany
    {
        return $this->hasMany(PembimbingPermohonan::class);
    }

    public function tembusanOpd(): HasMany
    {
        return $this->hasMany(TembusanOpd::class);
    }

    /**
     * Relasi Anak Tunggal (One-to-One / Has One)
     */
    public function laporanAkhir(): HasOne
    {
        return $this->hasOne(LaporanAkhir::class);
    }

    public function surveiKepuasan(): HasOne
    {
        return $this->hasOne(SurveiKepuasan::class);
    }
}