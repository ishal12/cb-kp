<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHariLibursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /**
     * ln => Libur nasional
     * lm => Libur minggu
     */
    public function up()
    {
        Schema::create('hari_liburs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 45);
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->enum('jenis', ['ln', 'lm']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hari_libur');
    }
}
