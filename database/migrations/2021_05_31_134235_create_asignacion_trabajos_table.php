<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('asignacion_trabajos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('tipo_trabajo');
            $table->string('descripcion');
            $table->string('fecha');
            $table->integer('estado_trabajo'); //1 Finalizado 0 No finalizado 
            // Empleado asociado
            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
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
        Schema::dropIfExists('asignacion_trabajos');
    }
}
