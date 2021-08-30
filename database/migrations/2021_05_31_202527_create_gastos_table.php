<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->increments('id');
             // Tipo de gasto asociado
            $table->integer('tipo_gasto_id')->unsigned();
            $table->foreign('tipo_gasto_id')->references('id')->on('tipo_gastos');
            $table->double('cantidad');
            $table->string('fecha')->default(date('d/m/Y'));
            $table->string('descripcion');
             // Sucursal asociado
            $table->integer('sucursal_id')->unsigned();
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
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
        Schema::dropIfExists('gastos');
    }
}
