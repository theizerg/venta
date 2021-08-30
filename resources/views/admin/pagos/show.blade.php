@extends('layouts.admin')
@section('title', 'Pagos')
@section('content')

<div class="card card-line-primary">
  <div class="col-xs-12">
    <div class="card-header">
      <h2 class="card-title">
        <i class="fa fa-user"></i> Datos del empleado
        <h5 class="pull-right ml-3">({{ $pagos->empleado->nb_nombre }})</h5>
      </h2>
    </div>
  </div>
  <div class="card-body">
    <div class="row card-body  ">
      <div class="col-sm-3">
        <strong>Nombre</strong><br>
         {{ $pagos->empleado->nb_nombre }}
      </div>
      <div class="col-sm-3">
          <strong>Sueldo base</strong>
          <br>
         {{ $pagos->nu_sueldo_base }}
        </div>
        <div class="col-sm-3">
            <strong>Tipo de pago</strong><br>
            {{ $pagos->tipopago->nb_tipo_pago_empleado}}
          </div>
          <div class="col-sm-3">
              <strong>Modo de cobro</strong><br>
             {{ $pagos->modopago->nb_modo_pago}}
          </div>
      </div>
      <div class="row card-body  ">
        <div class="col-sm-3">
           <strong>Monto</strong><br>
             {{ $pagos->nu_cantidad_tipo_pago }}
            </div>
            <div class="col-sm-3">
              <strong>Fecha</strong>
              <br>
               {{ date('d / m / Y', strtotime($pagos->fecha)) }}
              </div>
              <div class="col-sm-3">
                <strong>Total</strong><br>
                {{ $pagos->total }}
              </div>
              <div class="col-sm-3">
                <strong>Descripción</strong><br>
                 {{ $pagos->tx_descripcion }}
              </div>
            </div>
			 </div>
			  <div class="card-footer">
				<div class="row align-items-center">
				    <div class="col-sm-4">
				      
		                <a href="{{ url('/pagos/empleado', [$pagos->id, 'edit']) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
		               
				    </div>
				    <div class="col-">
					
		                
					
				    </div>
				  </div>
			    </div>
		</div>



@endsection