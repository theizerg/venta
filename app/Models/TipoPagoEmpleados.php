<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPagoEmpleados extends Model
{
    
    protected $table = 'tipo_pago_empleado';
    protected $primaryKey = 'id_tipo_pago_empleado';

    protected $fillable = [
        'nb_tipo_pago_empleado'
    ]; 



    public function pago()
    {
        return $this->hasMany('App\Models\TipoPagoEmpleados');
    } 
}
