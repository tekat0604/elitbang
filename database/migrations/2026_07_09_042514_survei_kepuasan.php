<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('survei_kepuasan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('permohonan_id')->constrained('permohonan')->onDelete('cascade');

            $table->string('keterangan')->default('Telah mengonfirmasi pengisian survei eksternal (Kesbangpol & BRIDA)');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('survei_kepuasan');
    }
};