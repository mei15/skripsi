<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('ket');
            $table->date('tgl');
            $table->bigInteger('id_dsn')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->timestamps();

            $table->foreign('id_dsn')->references('id')->on('dosens');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsultasis');
    }
}
