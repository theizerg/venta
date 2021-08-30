<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionTrabajo extends Model
{
    


     protected $fillable = [
        'tipo_trabajo', 'descripcion', 'fecha', 'estado_trabajo', 'empleado_id','usuario_id'
    ];


    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }


     public function getDisplayStatusAttribute()
    {
        return $this->estado_trabajo == 1 ? 'Actividad finalizada' : 'Pendiente por finalizar';
    }
}
