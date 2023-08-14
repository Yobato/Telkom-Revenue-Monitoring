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

    protected $connection = 'mysql';

    public function up()
    {
        //
        Schema::create('target', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->string('bulan');
            $table->integer('tahun');
            $table->string('jenis_laporan');
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
        Schema::dropIfExists('target');
    }
};