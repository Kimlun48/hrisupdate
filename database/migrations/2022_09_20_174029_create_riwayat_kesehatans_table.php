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
        Schema::create('riwayat_kesehatans', function (Blueprint $table) {
            $table->id();
	    $table->string('type_penyakit');
            $table->string('nama_penyakit');
            $table->string('penyembuhan');
            $table->string('tahun_kejadian');
            $table->string('akibat');
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
        Schema::dropIfExists('riwayat_kesehatans');
    }
};
