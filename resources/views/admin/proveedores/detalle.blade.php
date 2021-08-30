@extends('layouts.admin')
@section('title', 'Proveedores')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-primary card-outline card-header">
					<h4>Detalle de proveedor</h4>
				</div>
				<div class="card-body">
					<span class="float-right">
						<a class="btn btn-sm btn-success" href="/proveedores/nuevo" class="btn btn-link">
							<i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo proveedor
						</a>
					</span>
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/proveedores" class="link_ruta">
								Proveedores &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/proveedores/detalle/{{$proveedor->id}}" class="link_ruta">
								{{$proveedor->nombre}} {{$proveedor->apellido}}
							</a>
						</li>
					</ul><br>
					<div class="row">
							<div class="col-md-4"><br>
								<legend>
									Datos del proveedor
									<span class="float-right">
										<a class="btn btn-link btn-sm" id="editCodigo" data-toggle="modal" data-target="#modalEditarProveedor">
											<i class="fa fa-edit fa-lg" aria-hidden="true"></i>
										</a>
									</span>
								</legend>								
								<div class="form-group">
									<table class="table table-condensed table-striped table-bordered" width="100%">
										<tr>
											<th class="text-center th-b" colspan="2">Información general</th>
										</tr>
										<tr>
											<td width="30%">Nombre del proveedor</td>
											<td width="70%">
												{{ $proveedor->nombre }}
											</td>												
										</tr>
										<tr>											
											<td>
												Razón social
											</td>
											<td>
												{{$proveedor->razon_social}}
											</td>										
										</tr>
										<tr>
											<td>
												RIF
											</td>
											<td>												
												{{$proveedor->rut}}
											</td>												
										</tr>										
										<tr>
											<td>
												Mail
											</td>
											<td>
												{{$proveedor->mail}}
											</td>												
										</tr>
										<tr>
											<td>
												Dirección
											</td>
											<td>
												{{$proveedor->direccion}}
											</td>												
										</tr>
										<tr>
											<td>
												Teléfono
											</td>
											<td>
												{{$proveedor->telefono}}
											</td>												
										</tr>
										<tr>
											<td>
												Sitio web
											</td>
											<td>
												{{$proveedor->web}}
											</td>												
										</tr>										
									</table>
								</div>								
							</div>
							<div class="col-md-8"><br>
								<legend>Actividad del proveedor</legend>
								<div class="col-md-12">
									<div class="table-responsive">
										<table width="100%" class="table table-condensed table-striped table-bordered">
											<thead>
												<tr>
													
													<th class="text-center" width="120px">Fecha</th>
													<th class="text-center">Tipo de compras</th>
													
													<th class="text-center" width="100px">Total</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@foreach($compras as $c)
													<tr>
														
														<td>{{ date_format(date_create($c->fechaEmision), 'd/m/Y' ) }}</td>
														<td class="text-center">
															{{ $c->tipo->name }}
														</td>
														<td style="text-align: right;">
															{{ $c->moneda->simbolo }} {{ $c->total }}
														</td>														
														<td class="text-center">
															<a href="/compras/detalle/{{$c->id}}">
																<i class="fas fa-external-link-alt"></i>
															</a>
														</td>
													</tr>													
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEditarProveedor" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Editar datos del proveedor
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<form id="form_editar_proveedor" class="form-horizontal" role="form" method="POST" action="/proveedores/guardar">
						{{ csrf_field() }}
							<input type="hidden" name="proveedor_id" value="{{$proveedor->id}}">
							<div class="form-group">
								<table class="table table-condensed table-striped table-bordered" width="100%">
									<tr>
										<th width="40%">Nombre del proveedor</th>
										<td width="50%">											
											<input class="form-control input-sm" type="text" name="nombre" value="{{$proveedor->nombre}}">
										</td>												
									</tr>
									<tr>
										<th width="40%">Razón Social</th>
										<td width="50%">											
											<input class="form-control input-sm" type="text" name="razon_social" value="{{$proveedor->razon_social}}">
										</td>												
									</tr>
									<tr>
										<th>
											RIF
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="rif" value="{{$proveedor->rut}}">
										</td>												
									</tr>									
									<tr>
										<th>
											Mail
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="mail" value="{{$proveedor->mail}}">
										</td>												
									</tr>
									<tr>
										<th>
											Dirección
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="direccion" value="{{$proveedor->direccion}}">
										</td>												
									</tr>
									<tr>
										<th>
											Teléfono
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="telefono" value="{{$proveedor->telefono}}">
										</td>												
									</tr>
									<tr>
										<th>
											Sitio web
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="web" value="{{$proveedor->web}}">
										</td>												
									</tr>
								</table>
								<input type="submit" name="" value="Guardar cambios" class="btn btn-primary btn-block">
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				
			</div>        
		</div>
	</div>
</div>
@endsection
