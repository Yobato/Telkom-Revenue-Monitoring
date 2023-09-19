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
        Schema::create('laporan_nota', function (Blueprint $table) {
            $table->id();
            $table->string("pid_nota");
            $table->integer('nilai_awal');
            $table->integer('nilai_akhir');
            $table->string('pph');
            $table->float('persentase')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('id_peruntukan');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('kota');
            $table->foreign('pid_nota')->references('pid_finance')->on('laporan_finance');
            $table->foreign('id_peruntukan')->references('id')->on('peruntukan');
            $table->foreign('id_user')->references('id')->on('user_reco');
            $table->foreign('kota')->references('id')->on('city');
            $table->timestamps();
            $table->boolean('editable')->default(0);
            $table->timestamp('tanggal')->nullable();
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
        Schema::dropIfExists('laporan_nota');
    }
};