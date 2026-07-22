<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdChild extends Model
{
    use HasFactory;

    protected $table = 'opd_child';

    protected $fillable = [
        'nama',
        'id_opd',
        'id_kategori'
    ];

    /**
     * Relasi: OPD Child ini milik satu OPD Induk tertentu
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'id_opd');
    }

    /**
     * Relasi: OPD Child ini termasuk dalam Kategori tertentu
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriOpd::class, 'id_kategori');
    }
}