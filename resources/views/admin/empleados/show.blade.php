@extends('layouts.admin')
@section('title', 'Empleados')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-line-primary card-header">
				<div class=" ">
					<h4>Detalle del empleado</h4>
				</div>
				<div class="card-body">
					<span class="float-right">
						<a class="btn blue darken-4 btn-sm text-white tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Registrar sucursal" href="/empleados/create" >
							<i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo empleado
						</a>
					</span>
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/empleados" class="link_ruta">
								Listado de Empleados &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/empleados/{{$empleado->id}}" class="link_ruta">
								{{$empleado->nb_nombre}} {{$empleado->nb_apellido}}
							</a>
						</li>
					</ul><br>
					
					<div class="row">
						
							<div class="col-md-4">
								<legend>
									Datos del empleado
									<span class="float-right ">
										<a class="btn blue darken-4 btn-sm text-white" id="editCodigo" data-toggle="modal" data-target="#modalEditarCliente">
											<i class="fas fa-edit text-white fa-lg" aria-hidden="true"></i>
											Editar 
										</a>
									</span>
								</legend>								
								<div class="form-group">
									<table class="table table-condensed table-striped table-bordered" width="100%">
										<tr>
											<th class="text-center th-b" colspan="2">Información general</th>
										</tr>
										<tr>
											<td width="30%">Nombres</td>
											<td width="70%">
												{{ $empleado->display_name }}
											</td>												
										</tr>
										<tr>
										<td>
											RUC
										</td>
										<td>
											{{$empleado->nu_cedula}} 
										</td>
									   </tr>
										 <tr>
											<td>
												Fecha de ingreso
											</td>
											<td>
											{{$empleado->fe_ingreso}} 
										</td>										
										 </tr>
										</tr>
										<tr>
											<td>
												Teléfono
											</td>
											<td>
												{{$empleado->telefono}}
											</td>												
										</tr>
										<tr>
											<td>
												Profesión
											</td>
											<td>
												{{$empleado->nb_profesion}}
											</td>												
										</tr>
										<tr>
											<td>
												Fecha de nacimiento
											</td>
											<td>
												{{$empleado->fecha_nacimiento}} ({{ $empleado->edad }} años)
											</td>												
										</tr>
										
											<tr>
												<td>
													Cargo
												</td>
												<td>
													{{$empleado->cargos->nombre}}
												</td>												
											</tr>
										
										<tr>
											<td>
												Sueldo 
											</td>
											<td>
											{{ $empleado->sueldo_base }} {{ $empleado->modopago->nb_modo_pago }}
											</td>
											
										</tr>
										<tr>
											<td>
												Sucursal 
											</td>
											<td>
											{{ $empleado->sucursal->nombre }} ({{ $empleado->sucursal->rif }}) 
											</td>
											
										</tr>
									</table>
								</div>								
							</div><br>
							 <div class="col-md-7 offset-sm-1">
								<legend class="text-center">Actividad del empleado</legend>
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-condensed table-striped table-bordered">
											<thead>
												<tr>
													<th class="text-center" >Fecha</th>
													<th class="text-center" >Tipo de actividad</th>
													<th class="text-center">Descripcion</th>
													
													
												</tr>
											 </thead>
											  <tbody>
												@foreach($trabajador as $c)
													<tr>
														<td>{{ $c->fecha }}</td>
														<td class="text-center">
															{{ $c->tipo_actividad }}
														</td>
														<td>
															{{ $c->descripcion }}
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
	</div>
</div>
<div class="modal fade" id="modalEditarCliente" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Editar datos del Empleado
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						{!! Form::model($empleado, ['route' => ['empleados.update',$empleado->id],'method' => 'PUT']) !!}
							<input type="hidden" name="cliente_id" value="{{$empleado->id}}">
							<div class="form-group">
								<table class="table table-condensed table-striped table-bordered" width="100%">
									<tr>
										<th width="40%">Nombre</th>
											<td width="50%">
												<input class="form-control input-sm" type="text" name="nb_nombre"  value="{{ $empleado->nb_nombre }}" >	
											</td>												
									 </tr>
									<tr>
										<th width="40%">Apellido</th>
										<td width="50%">
											
												<input class="form-control input-sm" type="text" name="nb_apellido"  value="{{ $empleado->nb_apellido }}" >
											
										</td>												
									</tr>
									<tr>
										<th>
											RUC
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="nu_cedula" value="{{$empleado->nu_cedula}}">
										</td>												
									</tr>
									<tr>
										<th>
											Fecha de ingreso
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="fe_ingreso" value="{{$empleado->fe_ingreso}}">
										</td>												
									</tr>
									<tr>
										<th>
											Telefono
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="telefono" value="{{$empleado->telefono}}">
										</td>												
									</tr>
									<tr>
										<th>
											Profesión
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="nb_profesion" value="{{$empleado->nb_profesion}}">
										</td>												
									</tr>
									<tr>
										<th>
											Fecha de nacimiento
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="fecha_nacimiento" value="{{$empleado->fecha_nacimiento}}">
										</td>												
									</tr>
									<tr>
										<th>
											Tipo de cobro
										</th>
										<td>
											 {!! Form::select('modo_pagos_id', $modos, null,array('class' => 'form-control input-sm','placeholder'=>'Tipo de cobro','id'=>'cargo_id')) !!} 
										</td>												
									</tr>
									<tr>
										<th>
											Cargo del empleado
										</th>
										<td>
											 {!! Form::select('cargo_id', $cargos, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione el cargo','id'=>'cargo_id')) !!}    
		      								 
										</td>												
									</tr>
									<tr>
										<th>
											Sueldo base
										</th>
										<td>
											<input class="form-control input-sm" type="text" name="sueldo_base" value="{{$empleado->sueldo_base}}">
										</td>												
									</tr>
									<tr>
										<th>
											Sueldo base
										</th>
										<td>
											 {!! Form::select('sucursal_id', $sucursales, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione el cargo','id'=>'sucursal_id')) !!}
										</td>												
									</tr>
								</table>
								<input type="submit" name="" value="Guardar cambios" class="btn btn-primary btn-block">
							</div>
						{!! Form::close()!!}
					</div>
				</div>
			</div>

			<div class="modal-footer">
				
			</div>        
		</div>
	</div>
</div>
@endsection
