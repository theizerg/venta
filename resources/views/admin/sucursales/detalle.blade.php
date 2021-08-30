@extends('layouts.admin')
@section('title', 'Sucursales')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card  card-line-primary">
				<div class="card-header">
					<h4>Detalle de la sucursal</h4>
				</div>
				<div class="card-body">
					<span class="float-right">
						<a class="btn btn-md blue darken-4 text-white" href="/sucursales/nuevo" class="btn btn-link">
							<i class="fa fa-user-plus" aria-hidden="true"></i> Nueva sucursal
						</a>
					</span>
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/sucursales" class="link_ruta">
								Sucursales &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/sucursales/detalle/{{$sucursal->id}}" class="link_ruta">
								{{$sucursal->nombre}} 
							</a>
						</li>
					</ul><br>
					
					<div class="row">
						
							<div class="col-md-12"><br>
								<legend>
									Datos de la sucursal
									<span class="float-right">
									<a class="btn btn-md blue darken-4 text-white" id="editCodigo" data-toggle="modal" data-target="#modalEditarCliente" class="btn btn-link">
										<i class="fa fa-edit" aria-hidden="true"></i> Editar sucursal
									</a>
								</span>
								</legend>								
								<div class="form-group">
									<table class="table table-condensed table-striped table-bordered" width="100%">
										<tr>
											<th class="text-center th-b" colspan="2">Información general</th>
										</tr>
										<tr>
											<td width="30%">Nombre de la sucursal</td>
											<td width="70%">
												{{ $sucursal->nombre }}
											</td>												
										</tr>
										<tr>
											
										<tr>
											<td>
												Teléfono
											</td>
											<td>
												{{$sucursal->telefono}}
											</td>												
										</tr>
										<tr>
											<td>
												Dirección
											</td>
											<td>
												{{$sucursal->direccion}}
											</td>												
										</tr>
										<tr>
											<td>
												Rif
											</td>
											<td>
												{{$sucursal->rif}}
											</td>												
										</tr>
										<tr>
											<td>
												Estado de la sucursal
											</td>
											<td>
												<span class="badge text-white {{ $sucursal->status ? 'badge-success' : 'badge-danger' }}">{{ $sucursal->display_status }}</span>
											</td>												
										</tr>
										
										
									</table>
								</div>								
							</div><br>
							
						</div>
					</div>

				
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEditarCliente" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Editar datos de la sucursal
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<form id="form_editar_cliente" class="form-horizontal" role="form" method="POST" action="/sucursales/guardar">
						{{ csrf_field() }}
							<input type="hidden" name="sucursal_id" value="{{$sucursal->id}}">
							<div class="form-group">
								<table class="table table-condensed table-striped table-bordered" width="100%">
									
									
										<tr>
											<th>
												Nombre
											</th>
											<td>
												<input class="form-control input-sm" type="text" name="nombre" value="{{$sucursal->nombre}}">
											</td>										
																			
									</tr>
							
									<tr>
										<th>
											Teléfono
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="telefono" value="{{$sucursal->telefono}}">
										</td>												
									</tr>
									<tr>
										<th>
											Dirección
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="direccion" value="{{$sucursal->direccion}}">
										</td>												
									</tr>
									<tr>
										<th>
											Rif
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="rif" value="{{$sucursal->rif}}">
										</td>												
									</tr>
									<tr>
										<th>
											Estado de la sucursal
										</th>
										<td>
											<div class="checkbox icheck">
						                  <label class="font-weight-bolder">
						                    <input type="radio" name="status" value="1" {{ $sucursal->status == 1 ? 'checked' : '' }}> Activo&nbsp;&nbsp;
							                    <input type="radio" name="status" value="0" {{ $sucursal->status == 0 ? 'checked' : '' }}> Deshabilitado&nbsp;&nbsp;
							                  </label>
						                  </label>
						           </div>
										</td>												
									</tr>
								</table>
								<input type="submit" name="" value="Guardar cambios" class="btn blue darken-4 text-white btn-block">
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

@push('scripts')
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    
@endpush
