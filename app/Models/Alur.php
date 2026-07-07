<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alur extends Model
{
    public $table       = 'alur_layanan';
    public $timestamps  = true;

    protected $fillable = [
        'id',
        'gambar_alur',
        'deskripsi'
    ];
}
