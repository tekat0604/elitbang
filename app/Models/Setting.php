<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $table       = 'settings';
    public $timestamps  = true;

    protected $fillable = [
        'id',
        'title_nav',
        'unit',
        'name_apps',
        'deskripsi',
        'logo_page_login',
        'logo_branding',
        'primary_color',
        'secondary_color'
    ];
}
