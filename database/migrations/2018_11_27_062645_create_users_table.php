<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 10);
            $table->string('password');
            $table->integer('karyawan_id')->unsigned();
            $table->integer('karyawan_jabatan_id')->unsigned();

            $table->foreign('karyawan_id')->references('id')->on('karyawans');
            $table->foreign('karyawan_jabatan_id')->references('jabatan_id')->on('karyawans');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
