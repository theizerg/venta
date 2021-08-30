<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModoPago extends Model
{
     protected $table = 'modo_pagos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nb_modo_pago'
    ]; 



    public function pago()
    {
        return $this->hasMany('App\Models\ModoPago');
    } 
}
