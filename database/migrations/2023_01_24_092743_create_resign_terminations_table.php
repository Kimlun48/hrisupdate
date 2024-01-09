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
        Schema::create('resign_terminations', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_akhirkerja');
            $table->string('status'); ##RESIGN/PHK
            $table->string('dokumen')->nullable();

            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
            $table->string('status_approve')->nullable();
            $table->date('tanggal_approve')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('resign_terminations');
    }
};

