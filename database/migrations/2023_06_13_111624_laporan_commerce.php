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
            $table->string("id_commerce")->primary();
            $table->unsignedBigInteger('id_program');
            $table->string('kode_program');
            $table->integer('nilai');
            $table->string('jenis_laporan');
            $table->string('keterangan');
            $table->unsignedBigInteger('id_portofolio');
            $table->unsignedBigInteger('id_sub_grup_akun');
            // $table->string('id_nama_kota');
            $table->unsignedBigInteger('kota');
            $table->string("slug")->unique();
            $table->foreign('id_portofolio')->references('id')->on('portofolio');
            $table->foreign('id_program')->references('id')->on('program');
            $table->foreign('id_sub_grup_akun')->references('id')->on('sub_grup_akun');
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
        Schema::dropIfExists('laporan_commerce');
    }
};