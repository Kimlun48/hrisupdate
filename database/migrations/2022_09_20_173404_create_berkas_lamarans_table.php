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
        Schema::create('berkas_lamarans', function (Blueprint $table) {
            $table->id();
	        $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pelamar_id');
            $table->foreign('pelamar_id')->references('id')->on('pelamars');
            $table->date('tanggal');
            $table->string('cv');
            $table->string('lamaran');
            $table->string('photo');
            $table->string('skck');
            $table->string('kk');
            $table->string('npwp');
            $table->string('paklaring');
            $table->string('sim');
            $table->string('sio');
            $table->string('sertipikat');
            $table->string('ijazah');
            $table->string('transkrip_nilai');
            $table->string('ktp');
            $table->string('vaksin');
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
        Schema::dropIfExists('berkas_lamarans');
    }
};
