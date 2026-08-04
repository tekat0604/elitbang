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
        Schema::create('laporan_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonan')->onDelete('cascade');
            $table->string('file_laporan');
            $table->dateTime('tanggal_upload');

            // Status verifikasi laporan oleh BRIDA
            $table->enum('status_laporan', [
                'pending',
                'revisi',
                'disetujui'
            ])->default('pending');

            $table->text('catatan_revisi')->nullable();
            $table->string('file_surat_selesai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_akhir');
    }
};