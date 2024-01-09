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
        Schema::create('pengajuan_absens', function (Blueprint $table) {
            $table->id();
	    $table->timestamps();
            $table->date('hari');
            $table->unsignedBigInteger('id_karyawan');
	    $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
	    $table->dateTime('jam_masuk');
            $table->dateTime('jam_pulang');
	    $table->string('keterangan');
	    $table->string('dokumen');
	    $table->string('approve'); #disetujui / tidak disetujui
	    $table->unsignedBigInteger('approval_user');
            $table->foreign('approval_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_absens');
    }
};
