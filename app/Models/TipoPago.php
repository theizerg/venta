<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $table = 'tipo_pago';
   

    protected $fillable = [
        'nb_tipo_pago'
    ]; 



    public function pago()
    {
        return $this->hasMany('App\Models\TipoPago');
    } 
}
