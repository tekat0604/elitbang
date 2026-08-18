<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PejabatInstansi;

class PejabatInstansiSeeder extends Seeder
{
    public function run()
    {
        PejabatInstansi::create([
            'instansi' => 'kesbangpol',
            'nama_kepala_instansi' => 'Nama Kepala Kesbangpol',
            'nip' => '000000000000000000',
        ]);

        PejabatInstansi::create([
            'instansi' => 'brida',
            'nama_kepala_instansi' => 'Nama Kepala Brida',
            'nip' => '111111111111111111',
        ]);
    }
}
