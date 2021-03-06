<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /**
     * 0 => kategori tidak potorng cuti
     * 1 => kategori potong cuti
     * limit => max harinya
     */
    public function up()
    {
        Schema::create('jenis_cutis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 45);
            $table->integer('limit');
            $table->enum('kategori', ['0', '1']);
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
        Schema::dropIfExists('jenis_cuti');
    }
}
