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
        Schema::create('time_offs', function (Blueprint $table) {
            $table->id();
	        $table->date('tanggal');
            $table->string('statusoff');
            $table->string('dokumen')->nullable();
            $table->string('status_approve');
            $table->unsignedBigInteger('id_karyawan');
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade');
            $table->date('tanggal_approve');
            $table->string('notes');
            $table->string('notes_aju');

            $table->unsignedBigInteger('fk_param');
            $table->foreign('fk_param')->references('id')->on('ParamTimeOff')->onDelete('cascade');
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
        Schema::dropIfExists('time_offs');
    }
};
