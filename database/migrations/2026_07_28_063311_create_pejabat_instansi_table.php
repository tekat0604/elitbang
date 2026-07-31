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
        Schema::create('pejabat_instansi', function (Blueprint $table) {
            $table->id();
            $table->string('instansi')->unique();
            $table->string('nama_kepala_instansi');
            $table->string('nip');
            $table->timestamps();
            $table->string('file_ttd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabat_instansi');
    }
};
