<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
	    $table->string('anggota');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('usia');
            $table->string('urutan_anak');
            $table->unsignedBigInteger('fk_pelamar');
            $table->foreign('fk_pelamar')->references('id')->on('pelamars');
            $table->string('keterangan');
            $table->unsignedBigInteger('fk_karyawan')->nullable(); // kolom kunci asing
            $table->foreign('fk_karyawan')->references('id')->on('karyawans')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keluargas');
    }
};
