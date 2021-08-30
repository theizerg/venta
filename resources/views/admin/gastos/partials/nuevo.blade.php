  <div class="col-sm-12">
	
	 <label class="mt-3">Tipo de gasto</label><br>
	    <select name="empleado_id" class="form-control input-sm">
	    	<option value="0" selected="true">Seleccione</option>
		@foreach($tipog as $tipo)
			<option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
		@endforeach
	</select>
	

	<label class="mt-3" >Ingrese el monto</label><br>
	 {!! Form::text('nu_cantidad_tipo_pago', null,array('class' => 'form-control input-sm','placeholder'=>'Monto del gasto')) !!}
	

    <input type="hidden" name="usuario_id" id="usuario_id" value="{{ Auth::user()->id}}">
	
        <label class="mt-3" for="txtFecha">Fecha</label><br>
        {!! Form::date('fecha', null,array('class' => 'form-control input-sm','placeholder'=>'Nombres del empleado ','id'=>'fecha')) !!}


			<label class="mt-1">Sucursal</label>
            {!! Form::select('sucursal_id', $sucursales, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione la sucursal','id'=>'sucursal_id')) !!} 
             <br>
	
     <label class="mt-3">Descripción</label><br>
	 <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción del pago"name="descripcion">
	                  
	  </textarea>
	
</div>