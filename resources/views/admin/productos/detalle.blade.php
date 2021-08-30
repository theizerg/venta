@extends('layouts.admin')
@section('title', 'Productos')
@section('content')
<div class="container">
	<div class="row">
		@can('RegistraProducto')
		<div class="col-sm-6">
			<span class="float-left">
				<a class="btn btn-md blue darken-4 text-white" href="/productos/nuevo" class="btn btn-link">
					<i class="fas fa-plus" aria-hidden="true"></i> Nuevo producto
				</a>
			</span>
		</div>
		@endcan
	</div><br>
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary ">
				<div class="card-outline card-header">
					<h4>Detalle de producto</h4>
				</div>
				<div class="card-body">
					
					<ul class="list-inline">
						 <li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						 <li class="list-inline-item">
							<a href="/productos" class="link_ruta">
								Productos &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						 <li class="list-inline-item">
							<a href="/productos/detalle/{{$producto->codigo}}" class="link_ruta">
								{{ $producto->nombre }}
							</a>
						</li>
					</ul><br>
					
					<div class="row">
							<div class="col-md-4">
								<legend>
									Detalle del producto
									@can('RegistraProducto')
									<span class="float-right">
										<a class="btn btn-link btn-sm" id="editCodigo" data-toggle="modal" data-target="#modalEditarProducto">
											<i class="fas fa-edit fa-lg" aria-hidden="true"></i>
										</a>
									</span>
									@endcan
								</legend>								
								<div class="form-group">
									<table class="table table-condensed table-striped table-bordered" width="100%">
										<tr>
											<th class="text-center th-b" colspan="2">Información general</th>
										</tr>
										<tr>
											<td width="30%">Código</td>
											<td width="70%">
												{{ $producto->codigo }}
											</td>
										</tr>
										<tr>
											<td>Nombre</td>
											<td> 
												{{ $producto->nombre }}
											</td>
										</tr>
										<tr>
											<td>Cod. barras</td>
											<td> 
												{{ $producto->codigo_de_barras }}
											</td>												
										</tr>
										<tr>
											<td>Familia</td>
											<td> 
												{{ $producto->familia->nombre }}
											</td>
										</tr>
										<tr>
											<td>Impuesto</td>
											<td> 
												{{ $producto->iva->tasa }}%
											</td>
										</tr>
										<tr>
											<td>Descripción</td>
											 													
											<td title="{{$producto->descripcion}}">
														@if(strlen($producto->descripcion) > 20)
															{{ substr($producto->descripcion, 0, 20) . "..."}}
														@else
															{{ $producto->descripcion }}
														@endif
											   </td>
												
												
											
										</tr>
										<tr>
											<td>Precio de compra</td>
											<td>
												<!-- Se obtiene moneda predeterinada --> 
												{{ App\Models\Moneda::find(2)->simbolo }}{{ $producto->precio_compra }}
												
											</td>												
										</tr>

										<tr>
											<td>Precio venta</td>
											<td>
												<!-- Se obtiene moneda predeterinada --> 
												{{ App\Models\Moneda::find(2)->simbolo }}{{ $producto->precio }}
												<span class="float-right">
													<a href="#formStock" class="btn btn-sm" id="{{$producto->codigo}}" data-toggle="modal" data-target="#modalHistoricoPrecios" onclick='$("#form_stock").attr("action", "/productos/{{$producto->codigo}}/ModificarStock");'  title="Histórico de precios de venta para este producto">
														<i class="fas fa-book" aria-hidden="true"></i>
													</a>
												</span>
											</td>												
										</tr>
										
										
									
										<tr>
											<td>Stock</td>
											<td> 
												{{ $producto->stock }}
												<span class="float-right">
													<a href="#formStock" class="btn btn-sm" id="{{$producto->codigo}}" data-toggle="modal" data-target="#formStock" onclick='$("#form_stock").attr("action", "/productos/{{$producto->codigo}}/ModificarStock");' title="Realizar un movimiento de stock">
														<i class="fas fa-exchange-alt" aria-hidden="true"></i>
													</a>
												</span>
											</td>
										</tr>
										<tr>
											<td>Sucursal</td>
											<td> 
												{{ $producto->sucursal->nombre }}

											</td>
										</tr>
									</table>
								</div>								
								@include('partials.movimiento_stock')
							</div>


							<div class="col-md-8">
								<legend>Últimos movimientos</legend>
								<div class="col-md-12">
									<div class="table-responsive ">
										<table class="table table-condensed table-striped table-bordered">
											<thead>
												<tr>
													<th class="text-center" width="70px">Fecha</th>
													<th class="text-center" width="70px">Hora</th>
													<th class="text-center" width="40px">Cant.</th>
													<th class="text-center">Descripción</th>
													<th class="text-center">Comprobante</th>
													<th class="text-center" width="75px">Vendedor</th>
												</tr>
											</thead>
											<tbody>
												@foreach($movimientos->sortByDesc('fecha') as $m)
													<tr>
														<td>{{ date_format( date_create($m->fecha), 'd/m/Y' ) }}</td>
														<td>{{ date_format( date_create($m->fecha), 'H:i:s' ) }}</td>
														<td align="center">{{ $m->cantidad}}</td>
														<td title="{{$m->descripcion}}">
															@if(strlen($m->descripcion) > 36)
																{{ substr($m->descripcion, 0, 36) . "..."}}
															@else
																{{ $m->descripcion }}
															@endif
														</td>
														<td class="text-center">
															@if($m->comprobante_id)
																<a href="/comprobantes/detalle/{{$m->comprobante_id}}">
																	{{ $m->comprobante->tipo->nombre }}
																</a>
															@else
																-
															@endif
														</td>
														<td class="text-center">{{$m->usuario->name}}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
									
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<legend>Configuración del producto <i class="fa fa-cogs" aria-hidden="true"></i></legend>
								<div class="col-md-8">
									<form class="form-horizontal" role="form" method="POST" action="/productos/{{$producto->codigo}}/configuracion">
									{{ csrf_field() }}
										<div class="form-group">
											<h4>Notificaciones</h4> <small>	Recibe una notificación cuando el stock del producto sea menor o igual al especificado.</small>
											<div class="table">
												<table width="100%" class=" table">
													<tr>
														<th width="120px">
															Stock mínimo
														</th>
														<th width="700px">
															<input class="form-control" type="number" name="stockMinimo" value="{{ $producto->stock_minimo_valor }}" id="txtStockMinimo">
														</th>
														<td>
														
														</td>
														<td  class="text-center">
															@if( $producto->stock_minimo_notificar )
																<input type="hidden" id="activado" value="true">
																<span class="badge badge-success" >Activado</span>
																<a href="/productos/{{$producto->codigo}}/NotifStockMin">Desactivar</a>
															@else
																
																<span class="badge badge-danger">Desactivado</span>
																<a href="/productos/{{$producto->codigo}}/NotifStockMin">Activar</a>
															@endif
														</td>
													</tr>												
												</table>
											</div>
										</div>
										<div class="form-group">
											<input class="btn blue darken-4 text-white" type="submit" value="Guardar configuración">
										</div>
									</form>
								</div>
								<div class="col-md-3 col-md-offset-1">
									<div class="form-group">
										<form id="form-borrar" class="form-horizontal" role="form" method="POST" action="/productos/borrar">
											{{ csrf_field() }}
											<input type="hidden" name="producto_id" value="{{$producto->id}}">
											<h4>Eliminar producto</h4>
											<p><small>El producto no se mostrará más luego de ser borrado. Pero se mantendrá su registro histórico.</small></p>
											<input class="btn btn-danger" type="submit" name="" value="Borrar producto">
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>    
</div>
<div class="modal fade" id="modalEditarProducto" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Editar datos del producto
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<form id="form_editar_producto" class="form-horizontal" role="form" method="POST" action="/productos/editar">
						{{ csrf_field() }}
							<input type="hidden" name="producto_id" value="{{$producto->id}}">
							<div class="form-group">
								<table class="table table-condensed table-striped table-bordered" width="100%">
									<tr>
										<th width="30%">Código</th>
										<td width="70%">									
											<input id="txtCodigo" type="text" class="form-control input-sm" name="codigo" placeholder="Código del producto" value="{{$producto->codigo}}" hidden="true" required>
										</td>										
									</tr>
									<tr>
										<th>Nombre</th>
										<td>
											<input id="txtNombre" type="text" class="form-control input-sm" name="nombre" placeholder="Nombre del producto" value="{{$producto->nombre}}" required>
										</td>
										
									</tr>
									<tr>
										<th>Código de barras</th>
										<td>
											<input id="txtCodigoDeBarras" type="text" class="form-control input-sm" name="codigo_de_barras" placeholder="Codigo de barras del producto" value="{{$producto->codigo_de_barras}}" >
										</td>
										
									</tr>
									<tr>
										<th>Categoría</th>
										<td>
											<select id="selectFamiliaProducto" class="form-control" name="familia_producto">
												@foreach( $familias_producto as $f)
													@if($f->id == $producto->familia->id)
														<option value="{{ $f->id}}" selected="true">{{ $f->nombre }}</option>
													@else
														<option value="{{ $f->id}}">{{ $f->nombre }}</option>
													@endif
												@endforeach
											</select>
										</td>
										
									</tr>
									<tr>
										<th>STOCK</th>
										<td>
											<input id="txtCodigoDeBarras" type="text" class="form-control input-sm" name="stock" placeholder="Codigo de barras del producto" value="{{$producto->stock}}" >
										</td>
										
									</tr>
									<tr>
										<th>Descripción</th>
										<td>
											<textarea class="form-control input-sm" id="txtDescripcion" rows="3" placeholder="Descripción del producto" name="descripcion">{{str_replace('<br />','', $producto->descripcion)}}</textarea>
										</td>
										
									</tr>
									<tr>
										<th class="">Precio de compra</th>
										<td>
											<input class="form-control input-sm factura-required" type="text" name="precio_compra" placeholder="Marca del papel" value="{{$producto->precio_compra}} ">
										</td>
									</tr>
									<tr>
										<th>
											Precio de venta ({{ App\Models\Moneda::find(2)->simbolo }}) 
										</th>
										<td>
											<!-- Se obtiene moneda predeterinada -->
											<input id="txtPrecio" class="form-control input-sm" name="precio" placeholder="Precio" value="{{$producto->precio}}">
										</td>										
									</tr>
									<tr>
										<th class="">Sucursal</th>
										<td>
											 {!! Form::select('sucursal_id', $sucursales, null,array('class' => 'form-control input-sm','id'=>'sucursal_id')) !!} 
										</td>
									</tr>
																		
								</table>
								<input type="submit" name="" value="Guardar cambios" class="btn blue darken-4 btn-block text-white">
							</div>					
						</form>
					</div>
				</div>
			</div>

			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalHistoricoPrecios" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Histórico de precios de venta
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Precio ({{App\Models\Moneda::find(2)->simbolo}})</th>
								<th>Usuario</th>
							</tr>
						</thead>
						<tbody>
							@foreach($precios_historico as $p)
							<tr>
								<td>
									{{ date_format( date_create($p->fecha), 'd/m/Y' ) }}								
								</td>
								<td>{{App\Models\Moneda::find(2)->simbolo}} {{ $p->precio }}</td>
								<td>{{ App\Models\User::where('id', $p->usuario_id)->first()->name }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>					
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">	
	$(document).ready(function(){
		$('#form-borrar').on('submit', function(e) {			
			if(! confirm("¿Está seguro de que desea eliminar el producto?")){
				e.preventDefault();
			}
		});
	});

	$("#form_editar_producto").on('submit', function(e){    	
		var precio = $("#txtPrecio").val();
		precio = precio.replace(",", ".");      
		if(isNaN(precio)) {         
			e.preventDefault();
			alert("El precio ingresado no es válido.");
		}
	});
</script>

<script>
	$(document).ready(function() {

		

     form = $('#form_nuevo_producto');
     $(".form_factura_credito").hide();
     $('#nu_cantidad_tipo_pago').val(0);
     $('#selectFamiliaProducto').on("change", function(e) { //asigno el evento change u otro
    if ( $("#selectFamiliaProducto").val() == 2)
	    {
	    	
	      $(".form_factura_credito").show();
          


	    }
	else
	{
          $(".form_factura_credito").hide();
	}



    });



    });
   
</script>
<script type="text/javascript">
	//Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>

@endpush