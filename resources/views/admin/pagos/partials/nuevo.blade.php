    <div class="col-md-12 mt-3">
	 <label class="">Empleados</label><br>
	    <select name="empleado_id" class="form-control input-sm">
	    	
		@foreach($empleados as $empleado)
				<option value="{{$empleado->id}}" selected="true">{{$empleado->nb_nombre}} - {{$empleado->cargos->nombre}} </option>
		@endforeach
	</select>
	</div>					
	<div class="col-md-12 mt-3">
		<label class="">Tipo de pago</label><br>
      <select name="tipo_pago_empleado_id" class="form-control input-sm" id="tipo_pago">
	    <option value="0" selected="true">Seleccione</option>
		@foreach($tipos as $tipo)
		<option value="{{$tipo->id_tipo_pago_empleado}}">{{$tipo->nb_tipo_pago_empleado}}</option>
		@endforeach
	</select>
	</div>

	<div class="col-md-12 mt-3">
		<label id class="monto_empleado">Ingrese el monto</label><br>
		{!! Form::text('total', null,array('class' => 'form-control input-sm','placeholder'=>'Dinero a cancelar o deducir del empleado ','id'=>'total')) !!}
	</div>

    <input type="hidden" name="usuario_id" id="usuario_id" value="{{ Auth::user()->id}}">
	
	<div class="col-md-12 mt-3">
        <label class="" for="txtFecha">Fecha</label><br>
        {!! Form::date('fecha', null,array('class' => 'form-control input-sm','placeholder'=>'Nombres del empleado ','id'=>'fecha')) !!}
	</div>
	 <div class="col-md-12 mt-3">
			<label class="mt-1">Sucursal</label>
            {!! Form::select('sucursal_id', $sucursales, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione la sucursal','id'=>'sucursal_id')) !!} 
             </div><br>
	<div class="col-md-12 mt-3">
     <label class="">Descripción</label><br>
	 {!! Form::textarea('tx_descripcion', null,array('class' => 'form-control input-sm','placeholder'=>'Dinero a cancelar o deducir del empleado ','id'=>'total')) !!}


