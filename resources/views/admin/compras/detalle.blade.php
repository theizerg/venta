@extends('layouts.admin')
@section('title', 'Compras')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<span class="float-left">
				<a class="btn btn-sm blue darken-4 text-white" href="/compras/nuevo">
					<i class="fa fa-plus" aria-hidden="true"></i> Nueva compra
				</a>
			</span>
		</div>
	</div><br>
	<div class="row">    
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="card card-line-primary">
				<div class="card-primary card-outline card-header">
					<h4>Detalle de la compra</h4>
				</div>                
				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/compras" class="link_ruta">
								Listado de compras &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/compras/detalle/{{$compra->id}}" class="link_ruta">
								Detalle
							</a>
						</li>
					</ul><br>

                    <div class="row">
						<div class="col-md-4">							
							<div class="col-md-12 col-sm-12 col-xs-12">
								<legend>Detalle de la factura</legend>
							</div>
							<table class="table table-condensed table-striped table-bordered">
								<tr>
									<th class="text-center th-b" colspan="2">Información general</th>
								</tr>
								<tr>
									<td width="144px">Tipo de venta</td>
									<td>{{ $compra->tipo->name }}</td>									
								</tr>
								<tr>
									<td>Fecha de emisión</td>
									@if($compra->fecha_emision)
										
										<td>
											{{ date_format(date_create($compra->fecha_emision), 'd/m/Y' ) }}
										</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
								<tr>
									<td>Serie</td>
									@if($compra->serie)
										<td>{{ $compra->serie }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
								<tr>
									<td>Número</td>
									@if($compra->serie)
										<td>{{ $compra->numero }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>


								<tr>
									<th class="text-center th-b" colspan="2">Datos del proveedor</th>
								</tr>
								<tr>
									<td>Cliente</td>
									@if($compra->proveedor)
										<td><a href="/proveedores/detalle/{{ $compra->proveedor->id }}">{{ $compra->proveedor->nombre }}</a></td>
									@else
									   <td>{{ $compra->nombre_proveedor }}</td>
									@endif
								</tr>
								<tr>
									<td>RIF</td>
									@if($compra->serie)
										<td>{{ $compra->rut }}</td>
									@else
										<td>N/A</td>
									@endif
								</tr>
								<tr>
									<td>Dirección</td>
									@if($compra->direccion)
										<td>{{ $compra->direccion }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
							</table>
							
							<a href="/comprobantes/imprimir/{{$compra->id}}" target="_blank" class="btn btn-block btn-primary">
								Imprimir
								<span class="float-right">
									<i class="fa fa-print" aria-hidden="true"></i>
								</span>
							</a>
							
						</div>
						<div class="col-md-8">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<legend>Artículos</legend>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 pre-scrollable div-detalle-comprobante">
								<table class="table table-responsive" id="example">
									<thead>
										<tr>											
											<th class="text-center">Artículo</th>
											<th class="text-center" width="100px">Precio</th>
											<th class="text-center" width="50px">Cant.</th>
											<th class="text-center" width="200px">Sub total</th>
											<th class="text-center" width="200px">Total</th>
										</tr>
									</thead> 
									<tbody >
										@foreach($compra->lineasCompra as $l)
										<tr>											
											<td>
												<a href="/productos/detalle/{{ $l->producto->codigo }}">
													{{ $l->producto->nombre }}
												</a>
											</td>
                                            <td>
												
												<span class="text-center">
												&nbsp; {{ App\Models\Moneda::find(2)->simbolo }}	{{ $l->precioUnitario }}
												</span>
											</td>
											<td class="text-center">
												{{ $l->cantidad }}
											</td>
											<td>
												
												<span class="text-center ml-5">
												&nbsp; {{ App\Models\Moneda::find(2)->simbolo }}	{{ number_format($l->subTotal, 2, '.', ',') }}
												</span>
											</td>
											<td>
												
												<span class="text-center  ml-5">
												&nbsp; {{ App\Models\Moneda::find(2)->simbolo }}	{{ number_format($l->total, 2, '.', ',') }}
												</span>
											</td>
											
										</tr>
                                        
										@endforeach
									</tbody>
                                    
								</table>
							</div>							
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

							
						</div>
					</div>  
									
					                  
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
