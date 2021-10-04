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
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->unique()->nullable();
            $table->string('cantidad');
            $table->string('categoria');
            $table->string('marca');
            $table->string('estado');
            $table->string('presentacion');
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('sucursal_id')->nullable()->default(1);
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->string('fecha_fabricacion');
            $table->string('fecha_vencimiento');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['codigo', 'nombre']);
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
