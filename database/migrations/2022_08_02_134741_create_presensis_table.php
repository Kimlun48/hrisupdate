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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
	        $table->timestamps();
            $table->date('tanggal');
            $table->dateTime('jam_masuk');
            $table->dateTime('jam_pulang');
            $table->string('image_masuk');
            $table->string('image_pulang');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('latitude_pulang');
            $table->string('longitude_pulang');
	        $table->string('keterangan'); //cuti,absen keluar,pulang cepat,masuk siang dll
            $table->string('presensi_status'); //Ontime,Late,cuti,off,
            $table->string('presensi_status_pulang');
            $table->unsignedBigInteger('id_karyawan');
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');            
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->time('istirahat_keluar')->nullable();
            $table->time('istirahat_masuk')->nullable();
            $table->unsignedBigInteger('fk_overtime');
            $table->foreign('fk_overtime')->references('id')->on('over_times')->onDelete('cascade');
            $table->string('presensi_status_pulang');

            $table->unsignedBigInteger('fk_timeoff');
            $table->foreign('fk_timeoff')->references('id')->on('time_offs')->onDelete('cascade');

            $table->unsignedBigInteger('user_update');
            $table->foreign('user_update')->references('id')->on('users')->onDelete('cascade');
            $table->string('menu_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensis');
    }
};
