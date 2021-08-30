<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas_compras', function (Blueprint $table) {
            $table->increments('id');

            // Compra asociada
            $table->integer('compra_id')->unsigned();
            $table->foreign('compra_id')->references('id')->on('compras');

            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');

            $table->date('fecha_vencimiento');
            $table->integer('plazo')->nullable();
            
            $table->double('deuda_original');
            $table->double('deuda_actual');

            $table->index(['fecha_vencimiento']);
            $table->timestamps();

            $table->index(['compra_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas_compras');
    }
}
