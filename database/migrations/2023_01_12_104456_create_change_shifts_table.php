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
        Schema::create('change_shifts', function (Blueprint $table) {
	  $table->id();
          $table->string('shift_awal');
          $table->date('tanggal_awal');
          $table->string('shift_akhir');
          $table->date('tanggal_akhir');
          $table->unsignedBigInteger('id_karyawan');
          $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
          $table->string('keterangan');
          $table->string('status_approve');
          $table->date('tanggal_approve')->nullable();
          $table->date('tanggal_off')->nullable();
          $table->string('shift_off')->nullable();
          $table->string('notes')->nullable();
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
        Schema::dropIfExists('change_shifts');
    }
};
