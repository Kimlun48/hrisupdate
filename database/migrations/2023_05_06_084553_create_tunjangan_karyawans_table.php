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
        Schema::create('tunjangan_karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kar');
            $table->foreign('id_kar')->references('id')->on('karyawans');
            $table->unsignedBigInteger('id_param');
	    #$table->foreign('id_param')->references('id')->on('param_tunjangans');
	    $table->foreign('id_param')->references('id')->on('param_tunjangans')->onDelete('cascade || set null || null');
            $table->float('nilai');
            $table->string('periode');
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
        Schema::dropIfExists('tunjangan_karyawans');
    }
};

