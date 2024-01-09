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
        Schema::create('cuti_karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kar');
            $table->foreign('id_kar')->references('id')->on('karyawans');
            $table->date('mulai_cuti');
            $table->date('akhir_cuti');
            $table->integer('jumlah_cuti');
            $table->integer('sisa_cuti');
            $table->integer('tahun');
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
        Schema::dropIfExists('cuti_karyawans');
    }
};
