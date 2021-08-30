<?php

namespace App\Facades;

use App\Models\TipoDocumento;
use App\Models\Compras;
use App\Models\FacturasCompras;

class SistemaFacturaCompra
{
	private static $instancia;

	public static function getInstancia(){
		if(!isset(self::$instancia))
			self::$instancia = new SistemaFacturaCompra();
		return self::$instancia;
	}

	public function ingresarFactura($compra, $fecha_vencimiento, $deuda_original, $deuda_actual, $plazo,$proveedor_id){
		$nuevaFactura = new FacturasCompras();
	
		// Campos obligatorios		
		$nuevaFactura->compra_id = $compra->id;
		$nuevaFactura->fecha_vencimiento = $fecha_vencimiento;
		$nuevaFactura->deuda_original = $deuda_original;
		$nuevaFactura->proveedor_id = $proveedor_id;

		if($plazo)
			$nuevaFactura->plazo = $plazo;

		if($deuda_actual)
			$nuevaFactura->deuda_actual = $deuda_actual;
		else
			$nuevaFactura->deuda_actual = $deuda_original;

		$nuevaFactura->save();
		return $nuevaFactura;
	}
}