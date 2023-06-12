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
        Schema::create('laporan_commerce', function (Blueprint $table) {
            $table->id("id_commerce");
            $table->string('kode_program');
            $table->integer('nilai');
            $table->string('jenis_laporan');
            $table->string('keterangan');
            $table->string('id_portofolio')->references('id')->on('portofolio');
            $table->string('id_program')->references('id')->on('program');
            $table->string('id_sub_grup_akun')->references('id')->on('sub_grup_akun');
            $table->string('id_nama_kota')->references('nama_city')->on('city');
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
        Schema::dropIfExists('laporan_commerce');
    }
};