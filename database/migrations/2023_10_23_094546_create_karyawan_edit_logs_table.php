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
        Schema::create('karyawan_edit_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nomor_induk_karyawan')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nama_panggilan')->nullable();
            $table->string('no_identitas')->nullable(); 
            $table->string('tempat_lahir')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('gender')->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->string('jenis_identitas')->nullable(); 
            $table->string('masa_berlaku_identitas')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kodepos')->nullable();
            $table->string('status_rumah')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('photo')->nullable();
            //choice ke tabel cabang (ayani, rancaekek dll)
            $table->unsignedBigInteger('fk_cabang');
            $table->foreign('fk_cabang')->references('id')->on('cabangs')->nullable();
            // choice ke tabel (supporting, dll)
            $table->unsignedBigInteger('fk_bagian')->nullable();
            $table->foreign('fk_bagian')->references('id')->on('bagians')->nullable();
            //choice ke tabel (staff, spv, manager, direktur dll)
    	    $table->unsignedBigInteger('fk_level_jabatan');
            $table->foreign('fk_level_jabatan')->references('id')->on('level_jabatans')->nullable();
            $table->string('status_karyawan')->nullable(); //tetap, kontrak, probation hardcore
            $table->string('jenis_karyawan')->nullable(); //tetap, kontrak, probation hardcore
            //choice ke tabel (pt Ari, spbu, rkm, abm, ld)
            $table->unsignedBigInteger('fk_nama_perusahaan');
            $table->foreign('fk_nama_perusahaan')->references('id')->on('perusahaans')->nullable();
            $table->string('tahun_gabung')->nullable();
            $table->string('tahun_keluar')->nullable();
            $table->unsignedBigInteger('fk_user');
            $table->foreign('fk_user')->references('id')->on('users')->nullable();
            $table->integer('upah')->nullable();
            #tambahan
            $table->string('expired_kontrak')->nullable();
            $table->date('expired_kontrak_baru')->nullable();
            $table->date('tanggal_pengangkatan')->nullable();
            $table->string('masa_kerja')->nullable();
            $table->string('alamat_domisili')->nullable();
            $table->string('ptpk_status')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('grade')->nullable();
            $table->string('nama_institusi')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('tahun_masuk_pendidikan')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('gpa')->nullable();
            $table->string('email')->nullable();
            $table->string('kontak_darurat')->nullable();
            $table->string('medsos')->nullable();
            $table->string('NPWP')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('no_rek1')->nullable();
            $table->string('bank1')->nullable();
            $table->string('no_rek2')->nullable();
            $table->string('bank2')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->string('keterangan_bpjs')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->string('bpjs_tenaga_kerja')->nullable();
            $table->string('keterangan_bpjs_tenaga_kerja')->nullable();
            $table->string('no_bpjs_tenaga_kerja')->nullable();
            $table->string('jamkes_lainnya')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->string('instansi_ijazah')->nullable();
	        $table->string('no_finger')->nullable();

	        $table->string('brand')->nullable();
            $table->string('vendor')->nullable();
            $table->string('keterangan')->nullable();

            $table->unsignedBigInteger('fk_jenis_kar');
            $table->foreign('fk_jenis_kar')->references('id')->on('param_jenis_karyawans')->nullable();
            $table->unsignedBigInteger('user_update');
            $table->foreign('user_update')->references('id')->on('users');
            $table->string('menu_akses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan_edit_logs');
    }
};
