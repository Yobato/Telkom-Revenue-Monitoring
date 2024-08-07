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
        //
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->string('kode_program');
            $table->string('role');
            $table->foreign('role')->references('nama_role')->on('role');
            $table->unsignedBigInteger('id_portofolio')->nullable();
            $table->foreign('id_portofolio')->references('id')->on('portofolio');
            // $table->unsignedBigInteger('role');
            // $table->string('role');
            // $table->foreign('role')->references('id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('program');
    }
};