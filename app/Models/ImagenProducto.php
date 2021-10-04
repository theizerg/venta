<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    use HasFactory;


    public function fotos(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
