<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();

            // Relasi ke user (mahasiswa pengaju)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Kelompok ID (untuk pengajuan berkelompok)
            $table->string('kelompok_id')->nullable();

            // Informasi pengajuan
            $table->string('jenis'); // magang / penelitian
            $table->string('status');
            $table->string('nama');
            $table->string('nim')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('instansi_tujuan')->nullable();
            $table->string('judul_penelitian')->nullable();

            // Surat dan dokumen
            $table->string('surat_dari')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('file_ktp');
            $table->string('file_surat_dari');

            // Jadwal kegiatan
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            // Data tambahan (jika bukan mahasiswa)
            $table->string('nomor_identitas')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();

            // Hal surat
            $table->string('hal_surat')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
