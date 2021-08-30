<div class="col-sm-6">
		<label class="mt-1">Empleado</label>
     <div class="form-group">
      <select name="empleado_id" class="form-control input-sm">
        @foreach ($empleado as $element)

      	<option value="{{ $element->id }}" >{{ $element->display_name }}</option>
        @endforeach
      </select>
     </div> 
	</div>

	<input type="hidden" name="usuario_id" value="{{ \Auth::user()->id }}">
	<div class="col-sm-6">
		<label class="mt-1">Tipo de actividad</label>
   <div class="form-group">
    {!! Form::text('tipo_trabajo', null,array('class' => 'form-control input-sm','placeholder'=>'Tipo de actividad ','id'=>'tipo_trabajo')) !!}   
   </div> 
	</div>
	  <div class="col-sm-12">
		<label class="mt-1">Descripción de actividad</label>
       <div class="form-group">
        {!! Form::textarea('descripcion', null,array('class' => 'form-control input-sm','placeholder'=>'Ingrese las actividades realizadas por el empleado ','id'=>'descripcion')) !!}   
       </div> 
	    </div>
	    <div class="col-sm-12 text-center">
		<label class="mt-1">Fecha de la actividad realizada</label>
       <div class="form-group">
        <div class="input-group date text-center" id="reservationdate" data-target-input="nearest">
           {!! Form::text('fecha', null,array('class' => 'form-control input-sm  text-center datetimepicker-input','data-target'=>'#reservationdate','data-toggle'=>'datetimepicker','placeholder' => 'Fecha de la actividad realizada por el empleado')) !!}  
          </div> 
       </div> 
	   </div>
	   <div class="col-sm-12 text-center">
	   	<div class="form-group">
       <label class="font-weight-bolder" for="status">Estado de la actividad</label>
        <div class="checkbox icheck">
          <label class="font-weight-bolder">
 			    <input type="radio" name="estado_trabajo" value="1" checked> Finalizada&nbsp;&nbsp;
  		    <input type="radio" name="estado_trabajo" value="0"> Pendiente
            </label>
          </div>
        </div>
	   </div>
	    <div class="col-sm-12">
         <button type="submit" class="btn blue darken-4 text-white form-control  ajax" id="submit">
           <i id="ajax-icon" class="fa fa-save"></i> Ingresar
         </button>
      </div>