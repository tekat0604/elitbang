<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        Schema::create('opd', function (Blueprint $table) {
            $table->id();
            $table->string('nama_opd');

            $table->foreignId('id_kategori')->constrained('kategori_opd')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opd');
    }
};