<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang diizinkan untuk diisi secara massal (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
        'instansi',
        'id_opd',
        'id_opd_child',
    ];

    /**
     * Atribut yang harus disembunyikan saat model diubah ke array atau JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang harus di-cast (diubah tipe datanya secara otomatis).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tabel Pemohon (One-to-One)
     * Satu akun user hanya memiliki satu profil pemohon.
     */
    public function pemohon(): HasOne
    {
        return $this->hasOne(Pemohon::class);
    }
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'id_opd');
    }

    public function opdChild()
    {
        return $this->belongsTo(OpdChild::class, 'id_opd_child');
    }
}