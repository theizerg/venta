    
 
    <div class="col-md-12">
     <div class="form-group">
		<label class="mt-1">Nombres</label>
		{!! Form::text('nb_nombre', null,array('class' => 'form-control input-sm','placeholder'=>'Nombres del empleado ','id'=>'nb_nombre')) !!}
			
		</div>
		 <div class="form-group">
			<label class="mt-1">Apellidos</label>
			{!! Form::text('nb_apellido', null,array('class' => 'form-control input-sm','placeholder'=>'Apellidos del empleado ','id'=>'nb_apellido')) !!}
		</div>

		<div class="form-group">
			<label class="mt-1">Cédula</label>
			{!! Form::text('nu_cedula', null,array('class' => 'form-control input-sm','placeholder'=>'Cédula del empleado ','id'=>'nu_cedula')) !!}
		
		</div>
		<div class="form-group">
			<label class="mt-1">Teléfono</label>
			{!! Form::text('telefono', null,array('class' => 'form-control input-sm inputmask','id'=>'telefono','data-inputmask'=> '"mask": "(9999) 999-9999"','data-mask',' placeholder'=>'Ingrese el Teléfono')) !!}
		</div>
		
			<div class="form-group">
			<label class="mt-1" for="txtFecha">Fecha de nacimiento</label>
			<div class="input-group date" id="reservationdate" data-target-input="nearest">
                  {!! Form::text('fecha_nacimiento', null,array('class' => 'form-control input-sm  datetimepicker-input','data-target'=>'#reservationdate','data-toggle'=>'datetimepicker','id'=>'nacimiento-action', 'placeholder' => 'Fecha de nacimiento')) !!}
             </div>
          
            </div>
			<div class="form-group">
			<label class="mt-1">Profesión</label>
			{!! Form::text('nb_profesion', null,array('class' => 'form-control input-sm ','placeholder'=>'Profesion del empleado ',)) !!}
             </div>
             <div class="form-group">
			<label class="mt-1">Sueldo base del empleado</label>
			{!! Form::text('sueldo_base', null,array('class' => 'form-control input-sm','placeholder'=>'Sueldo base del empleado ','id'=>'nb_profesion')) !!}
		
	     	<input type="hidden" name="usuario_id" id="usuario_id" value="{{ Auth::user()->id}}">
	     	</div>
	     	<div class="form-group">
			<label class="mt-1" for="txtFecha">Fecha de ingreso</label>
			<div class="input-group date" id="ingresodate" data-target-input="nearest">
                  {!! Form::text('fe_ingreso', null,array('class' => 'form-control input-sm  datetimepicker-input','data-target'=>'#ingresodate','data-toggle'=>'datetimepicker','id'=>'nacimiento-action', 'placeholder' => 'Fecha de ingreso a la empresa')) !!}
             </div>
             </div>
             <div class="form-group">
			<label class="mt-1">Modo de cobro</label>
            {!! Form::select('modo_pagos_id', $modos, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione el modo de cobro','id'=>'cobro_id')) !!} 
             </div>
             
		     <label class="mt-1">Cargos</label>
		        <div class="form-group">
		           {!! Form::select('cargo_id', $cargos, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione el cargo','id'=>'cargo_id')) !!}    
		      </div> 
		     <div class="form-group">
			<label class="mt-1">Sucursal</label>
            {!! Form::select('sucursal_id', $sucursales, null,array('class' => 'form-control input-sm','placeholder'=>'Selecione el modo de cobro','id'=>'sucursal_id')) !!} 
             </div><br>
		  		
		<div class="col-md-12"> 
			<button type="submit" class="btn btn-block btn-primary">Guardar</button>
		</div>
	</div>