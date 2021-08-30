@extends('layouts.admin')
@section('title', 'Ventas')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<span class="float-left">
				<a class="btn btn-sm blue darken-4 text-white" href="/comprobantes/nuevo">
					<i class="fa fa-plus" aria-hidden="true"></i> Nueva venta
				</a>
			</span>
		</div>
	</div><br>
	<div class="row">    
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="card card-line-primary">
				<div class="card-primary card-outline card-header">
					<h4>Detalle de la venta</h4>
				</div>                
				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/comprobantes" class="link_ruta">
								Listado de ventas &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/comprobantes/detalle/{{$comprobante->id}}" class="link_ruta">
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
									<td width="144px">Tipo de comprobante</td>
									<td>{{ $comprobante->tipo->nombre }}</td>									
								</tr>
								<tr>
									<td>Fecha de emisión</td>
									@if($comprobante->fecha_emision)
										
										<td>
											{{ date_format(date_create($comprobante->fecha_emision), 'd / m / Y' ) }}
										</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
								<tr>
									<td>Serie</td>
									@if($comprobante->serie)
										<td>{{ $comprobante->serie }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
								<tr>
									<td>Número</td>
									@if($comprobante->serie)
										<td>{{ $comprobante->numero }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>


								<tr>
									<th class="text-center th-b" colspan="2">Datos del cliente</th>
								</tr>
								<tr>
									<td>Cliente</td>
									@if($comprobante->cliente)
										<td><a href="/clientes/detalle/{{ $comprobante->cliente->id }}">{{ $comprobante->cliente->nombre }} {{ $comprobante->cliente->apellido }}</a></td>
									@else
									   <td>{{ $comprobante->nombre_cliente }}</td>
									@endif
								</tr>
								<tr>
									<td>RIF</td>
									@if($comprobante->serie)
										<td>{{ $comprobante->rif }}</td>
									@else
										<td>N/A</td>
									@endif
								</tr>
								<tr>
									<td>Dirección</td>
									@if($comprobante->direccion)
										<td>{{ $comprobante->direccion }}</td>
									@else
										<td style="color: #aaa;">- - -</td>
									@endif
								</tr>
							</table>
							
							<a href="/comprobantes/imprimir/{{$comprobante->id}}" target="_blank" class="btn btn-block btn-primary">
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
								<table width="100%" class="table table-responsive" id="example">
									<thead>
										<tr>											
											<th class="text-center">Artículo</th>
											<th class="text-center" width="100px">Precio</th>
											<th class="text-center" width="50px">Cant.</th>
											<th class="text-center" width="100px">Sub total</th>
											<th class="text-center" width="100px">Total</th>
										</tr>
									</thead> 
									<tbody >
										@foreach($comprobante->lineasProducto as $l)
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
												
												<span class="text-center">
												&nbsp; {{ App\Models\Moneda::find(2)->simbolo }}	{{ number_format($l->subTotal, 2, '.', ',') }}
												</span>
											</td>
											<td>
												
												<span class="text-center">
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
