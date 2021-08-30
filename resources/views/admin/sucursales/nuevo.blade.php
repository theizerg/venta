@extends('layouts.admin')
@section('title', 'Sucursales')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class="card-header">
					<h4>Alta de sucursales</h4>
				</div>

				<div class="card-body">
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
							<a href="/clientes/nuevo" class="link_ruta">
								Nuevo
							</a>
						</li>
					</ul><br>
					<div class="row">
							<div class="col-md-4">
								<legend>Datos de la sucursal</legend>
								<form method="post" action="/sucursales/guardar">
									{{ csrf_field() }}
									
									
									
									

									<div class="form-group form-persona">
										<label class="sr-only">Nombre</label>
										<input class="form-control form-persona-required" type="text" name="nombre" placeholder="Nombre" required="true" oninvalid="this.setCustomValidity('Debe ingresar un nombre de la sucursal')" oninput="setCustomValidity('')">
									</div>
									<div class="form-group form-persona">
										<label class="sr-only">Teléfono</label>
										<input class="form-control" type="text" name="telefono" placeholder="Teléfono">
									</div>

									<div class="form-group form-persona">
										<label class="sr-only">Dirección</label>
										<input class="form-control" type="text" name="direccion" placeholder="Dirección">
									</div>
									<div class="form-group form-empresa">
										<label class="sr-only">RIF</label>
										<input class="form-control form-empresa-required" type="text" name="rif" placeholder="RIF" oninvalid="this.setCustomValidity('Debe ingresar un RIF para el cliente')" oninput="setCustomValidity('')">
									</div>
									<div class="form-group">
						                <label class="font-weight-bolder" for="status">Estado de la sucursal</label>
						                <div class="checkbox icheck">
						                  <label class="font-weight-bolder">
						                    <input type="radio" name="status" value="1" checked> Activo&nbsp;&nbsp;
						                    <input type="radio" name="status" value="0"> Deshabilitado
						                  </label>
						                </div>
						              </div>

									<div class="form-group form-persona form-empresa" >
										<button type="submit" class="btn btn-block blue darken-4 text-white">Guardar</button>
									</div>
								</form>
							</div>
							<div class="col-md-8 "><br>
                				<legend>Últimas sucursales registradas</legend>
                				<div class="table-responsive">
	                				<table width="97%" class="table table-hover display">
	                					<thead>
	                						<tr>
	                							<th>Nombre</th>
	                							<th>Fecha de registro</th>
	                						</tr>	                						
	                					</thead>
	                					<tbody>
	                						@foreach($sucursales->sortByDesc('created_at')->take(8) as $c)
	                							<tr>
	                								<td>
	                									<a href="/sucursales/detalle/{{ $c->id}}">
	                										@if($c->empresa)
	                											<i style="width: 20px;" class="fa fa-briefcase text-center" aria-hidden="true"></i>
	                										@else
	                											<i style="width: 20px;" class="fa fa-user text-center" aria-hidden="true"></i>
	                										@endif
                											{{ $c->nombre }} {{ $c->apellido }}
	                									</a>
	                								</td>
	                								@if($c->created_at != null)
	                									<td>{{ date_format( $c->created_at, 'd/m/Y H:i:s' ) }}</td>
	                								@else
	                									<td></td>
	                								@endif
	                							</tr>
	                						@endforeach
	                					</tbody>
	                				</table>
	                			</div>
                			</div>
							<div class="col-md-5 col-md-offset-2">                				

                			</div>
						</div>
					</div>
				</div>
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
