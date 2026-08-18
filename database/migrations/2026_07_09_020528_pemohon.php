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
            $table->string('nama_lengkap');

            $table->enum('jenis_identitas', ['ktp', 'ktm', 'passport', 'sim']);
            $table->string('nomor_identitas', 16)->unique();

            $table->string('no_hp', 13);
            $table->string('email')->unique();
            $table->string('kewarganegaraan');
            $table->date('tanggal_lahir');
            $table->string('provinsi');
            $table->string('kota_kabupaten');
            $table->string('kecamatan');
            $table->string('kelurahan_desa');
            $table->text('alamat');
            $table->string('path_identitas');

            // verif
            $table->enum('status_verifikasi', [
                'pending',
                'terverifikasi',
                'revisi'
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