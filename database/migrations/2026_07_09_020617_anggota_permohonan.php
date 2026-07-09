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
        Schema::create('anggota_permohonan', function (Blueprint $table) {
            $table->id();

            // Mengikat anggota ke satu ID permohonan spesifik
            $table->foreignId('permohonan_id')->constrained('permohonan')->onDelete('cascade');

            $table->string('nama_anggota');
            $table->string('nik_nim');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_permohonan');
    }
};