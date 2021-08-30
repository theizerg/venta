@extends('layouts.admin')
@section('title', 'Pagos')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-line-primary ">
				<div class=" card-header">
					<h4>Creación de pagos de empleados</h4>
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
								Pagos &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/empleado/pagos/create" class="link_ruta">
								Nuevo
							</a>
						</li>
					</ul><br>
					<div class="row">
						<div class="container row">
							<div class="col-md-12 col-md-offset-0">
								<form method="post" action="{{route('pagos.store')}}" id="empleados_form">
									{{ csrf_field() }}
									<div class="form-group row">
                                     
                                    @include('admin.pagos.partials.nuevo')

					                <div class="col-md-12"> <br>
					                  <button type="submit" class="btn btn-block btn-primary">Guardar</button>
					                </div>
								</form>
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



<script type="text/javascript">
      
$(document).ready(function() {

		

     form = $('#empleados_form');
     $("#nu_cantidad_tipo_pago").hide();
     $(".monto_empleado").hide();
     $('#nu_cantidad_tipo_pago').val(0);
     $('#tipo_pago').on("change", function(e) { //asigno el evento change u otro
    if ( $("#tipo_pago").val() == 1)
	    {
	      $("#nu_cantidad_tipo_pago").show();
          $(".monto_empleado").show();


	    }
	else if( $("#tipo_pago").val() == 2)
	{
          $("#nu_cantidad_tipo_pago").show();
          $(".monto_empleado").show();
          $('#nu_cantidad_tipo_pago').val(0);
	}

	else if( $("#tipo_pago").val() == 3)
	{
	      $("#nu_cantidad_tipo_pago").show();
          $(".monto_empleado").show();

	}

	else if( $("#tipo_pago").val() == 4)
	{
	      $("#nu_cantidad_tipo_pago").show();
          $(".monto_empleado").show();

	}




    });



    });
   


</script>

   

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




