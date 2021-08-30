@extends('layouts.admin')
@section('title', 'Desgloce de ganacias')
@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class="card-header">
					<h4>Desgloce de ganancias obtenidas por productos vendidos</h4>
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
								Desgloce de ganacias
							</a>
						</li>						
					</ul><br>
			
					<div class="table-responsive">
						<table id="example" class="table table-hover table-border">
							<thead>
							<tr>
								<th >ID</th>	
								<th >Producto</th>
								<th >Inversión </th>
								<th >Ganancia por venta</th>
								<th >Cantidad vendida</th>
                                <th >Descripcion</th>
								
                                <th >Fecha</th>
							</tr>
							</thead>
							<tbody>

							@foreach($venta_detalle_1 as $historial)
							<tr >
                                <td>{{$historial->id}}</td>		
                                <td>{{$historial->producto->nombre}}</td>
                                <td>${{$historial->producto->precio_compra }}</td>
                                <td>${{str_replace(',', '.', $historial->total) - str_replace(',', '.',$historial->producto->precio_compra) }}</td>
                                <td>{{$historial->cantidad}}</td>
                                <td>{{$historial->descripcion}}</td>
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

