<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCutiTanggalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti_tanggals', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->enum('status', ['0', '1']);
            $table->longText('keterangan')->nullable();
            $table->integer('cuti_id')->unsigned();
            $table->integer('cuti_jenis_cuti_id')->unsigned();
            $table->integer('cuti_karyawan_id')->unsigned();
            $table->integer('cuti_karyawan_jabatan_id')->unsigned();

            $table->foreign('cuti_id')->references('id')->on('cutis');
            $table->foreign('cuti_jenis_cuti_id')->references('jenis_cuti_id')->on('cutis');
            $table->foreign('cuti_karyawan_id')->references('karyawan_id')->on('cutis');
            $table->foreign('cuti_karyawan_jabatan_id')->references('karyawan_jabatan_id')->on('cutis');
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
        Schema::dropIfExists('cuti_tanggal');
    }
}
