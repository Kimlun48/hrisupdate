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
        Schema::create('param_componens', function (Blueprint $table) {
            $table->id();
	    $table->string('nama'); ##Nama Tunjangan
	    $table->string('komponen'); ##Allowances/Deductions/Benefits
	    $table->string('jenis'); ##Penambah/Pengurang
            $table->string('status_tunjangan'); # Tunjangan Monthly, Daily, One Time
            $table->string('status_aktif'); # Status AKtif
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
        Schema::dropIfExists('param_componens');
    }
};
