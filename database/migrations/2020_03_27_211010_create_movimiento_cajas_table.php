<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_cajas', function (Blueprint $table) {
            $table->increments('id');
            // Usuario asociado
            $table->integer('usuario_id')->unsigned();
            // Tipo comprobante
            $table->integer('tipo_comprobante_id')->unsigned();
            // Tipo de pago asociado
            $table->integer('tipo_pago_id');

            // Moneda
            $table->integer('moneda_id');
            $table->double('cotizacion')->default(1);

            // Cliente asociado
            $table->string('cliente')->nullable();

            // Caja asociada
            $table->integer('caja_id');
            
            // Comprobantes asociados
            $table->integer('comprobante_id');

            $table->integer('producto_id');
            $table->string('fecha');

            $table->string('descripcion');


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
        Schema::dropIfExists('movimiento_cajas');
    }
}
