@extends('layouts.admin')
@section('title', 'Historial')
@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class=" card-header">
					<h4>Vista general del historial de las cajas</h4>
				</div>
				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/historial" class="link_ruta">
								Historial
							</a>
						</li>						
					</ul><br>
			
					<div class="table-responsive">
						<table id="example" class="table table-hover table-border display">
							<thead>
							<tr>
								<th >ID</th>	
                                <th >Descripcion</th>
								<th >Vendedor</th>
                                <th  >N° Caja</th>
                                <th  >Fecha</th>
							</tr>
							</thead>
							<tbody>

							@foreach($historiales as $historial)
							<tr >
                                <td>{{$historial->id}}</td>		
                                <td>{{$historial->descripcion}}</td>
                                <td>{{$historial->usuario->display_name}}</td>
                                <td>{{$historial->caja_id}}</td>
                                <td>{{$historial->fecha}}</td>	
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
