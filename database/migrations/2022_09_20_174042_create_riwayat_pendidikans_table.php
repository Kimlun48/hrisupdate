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
        Schema::create('riwayat_pendidikans', function (Blueprint $table) {
            $table->id();
	    $table->string('pendidikan');
            $table->string('institusi');
            $table->string('jurusan');
            $table->string('tempat');
            $table->string('tahun_masuk');
            $table->string('tahun_keluar');
            $table->string('keterangan');
            $table->string('nilai');
            $table->unsignedBigInteger('fk_pelamar');
            $table->foreign('fk_pelamar')->references('id')->on('pelamars');
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
        Schema::dropIfExists('riwayat_pendidikans');
    }
};
