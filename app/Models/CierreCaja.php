<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CierreCaja extends Model
{
    
    protected $table = 'cierre_caja';
    
    protected $primaryKey = 'id_cierre';

    protected $fillable = [
        'nu_cantidad_efectivo',
        'nu_cantidad_dolares', 
        'nu_cantidad_punto_venta', 
        'nu_cantidad_transferencias', 
        'nu_cantidad_pago_movil', 
        'caja_id', 
        'usuario_id', 
        'status',
        'fecha_cierre'
    ];



    public function UsuarioCerrador()
    {
        return $this->hasMany(User::class, 'usuario_id');
    }


        public function cierre()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }

    public function getDisplayStatusAttribute()
    {
        return $this->status == 1 ? 'Caja abierta' : 'Caja cerrada';
    }
}
