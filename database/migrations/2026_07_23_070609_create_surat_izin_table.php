<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_izin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonan')->onDelete('cascade');

            $table->string('nomor_surat')->unique()->nullable();

            $table->string('file_path')->nullable();

            $table->enum('status_tte_kesbangpol', ['pending', 'proses', 'selesai', 'gagal'])->default('pending');
            $table->enum('status_tte_brida', ['pending', 'proses', 'selesai', 'gagal'])->default('pending');

            // Data Tambahan TTE (Jika sistemmu membuat QR Code mandiri sebelum dikirim ke BSrE)
            $table->text('qr_code_link')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_izin');
    }
};