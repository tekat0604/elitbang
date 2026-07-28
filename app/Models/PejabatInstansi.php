<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PejabatInstansi extends Model
{
    use HasFactory;

    protected $table = 'pejabat_instansi';

    protected $fillable = [
        'instansi',
        'nama_kepala_instansi',
        'nip',
    ];
}