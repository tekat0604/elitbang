<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveiKepuasan extends Model
{
    use HasFactory;

    protected $table = 'survei_kepuasan';

    protected $fillable = [
        'permohonan_id',
        'keterangan',
    ];

    /**
     * Relasi balik ke tabel Permohonan
     */
    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }
}