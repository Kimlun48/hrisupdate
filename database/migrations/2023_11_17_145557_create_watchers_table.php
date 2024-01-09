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
        Schema::create('watchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_watcher');
            $table->foreign('id_watcher')->references('id')->on('karyawans')->onDelete('cascade');
            $table->unsignedBigInteger('id_sp');
            $table->foreign('id_sp')->references('id')->on('peringatans')->onDelete('cascade');           
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
        Schema::dropIfExists('watchers');
    }
};
