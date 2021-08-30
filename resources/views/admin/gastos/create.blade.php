@extends('layouts.admin')
@section('title', 'Gastos')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-primary card-outline card-header">
					<h4>Registro de gastos</h4>
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
								Gastos &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/gastos/nuevo" class="link_ruta">
								Nuevo
							</a>
						</li>
					</ul><br> 
				
					<div class="row">
						
							<div class="col-md-4">
								<legend>Registro de gastos</legend>
								<form id="form_nuevo_producto" role="form" method="POST" action="{{route('gastos.store')}} ">
									{{ csrf_field() }}
									
										@include('admin.gastos.partials.nuevo')							
									<br>
									<div class="form-group text-center">
										<input type="submit" class="btn btn-primary btn-block" value="Guardar">
									</div>		                    		
								</form>   

							</div>
		
							<div class="col-md-8">
								<legend>Últimos gastos registrados</legend>
								<div class="table-responsive">
									<table id="example" class="table table-bordered table-hover display">
						                <thead>
						                <tr>
						                   <th>#</th>	
							               <th class="text-center">Gasto por:</th>
							               <th  class="text-center">Monto</th>
							               <th  class="text-center">Fecha</th>                              
						                </tr>
						              </thead>
						                @foreach ($gastos as $p)
						                <tr>
							               <td>{{$p->id}} </td>
							               <td>{{ $p->tipogastos->nombre}}</td>
							               <td>${{ $p->cantidad }}</td>
							               <td class="text-center">{{ $p->fecha}}</td>
						                </tr>
						                @endforeach
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
@endsection

@push('scripts')
 <script>
    $(document).ready(function (){
	var fechaEmision = new Date();
	var day = ("0" + fechaEmision.getDate()).slice(-2);
	var month = ("0" + (fechaEmision.getMonth() + 1)).slice(-2);
	fecha = fechaEmision.getFullYear()+"-"+(month)+"-"+(day);
	$("#fecha").val(fecha);
	     });
    </script>

@endpush