$(document).ready(function (){
	var fechaEmision = new Date();
	var day = ("0" + fechaEmision.getDate()).slice(-2);
	var month = ("0" + (fechaEmision.getMonth() + 1)).slice(-2);
	fecha = fechaEmision.getFullYear()+"-"+(month)+"-"+(day);
	$("#txtFecha").val(fecha);
	$(".form_devolucion_contado").hide();
	$(".form_compra_contado").hide();
	$(".form_factura_credito").hide();
	$(".form_venta_contado").show();
	$(".cliente-required").prop('required',true);
	$(".proveedor-required").prop('required',false);
	
	actualizarTablaArticulos();

	$("#txtAgregarArticulo").focus();

	$("#txtAgregarArticulo").on('keyup', function(e){
		e.preventDefault();
		if(e.keyCode == 13){
			$("#btnAgregarArticulo").click();
		}
		var str = $("#txtAgregarArticulo").val();
		if(str != ""){
			//url = "{{ url('productos/buscar?texto=') }}" + str;
			url = buscar_prodcto_url + str;
			delay(function(){
				$.get(url , function( data ){
					$("#divData").html( data );
					var productos = data["productos"];
					if(productos.length == 0){
						$("#listaBusquedaProducto").html("");
					}else{
						$("#listaBusquedaProducto").html("");                        
						for (i = 0; i < productos.length; i++) { 
							$("#listaBusquedaProducto").append(
								$('<option></option>').val(productos[i].codigo).html(productos[i].nombre + ", " + " $." + productos[i].precio )
							);
						}
					}				
				});
			}, 600);
		}else{
			$("#listaBusquedaProducto").html("");
		}
	});
	
	$('#btnAgregarArticulo').on('click', function(e) {
		e.preventDefault();
		var producto_codigo = $("#txtAgregarArticulo").val();
		if(producto_codigo.length > 2){
			//url = "{{ url('productos/buscar?texto=') }}" + producto_codigo;
			url = buscar_prodcto_url + producto_codigo;
			$.get(url , function( data ){
				agregarArticulo(data);
			});
		}
	});
	
	$("#formNuevoComprobante").on('submit', function(e){
		if(! confirm("¿Guardar comprobante?, una vez ingresado al sistema no podrá ser modificado.")){
			e.preventDefault();
		}
		var articulos = JSON.stringify(listadoArticulos);
		$("#hiddenListado").val(articulos);
		alert(requestData);
		//var url = "{{ url('comprobantes/vistaPrevia') }}";
		var url = comprobante_vistaprevia_url;
		var request;

		request = $.ajax({
			url: url,
			method: "POST",
			dataType: "json",
			data: { data: requestData }
		});
	});
	
	$(document).on('blur', '.td_cantidad', function() {
		var cantidad = $(this).val();
		var codigo = $(this).parents("tr").find(".td_codigo").html();		
		if(cantidad > $(this).prop('max')){			
			cantidad = $(this).prop('max');
			$(this).val(cantidad);
		}
		$(this).one('focus');
		modificarStock(codigo, cantidad);
	});

	$(document).on('blur', '.td_precio', function() {            
		var precio = $(this).val();
		var codigo = $(this).parents("tr").find(".td_codigo").html();
		precio = precio.replace(",", ".");
		modificarPrecio(codigo, precio);
		$(this).focus();
	});

	$('#btnAgregarCliente').on('click', function(e) {
		e.preventDefault();
		$("#hiddenCliente").val("");

		$("#txtCliente").val("");
		$("#txtDireccion").val("");
		$("#txtRif").val("");
		$("#txtCliente").prop( "disabled", false );
		//$("#txtDireccion").prop( "disabled", false );
		$("#txtRif").prop( "disabled", false );

		$("#txtBuscadorCliente").focus();
	});

	$('#btnBuscarCliente').on('click', function(e) {
		e.preventDefault();
		var str = $("#txtBuscadorCliente").val();
		//var url = "{{ url('clientes/buscar?texto=') }}" + str;
		var url = buscar_cliente_url + str;
		$.get(url , function( data ){			    
			var clientes = data["clientes"];
			console.log(clientes);
			$("#tablaClientes").html("");
			for(i=0; i < clientes.length; i++){
				var cliente_id = clientes[i]["id"];
				var cliente_nombre = clientes[i]["nombre"];

				var cliente_apellido = "";
				if(clientes[i]["apellido"] != null){
					var cliente_apellido = clientes[i]["apellido"];	
				}

				var cliente_telefono = "-";
				if(clientes[i]["telefono"] != null){
					var cliente_telefono = clientes[i]["telefono"];	
				}

				var cliente_direccion = "-";
				if(clientes[i]["direccion"] != null){
					var cliente_direccion = clientes[i]["direccion"];	
				}

				$("#tablaClientes").append(
					$('<tr></tr>').html(
						"<td class='td_cliente_id'>" 
							+ cliente_id +
						"<td class='td_cliente_nombre'>" 
							+ cliente_nombre +' '+cliente_apellido	
						+ "</td><td class='td_cliente_telefono_vehiculo'>"
							+ cliente_telefono
						+ "</td><td>"
							+ "<a class='btn-agregar-cliente btn btn-sm btn-block btn-link'>"
								+ '<i class="fa fa-share" aria-hidden="true"></i>'
							+ "</a>"
						+ "</td>"

					)
				);
			}
		});
	});

	$(document).on('click', '.btn-agregar-cliente', function() {
		var cliente_id = $(this).parents("tr").find(".td_cliente_id").html();
		var cliente_nombre = $(this).parents("tr").find(".td_cliente_nombre").html();			
		var cliente_marca_vehiculo = $(this).parents("tr").find(".td_cliente_marca_vehiculo").html();			
		var cliente_ano_vehiculo = $(this).parents("tr").find(".td_cliente_ano_vehiculo").html();
		var cliente_placa_vehiculo = $(this).parents("tr").find(".td_cliente_placa_vehiculo").html();	
		
		$("#hiddenCliente").val(cliente_id);

		$("#txtCliente").val(cliente_nombre);
		$("#txtCliente").prop( "disabled", true );
		$("#txtModelo").val(cliente_marca_vehiculo);
		//$("#txtDireccion").prop( "disabled", true );
		$("#txtAno").val(cliente_ano_vehiculo);
		$("#txtPlaca").val(cliente_placa_vehiculo);
		
		$("#btnOkModalAgregarCliente").click();
	});

	$(document).on('click', '.btn-agregar-proveedor', function() {
		var cliente_id = $(this).parents("tr").find(".td_cliente_id").html();
		var cliente_nombre = $(this).parents("tr").find(".td_cliente_nombre").html();			
		var cliente_direccion = $(this).parents("tr").find(".td_cliente_direccion").html();			
		var cliente_rif = $(this).parents("tr").find(".td_cliente_rif").html();			
		
		$("#hiddenCliente").val(cliente_id);

		$("#txtCliente").val(cliente_nombre);
		$("#txtCliente").prop( "disabled", true );
		$("#txtDireccion").val(cliente_direccion);
		//$("#txtDireccion").prop( "disabled", true );
		$("#txtRif").val(cliente_rif);
		$("#txtRif").prop( "disabled", true );
		
		$("#btnOkModalAgregarCliente").click();
	});
});


