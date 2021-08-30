<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;


    public function tipo(){
        return $this->belongsTo(TipoCompra::class, 'tipo_compra_id');
    }

    public function sucursal(){
        return $this->belongsTo(Sucursales::class, 'sucursal_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function moneda(){
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function lineasCompra(){
        return $this->hasMany(LineaCompras::class, 'compra_id');
    }

    public function factura(){
        return $this->hasOne(Factura::class);
    }


       
}
