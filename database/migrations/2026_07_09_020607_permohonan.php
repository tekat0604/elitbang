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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pemohon_id')->constrained('pemohon')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanan')->onDelete('cascade');

            $table->string('judul');
            $table->foreignId('id_opd_child')->constrained('opd_child')->onDelete('cascade');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('jenjang_pendidikan');

            $table->string('fakultas')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('nim')->nullable();

            $table->string('bidang_penelitian');
            $table->string('rumpun_penelitian');

            $table->enum('jenis_pengajuan', ['personal', 'kelompok'])->default('personal');
            $table->integer('jumlah_anggota')->default(1);

            $table->string('nama_instansi')->nullable();
            $table->text('alamat_instansi')->nullable();

            $table->string('link_pengantar_kampus')->nullable();
            $table->string('link_proposal')->nullable();

            // status
            $table->enum('status_permohonan', [
                'diajukan',
                'proses_verifikasi',
                'disetujui',
                'ditolak'
            ])->default('diajukan');

            // verif
            // Kesbangpol
            $table->enum('status_kesbangpol', ['pending', 'revisi', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan_kesbangpol')->nullable();

            // BRIDA
            $table->enum('status_brida', ['pending', 'revisi', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan_brida')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};