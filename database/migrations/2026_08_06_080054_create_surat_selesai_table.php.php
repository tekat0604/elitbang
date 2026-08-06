<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_selesai', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel laporan_akhir
            $table->foreignId('laporan_akhir_id')->constrained('laporan_akhir')->onDelete('cascade');

            $table->string('nomor_surat')->unique();
            $table->string('file_path')->nullable();
            $table->string('qr_code_link')->nullable()->unique();

            // Status TTE
            $table->enum('status_tte_brida', ['pending', 'selesai'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_selesai');
    }
};