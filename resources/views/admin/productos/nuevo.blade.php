@extends('layouts.admin')
@section('title', 'Productos')
@section('content')
<div class="container">
	
  @if(Session::has('danger'))
      <div class="col-lg-12">
          <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="color: #ffffff;background-color: #ed2b2b;">
              {{Session::get('danger')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      </div>
  @endif 
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
            <form action="{{ url('productos/nuevo') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <img src="{{asset('images/productos/default.jpg')}}" id="blah" style="width:100%">
                                    <input type="file" id="imgInp" name="poster" class="form-control mt-4">
                                    @error ('poster')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('poster') }}</strong>
                                        </span>
                                    @enderror
                                    <center><button type="submit" class="btn btn-download mt-4" style="background-color: #69e781;">Registrar</button></center>
                                </div>
                                <div class="col-lg-9 col-md-9  form-group">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label><b>Título del producto</b></label>
                                            <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" placeholder="Nombre del producto">
                                            @error('nombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        <div class="col-lg-4 form-group">
                                            <label><b>Categoría</b></label>
                                            <select class="form-control" searchable="buscar.." name="categoria">
                                                <option value="SELECCIONAR" selected disabled>SELECCIONAR</option>
                                                @foreach ($categorias as $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                           @error('categoria')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <label><b>Marca</b></label>
                                            <select class="form-control" searchable="buscar.." name="marca">
                                                <option value="SELECCIONAR" selected disabled>SELECCIONAR</option>
                                                @foreach ($marcas as $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                            @error('marca')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <label><b>Precio de compra</b></label>
                                            <input type="text" name="precio_compra" class="form-control" value="{{old('precio_compra')}}" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"  data-type="currency" placeholder="$0">
                                           @error('precio_compra')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <label><b>Precio de venta</b></label>
                                            <input type="text" name="precio_venta" class="form-control" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"  data-type="currency" placeholder="$0">
                                            @error('precio_venta')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-lg-4 form-group">
                                            <label><b>Código</b></label>  
                                            <input type="text" name="codigo" class="form-control" value="{{$codigo}}">
                                            @error('codigo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <label><b>Cantidad</b></label>
                                            
                                            <div class="input-group">
                                                <input type="number" name="cantidad" class="form-control" value="{{old('cantidad')}}" placeholder="Cantidad" min="0"> 
                                                @error('cantidad')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <div class="input-group-addon">
                                                <select name="presentacion" class="form-control">
                                                        @foreach ($presentaciones as $item)
                                                            <option value="{{$item}}">{{strtolower($item)}}</option>
                                                        @endforeach
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        $sucursales = App\Models\Sucursales::get()
                                        @endphp
                                        <div class="col-lg-6 form-group">
                                            <label><b>Estado</b></label>
                                            <select class="form-control" name="estado">
                                                <option value="SELECCIONAR" selected disabled>SELECCIONAR</option>
                                                <option value="Disponible">Disponible</option>
                                                <option value="En espera">En espera</option>
                                            </select>
                                             @error('estado')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label><b>Sucursal</b></label>
                                            <select class="form-control" name="estado">
                                                <option value="SELECCIONAR" selected disabled>SELECCIONAR</option>
                                               <?php foreach ($sucursales as $key => $value): ?>
                                               	 <option value="{{$value->id}}">{{$value->nombre}}</option>
                                               <?php endforeach ?>
                                            </select>
                                            @error('sucursal_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="col-lg-6 form-group">
                                            <label><b>Fecha de fabricación</b></label>
                                            <input type="date" name="fecha_fabricacion" class="form-control" value="{{old('fecha_fabricacion')}}">
                                             @error('fecha_fabricacion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label><b>Fecha de vencimiento</b></label>
                                            <input type="date" name="fecha_vencimiento" class="form-control" value="{{old('fecha_vencimiento')}}">
                                             @error('fecha_vencimiento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label><b>Descripción</b></label>
                                            <textarea name="descripcion" class="form-control" placeholder="Breve descripción del producto" style="height:150px">{{old('descripcion')}}</textarea>
                                             @error('descripcion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
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
        window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });


        $("input[data-type='currency']").on({
            keyup: function() {
            formatCurrency($(this));
            },
            blur: function() { 
            formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                
                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                right_side += "00";
                }
                
                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = "<?php echo $config->prefijo_moneda?>" + left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = "<?php echo $config->prefijo_moneda?>" + input_val;
                
                // final formatting
                if (blur === "blur") {
                input_val += ".00";
                }
            }
            
            // send updated string to input
            input.val(input_val);

            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

    </script>
@endpush