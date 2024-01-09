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
        Schema::create('sub_bagians', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
	    $table->string('kode');            
	    $table->unsignedBigInteger('fk_bagian');
	    $table->foreign('fk_bagian')->references('id')->on('bagians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_bagians');
    }
};
