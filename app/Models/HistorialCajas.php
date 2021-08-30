<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class HistorialCajas extends Model
{
    protected $table = 'historial_cajas';

	protected $fillable = [
		'descripcion',
		'usuario_id',
		'caja_id',
		'fecha'];


    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
		
						


}
