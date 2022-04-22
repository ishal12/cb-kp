<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_pengajuan');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->longText('keterangan');
            $table->enum('status', ['0', '1', '2']);
            $table->integer('jenis_cuti_id')->unsigned();
            $table->integer('karyawan_id')->unsigned();
            $table->integer('karyawan_jabatan_id')->unsigned();
            $table->integer('pimpinan_id')->unsigned()->nullable();
            $table->integer('pimpinan_jabatan_id')->unsigned()->nullable();

            $table->foreign('jenis_cuti_id')->references('id')->on('jenis_cutis');
            $table->foreign('karyawan_id')->references('id')->on('karyawans');
            $table->foreign('karyawan_jabatan_id')->references('jabatan_id')->on('karyawans');
            $table->foreign('pimpinan_id')->references('karyawan_id')->on('karyawans');
            $table->foreign('pimpinan_jabatan_id')->references('karyawan_jabatan_id')->on('karyawans');
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
        Schema::dropIfExists('cuti');
    }
}
