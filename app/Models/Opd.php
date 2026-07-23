<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $table = 'opd';

    protected $fillable = [
        'nama_opd',
        'id_kategori'
    ];

    /**
     * Relasi: OPD ini milik satu Kategori tertentu
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriOpd::class, 'id_kategori');
    }

    /**
     * Relasi: Satu OPD memiliki banyak OPD Child (Anak Cabang/Bidang)
     */
    public function children()
    {
        return $this->hasMany(OpdChild::class, 'id_opd');
    }
}