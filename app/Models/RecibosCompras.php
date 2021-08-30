<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecibosCompras extends Model
{
    use HasFactory;





      public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function moneda(){
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }

    public function proveedor(){
        return $this->belongsTo(Cliente::class, 'proveedor_id');
    }

    public function facturas(){
        return $this->belongsToMany(FacturaCompra::class, 'recibo_facturas', 'recibo_id', 'compra_id')->withPivot('deuda_inicial', 'deuda_final');
    } 
    
  
}
