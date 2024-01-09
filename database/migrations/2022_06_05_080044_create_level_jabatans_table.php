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
        Schema::create('level_jabatans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('kode');
            $table->string('status');
            $table->integer('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('level_jabatans')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('param_level')->nullable();
            $table->foreign('param_level')->references('id')->on('par_level_jabatans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_jabatans');
    }
};
