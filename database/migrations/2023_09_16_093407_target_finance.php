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
        Schema::create('target_finance', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->string('bulan');
            $table->integer('tahun');
            $table->unsignedBigInteger('id_portofolio');
            $table->foreign('id_portofolio')->references('id')->on('portofolio');
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
        Schema::dropIfExists('target_finance');
    }
};