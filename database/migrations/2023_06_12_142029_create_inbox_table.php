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
        Schema::create('inbox', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengirim_id');
            $table->unsignedBigInteger('penerima_id');
            $table->string('title');
            $table->text('isi_pengirim');
            $table->text('isi_penerima');
            $table->string('status_atasan')->nullable();
            $table->string('status_bawahan')->nullable();
            $table->timestamps();
            $table->foreign('pengirim_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('penerima_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_time_offs')->nullable();
	        $table->foreign('id_time_offs')->references('id')->on('time_offs')->onDelete('cascade');
            $table->unsignedBigInteger('id_presensi_requests')->nullable();
	        $table->foreign('id_presensi_requests')->references('id')->on('presensi_requests')->onDelete('cascade');
            $table->unsignedBigInteger('id_change_shift')->nullable();
	        $table->foreign('id_change_shift')->references('id')->on('change_shifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbox');
    }
};
