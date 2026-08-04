<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Kosongkan tabel sebelum diisi agar tidak duplikat (opsional tapi disarankan)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('layanan')->truncate();
        DB::table('alur_layanan')->truncate();
        DB::table('settings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ==========================================
        // 1. DATA LAYANAN
        // ==========================================
        $layananData = [
            [
                'nama_layanan' => 'Izin Penelitian',
                'slug_layanan' => 'izin-penelitian',
                'logo' => 'penelitian_logo.png',
                'deskripsi' => 'Pelayanan izin penelitian untuk mahasiswa, instansi, dan umum.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_layanan' => 'Izin KKN',
                'slug_layanan' => 'izin-kkn',
                'logo' => 'kkn_logo.png',
                'deskripsi' => 'Pelayanan izin Kuliah Kerja Nyata (KKN) bagi mahasiswa.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_layanan' => 'Izin Permohonan Data',
                'slug_layanan' => 'izin-permohonan-data',
                'logo' => 'permohonan_data_logo.png',
                'deskripsi' => 'Pelayanan permohonan permintaan data sektoral atau daerah.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_layanan' => 'Izin Survey',
                'slug_layanan' => 'izin-survey',
                'logo' => 'survey_logo.png',
                'deskripsi' => 'Pelayanan izin pelaksanaan survey lapangan atau observasi.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_layanan' => 'Izin Wawancara',
                'slug_layanan' => 'izin-wawancara',
                'logo' => 'wawancara_logo.png',
                'deskripsi' => 'Pelayanan izin pengambilan data melalui wawancara narasumber.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_layanan' => 'Izin Pengabdian Masyarakat',
                'slug_layanan' => 'izin-pengabdian-masyarakat',
                'logo' => 'pengabdian_masyarakat_logo.png',
                'deskripsi' => 'Pelayanan izin program pengabdian masyarakat (Abdimas).',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('layanan')->insert($layananData);

        // ==========================================
        // 2. DATA ALUR LAYANAN
        // ==========================================
        DB::table('alur_layanan')->insert([
            'id' => 1,
            'gambar_alur' => 'alur_layanan.jpeg', // Cek apakah nama kolomnya benar 'gambar'
            'deskripsi' => '<p class="mb-0">Dasar Hukum :
    Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 07 Tahun 2014 tentang Perubahan atas Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 64 Tahun 2011 tentang Pedoman Penerbitan Rekomendasi Penelitian.</p><br>
<p class="mb-0">Surat Edaran Kepala Badan Kesatuan Bangsa dan Perlindungan Masyarakat Provinsi Jawa Tengah Nomor 070/265 Perihal Penyederhanaan Prosedur Permohonan Riset, KKN, PKL di Jawa Tengah.</p><br>
<p class="mb-0">Syarat-syarat yang harus dipenuhi:</p>
<ul class="mb-0">
    <li>Fotokopi identitas (KTP/Kartu Pelajar/KTM/SIM/Kartu Pegawai)</li>
    <li>Proposal Penelitian</li>
    <li>Surat Pengantar Dari Instansi Pemohon Terkait Penelitian</li>
</ul>
<p class="mb-0">Prosedur untuk mendapatkan perizinan:</p>', // Cek apakah nama kolomnya benar 'deskripsi'
            'created_at' => '2026-07-02 14:46:12',
            'updated_at' => '2026-07-02 14:46:14',
        ]);

        // ==========================================
        // 3. DATA SETTINGS
        // ==========================================
        // PERHATIAN: Sesuaikan nama-nama kolom di bawah dengan struktur tabel settings kamu!
        DB::table('settings')->insert([
            'id' => 1,
            'title_nav' => 'Portal E-Litbang Kota Surakarta',
            'unit' => 'BRIDA Kota Surakarta',
            'name_apps' => 'E-Litbang',
            'deskripsi' => 'Layanan digital perizinan penelitian, KKN, survei, dan pengajuan inovasi daerah Kota Surakarta',
            'logo_page_login' => 'logo.png',
            'logo_branding' => 'logo.png',
            'primary_color' => '#eb1b2f',
            'secondary_color' => '#FFAB1D',
            'created_at' => '2026-07-01 10:16:07',
            'updated_at' => '2026-07-01 10:16:12',
        ]);
    }
}