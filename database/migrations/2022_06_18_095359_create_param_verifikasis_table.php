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
        Schema::create('param_verifikasis', function (Blueprint $table) {
            $table->id();
	    $table->timestamps();
            $table->integer('level');
            $table->string('status_aktif');
	    $table->string('progres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('param_verifikasis');
    }
};
