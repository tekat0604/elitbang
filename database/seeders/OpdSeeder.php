<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OpdSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Data Master: Kategori -> OPD Induk (Tembusan) -> OPD Child (Lokasi Asli)
        $dataMaster = [
            'Kesehatan' => [
                'Dinas Kesehatan Kota Surakarta' => [
                    'Puskesmas Ngoresan',
                    'Puskesmas Jebres',
                    'RSUD Bung Karno',
                ]
            ],
            'Pemerintahan' => [
                'Kecamatan Jebres' => [
                    'Kelurahan Jebres',
                    'Kelurahan Mojosongo',
                    'Kelurahan Pucangsawit'
                ],
                'Kecamatan Banjarsari' => [
                    'Kelurahan Banyuanyar',
                    'Kelurahan Kadipiro'
                ]
            ],
            'Kependudukan' => [
                'Disdukcapil Kota Surakarta' => [
                    'UPTD Pelayanan Adminduk Jebres',
                    'UPTD Pelayanan Adminduk Laweyan'
                ]
            ],
            'Sosial' => [
                'Dinas Sosial Kota Surakarta' => [
                    'UPTD Perlindungan Perempuan dan Anak',
                    'UPTD Panti Pelayanan Sosial'
                ]
            ],
            'Lingkungan Hidup' => [
                'Dinas Lingkungan Hidup Kota Surakarta' => [
                    'UPTD TPA Putri Cempo',
                    'UPTD Laboratorium Lingkungan'
                ]
            ],
            'Ekonomi' => [
                'Dinas Koperasi, UKM dan Perindustrian' => [
                    'UPTD Pusat Layanan Usaha Terpadu (PLUT)'
                ]
            ],
        ];

        // Kosongkan tabel sebelum diisi agar tidak duplikat jika dijalankan berkali-kali
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('opd_child')->truncate();
        DB::table('opd')->truncate();
        DB::table('kategori_opd')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Proses Looping untuk memasukkan data ke 3 tabel yang saling berelasi
        foreach ($dataMaster as $namaKategori => $daftarOpd) {

            // 1. Insert ke tabel kategori_opd
            $idKategori = DB::table('kategori_opd')->insertGetId([
                'kategori' => $namaKategori,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($daftarOpd as $namaOpdInduk => $daftarChild) {

                // 2. Insert ke tabel opd (Instansi Induk)
                $idOpdInduk = DB::table('opd')->insertGetId([
                    'nama_opd' => $namaOpdInduk,
                    'id_kategori' => $idKategori,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // 3. Insert ke tabel opd_child (Anak Instansi)
                foreach ($daftarChild as $namaChild) {
                    DB::table('opd_child')->insert([
                        'nama' => $namaChild,
                        'id_opd' => $idOpdInduk,
                        'id_kategori' => $idKategori,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}