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
        Schema::create('over_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kar');
            $table->foreign('id_kar')->references('id')->on('karyawans');
            $table->date('tanggal');
            $table->date('tanggal_overtime');
            $table->date('tgl_approve');
            $table->time('mulai');#->nullable() //awal  jam lemburnya
            $table->time('akhir');#->nullable() //Akhir berapa jam lemburnya
            $table->time('durasi');#->nullable() //berapa Lama jam lemburnya 
            $table->string('status_approve')->nullable(); #Approve,Reject
            $table->unsignedBigInteger('user_approve');
            $table->foreign('user_approve')->references('id')->on('users');
            $table->string('kompensasi'); //dibayar ( Paid Overtime )/ diganti Libur ( Overtime leave )
            $table->string('note')->nullable(); //Catatan
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
        Schema::dropIfExists('over_times');
    }
};
