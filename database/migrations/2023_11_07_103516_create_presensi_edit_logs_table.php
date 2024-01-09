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
        Schema::create('presensi_edit_logs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->dateTime('jam_masuk')->nullable();
            $table->dateTime('jam_pulang')->nullable();
            $table->string('image_masuk')->nullable();
            $table->string('image_pulang')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude_pulang')->nullable();
            $table->string('longitude_pulang')->nullable();
	        $table->string('keterangan')->nullable(); //cuti,absen keluar,pulang cepat,masuk siang dll
            $table->string('presensi_status')->nullable(); //Ontime,Late,cuti,off,
            $table->string('presensi_status_pulang')->nullable();
            $table->string('id_karyawan')->nullable();           
            $table->string('id_user')->nullable();
            $table->time('istirahat_keluar')->nullable()->nullable();
            $table->time('istirahat_masuk')->nullable()->nullable();
            $table->string('fk_overtime')->nullable();          
            $table->string('fk_timeoff')->nullable();
            $table->string('user_update')->nullable();
            $table->string('menu_update')->nullable();
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
        Schema::dropIfExists('presensi_edit_logs');
    }
};
