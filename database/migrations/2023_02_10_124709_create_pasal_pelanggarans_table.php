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
        Schema::create('pasal_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->string('pasal')->nullable();
            $table->string('ayat')->nullable();
            $table->string('isiayat')->nullable();
            $table->string('status')->nullable(); #aktif, nonaktif
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
        Schema::dropIfExists('pasal_pelanggarans');
    }
};

