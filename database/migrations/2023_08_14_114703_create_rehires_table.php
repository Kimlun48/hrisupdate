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
        Schema::create('rehires', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_induk_karyawan');
            $table->string('jenis_karyawan'); 
            $table->string('tahun_gabung_lama');
            $table->string('tahun_keluar_lama');
            $table->integer('upah');
            $table->string('masa_kerja');
            $table->string('ptpk_status');
            $table->string('email');
            $table->date('tanggal_pengangkatan');
            $table->string('status'); //Rehire
            $table->date('tanggal_rehire');
            $table->date('tanggal_effektif');
            //History Id Karyawans Lamanya
            $table->unsignedBigInteger('id_kar');
            $table->foreign('id_kar')->references('id')->on('karyawans');
            //choice ke tabel cabang (ayani, rancaekek dll)
            $table->unsignedBigInteger('fk_cabang');
            $table->foreign('fk_cabang')->references('id')->on('cabangs');
            // choice ke tabel (supporting, dll)
            $table->unsignedBigInteger('fk_bagian');
            $table->foreign('fk_bagian')->references('id')->on('bagians');
            //choice ke tabel (staff, spv, manager, direktur dll)
            $table->unsignedBigInteger('fk_level_jabatan');
            $table->foreign('fk_level_jabatan')->references('id')->on('level_jabatans');
            $table->string('status_karyawan'); //tetap, kontrak, probation hardcore
            $table->unsignedBigInteger('fk_nama_perusahaan');
            $table->foreign('fk_nama_perusahaan')->references('id')->on('perusahaans');
            $table->unsignedBigInteger('fk_user');
            $table->foreign('fk_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_resign');
            $table->foreign('id_resign')->references('id')->on('resign_terminations');
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
        Schema::dropIfExists('rehires');
    }
};