/****************************************************************************************
****************************************************************************************/


/***************************************************************************************/


var listadoArticulos = [
/*
   {'Id':'1','Username':'Ray','FatherName':'Thompson'},
   {'Id':'2','Username':'Steve','FatherName':'Johnson'}           
*/
]
console.log(listadoArticulos);

function agregarArticulo(data){
	//console.log(data["productos"]);


	if(data["productos"].length > 0){
		console.log(data["productos"].length);

		var producto = data["productos"][0];
		var producto_codigo = producto["codigo"];
		var productoBuscado = buscarArticuloEnListado(producto_codigo);
		if( productoBuscado == null){

				var producto_nombre = producto["nombre"];
				
				var producto_precio = producto["precio"];
				//var producto_iva =producto["precio"] * 40/100;
				var producto_cantidad = 1;
				
				listadoArticulos[listadoArticulos.length] = {
					'codigo':producto_codigo,
					'nombre': producto_nombre,
					'precio': producto_precio,
					'subTotal': (producto_precio),
					//'iva': (producto_iva),
					'total': (producto_precio),
				};            	
		}
		//console.log(productoBuscado["cantidad"] < productoBuscado["stock"] < productoBuscado["precioDolar"]);
		actualizarTablaArticulos();
		$("#txtAgregarArticulo").val("");
	}
}



