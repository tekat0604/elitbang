<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriOpd extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara spesifik
    protected $table = 'kategori_opd';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'kategori'
    ];

    /**
     * Relasi: Satu Kategori memiliki banyak OPD
     */
    public function opds()
    {
        return $this->hasMany(Opd::class, 'id_kategori');
    }

    /**
     * Relasi: Satu Kategori memiliki banyak OPD Child
     */
    public function opdChildren()
    {
        return $this->hasMany(OpdChild::class, 'id_kategori');
    }
}