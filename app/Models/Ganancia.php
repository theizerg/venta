<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ganancia extends Model
{





     public function productos(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
