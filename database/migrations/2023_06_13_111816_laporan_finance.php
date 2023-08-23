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
            $table->integer('nilai');
            $table->string('keterangan');
            $table->unsignedBigInteger('id_portofolio');
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('id_cost_plan');
            $table->unsignedBigInteger('id_peruntukan');
            $table->unsignedBigInteger('id_user');
            // $table->string('id_nama_kota');
            $table->unsignedBigInteger('kota');
            $table->foreign('id_portofolio')->references('id')->on('portofolio');
            $table->foreign('id_program')->references('id')->on('program');
            $table->foreign('id_cost_plan')->references('id')->on('cost_plan');
            $table->foreign('id_peruntukan')->references('id')->on('peruntukan');
            $table->foreign('id_user')->references('id')->on('user_reco');
            $table->foreign('kota')->references('id')->on('city');
            $table->timestamps();
            $table->boolean('editable')->default(0);
            $table->string('tanggal');

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