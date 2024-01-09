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
        Schema::create('riwayat_kerjas', function (Blueprint $table) {
            $table->id();
	    $table->string('perusahaan');
            $table->string('posisi');
            $table->string('alamat');
            $table->string('tanggal_masuk');
            $table->string('tanggal_keluar');
            $table->string('keterangan');
            $table->unsignedBigInteger('fk_pelamar');
            $table->foreign('fk_pelamar')->references('id')->on('pelamars');
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
        Schema::dropIfExists('riwayat_kerjas');
    }
};
