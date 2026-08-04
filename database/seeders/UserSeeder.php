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

        $userTerverifikasi = User::create([
            'name' => 'Faadhilah Hana Gustie Fatimah',
            'email' => 'faadhilah@student.uns.ac.id',
            'password' => $password,
            'role' => 'user',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $pemohonTerverifikasi = Pemohon::create([
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

        $permohonanVerif = Permohonan::create([
            'pemohon_id' => $pemohonTerverifikasi->id,
            'layanan_id' => 1,
            'judul' => 'Implementasi IoT dan AI dalam Efisiensi Energi Bangunan Puskesmas (Green Neuro City 2045)',
            'id_opd_child' => 1,
            'tgl_mulai' => $now->copy()->addDays(7)->format('Y-m-d'),
            'tgl_selesai' => $now->copy()->addMonths(3)->format('Y-m-d'),
            'jenjang_pendidikan' => 'S1',
            'bidang_penelitian' => 'Informatika',
            'rumpun_penelitian' => 'Sains dan Teknologi',
            'jenis_pengajuan' => 'personal',
            'jumlah_anggota' => 1,
            'nama_instansi' => 'Universitas Sebelas Maret',
            'alamat_instansi' => 'Jl. Ir. Sutami No.36A, Jebres, Surakarta',
            'status_permohonan' => 'disetujui',
            'status_kesbangpol' => 'disetujui',
            'catatan_kesbangpol' => 'Berkas persyaratan lengkap dan valid. Disetujui.',
            'status_brida' => 'disetujui',
            'catatan_brida' => 'Tema riset sangat relevan dengan inovasi teknologi. Disetujui.',
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