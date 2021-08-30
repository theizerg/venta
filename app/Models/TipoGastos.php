<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoGastos extends Model
{
    
     #Tabla asociada
    protected $table = 'tipo_gastos';

    protected $fillable = [
        'nombre'
    ];

  
}
