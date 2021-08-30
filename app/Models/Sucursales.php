<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    



     public function getDisplayStatusAttribute()
    {
        return $this->status == 1 ? 'Activa' : 'Deshabilitada';
    }
}
