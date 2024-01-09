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
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('kode');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('no_telp');
            $table->unsignedBigInteger('fk_nama_perusahaan');
            $table->foreign('fk_nama_perusahaan')->references('id')->on('perusahaans');
            $table->string('dokumen');
	    $table->string('status');
	    $table->string('latitude');
            $table->string('longitude');
            $table->string('radius');
            $table->string('satuan_radius');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabangs');
    }
};
