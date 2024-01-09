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
        Schema::create('param_presensis', function (Blueprint $table) {
            $table->id();
	        $table->timestamps();
            $table->string('jenis_karyawan');
            $table->unsignedBigInteger('fk_cabang')->nullable();
            $table->foreign('fk_cabang')->references('id')->on('cabangs');
            $table->unsignedBigInteger('fk_level_jabatan')->nullable();
	        $table->foreign('fk_level_jabatan')->references('id')->on('level_jabatans');
	        $table->time('awal_absen_masuk');
	        $table->time('jam_masuk');
	        $table->time('maks_telat');
            $table->time('jam_pulang');
            $table->string('latitude');
            $table->string('longitude');
	        $table->string('status');
            $table->string('jenis_shift');	    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('param_presensis');
    }
};
