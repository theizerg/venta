<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
 
 #Tabla asociada
    protected $table = 'gastos';

    protected $fillable = [
        'nombre'
    ];

    public function tipogastos(){
        return $this->belongsTo	(TipoGastos::class, 'tipo_gasto_id');
    }

}
