<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCierreCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierre_caja', function (Blueprint $table) {
            $table->increments('id_cierre');
            $table->integer('nu_cantidad_efectivo');
            $table->integer('nu_cantidad_dolares');
            $table->integer('nu_cantidad_punto_venta');
            $table->integer('nu_cantidad_transferencias');
            $table->integer('nu_cantidad_pago_movil');
            $table->smallInteger('status'); //  0 Cerrada
            //Caja Asociada
            $table->integer('caja_id')->unsigned();
            
            // Usuario asociado
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->datetime('fecha_cierre');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['fecha_cierre']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cierre_cajas');
    }
}
