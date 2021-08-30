@extends('layouts.admin')
@section('title', 'Recibo')
@push('scripts')	
	<script src="{{ asset('js/forms/recibos.js') }}"></script>
@endpush

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class=" card-header">
					<h4>Listado de recibos por pagar</h4>
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
								Comprobantes &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						 <li class="list-inline-item">
							<a href="/comprobantes/vencimientos" class="link_ruta">
								Vencimientos
							</a>
						</li>
					   </ul><br>			                  
				   </div> 
				   <div class="card-body">
					<div class="table-responsive">
						<table id="example" cellspacing="0" width="100%" class="table table-hover table-responsive display">
							<thead>
								<tr>
									<th width="180px" class="text-center">Vencimiento</th>
									<th class="text-center">Proveedor</th>
									<th width="180px" class="text-center">Deuda Original</th>
									<th width="180px" class="text-center">Deuda Actual</th>
									<th width="180px" class="text-center">Días de atraso</th>
									<th width="110px" class="text-center">Ingresar pago</th>
									<th width="10px" class="text-center">Detalle</th>
								</tr>
							</thead>

							@foreach($vencimientos as $v)
							<tbody>
								<?php
								$hoy = time();
								$fecha_vencimiento = strtotime($v->fecha_vencimiento);
								$date_diff = $fecha_vencimiento - $hoy;
								$dias_de_atraso = round($date_diff / (60 * 60 * 24))*-1;
							?>
							@if($v->deuda_actual == 0)
							<tr class="td-success">
							@elseif($dias_de_atraso > 0)
							<tr class="td-danger">
							@elseif($dias_de_atraso > -7)
							<tr class="td-warning">
							@else
							<tr>
							@endif
								<td class="text-center">{{date_format(date_create($v->fecha_vencimiento), 'd / m / Y' )}}</td>
								<td class="text-center">
									<a href="/proveedores/detalle/{{$v->compras->proveedor->id}}">
										{{ $v->compras->proveedor->nombre }} 
									</a>
								</td>
								<td class="text-center">
									{{ $v->compras->moneda->simbolo }} {{ $v->deuda_original }}
								</td>
								<td class="text-center">
									{{ $v->compras->moneda->simbolo }} {{ $v->deuda_actual }}
								</td>
								@if($v->deuda_actual == 0)
								<td>
								@elseif($dias_de_atraso > 0)
								<td style="color: red;" class="text-center">
									{{ $dias_de_atraso }}
								@else
								<td class="text-center">
									{{ $dias_de_atraso }}
								@endif									
								</td>
								<td class="text-center" title="Ingreso de pago">
									<a class="btn btn-link btn-sm" href="/comprobantes/recibos/factura/nuevo/{{$v->compras->proveedor->id}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</td>
								<td class="text-center" title="Detalle de la factura">
									<a target="_blank" class="btn btn-link btn-sm" href="/compras/detalle/{{ $v->compras->id }}">
										<i class="fas fa-external-link-alt"></i>
									</a>
								</td>
							</tr>
							</tbody>
							@endforeach
						</table>
					</div>
					
				</div>
				
				</div>
			</div>				
		</div>        
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){        
	});
</script>
@endsection