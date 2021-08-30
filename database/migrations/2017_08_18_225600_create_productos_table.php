<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->unique()->nullable();
            $table->index('codigo');
            $table->string('codigo_de_barras')->nullable();
            $table->index('codigo_de_barras');
            $table->string('marca_producto');
           
            
            $table->integer('familiaproducto_id')->nullable()->default(1);
            $table->foreign('familiaproducto_id')->references('id')->on('familia_productos');

            $table->integer('tipo_producto_id')->nullable()->default(1);
            $table->foreign('tipo_producto_id')->references('id')->on('tipo_productos');

            // Tasa de IVA
            $table->integer('tasa_iva_id')->nullable()->default(1);
            $table->foreign('tasa_iva_id')->references('id')->on('tasas_iva');

            $table->string('stock')->default(0);
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('precio')->default(0);
            $table->string('precio_compra')->default(0);
            $table->integer('stock_minimo_valor')->default(0);
            $table->integer('stock_minimo_notificar')->default(0);
            $table->integer('sucursal_id')->nullable()->default(1);
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->integer('producto_garantia')->default(0);
            $table->string('producto_tiempo_garantia')->default('3 meses');
            $table->string('photo')->nullable();
            $table->string('fecha_fabricacion')->nullable();
            $table->string('fecha_vencimiento')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['codigo', 'codigo_de_barras', 'nombre']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