function modificarPrecio(codigo, precio){    

	var articulo = buscarArticuloEnListado(codigo);
	
	if(articulo != null){
		articulo["precio"] = precio;
		articulo["subTotal"] = parseFloat(precio);
		//articulo["iva"] = parseFloat(precio *40/100);
		articulo["total"] = parseFloat(articulo["subTotal"]).toFixed(2);

		//console.log(articulo["precioDolar"]);
		actualizarTablaArticulos();
	}
}

function buscarArticuloEnListado(codigo){
	var i = 0;            
	var articuloBuscado = null;
	while(i < listadoArticulos.length && articuloBuscado == null){
		if(listadoArticulos[i]["codigo"] == codigo){
			articuloBuscado = listadoArticulos[i];
		}
		i++;
	}
	//console.log(articuloBuscado)
	return articuloBuscado;
	;
}

function descartarArticulo(posicion){
	listadoArticulos.splice(posicion, 1);
	$("#precioDolar").val(0);
	actualizarTablaArticulos();
}

function actualizarTablaArticulos(){
	$("#tablaProductos").html("");
	var resumen_sub_total = 0;
	var precio_dolar = 0;
	var resumen_iva = 0;
	var resumen_total = 0;
	for(i=0; i < listadoArticulos.length; i++){
		$("#tablaProductos").append(
			$('<tr></tr>').html(
				"<td class='td_codigo'>" 
					+ listadoArticulos[i]["codigo"] 
				+ "</td><td>"
					+ listadoArticulos[i]["nombre"] 
				+ "</td><td>" 
					//+ listadoArticulos[i]["precio"] 
					+ "<input class='form-control mr-5 input-sm td_precio' value="+ listadoArticulos[i]["precio"] + ">"
				+ "</td><td>"
				+"$"+	+ listadoArticulos[i]["subTotal"] 
				+ "</td><td class='td_iva'>" 
				+"$"+	+ listadoArticulos[i]["total"]
				+ "</td><td class='text-center'>"
					+ "<a style='color: #8a8686;' onclick='descartarArticulo(" + i + ");''><i class='fa fa-trash'></i></a>"
				+ "</td>"
			)                
		);
		resumen_sub_total += parseFloat(listadoArticulos[i]["subTotal"]);
		resumen_iva += parseFloat(listadoArticulos[i]["iva"]);
		resumen_total += parseFloat(listadoArticulos[i]["total"]);
	}
	$("#tablaResumen").html("");
	$("#tablaResumen").append(
		$('<tr></tr>').html(
			"<th width='120px'><h4>Sub Total</h4></th><td>"
			+ "<td> <h4>" + resumen_sub_total.toFixed(2)
			+"</h4></td>"
		)
	);
	$("#tablaResumen").append(
		$('<tr></tr>').html(
			"<th><h4>Total</h4></th><td>"
			+"<td> <h4>" + resumen_total.toFixed(2)
			+ "</h4></td>"
		)
	);
}

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();