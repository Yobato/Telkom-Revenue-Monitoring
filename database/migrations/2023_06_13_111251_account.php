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
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('nik');
            $table->string('password');
            $table->string('keterangan');
            $table->string('role');
            // $table->string('id_nama_kota');
            // $table->unsignedBigInteger('role');
            $table->unsignedBigInteger('kota');
            $table->foreign('role')->references('nama_role')->on('role');
            $table->foreign('kota')->references('id')->on('city');
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
        Schema::dropIfExists('account');
    }
};