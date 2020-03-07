<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecintosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajllita_recintos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('circunscripcion');
            $table->string('distrito');
            $table->string('direccion');
            $table->string('ubicacion_gps');
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
        Schema::drop('recintos');
    }
}