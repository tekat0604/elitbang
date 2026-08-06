<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Pemohon;
use App\Models\Permohonan;
use App\Models\SuratIzin;
use App\Models\Opd;
use App\Models\OpdChild;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $password = Hash::make('password123'); // Semua akun pakai password yang sama

        // ==========================================
        // 1. AKUN SISTEM DAN ADMIN UTAMA
        // ==========================================
        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@surakarta.go.id',
            'password' => $password,
            'role' => 'super_admin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Admin BRIDA',
            'email' => 'brida@surakarta.go.id',
            'password' => $password,
            'role' => 'verifikator',
            'instansi' => 'brida',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Admin Kesbangpol',
            'email' => 'kesbangpol@surakarta.go.id',
            'password' => $password,
            'role' => 'verifikator',
            'instansi' => 'kesbangpol',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Kepala BRIDA',
            'email' => 'kepala.brida@surakarta.go.id',
            'password' => $password,
            'role' => 'tanda_tangan',
            'instansi' => 'brida',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => 'Kepala Kesbangpol',
            'email' => 'kepala.kesbangpol@surakarta.go.id',
            'password' => $password,
            'role' => 'tanda_tangan',
            'instansi' => 'kesbangpol',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // ==========================================
        // 2. AKUN PEMOHON & DATA UJI COBA
        // ==========================================
        User::create([
            'name' => 'Pengguna Baru',
            'email' => 'baru@gmail.com',
            'password' => $password,
            'role' => 'user',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3. GENERATOR OTOMATIS AKUN OPD & UPTD

        // Ambil semua data master OPD
        $semuaOpd = Opd::all();

        foreach ($semuaOpd as $opd) {
            // Hilangkan spasi dan ubah jadi huruf kecil untuk email
            $formatEmail = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $opd->nama_opd));

            User::firstOrCreate(
                ['email' => $formatEmail . '@surakarta.go.id'], // Pastikan email unik
                [
                    'name' => 'Admin ' . $opd->nama_opd,
                    'password' => $password,
                    'role' => 'opd',
                    'id_opd' => $opd->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        // Ambil semua data master UPTD / Cabang
        $semuaUptd = OpdChild::all();

        foreach ($semuaUptd as $uptd) {
            // Hilangkan spasi dan ubah jadi huruf kecil untuk email
            $formatEmail = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $uptd->nama));

            User::firstOrCreate(
                ['email' => $formatEmail . '@surakarta.go.id'], // Pastikan email unik
                [
                    'name' => 'Admin ' . $uptd->nama,
                    'password' => $password,
                    'role' => 'uptd',
                    'id_opd_child' => $uptd->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}