<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel
    protected $table = 'layanan';

    protected $fillable = [
        'nama_layanan',
        'slug_layanan',
        'logo',
        'deskripsi',
    ];

    /**
     * Relasi ke tabel Permohonan (One-to-Many)
     * Satu layanan bisa digunakan oleh banyak data permohonan
     */
    public function permohonan(): HasMany
    {
        return $this->hasMany(Permohonan::class);
    }
}