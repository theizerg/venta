<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
   
	protected $table = 'cajas';

	protected $fillable = [
		'nu_caja'
	];

    public function apertura()
    {
        return $this->hasMany(AperturaCaja::class);
    }


        public function cierre()
    {
        return $this->hasMany(CierreCaja::class);
    }

}
