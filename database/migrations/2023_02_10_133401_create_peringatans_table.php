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
        Schema::create('peringatans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->unsignedBigInteger('id_karyawan');
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
            $table->unsignedBigInteger('user_aju_id');
            $table->foreign('user_aju_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pasal_id');
            $table->foreign('pasal_id')->references('id')->on('pasal_pelanggarans')->onDelete('cascade');
            $table->string('jenis_peringatan'); # Teguran1,Teguran2,Teguran3,SP1,SP2,SP3,skorsing
            $table->string('status_approve')->nullable(); #Approve,Reject
            $table->date('tanggal_approve')->nullable();
            $table->unsignedBigInteger('user_approve_id')->nullable();
	    $table->foreign('user_approve_id')->references('id')->on('users')->onDelete('cascade')->nullable();
	    $table->string('note')->nullable();
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
        Schema::dropIfExists('peringatans');
    }
};

