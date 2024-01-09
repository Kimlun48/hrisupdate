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
        Schema::create('karyawan_transfers', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->date('tgl_transfer');
            $table->unsignedBigInteger('id_karyawan');
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
            $table->string('type'); ##Rotasi, Mutasi, Promosi, Demosi, extencontract
            $table->string('status_karyawan')->nullable(); //tetap, kontrak, probation,PHK,Resign hardcore
            $table->unsignedBigInteger('fk_cabang')->nullable();
            $table->foreign('fk_cabang')->references('id')->on('cabangs')->nullable();
            $table->unsignedBigInteger('fk_bagian');
            $table->foreign('fk_bagian')->references('id')->on('bagians')->nullable();
    	    $table->unsignedBigInteger('fk_level_jabatan');  //choice ke tabel (staff, spv, manager, direktur dll)
            $table->foreign('fk_level_jabatan')->references('id')->on('level_jabatans')->nullable();
            $table->unsignedBigInteger('fk_nama_perusahaan');
            $table->foreign('fk_nama_perusahaan')->references('id')->on('perusahaans')->nullable();

            ###FIELD TAMBAHAN Belum Di migrate
            $table->string('status_karyawan_lama')->nullable(); //tetap, kontrak, probation,PHK,Resign hardcore

            $table->unsignedBigInteger('fk_cabang_lama')->nullable();
            $table->foreign('fk_cabang_lama')->references('id')->on('cabangs')->nullable();

            $table->unsignedBigInteger('fk_bagian_lama');
            $table->foreign('fk_bagian_lama')->references('id')->on('bagians')->nullable();

    	    $table->unsignedBigInteger('fk_level_jabatan_lama');  //choice ke tabel (staff, spv, manager, direktur dll)
            $table->foreign('fk_level_jabatan_lama')->references('id')->on('level_jabatans')->nullable();

            $table->unsignedBigInteger('fk_nama_perusahaan_lama');
            $table->foreign('fk_level_jabatan_lama')->references('id')->on('perusahaans')->nullable();

            $table->string('status_approval')->nullable(); //Approve, Canceled
            $table->date('signdate'); ##untuk Mulai Dari Tanggal berapa jadi status karyawan permanen
            $table->date('untildate');  ##untuk Hingga Tanggal berapa jadi status karyawan kontrak / probationnya
            ###AKHIR FIELD TAMBAHAN
            $table->string('keterangan')->nullable(); 
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
        Schema::dropIfExists('karyawan_transfers');
    }
};

