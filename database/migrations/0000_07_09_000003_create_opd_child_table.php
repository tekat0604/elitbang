<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('opd_child', function (Blueprint $table) {
            $table->id();
            $table->string('nama');

            $table->foreignId('id_opd')->constrained('opd')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('kategori_opd')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opd_child');
    }
};