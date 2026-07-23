<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pemohon;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $password = Hash::make('password123'); // Semua akun pakai password yang sama biar gampang

        // 1. Akun Verifikator BRIDA
        User::create([
            'name' => 'Admin BRIDA',
            'email' => 'brida@surakarta.go.id',
            'password' => $password,
            'role' => 'verifikator',
            'instansi' => 'brida',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 2. Akun Verifikator Kesbangpol
        User::create([
            'name' => 'Admin Kesbangpol',
            'email' => 'kesbangpol@surakarta.go.id',
            'password' => $password,
            'role' => 'verifikator',
            'instansi' => 'kesbangpol',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3. Akun User Biasa (Belum isi identitas sama sekali)
        User::create([
            'name' => 'Pengguna Baru',
            'email' => 'baru@gmail.com',
            'password' => $password,
            'role' => 'user',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 4. Akun User Biasa (Sudah Terverifikasi)
        $userTerverifikasi = User::create([
            'name' => 'Faadhilah Hana Gustie Fatimah',
            'email' => 'faadhilah@student.uns.ac.id',
            'password' => $password,
            'role' => 'user',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Buat profil pemohon yang langsung terhubung dan terverifikasi
        Pemohon::create([
            'user_id' => $userTerverifikasi->id,
            'nama_lengkap' => 'Faadhilah Hana Gustie Fatimah',
            'jenis_identitas' => 'ktm',
            'nomor_identitas' => 'L0124012',
            'no_hp' => '081234567890',
            'email' => 'faadhilah@student.uns.ac.id',
            'kewarganegaraan' => 'WNI',
            'tanggal_lahir' => '2004-01-01',
            'provinsi' => 'Jawa Tengah',
            'kota_kabupaten' => 'Surakarta',
            'kecamatan' => 'Jebres',
            'kelurahan_desa' => 'Jebres',
            'alamat' => 'Kampus UNS Kentingan, Surakarta',
            'path_identitas' => 'identitas/dummy_ktm.jpg',
            'status_verifikasi' => 'terverifikasi',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}