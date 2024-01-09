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
        Schema::create('param_time_offs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('nama');
            $table->string('kode');
            $table->integer('durasi');
            $table->date('efektif_date');
            $table->date('expire_date')->nullable();
            $table->string('status');
            $table->string('dokumen');
            $table->string('kuota');
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
        Schema::dropIfExists('param_time_offs');
    }
};
