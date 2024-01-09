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
        Schema::create('member_ships', function (Blueprint $table) {
            $table->id();
            $table->string('loyaltycode');
            $table->string('nama');
            $table->string('loyaltykategori');
            $table->string('gender');
            $table->string('idtype');
            $table->string('idnum');
            $table->string('pendididkan');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('kodepos');
            $table->string('email');
            $table->string('job');
            $table->string('tempatlahir');
            $table->date('tgllahir');
            $table->string('agama');
            $table->string('statusnikah');
            $table->boolean('statusaktif');
	    $table->string('loyaltypotensi');
	    $table->string('notelp');
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
        Schema::dropIfExists('member_ships');
    }
};

