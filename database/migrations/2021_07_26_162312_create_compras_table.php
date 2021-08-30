<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');

            // Tipo comprobante
            $table->integer('tipo_compra_id')->unsigned();
            $table->foreign('tipo_compra_id')->references('id')->on('tipo_compra');
            $table->string('descripcion_diferencia')->nullable();
            $table->string('cantidad_diferencia')->nullable();

            // Moneda
            $table->integer('moneda_id')->unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->double('cotizacion')->default(1);

            // Cliente asociado
            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');

            // Datos del comprobante
            $table->string('serie')->nullable();
            $table->integer('numero')->nullable();

            // Datos del cliente
            $table->string('nombre_proveedor')->nullable();
            $table->string('direccion')->nullable();            
            $table->string('rut')->nullable();

             // Calculo final
            $table->double('subTotal')->default(0);
            $table->double('iva')->default(0);
            $table->double('total')->default(0);
            $table->integer('sucursal_id')->unsigned();
            $table->foreign('sucursal_id')->references('id')->on('sucursales');

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
        Schema::dropIfExists('compras');
    }
}
