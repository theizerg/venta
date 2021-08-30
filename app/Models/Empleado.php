<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
 

public function trabajos(){
        return $this->hasMany(LineaTrabajador::class);
    }

public function pagos(){
        return $this->hasMany(Pago::class);
    }

public function cargos(){
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

 public function modopago()
    {
        return $this->belongsTo(ModoPago::class, 'modo_pagos_id');
    }


public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'sucursal_id');
    }

  public function getDisplayNameAttribute()
     {
         return trim(str_replace( '  ', ' ',  "{$this->nb_nombre} {$this->nb_apellido}")) ;
     }
}
