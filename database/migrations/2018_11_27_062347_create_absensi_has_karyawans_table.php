<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensiHasKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * 0 => alfa
     * 1 => masuk
     * 2 => sakit
     * 3 => cuti
     */
    public function up()
    {
        Schema::create('absensi_has_karyawans', function (Blueprint $table) {
            $table->integer('absensi_id')->unsigned();
            $table->integer('karyawan_id')->unsigned();
            $table->enum('status', ['0', '1', '2', '3'])->nullable();

            $table->foreign('absensi_id')->references('id')->on('absensis');
            $table->foreign('karyawan_id')->references('id')->on('karyawans');
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
        Schema::dropIfExists('absensi_has_karyawans');
    }
}
