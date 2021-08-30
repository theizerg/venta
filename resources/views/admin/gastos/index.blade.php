@extends('layouts.admin')
@section('title', 'Gastos')
@section('content')
<div class="container">
	<div class="row">   
	<div class="form-group">
		
			<a href="/gastos/create" class="btn blue darken-4 text-white ml-1"><i class="fas fa-plus-square"></i> Registrar gastos</a>
		
	</div> 
		<div class="col-md-12">
			<div class="card">
				<div class="card-primary card-outline card-header">
					<h4>Vista general de los gastos.</h4>
				</div>
				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/gastos" class="link_ruta">
								Gastos
							</a>
						</li>						
					</ul><br>			
					<div class="table-responsive">
						<table  cellspacing="0" class="table table-hover table-border display ">
							<thead>
							<tr>
								<th class="text-center">ID</th>	
                                <th class="text-center">Gasto por:</th>
                                <th  class="text-center">Monto</th>
                                <th  class="text-center">Fecha</th>
                                <th class="text-center">Descripción</th>                                
							</tr>
							</thead>
							<tbody>

							@foreach($gastos as $pago)
							<tr class="text-center">
                                <td width ="10px">{{ $pago->id  }}</td>		
                                <td width ="120px">{{ $pago->tipogastos->nombre  }}  </td>                            	
                                <td width ="100px">${{ $pago->cantidad }}</td>
                                <td width ="120px">{{ date('d / m / Y', strtotime($pago->fecha)) }}</td>
                                <td width ="500px">{{ $pago->descripcion }}</td>

            
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
