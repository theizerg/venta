@extends('layouts.admin')
@section('title', 'Compras')
@section('content')
<div class="container">
   <div class="row">
		<div class="col-sm-3 float-left">
			<a href="/compras/nuevo"class="btn btn-block blue darken-4 text-white">
				Nueva compra
				<span class="float-left">
					<i class="fa fa-plus-square" aria-hidden="true"></i>
				</span>
			</a>
		</div>
	</div>
   </div><br>
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class=" card-header">
					<h4>Vista general de compras</h4>
				</div>
				<div class="card-body">
					
					<div class="col-sm-3 float-left">
						
					</div>
					<div class="table-responsive"><br>
						<table id="example" cellspacing="0" class="table table- table-border display">
							<thead>
							<tr>								
								<th class="text-center " width="120px">Fecha emisión</th>
								<th class="text-center " width="100px">Tipo de compra</th>
								<th class="text-center">Proveedor</th>
								<th class="text-center " class="text-center " width="120px">Sub-total</th>
								<th class="text-center " class="text-center " width="120px">Total</th>
								<th class="text-center">OPCIÓN</th>	
													
							</tr>
							</thead>
							<tbody>

							@foreach($compras as $comprobante)
							<tr>								
								<td class="text-center ">{{ date('d/m/Y', strtotime($comprobante->fecha_emision)) }}</td>
								<td>{{ $comprobante->tipo->name }}</td>
							<!--
								<td class="text-center ">
									<?php $i=0; ?>
									@foreach($comprobante->lineasCompra as $l)
										@if($i<2)
											x {{ $l->cantidad}}  {{$l->producto->nombre}}, 
											<?php $i++; ?>
										@elseif($i==2)
											{{$l->producto->nombre}} x {{ $l->cantidad}}
											<?php $i++; ?>
										@endif
									@endforeach
								</td>
							-->
								@if($comprobante->proveedor)

								<td title="{{$comprobante->proveedor->rut}}">
									<a href="/proveedores/detalle/{{$comprobante->proveedor->id}}">
										{{$comprobante->proveedor->nombre}} 
									</a>
								</td>
								@else
								<td class="text-center" >
									------
								</td>
								@endif
								
								<td>
								
									<span class="text-center">
										${{ number_format($comprobante->subTotal, 2) }}
									</span>
								</td>

								<td>
									
									<span class="text-center">
										${{ number_format($comprobante->total, 2) }}
									</span>
								</td>
								
							
								<td class="text-center " >
									<a target="_blank" class="btn btn-round blue darken-4 text-white tooltip-wrapper"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Imprimir comprobante" href="/comprobantes/imprimir/{{$comprobante->id}}">
										<i class="mdi mdi-printer" aria-hidden="true"></i>
									</a>
									<a href="/comprobantes/detalle/{{$comprobante->id}}" class="ml-3 btn btn-round blue darken-4 text-white tooltip-wrapper"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver detalle de la venta">
										<i class="mdi mdi-link-box-outline" aria-hidden="true"></i>
									</a>
								</td>
								
											
							@endforeach
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
		</div>        
	</div>
</div>
@endsection
