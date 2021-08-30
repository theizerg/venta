@extends('layouts.admin')
@section('title', 'Asignación de trabajo')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="card card-line-primary">
				<div class="card-header">
					<h6>Asignación de actividad a empleado</h6>
				</div>
				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/asignaciones" class="link_ruta">
								Listado de asignación de actividades &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							
								Nuevo
						
			 			</li>
					</ul><br>
					<form method="post" action="/asignacion/guardar" id="asignacion_form" autocomplete="off">
									{{ csrf_field() }}
					<div class="row">
						@include('admin.empleados.partials.asignacion_form')
						
					  </div>
					 </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	 $('#reservationdate').datetimepicker({
        format: 'L'
    });

</script>
  <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

   <script>
	$('#asignacion_form').validate({
    rules: {
      tipo_trabajo: {
        required: true,
        
      },
       descripcion: {
        required: true,
        
      },
     fecha: {
        required: true
      },
    },
    messages: {
      tipo_trabajo: {
        required: "Ingresa el tipo de actividad del empleado"
        
      },
       
      descripcion: {
        required: "Ingresa la descripción de la actividad asignada al empleado"
        
      },
    
    	fecha: {
        required: "Ingresa la fecha en que el empleado realizó la actividad"
        
      }
     
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
</script>
@endpush
