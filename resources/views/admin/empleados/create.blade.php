@extends('layouts.admin')
@section('title', 'Empleados')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class=" card-header">
					<h4>Creación de empleados</h4>
				</div>

				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/empleados" class="link_ruta">
								Empleados &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/empleados/create" class="link_ruta">
								Nuevo
							</a>
			 			</li>
					</ul><br>
					<div class="row">
						<div class="container row">
							<div class="col-md-4 col-md-offset-0">
								<legend>Datos para crear empleados</legend><br>
								<form method="post" action="{{route('empleados.store')}}" autocomplete="off" id="empleados_form">
									{{ csrf_field() }}
									<div class="form-group row">
                                     
                   @include('admin.empleados.partials.nuevo')
								</form>
							</div>
							
							
						</div>
						<div class="col-md-8"><br>
							<legend>Últimos empleados registrados</legend>
							<div class="table-responsive">
								<table width="97%" class="table table-striped table-bordered display">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Fecha de registro</th>
										</tr>	                						
									</thead>
									<tbody>
										@foreach($empleados->sortByDesc('created_at')->take(8) as $c)
											<tr>
												<td>
														{{ $c->nb_nombre }} {{ $c->nb_apellido }}
													
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
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>


</script>

<script>
	$('#empleados_form').validate({
    rules: {
      nb_nombre: {
        required: true,
        
      },
       nb_apellido: {
        required: true,
        
      },
      nu_cedula: {
        required: true,
        number: true,
        minlength: 5
      },
      telefono,
      telefono: {
        required: true
      },
      fecha_nacimiento: {
        required: true
      },
      nb_profesion: {
        required: true
      },
      sueldo_base: {
        required: true,
        number: true
      },
       fe_ingreso: {
        required: true
      },
      modo_pagos_id: {
        required: true
      },
       cargo_id: {
        required: true
      },
    },
    messages: {
      nb_nombre: {
        required: "Ingresa el nombre del empleado"
        
      },
       modo_pagos_id: {
        required: "Ingresa el modo de pago del empleado"
        
      },
      cargo_id: {
        required: "Ingresa el cargo del empleado"
        
      },
      nb_apellido: {
        required: "Ingresa el apellido del empleado"
        
      },
      nu_cedula: {
        required: "Ingresa la cédula del empleado",
        number: "Es un campo numérico",
        minlength: "Your password must be at least 5 characters long"
      },
    	fecha_nacimiento: {
        required: "Ingresa la fecha de nacimiento del empleado"
        
      },
      fe_ingreso: {
        required: "Ingresa la fecha de ingreso del empleado"
        
      },
      nb_profesion: {
        required: "Ingresa la profesión del empleado"
        
      },
      sueldo_base: {
        required: "Ingresa el sueldo base del empleado",
        number: "Es un campo numérico"
        
      },
      codigo_de_barras: {
        required: "Please provide a password",
        number: "Es un campo numérico",
        minlength: "Your password must be at least 5 characters long"
      },
      telefono,
      telefono: "Ingresa el teléfono del empleado."
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

//Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

$('#ingresodate').datetimepicker({
        format: 'L'
    });
 $('[data-mask]').inputmask();
    
</script>
@endpush
 
