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
        Schema::create('penawaran_kerjas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            //$table->string('jabatan');
            //$table->string('bagian');
            //$table->string('cabang');
            $table->integer('upah');
            $table->string('keterangan');
            $table->string('status_kerja');
            $table->string('tanggal_masuk');
            $table->string('lain_lain');
            $table->unsignedBigInteger('fk_apllyloker');
            $table->foreign('fk_apllyloker')->references('id')->on('apllylokers')->onDelete('cascade');
            $table->unsignedBigInteger('fk_bagian');
            $table->foreign('fk_bagian')->references('id')->on('posisijobs')->onDelete('cascade');            
	        $table->unsignedBigInteger('fk_cabang');
            $table->foreign('fk_cabang')->references('id')->on('cabangs');
            $table->unsignedBigInteger('fk_level_jabatan');
            $table->foreign('fk_level_jabatan')->references('id')->on('level_jabatans');            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penawaran_kerjas');
    }
};
