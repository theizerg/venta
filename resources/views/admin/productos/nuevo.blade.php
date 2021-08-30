@extends('layouts.admin')
@section('title', 'Productos')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class="card-header">
					<h4>Alta de producto</h4>
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
							<a href="/productos/nuevo" class="link_ruta">
								Nuevo
							</a>
						</li>
					</ul><br> 
				
					<div class="row">
						{!! Form::model(['url' => ['productos/guardar'],'method' => 'POST','enctype'=>'multipart/form-data']) !!}
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
										<div class="form-group">
										<label for="txtCodigo" class="control-label  ">Código</label>
										<input id="txtCodigo" type="text" class="form-control" name="codigo" placeholder="Código de producto"  value="{!! old('codigo') !!}" oninvalid="this.setCustomValidity('Debe ingresar un código para registrar el producto')" required oninput="setCustomValidity('')">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="txtNombre" class="control-label  ">Nombre</label>
										<input id="txtNombre" type="text" class="form-control" name="nombre" placeholder="Nombre de producto" oninvalid="this.setCustomValidity('Debe ingresar un nombre de producto')"  required oninput="setCustomValidity('')">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										@php
										$tipos = App\Models\TipoProducto::pluck('nombre','id')
										@endphp
			           <label class="mt-1">Tipo de producto</label>
                  {!! Form::select('sucursal_id', $tipos, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione la clase de producto','id'=>'sucursal_id')) !!} 
                  </div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="txtCodigoDeBarras" class="control-label  ">
											Marca del producto
										</label>
										<input id="txtMarcaProducto" type="text" class="form-control" name="marca_producto" placeholder="Marca del producto"  value="{!! old('marca_producto') !!}"  >
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="txtCodigoDeBarras" class="control-label  ">
											Código de barras
										</label>
										<input id="txtCodigoDeBarras" type="text" class="form-control" name="codigo_de_barras" placeholder="Código de barras"  value="{!! old('codigo_de_barras') !!}"  >
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="txtNombre" class="control-label   ">
											Categoría del producto
										
										</label>

										<div class="input-group float-right">
											<select id="selectFamiliaProducto" class="form-control " name="familia_producto" required="true">
												<option value="" disabled selected hidden>Categoría</option>
												@foreach( $familias_producto as $f)
													<option value="{{ $f->id}}">{{ $f->nombre }}</option>
												@endforeach
											</select>
											
											<div class="input-group-btn">
												<a href="#formFamiliaProducto" id="btnAgregarArticulo" class="btn btn-default" data-toggle="modal" data-target="#formFamiliaProducto" style="color:green">
													<i class="fa fa-plus-square" aria-hidden="true"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
										<div class="form-group">
										<label >Imágen del producto</label>
										<input class="form-control input-sm" type="file" name="photo" placeholder="Precio de compra">
									</div>
								</div>
								<div class="col-sm-4">
										<div class="form-group  ">
										<label >Precio de compra</label>
										<input class="form-control input-sm" type="text" name="precio_compra" placeholder="Precio de compra">
									</div>
								</div>
								<div class="col-sm-4">
										<div class="form-group">
										<label for="txtPrecio" class="control-label  ">Precio de venta</label>
										<input id="txtPrecio" class="form-control" name="precio" placeholder="Precio de venta en {{App\Models\Moneda::find(1)->simbolo }}">
									</div>
								</div>
								<div class="col-sm-4">
										<div class="form-group">										
										<label for="txtStock" class="control-label  ">Cantidad inicial</label>
										<input id="txtStock" type="text" class="form-control" name="stock" placeholder="Cantidad inicial del producto">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">		
			           <label class="mt-1">Sucursal</label>
                  {!! Form::select('sucursal_id', $sucursales, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione la sucursal','id'=>'sucursal_id')) !!} 
                  </div>
								</div>
								<div class="col-sm-4">
									 <div class="form-group">
                  	<label class="mt-1">¿Producto con garantia?</label>
											<select id="producto_garantia" class="form-control " name="producto_garantia" required="true">
												<option value="" disabled selected hidden>Seleccione</option>
												<option value="1" >Sí</option>
												<option value="0" >No</option>
											
											</select>
											<div class="form-group">										
										<label for="producto_tiempo_garantia" class="control-label producto_tiempo_garantia  ">Tiempo de garantía</label>
										<input id="txtStock" type="text" class="form-control producto_tiempo_garantia" name="producto_tiempo_garantia" placeholder="Stock inicial del producto" value="3 meses">
									</div>
										
										</div>
								</div>
								<div class="col-sm-4">
										<div class="form-group" style="">
										<label for="txtDescripcion" class="control-label  ">Fecha de fabricación</label>
										<input id="txtCodigo" type="date" class="form-control" name="fecha_fabricacion" placeholder="Código de producto"  value="{!! old('codigo') !!}" oninvalid="this.setCustomValidity('Debe ingresar un código para registrar el producto')" required oninput="setCustomValidity('')">
									</div>	
								</div>
								<div class="col-sm-4">
										<div class="form-group" style="">
										<label for="txtDescripcion" class="control-label  ">Fecha de vencimiento</label>
										<input id="txtCodigo" type="date" class="form-control" name="fecha_vencimiento" placeholder="Código de producto"  value="{!! old('codigo') !!}" oninvalid="this.setCustomValidity('Debe ingresar un código para registrar el producto')" required oninput="setCustomValidity('')">
									</div>	
								</div>
								<div class="col-sm-4">
										<div class="form-group" style="">
										<label for="txtDescripcion" class="control-label  ">N° de lote</label>
										<input id="txtCodigo" type="text" class="form-control" name="lote" placeholder="Código de producto"  value="{!! old('codigo') !!}" oninvalid="this.setCustomValidity('Debe ingresar un código para registrar el producto')" required oninput="setCustomValidity('')">
									</div>	
								</div>
									<div class="col-sm-6">
										<div class="form-group" style="">
										@php
										$tipos = App\Models\TasaIva::get()
										@endphp
			           <label class="mt-1">Impuesto del producto</label>
                 <select id="selectFamiliaProducto" class="form-control " name="familia_producto" required="true">
												<option value="" disabled selected hidden>Tasa de impuestos</option>
												@foreach( $tipos as $f)
													<option value="{{ $f->id}}">{{ $f->nombre }} ({{ $f->tasa }}%)</option>
												@endforeach
											</select>
									</div>	
								</div>
								<div class="col-sm-6">
										<div class="form-group" style="">
										<label for="txtDescripcion" class="control-label  ">Descripción</label>
										<textarea class="form-control" id="txtDescripcion" rows="3" placeholder="Descripción del producto" name="descripcion"></textarea>
									</div>	
								</div>
								
									<div class="col-sm-12">
									  <button type="submit" class="btn blue darken-4 form-control" 
									   id="boton">
										  <i class="fas fa-save text-white" id="ajax-icon"></i>
										   <span class="text-white ml-3">{{ __('Guardar') }}</span>
									  </button>
									</div>
									{!! Form::close()!!}
								  </div>
								 <div class="col-md-12 ">
								<legend>Últimos productos registrados</legend>
								<div class="table-responsive">
									<table class="table table-bordered table-hover display">
                <thead>
                <tr>
                   <th>#</th>
								   <th class="text-center">Código</th>
								   <th class="text-center">Nombre</th>
								   <th class="text-center">Categoría</th>
								   <th class="text-center">Precio ($)</th>
				                                  
                </tr>
              </thead>
                @foreach ($productos as $p)
                <tr>
                  <td>{{$p->id}} </td>
                  <td><a href="/productos/detalle/{{ $p->codigo}}">{{ $p->codigo}}</a></td>
                  <td>
                  	@if(strlen($p->nombre) > 24)
				           		{{ substr($p->nombre, 0, 24) . "..."}}
									@else
										{{ $p->nombre }}
									@endif
				                  </td>
				                  <td class="text-center">{{ $p->familia->nombre}}</td>
				                  <td>
									&nbsp;
									
									<span class="text-center">
										{{App\Models\Moneda::find(2)->simbolo }}
										{{ $p->precio}}
									</span>
								</td>
                </tr>
                @endforeach
              </table>
									
								</div>
							</div>
							</div>
						</div>
							

		
							
							@include('partials.familia_producto_box')
						</div>
					</div>                        
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script type="text/javascript">	
	//Auto focus al buscador
	$("#txtCodigo").focus();
	$("#form_nuevo_producto").on('submit', function(e){		
		var precio = $("#txtPrecio").val();
		precio = precio.replace(",", ".");		
		if(isNaN(precio)) {			
			e.preventDefault();
			alert("El precio ingresado no es válido.");
		}
	});

	$("#formFamiliaProducto").on('submit', function(e){
		e.preventDefault();		
		var familiaProducto = $('#txtnombreFamiliaProducto').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "POST",
			url: '/productos/familiaProductos/nueva',
			data: {nombreFamiliaProducto: familiaProducto},            
			success: function( response ) {				
				$('#selectFamiliaProducto').append($('<option>', {
					value: response,
					text: familiaProducto,
					selected: true
				}));
				$('#formFamiliaProducto').modal('toggle');
			}
		});
	});
</script>
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
$('#txtCodigo').val(myArray.join("") +'-'+'2' );
  });
