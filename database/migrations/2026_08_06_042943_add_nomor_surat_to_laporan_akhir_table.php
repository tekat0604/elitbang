<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporan_akhir', function (Blueprint $table) {
            // Menambahkan kolom nomor_surat setelah kolom permohonan_id
            $table->string('nomor_surat')->nullable()->after('permohonan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_akhir', function (Blueprint $table) {
            // Menghapus kolom jika kita melakukan rollback
            $table->dropColumn('nomor_surat');
        });
    }
};