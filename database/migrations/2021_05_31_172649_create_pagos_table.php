<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
        $table->increments('id');
        // Empleado asociado
        $table->integer('empleado_id')->unsigned();
        $table->foreign('empleado_id')->references('id')->on('empleados');
        // Usuario asociado
        $table->integer('usuario_id')->unsigned();
        $table->foreign('usuario_id')->references('id')->on('users');
        // Tipo de pago asociado
        $table->integer('tipo_pago_empleado_id')->unsigned();
        $table->foreign('tipo_pago_empleado_id')->references('id_tipo_pago_empleado')->on('tipo_pago_empleado');
    
        // Dinero por concepto de bono o de un vale
        $table->double('nu_cantidad_tipo_pago')->default(0);

        // Fecha en que se hizo el recibo de pago
        $table->DateTime('fecha');

        // descripcion del pago 
        $table->string('tx_descripcion');

         // Sucursal asociado
        $table->integer('sucursal_id')->unsigned();
        $table->foreign('sucursal_id')->references('id')->on('sucursales');

        // Dinero por concepto de bono o de un vale
        $table->double('total')->default(0);

        $table->softDeletes();
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
        Schema::dropIfExists('pagos');
    }
}