</script>
<script>
    
$(document).ready(function (){
   
    //Define la cantidad de numeros aleatorios.
var cantidadNumeros = 12;
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
$('#txtCodigoDeBarras').val(myArray.join(""));
  });
</script>



<script>
	$('.select2bs4').select2();

</script>
<script>
	$('#quickForm').validate({
    rules: {
      nombre: {
        required: true,
        
      },
       descripcion: {
        required: true,
        
      },
      codigo_de_barras: {
        required: true,
        number: true,
        minlength: 5
      },
      precio_compra: {
        required: true
      },
      precio: {
        required: true
      },
      stock: {
        required: true
      },
    },
    messages: {
      nombre: {
        required: "Ingresa el nombre del producto"
        
      },
      stock: {
        required: "Ingresa la cantidad disponible del producto"
        
      },
      descripcion:{
    		 required: "Ingresa la descripción del producto"
    	},
    	precio: {
        required: "Ingresa el precio del producto"
        
      },
      codigo_de_barras: {
        required: "Please provide a password",
        number: "Es un campo numérico",
        minlength: "Your password must be at least 5 characters long"
      },
      precio_compra: "Ingresa el precio de compra"
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
<script type="text/javascript">

		$(document).ready(function(){
			$(".producto_tiempo_garantia").hide();
			$("#producto_garantia").on('change', function(){
				if($("#producto_garantia").val() == 1){
	
					$(".producto_tiempo_garantia").show();
				

				}else {

					$(".producto_tiempo_garantia").hide();
				}
			});
		});
	</script>
@endpush