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
        Schema::create('pemohon', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('nik', 16)->unique();
            $table->string('no_hp', 20);
            $table->string('kewarganegaraan');
            $table->string('instansi');
            $table->string('nim_nip')->nullable();

            $table->string('provinsi');
            $table->string('kota_kabupaten');
            $table->string('kecamatan');
            $table->string('kelurahan_desa');
            $table->text('alamat');
            $table->string('identitas');

            // verif
            $table->enum('status_verifikasi', [
                'pending',
                'terverifikasi',
                'revisi',
                'ditolak'
            ])->default('pending');
            $table->text('catatan_verifikasi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemohon');
    }
};