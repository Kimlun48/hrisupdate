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
	    Schema::create('presensi_requests', function (Blueprint $table) {
	    $table->id();
            $table->date('tanggal');
            $table->time('jam');
            $table->string('jenis');
            $table->unsignedBigInteger('id_karyawan');
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');

            $table->string('status_approve')->nullable();
            $table->date('tanggal_approve')->nullable();
            $table->string('notes')->nullable();
            $table->unsignedBigInteger('user_approve_id')->nullable();
            $table->foreign('user_approve_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

            #$table->id();
            #$table->date('tanggal');
            #$table->time('jam_masuk');
            #$table->time('jam_pulang');
            #$table->unsignedBigInteger('id_karyawan');
            #$table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
            #$table->string('status_approve');
            #$table->date('tanggal_approve');
            #$table->string('notes');
            #$table->unsignedBigInteger('user_approve_id');
            #$table->foreign('user_approve_id')->references('id')->on('users')->onDelete('cascade');
            #$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensi_requests');
    }
};
