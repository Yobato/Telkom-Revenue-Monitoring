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
        Schema::create('laporan_finance', function (Blueprint $table) {
            $table->id("pid");
            $table->integer('nilai');
            $table->string('keterangan');
            $table->string('id_portofolio')->references('id')->on('portofolio');
            $table->string('id_program')->references('id')->on('program');
            $table->string('id_cost_plan')->references('id')->on('cost_plan');
            $table->string('id_peruntukan')->references('id')->on('peruntukan');
            $table->string('id_user')->references('id')->on('user');
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
        Schema::dropIfExists('laporan_finance');
    }
};