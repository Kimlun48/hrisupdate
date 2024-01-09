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
        Schema::create('param_cabangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kar');
            $table->foreign('id_kar')->references('id')->on('karyawans');
            $table->unsignedBigInteger('id_cabang');
            $table->foreign('id_cabang')->references('id')->on('cabangs');
            $table->string('status');
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
        Schema::dropIfExists('param_cabangs');
    }
};
