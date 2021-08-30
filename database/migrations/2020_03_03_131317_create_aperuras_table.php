<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAperurasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apertura_caja', function (Blueprint $table) {
            $table->increments('id_apertura');
            $table->integer('nu_cantidad_efectivo');
            $table->integer('nu_cantidad_dolares');
            $table->integer('nu_cantidad_punto_venta');
            $table->integer('nu_cantidad_transferencias');
            $table->integer('nu_cantidad_pago_movil');
            
            //Caja Asociada
            $table->integer('caja_id')->unsigned();
           

            // Usuario asociado
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->smallInteger('status'); //  1 Abierta
            $table->string('fecha_emision');

            $table->softDeletes();
            $table->timestamps();
            $table->index(['fecha_emision']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aperuras');
    }
}
