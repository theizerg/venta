<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineaComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linea_compras', function (Blueprint $table) {
         
            $table->increments('id');
            // Producto asociado
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
            // Usuario asociado
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
            // Cinoribante asociado : NULLABLE
            $table->integer('compra_id')->unsigned()->nullable();
            $table->foreign('compra_id')->references('id')->on('compras');
            
            $table->string('descripcion');            
            $table->DateTime('fecha')->default(date("Y-m-d H:i:s"));
            $table->double('stock')->default(0);

            // Tasa de IVA
            $table->integer('tasa_iva_id')->unsigned()->default(1);
            $table->foreign('tasa_iva_id')->references('id')->on('tasas_iva');

            $table->double('precioUnitario')->nullable();
            $table->integer('cantidad');

            $table->double('subTotal')->nullable();
            $table->double('iva')->nullable();
            $table->double('total')->nullable();
            $table->timestamps();
            $table->index(['fecha']);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linea_compras');
    }
}
