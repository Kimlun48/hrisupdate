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
        Schema::create('apllylokers', function (Blueprint $table) {
  	    $table->id();
	    $table->date('tanggal');
        $table->unsignedBigInteger('loker_id');
	    $table->foreign('loker_id')->references('id')->on('lokers');
        $table->unsignedBigInteger('pelamar_id');
        $table->foreign('pelamar_id')->references('id')->on('pelamars');
        $table->timestamps();
        $table->string('progres');
        $table->string('status');
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apllylokers');
    }
};
