<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
  

	protected $table = 'pagos';

    protected $fillable = [
        'empleado_id',
        'usuario_id',
        'tipo_pago_empleado_id',
        'modo_pagos_id',
        'nu_sueldo_base',
        'nu_cantidad_tipo_pago',
        'fecha',
        'tx_descripcion',
        'total'

    ]; 


    public function empleado(){

        return $this->belongsTo(Empleado::class, 'empleado_id');
    }


    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }



   public function tipopago()
    {
       return $this->belongsTo(TipoPagoEmpleados::class, 'tipo_pago_empleado_id');
    }

      
}
