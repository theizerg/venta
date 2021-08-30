<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    protected $table = 'movimiento_cajas';

	protected $fillable = [
		'usuario_id',
		'fecha',
		'tipo_comprobante_id',
		'descripcion',
		'caja_id',
		'tipo_pago_id',
		'moneda_id',
		'producto_id',
		'comprobante_id'

	];


    public function tipo(){
        return $this->belongsTo(TipoComprobante::class, 'tipo_comprobante_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function moneda(){
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }

        public function tipoPago(){
        return $this->belongsTo(TipoPago::class, 'tipo_pago_id');
    }

     public function comprobante(){
        return $this->belongsTo(Comprobante::class, 'comprobante_id');
    }

         public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }



    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

}
