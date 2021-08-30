<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AperturaCaja extends Model
{
    
 	protected $table = 'apertura_caja';
    protected $primaryKey = 'id_apertura';
    protected $fillable = [
        'nu_cantidad_efectivo', 'nu_cantidad_dolares', 'nu_cantidad_punto_venta', 'nu_cantidad_transferencias', 'nu_cantidad_pago_movil', 'caja_id', 'usuario_id', 'status','fecha_emision',
    ];

    protected $dates = ['deleted_at'];




     public function UsuarioAperturador()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }


        public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }


    
    public function getDisplayStatusAttribute()
    {
        return $this->status == 1 ? 'Caja abierta' : 'Caja cerrada';
    }

}
