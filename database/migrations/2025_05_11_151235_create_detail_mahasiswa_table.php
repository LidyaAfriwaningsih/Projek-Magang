<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id'); // Kolom untuk relasi ke pengajuan
            $table->string('nama');
            $table->string('nim');
            $table->string('program_studi');
            $table->timestamps();

            // Menambahkan foreign key untuk kolom pengajuan_id
            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_mahasiswa');
    }
}