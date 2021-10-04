<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('fecha');
            $table->string('hora_cierre')->nullable();
            $table->string('hora');
            $table->string('mes');
            $table->string('year');
            $table->integer('idusers')->unsigned();
            $table->foreign('idusers')->references('id')->on('users');
            $table->string('monto');
            $table->string('monto_cierre');
            $table->string('estado');
            $table->string('caja');
            $table->softDeletes();
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
        Schema::dropIfExists('cajas');
    }
}
