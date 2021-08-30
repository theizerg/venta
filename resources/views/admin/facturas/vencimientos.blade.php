@extends('layouts.admin')
@section('title', 'Vencimiento')
@push('scripts')		
	<script type="text/javascript">
		var buscar_cliente_url = "{{ url('clientes/buscar?texto=') }}";
		var buscar_prodcto_url = "{{ url('productos/buscar?texto=') }}";
		var comprobante_vistaprevia_url = "{{ url('comprobantes/vistaPrevia') }}";
	</script>
	<script src="{{ asset('js/forms/comprobantes.js') }}"></script>
@endpush

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<span class="float-left">
				<a class="btn btn-sm btn-success" href="/comprobantes/nuevo" class="btn btn-link">
					<i class="fa fa-plus" aria-hidden="true"></i> Nuevo comprobante
				</a>
			</span>
		</div>
	</div><br>
	<div class="row">    
		<div class="col-md-12">
			<div class="card">
				<div class="card-primary card-outline card-header">
					<h4>Vencimientos</h4>
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
									<th class="text-center">Cliente</th>
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
									<a href="/clientes/detalle/{{$v->comprobante->cliente->id}}">
										{{ $v->comprobante->cliente->nombre }} {{ $v->comprobante->cliente->apellido }}
									</a>
								</td>
								<td class="text-center">
									{{ $v->comprobante->moneda->simbolo }} {{ $v->deuda_original }}
								</td>
								<td class="text-center">
									{{ $v->comprobante->moneda->simbolo }} {{ $v->deuda_actual }}
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
									<a class="btn btn-link btn-sm" href="/comprobantes/recibos/nuevo/{{$v->comprobante->cliente->id}}">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</td>
								<td class="text-center" title="Detalle de la factura">
									<a target="_blank" class="btn btn-link btn-sm" href="/comprobantes/detalle/{{ $v->comprobante->id }}">
										<i class="fas fa-external-link-alt"></i>
									</a>
								</td>
							</tr>
							</tbody>
							@endforeach
						</table>
					</div>
					<div class="text-center">
						{{ $vencimientos->links( "pagination::bootstrap-4") }}
					</div>
				</div>
			</div>
		</div>        
	</div>
</div>

<div class="modal fade" id="modalAgregarCliente" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Buscar cliente
					<span class="pull-right">
						<a class="btn btn-success btn-sm text-center" href="/clientes/nuevo" target="_blank" >
							<i class="fa fa-user-plus" aria-hidden="true"></i>
						</a>
					</span>
				</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label class="sr-only">Buscar cliente</label>
						<div class="row">
							<div class="col-md-10">
								<input id="txtBuscadorCliente" class="form-control" type="text" name="BuscadorCliente" placeholder="Buscar cliente...">
							</div>
							<div class="col-md-2">
								<button id="btnBuscarCliente" type="submit" class="btn btn-primary btn-block">
									<i class="fa fa-search" aria-hidden="true"></i>									
								</button>
							</div>
						</div>						
						<hr/>
						<table width="100%" class="table-condensed table-striped table-bordered">
							<thead>
								<tr>
									<th width="5%">ID</th>
									<th width="20%">Nombre / Razón Social</th>
									<th width="20%">RIF</th>
									<th width="20%">Mail</th>
									<th width="20%">Dirección</th>
									<th width="5%"></th>
								</tr>
							</thead>
							<tbody id="tablaClientes">
								
							</tbody>
						</table>
							<div class="text-center">
						{{ $vencimientos->links( "pagination::bootstrap-4")}}
					</div>					
					</div>
				</form>
			</div>

			<div class="modal-footer">				
				<button id="btnOkModalAgregarCliente" class="btn btn-block btn-primary" data-dismiss="modal">
					Confirmar
				</button>
			</div>
		</div>
	</div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

    var table = $('#').DataTable({
example    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
            }
        },
    });
    } );
        </script>
@endpush