@extends('layouts.admin')
@section('title', 'Ventas')
@push('scripts')		
	<script type="text/javascript">
		var buscar_cliente_url = "{{ url('clientes/buscar?texto=') }}";
		var buscar_prodcto_url = "{{ url('productos/buscar?texto=') }}";
		var comprobante_vistaprevia_url = "{{ url('comprobantes/vistaPrevia') }}";
		var buscar_proveedor_url = "{{ url('proveedores/buscar?texto=') }}";
	</script>
	<script src="{{ asset('js/forms/compras.js') }}"></script>
	<script>
		     
		$(document).ready(function (){
		   
		    //Define la cantidad de numeros aleatorios.
		var cantidadNumeros = 8;
		var myArray = []
		while(myArray.length < cantidadNumeros ){
		  var numeroAleatorio = Math.ceil(Math.random()*cantidadNumeros);
		  var existe = false;
		  for(var i=0;i<myArray.length;i++){
		    if(myArray [i] == numeroAleatorio){
		        existe = true;
		        break;
		    }
		  }
		  if(!existe){
		    myArray[myArray.length] = numeroAleatorio;
		  }

		}
		$('#txtNumeroComprobante').val(myArray.join(""));
		  });
</script>
@endpush

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class="card-header">
				<h4>Ingreso de venta</h4> 
				
				</div>                
				<div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/comprobantes" class="link_ruta">
								Listado de ventas &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/comprobantes/nuevo" class="link_ruta">
								Nuevo
							</a>
						</li>						
					</ul>
					
					
					<form id="formNuevoComprobante" action="/compras/guardar" method="post">
					{{ csrf_field() }}
						<div class="modal fade" id="modalDescripcion" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<legend>Agregar información</legend>
									</div>

									<input type="hidden" name="usuario_id" id="usuario_id" value="{{Auth::user()->id}}">

									<div class="modal-body">
										<div class="form-group">
											<input maxlength="60" class="form-control" type="text" name="descripcion_1" placeholder="Línea 1">
											<input maxlength="60" class="form-control" type="text" name="descripcion_2" placeholder="Línea 2">
											<input maxlength="60" class="form-control" type="text" name="descripcion_3" placeholder="Línea 3">
										</div>
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-block blue darken-4 text-white" data-dismiss="modal">Confirmar</button>
									</div>        
								</div>
							</div>
						</div>
						<input id="hiddenListado" type="hidden" name="listadoArticulos">
						<div class="row">
							<div class="col-md-12"><br>
								<fieldset>
									<div class="row">
										<div class="form-group col-md-4">
									
										<label  for="txtFecha">Fecha de emisión</label>
										<input id="txtFecha" type="date" name="fecha_emision" class="form-control input-sm">
									</div><br><br>
										<div class="form-group col-md-4">
										<label  for="selectTipoComprobante">Tipo de compra</label>
										<select id="selectTipoComprobante" name="tipo_comprobante" class="form-control input-sm" tabindex="2">
											@foreach($tipos_compras as $t)
												<option value="{{$t->id}}">{{$t->name}}</option>
											@endforeach											
										</select>
									</div>
									<div class="form-group col-md-4 form_venta_contado form_factura_credito form_devolucion_contado">
										<label  for="txtSerieComprobante">Serie</label>
										<input name="serie" type="text" class="form-control input-sm" id="txtSerieComprobante" placeholder="Serie" tabindex="2" value="01">
									</div>
									<div class="form-group col-md-4 form_venta_contado form_factura_credito form_devolucion_contado">
										<label  for="txtSerieComprobante">Cotización</label>
										<input name="cotizacion" type="text" class="form-control input-sm" id="txtSerieComprobante" placeholder="Cotización del dólar">
									</div>
									<div class="form-group col-md-4 form_venta_contado form_factura_credito form_devolucion_contado">
										<label  for="txtNumeroComprobante">Número de factura</label>
										<input name="numero" type="text" class="form-control input-sm" id="txtNumeroComprobante" placeholder="N° de Comprobante" tabindex="3">
									</div>
										<div class="form-group col-md-4 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<label  for="txtMoneda">Moneda</label>
										<select name="moneda" class="form-control input-sm" tabindex="4">
											@foreach($monedas as $moneda)
													<option value="{{$moneda->id}}" selected="true">{{$moneda->nombre}} ({{$moneda->simbolo}})</option>
											@endforeach
										</select>
									</div>
									
                
									<div class="form-group col-md-6">		
			          				 <label class="mt-1">Sucursal</label>
                  					{!! Form::select('sucursal_id', $sucursales, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione la sucursal','id'=>'sucursal_id')) !!} 
                					  </div>
                					  <div class="col-sm-6">
										 <label class="mt-1">Tipo de pago</label>
                 						 {!! Form::select('tipo_pago_id', $tipo, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione el tipo de pago','id'=>'tipo_pago_id')) !!} 
                 						 </div>
									</div>
									
								
									<br>
									
										<!-- CLIENTE -->
									
									<!-- PROVEEDOR -->
														

									<div class="row">
										<legend for="txtCliente" class="text-center ">Datos del proveedor</legend>
										<div class="form-group col-md-4 form_venta_contado  form_factura_credito form_venta_cliente form_devolucion_contado">
										
										<label  for="txtCliente ">Nombre o razón social</label>
										<div class="input-group">
											<input id="hiddenCliente" type="hidden" name="proveedor_id">
											<input name="cliente" type="text" class="form-control input-sm" id="txtCliente" placeholder="Nombre o razón social">
											<div class="input-group-btn">
											<button id="btnAgregarCliente" class="btn blue darken-4 text-white btn-md" data-toggle="modal" data-target="#modalAgregarCliente">
													<i class="fas fa-address-book"></i>
												</button>
											</div>
										</div>
									</div>

										<div class="form-group col-md-4 form_venta_contado form_venta_cliente form_factura_credito form_devolucion_contado">
										<label  for="txtDireccion">Dirección</label>
										<input name="direccion" type="text" class="form-control input-sm" id="txtDireccion" placeholder="Dirección" tabindex="7">
									</div>
									<div class="form-group col-md-4 form_venta_contado  form_venta_cliente form_factura_credito form_devolucion_contado form_compra_contado">
										<label  for="txtRif">RIF</label>
										<input name="rif" type="text" class="form-control input-sm" id="txtRif" placeholder="RIF" tabindex="8">
									</div>
									</div>

									<!-- DATOS DE FACTURA -->
									<div class="row">
										<legend class="form_factura_credito text-center">Datos de la factura</legend>
										<div class="form-group col-md-4 form_factura_credito">
										
										<label for="txtFechaVencimiento">Vencimiento</label>
										<input class="form-control input-sm factura-required" type="date" name="fecha_vencimiento" placeholder="Vencimiento de la factura">
									</div>
									<div class="form-group col-md-4 form_factura_credito">
										<label >Plazo</label>
										<input class="form-control input-sm" type="number" name="plazo" placeholder="Plazo (en días)">
									</div>
									<div class="form-group col-md-4 form_factura_credito">
										<label >Pago inicial</label>
										<input class="form-control input-sm" type="number" name="pago_inicial" placeholder="Pago inicial">
									</div>

									</div>

									
								</fieldset>
							</div>
							
							<div class="col-md-12 ">
								<fieldset>
									<legend>
									<div class="row container form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<div class="col-md-6">
											Buscar artículos
										</div>
										<div class="col-sm-12">
											<div class="input-group float-right">
												<form>
													<input type="text" class="form-control input-sm" id="txtAgregarArticulo" list="listaBusquedaProducto" placeholder="Agregar un artículo..." onkeydown="if (event.keyCode == 13) return false;" tabindex="1">
													<div class="input-group-btn">
														<button id="btnAgregarArticulo" class="btn blue darken-4 text-white btn-md mb-2">
															<i class="fa fa-cart-plus" aria-hidden="true"></i>
														</button>
													</div>
												</form>
											</div>
										</div>
					
										
										 
										<datalist id="listaBusquedaProducto">
											<!--
											<option value="a"/>
											<option value="b"/>
											<option value="c"/>
											-->
										</datalist>
									</div>
									</legend>
									<div class="col-md-12 pre-scrollable div-detalle-comprobante form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<table width="100%" class="table table-responsive table-hover">
											<thead>
												<tr>
													<th class="text-center" width="100px">Código</th>
													<th class="text-center">Artículo</th>
													<th class="text-center" width="200px">Precio</th>
													<th class="text-center" width="200px">Cantidad</th>
													<th class="text-center" width="200px">Subtotal</th>
													<th class="text-center" width="200px">Total</th>
													<th class="text-center" width="200px"></th>
												</tr>
											</thead> 
											<tbody id="tablaProductos">
												
											</tbody>
										</table><br><br><br><br><br>	
									
									<div class="col-md-12 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<table class="table-condensed float-right table-striped">
											<thead id="tablaResumen">
												
											</thead>
										</table>
									</div>		
									<div class="col-md-6 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<button id="btnGuardarComprobante" class="btn btn-block text-white blue darken-4" tabindex="9">
											<i class="ti ti-check mr-3"></i>
											Confirmar
										</button>
									</div>
								</fieldset>                                
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal  fade" id="modalAgregarPorducto" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<legend>Agregar artículo</legend>
			</div>

			<div class="modal-body">
				
			</div>

			<div class="modal-footer">
				
			</div>        
		</div>
	</div>
</div>

<div class="modal fade" id="modalAgregarCliente" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Buscar proveedor
					<span class="float-right">
						<a class="btn btn-success btn-sm ml-5" href="/proveedores/nuevo" target="_blank" >
							<i class="fa fa-user-plus" aria-hidden="true"></i>
						</a>
					</span>
				</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label >Buscar proveedor</label>
						<div class="row">
							<div class="col-md-10">
								<input id="txtBuscadorCliente" class="form-control" type="text" name="BuscadorCliente" placeholder="Buscar proveedor...">
							</div> 
							<div class="col-md-2">
								<button id="btnBuscarCliente" type="submit" class="btn btn-primary btn-block">
									<i class="fa fa-search" aria-hidden="true"></i>									
								</button>
							</div>
						</div>						
						<hr/>
						<table width="100%" class="table table-responsive table-hover">
							<thead>
								<tr>
									<th width="5%">ID</th>
									<th width="20%">Nombre / Razón Social</th>
									<th width="20%">RIF</th>
									<th width="20%">Mail</th>
									<th width="20%">Dirección</th>
									<th width="5%"></th>
								</tr>
							</thead>
							<tbody id="tablaClientes">
								
							</tbody>
						</table>						
					</div>
				</form>
			</div>

			<div class="modal-footer">				
				<button id="btnOkModalAgregarCliente" class="btn btn-block btn-primary" data-dismiss="modal">
					Confirmar
				</button>
			</div>
		</div>
	</div>
</div>

@endsection
