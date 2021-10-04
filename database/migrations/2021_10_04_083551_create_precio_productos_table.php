<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecioProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precio_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('precio_compra');
            $table->string('precio_venta');
            $table->integer('idproducto')->unsigned();
            $table->foreign('idproducto')->references('id')->on('producto');
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
        Schema::dropIfExists('precio_productos');
    }
}
