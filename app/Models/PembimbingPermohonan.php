<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembimbingPermohonan extends Model
{
    use HasFactory;

    protected $table = 'pembimbing_permohonan';

    protected $fillable = [
        'permohonan_id',
        'nama_pembimbing',
    ];

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }
}