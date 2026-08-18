<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TembusanOpd extends Model
{
    use HasFactory;

    protected $table = 'tembusan_opd';

    protected $fillable = [
        'permohonan_id',
        'user_id',
        'level_distribusi',
        'is_read',
        'status_penyaluran',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}