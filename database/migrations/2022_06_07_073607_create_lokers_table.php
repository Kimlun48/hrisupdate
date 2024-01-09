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
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posisi_id');
	    	$table->foreign('posisi_id')->references('id')->on('posisijobs');	    
            $table->text('deskripsi')->nullable();
            $table->text('kualifikasi')->nullable();
            $table->string('status');
	        $table->date('tanggal');
            $table->unsignedBigInteger('fk_penempatan');
            $table->foreign('fk_penempatan')->references('id')->on('cabangs');
            $table->string('lowongan_kerja');
            $table->string('dok_header');
            $table->string('dok_poster');
            $table->string('pendidikan');
            $table->string('pengalaman');
            $table->string('level_job');
            $table->string('kategory_job');
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
        Schema::dropIfExists('lokers');
    }
};
