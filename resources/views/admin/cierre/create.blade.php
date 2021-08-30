@extends('layouts.admin')
@section('title', 'Cierre de caja')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary ">
				<div class=" card-outline card-header">
					<h4>Cierre de caja</h4>
				</div>

				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/cierre" class="link_ruta">
								Cierre de caja &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/cierre/create" class="link_ruta">
								Nuevo
							</a>
						</li>
					</ul><br>
					<div class="row">
						<div class="container row">
							<div class="col-md-12 col-md-offset-0">
								<legend>Datos para el cierre de la caja</legend><br>
								<form method="post" action="{{route('cierre.store')}}">
									{{ csrf_field() }}
									<div class="form-group row">
                                     
                                        <div class="col-md-4">
                                            <label class="sr-only">N° de caja</label><br>
                                            <input class="form-control" type="text"  id="caja_id"  name="caja_id" placeholder="Cantidad de efectivo en caja" required="true" oninvalid="this.setCustomValidity('Debe ingresar la cantidad de efectivo en caja.')" oninput="setCustomValidity('')" value="1">
                                        </div>
									
									<div class="col-md-4">
										<label class="sr-only"></label><br>
                                        <input class="form-control" type="text"  id="nu_cantidad_efectivo"  name="nu_cantidad_efectivo" placeholder="Cantidad de efectivo en caja" required="true" oninvalid="this.setCustomValidity('Debe ingresar la cantidad de efectivo en caja.')" oninput="setCustomValidity('')">
									</div>

									<div class="col-md-4">
										<br>
										<input class="form-control" type="text" name="nu_cantidad_punto_venta" id="nu_cantidad_punto_venta" placeholder="Cantidad de dinero en punto de venta" required="true" oninvalid="this.setCustomValidity('Debe ingresar la cantidad de dinero en punto de venta.')" oninput="setCustomValidity('')">
									</div>
									<div class="col-md-4">
										<br>
										<input class="form-control" type="text" id="nu_cantidad_dolares" name="nu_cantidad_dolares" placeholder="Cantidad de dólares en efectivo en caja" required="true" oninvalid="this.setCustomValidity('Debe ingresar la cantidad de efectivo en dolares que posee en caja.')" oninput="setCustomValidity('')">
									</div>
									<div class="col-md-4">
										<br>
										<input class="form-control" type="text" name="nu_cantidad_transferencias" id="nu_cantidad_transferencias" placeholder="Cantidad de dinero por concepto de transferencias" required="true" oninvalid="this.setCustomValidity('Debe ingresar la cantidad de dinero por concepto de transferencia.')" oninput="setCustomValidity('')">
									</div>

									<div class="col-md-4">
										<br>
										<input class="form-control" type="text" name="nu_cantidad_pago_movil" id="nu_cantidad_pago_movil" placeholder="Cantidad de dinero ingresado por concepto de pago móvil" required="true" oninvalid="this.setCustomValidity('Debe ingresar la cantidad de dinero por concepto de pago móvil.')" oninput="setCustomValidity('')">
									</div>
									<div class="col-md-4">	
                                      
                                        <div class="checkbox icheck">  <br>
                                          <label>
                                            <input type="radio" name="status" id="status" value="0" checked> Cerrar Caja&nbsp;&nbsp;
                                          </label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="usuario_id" id="usuario_id" value="{{ Auth::user()->id}}">
									<div class="col-md-4">
                                        <label class="sr-only" for="txtFecha">Fecha de emisión</label><br>
                                        <input id="txtFecha" type="date" name="fecha_cierre" class="form-control input-sm" title="Fecha del recibo">
									</div>
                                   
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
    $(document).ready(function (){
	var fechaEmision = new Date();
	var day = ("0" + fechaEmision.getDate()).slice(-2);
	var month = ("0" + (fechaEmision.getMonth() + 1)).slice(-2);
	fecha = fechaEmision.getFullYear()+"-"+(month)+"-"+(day);
	$("#txtFecha").val(fecha);
	     });
    </script>
@endpush

