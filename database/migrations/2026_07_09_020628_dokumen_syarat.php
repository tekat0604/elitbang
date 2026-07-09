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
        Schema::create('dokumen_syarat', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel permohonan
            $table->foreignId('permohonan_id')->constrained('permohonan')->onDelete('cascade');

            // Jenis dokumen (misal: "Proposal", "Surat Pengantar")
            $table->enum('jenis_dokumen');

            // Link Google Drive
            $table->text('tautan_dokumen');

            // Status verifikasi khusus dokumen ini
            $table->enum('status_validasi', [
                'pending',
                'valid',
                'tidak_valid'
            ])->default('pending');

            $table->text('catatan_revisi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_syarat');
    }
};