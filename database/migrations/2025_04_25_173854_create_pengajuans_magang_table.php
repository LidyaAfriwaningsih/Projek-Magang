<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis'); // magang / penelitian
            $table->string('nama');
            $table->string('nim');
            $table->string('program_studi');
            $table->string('instansi_tujuan')->nullable();
            $table->string('judul_penelitian')->nullable(); // tambahkan ini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
