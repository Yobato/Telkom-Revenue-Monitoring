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
            $table->string("pid_finance")->primary();
            $table->unsignedBigInteger('id_portofolio');
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('id_cost_plan');
            $table->unsignedBigInteger('kota');
            $table->foreign('id_portofolio')->references('id')->on('portofolio');
            $table->foreign('id_program')->references('id')->on('program');
            $table->foreign('id_cost_plan')->references('id')->on('cost_plan');
            $table->foreign('kota')->references('id')->on('city');
            $table->timestamps();
            $table->boolean('editable')->default(0);
            // $table->timestamp('tanggal')->nullable();
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