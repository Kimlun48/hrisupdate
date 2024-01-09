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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nomor_induk_karyawan');
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->string('no_identitas'); 
            #$table->string('fk_tempat_lahir'); //choice ke tabel kota/kab
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('agama');
            $table->string('gender');
            $table->string('status_pernikahan');
            $table->string('jenis_identitas'); 
            $table->string('masa_berlaku_identitas');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kodepos');
            $table->string('status_rumah');
            $table->string('no_hp');
            $table->string('no_telp');
            $table->string('photo');
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
            $table->string('jenis_karyawan'); //tetap, kontrak, probation hardcore
            //choice ke tabel (pt Ari, spbu, rkm, abm, ld)
            $table->unsignedBigInteger('fk_nama_perusahaan');
            $table->foreign('fk_nama_perusahaan')->references('id')->on('perusahaans');
            $table->string('tahun_gabung');
            $table->string('tahun_keluar');
            $table->unsignedBigInteger('fk_user');
            $table->foreign('fk_user')->references('id')->on('users');
            $table->integer('upah');
            #tambahan
            $table->string('expired_kontrak');
            $table->date('expired_kontrak_baru');
            $table->date('tanggal_pengangkatan');
            $table->string('masa_kerja');
            $table->string('alamat_domisili');
            $table->string('ptpk_status');
            $table->string('pendidikan_terakhir');
            $table->string('grade');
            $table->string('nama_institusi');
            $table->string('jurusan');
            $table->string('tahun_masuk_pendidikan');
            $table->string('tahun_lulus');
            $table->string('gpa');
            $table->string('email');
            $table->string('kontak_darurat');
            $table->string('medsos');
            $table->string('NPWP');
            $table->string('golongan_darah');
            $table->string('no_rek1');
            $table->string('bank1');
            $table->string('no_rek2');
            $table->string('bank2');
            $table->string('nama_ibu_kandung');
            $table->string('bpjs_kesehatan');
            $table->string('keterangan_bpjs');
            $table->string('no_bpjs_kesehatan');
            $table->string('bpjs_tenaga_kerja');
            $table->string('keterangan_bpjs_tenaga_kerja');
            $table->string('no_bpjs_tenaga_kerja');
            $table->string('jamkes_lainnya');
            $table->string('no_ijazah');
            $table->string('instansi_ijazah');
	        $table->string('no_finger');

	        $table->string('brand');
            $table->string('vendor');
            $table->string('keterangan');

            $table->unsignedBigInteger('fk_jenis_kar');
            $table->foreign('fk_jenis_kar')->references('id')->on('param_jenis_karyawans');

            $table->unsignedBigInteger('fk_user_update');
            $table->foreign('fk_user_update')->references('id')->on('users');
            $table->string('menu_akses_update');
            $table->string('approval_via'); //PIC OR JABATAN
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
};
