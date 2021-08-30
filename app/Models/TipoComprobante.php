<?php

namespace App\Models;
use App\Models\Comprobante;

use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{    
    public function comprobantes(){
    	return $this->hasMany(Comprobante::class);
    }
}
