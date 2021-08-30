@extends('layouts.admin')
@section('title', 'Clientes')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<span >
				<a class="btn btn-md blue darken-4 text-white" href="/clientes/nuevo" class="btn btn-link">
					<i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo cliente
				</a>
			</span>
		</div>
	</div><br>
	<div class="row">    
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class=" card-header">
					<h4>Vista general de clientes</h4>
				</div>
				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/clientes" class="link_ruta">
								Clientes
							</a>
						</li>						
					</ul><br>
					<div class="table-responsive">
						<table id="example1" cellspacing="0" width="100%" class="table table-hover display">
							<thead>
								<tr>
								<th  class="text-center" colspan="2">ID</th>	
								<th  class="text-center">Nombre</th>
								<th  class="text-center">Dirección</th>
								<th  class="text-center">Teléfono</th>
								<th  class="text-center">E-Mail</th>
								<th  class="text-center">Saldo</th>
							</tr>
							</thead>
							<tbody>
								@foreach($clientes as $cliente)
							<tr class="text-center">
								<td>{{$cliente->id}}</td>								
								@if($cliente->empresa)
								<td>
									<i style="width: 20px;" class="fa fa-briefcase text-center" aria-hidden="true"></i>
								</td>
								<td>
									<a href="/clientes/detalle/{{$cliente->id}}">
										{{$cliente->nombre}}
									</a>
								</td>
								@else
								<td width="40px">
									<i style="width: 20px;" class="fa fa-user text-center" aria-hidden="true"></i>
								</td>
								<td>
									<a href="/clientes/detalle/{{$cliente->id}}">		
										{{$cliente->nombre}} {{$cliente->apellido}}
									</a>
								</td>
								@endif								
								<td>{{$cliente->direccion}}</td>
								<td>{{$cliente->telefono}}</td>								
								<td>{{$cliente->mail}}</td>
								<td class="text-center">
									{{ App\Models\Moneda::find(2)->simbolo }}
									{{ $cliente->getSaldo() }}
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

@endsection
