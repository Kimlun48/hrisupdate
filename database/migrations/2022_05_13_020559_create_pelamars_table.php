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
        Schema::create('pelamars', function (Blueprint $table) {
	    $table->id();
	    $table->string('nama_lengkap');
	    $table->string('nik');
	    $table->string('no_hp');
	    $table->string('no_telp');
	    $table->date('tgl_lahir');
	    $table->string('agama');
	    $table->string('photo');
	    $table->string('gender');
	    $table->string('tempat_lahir');
	    $table->string('status_pernikahan');
	    $table->string('cv');
	    $table->string('alamat');
	    $table->string('rt');
	    $table->string('rw');
  	    $table->string('desa');
	    $table->string('kecamatan');
	    $table->string('kota');
	    $table->string('provinsi');
	    $table->string('kodepos');
	    $table->string('status_rumah');
	    $table->string('pendidikan_terakhir');
	    $table->string('nama_sekolah');
	    $table->string('jurusan');
	    $table->string('tahun_masuk');
	    $table->string('tahun_lulus');		
	    $table->string('ipk');		
            $table->string('hubungan_keluarga');	
            $table->timestamps();
            $table->unsignedBigInteger('fk_user');
	    $table->foreign('fk_user')->references('id')->on('users')->onDelete('cascade');
	    $table->string('sosial_media');
            $table->string('referensi_job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelamars');
    }
};
