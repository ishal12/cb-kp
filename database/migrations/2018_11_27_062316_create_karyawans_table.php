<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 45);
            $table->longText('alamat');
            $table->string('kontak', 45);
            $table->integer('jabatan_id')->unsigned();
            $table->integer('karyawan_id')->unsigned()->nullable();
            $table->integer('karyawan_jabatan_id')->unsigned()->nullable();

            $table->foreign('jabatan_id')->references('id')->on('jabatans');
            $table->foreign('karyawan_id')->references('id')->on('karyawans');
            $table->foreign('karyawan_jabatan_id')->references('jabatan_id')->on('karyawans');
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
        Schema::dropIfExists('karyawan');
    }
}
