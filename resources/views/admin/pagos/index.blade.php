@extends('layouts.admin')
@section('title', 'Pagos')
@section('content')
<div class="container">
	<div class="row">
		<div class="btn-group">
			<span class="float-right">
					<a href="/empleado/pagos/create" class="btn blue darken-4 text-white"> <i class="fas fa-plus-square"></i> Nuevo pago</a>	
			</span>
		</div>
	</div><br>
	<div class="row">    
		<div class="col-md-12">
			<div class="card card-line-primary ">
				<div class=" card-header">
					<h4>Vista general del historial de pagos a los empleados</h4>
				</div>
				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/empleado/pagos" class="link_ruta">
								Pagos
							</a>
						</li>						
					</ul><br>				
					<div class="table-responsive">
						<table id="example" cellspacing="0" class="table table-hover table-border">
							<thead>
							<tr>
								<th class="text-center">ID</th>	
                                <th class="text-center">Empleado</th>
                                <th class="text-center">Sueldo base</th>
								<th class="text-center">Tipo de pago</th>
                                <th  class="text-center">Modo de cobro</th>
                                <th  class="text-center">Monto</th>
                                <th  class="text-center">Fecha</th>
                                <th class="text-center">Total</th>
                                <th class="text-center" colspan="3">Opciones</th>
                                
							</tr>
							</thead>
							<tbody>

							@foreach($pagos as $pago)
							<tr class="text-center">
                                <td>{{ $pago->id  }}</td>		
                                <td>{{ $pago->empleado->nb_nombre  }}  </td>
                                <td>${{ $pago->empleado->sueldo_base }}</td>
                                <td>{{ $pago->tipopago->nb_tipo_pago_empleado}}</td>
                                <td>{{ $pago->empleado->modopago->nb_modo_pago}}</td>	
                                <td>${{ $pago->total   }}</td>
                                <td>{{ date('d / m / Y', strtotime($pago->fecha)) }}</td>
                                @if ($pago->tipo_pago_empleado_id == 1 )
                                	<td>${{ $pago->total + $pago->empleado->sueldo_base }}</td>
                                @elseif($pago->tipo_pago_empleado_id == 2)	
                                	<td>${{ $pago->total }}</td>
                                @elseif($pago->tipo_pago_empleado_id == 3)	
                                	<td>${{ $pago->nu_cantidad_tipo_pago - $pago->empleado->sueldo_base }}</td>
                                 @elseif($pago->tipo_pago_empleado_id == 4)	
                                	<td>${{ $pago->total }}</td>
                                @endif
                               
                                <td>
                                	<div class="dropdown">
				                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                       <i class="fas fa-cogs"></i>&nbsp Opciones
				                      </button>
				                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				                        <li>
				                        	{!! Form::open(['route' => ['pagos.destroy', $pago->id], 'method' => 'DELETE', 'class' => 'form-borrar' ]) !!}
				                        	<button class="dropdown-item" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i> Eliminar pago</button>

                             
                                         {!! Form::close() !!}
				                        </li>
				                       
				                        <li>
				                        	<a class="dropdown-item" href="{{ url('empleado/pagos', [$pago->id, 'edit']) }}"><i class="fa fa-edit"></i> Editar Pago</a>
				                        </li>

				                        <li>
				                        	<a class="dropdown-item" href="{{ url('pagos/empleado', [$pago->id, 'imprimir']) }}"><i class="fa fa-print"></i> Imprimir</a>
				                        </li>
				                      </div>
				                    </div>
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
	@include('partials.mensajes');
</div>

@endsection
