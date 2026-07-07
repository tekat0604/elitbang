<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    public $table       = 'layanan';
    public $timestamps  = true;

    protected $fillable = [
        'id',
        'nama_layanan',
        'slug_layanan',
        'deskripsi'
    ];
}
