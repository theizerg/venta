<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nb_nombre');
            $table->string('nb_apellido');
            $table->string('nu_cedula');
            $table->string('fe_ingreso');
            $table->string('telefono');
            $table->string('nb_profesion');
            $table->string('sueldo_base');
            $table->string('fecha_nacimiento');
            $table->string('edad');
            // Usuario asociado
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
            // Cargo asociado al empleado
            $table->integer('cargo_id')->unsigned();
            $table->foreign('cargo_id')->references('id')->on('cargos');
             // Modo de pago asociado
            $table->integer('modo_pagos_id')->unsigned();
            $table->foreign('modo_pagos_id')->references('id')->on('modo_pagos');
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
        Schema::dropIfExists('empleados');
    }
}
