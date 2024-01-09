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
        Schema::create('dokumen_karyawans', function (Blueprint $table) {
		$table->id();
        $table->unsignedBigInteger('id_kar');
        $table->foreign('id_kar')->references('id')->on('karyawans')->onDelete('cascade');
        $table->string('nama');
        $table->string('tipe_dok');
        $table->string('nomor_dok');
        $table->date('tanggal');
        $table->string('lokasi_penyimpanan')->nullable();
        $table->string('dok_file');
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
        Schema::dropIfExists('dokumen_karyawans');
    }
};
