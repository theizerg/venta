@extends('layouts.admin')
@section('title', 'Empleados')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-line-primary">
          <h4>Edición de los datos del empleado</h4>
        </div>

        <div class="card-body">
          <ul class="list-inline">
            <li class="list-inline-item">
              <a href="/" class="link_ruta">
                Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="/empleados" class="link_ruta">
                Empleados &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="/empleados/create" class="link_ruta">
                Nuevo
              </a>
            </li>
          </ul><br>
          <div class="row">
            <div class="container row">
              <div class="col-md-12 col-md-offset-0">
                
                {!! Form::model($empleados, ['route' => ['empleados.update',$empleados->id],'method' => 'PUT']) !!}
                  <div class="form-group row">
                                     
                                        
                  @include('admin.empleados.partials.nuevo')

                  
                                   
                  
              {!! Form::close()!!}
              </div>
              <div class="col-md-5 col-md-offset-2">                        

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('partials.mensajes');
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


