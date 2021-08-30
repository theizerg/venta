@extends('layouts.admin')
@section('title', 'Movimiento de productos')
@section('content')
<div class="container">
     <div class="col-md-6">
          <div class="btn-group">
           
           @can('RegistraProducto')
            <a href="{{ url('productos/nuevo') }}" class="btn blue darken-3 text-white "><i class="fa fa-plus-square"></i> Ingresar</a>  

           
           @endcan
          </div>
      </div><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-line-primary">
                <div class="card-primary card-outline card-header">
                    <h4>Movimiento de productos</h4>
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
                            <a href="/productos/movimientos" class="link_ruta">
                                Movimientos
                            </a>
                        </li>
                    </ul><br>                    
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <div class="table-responsive">
                                <table width="97%" class="table table-hover display">
                                    <thead>
                                        <tr>
                                            <th width="70px">Fecha</th>
                                            <th width="70px">Hora</th>
                                            <th width="200px">Producto</th>
                                            <th width="40px">Cant.</th>
                                            <th>Descripción</th>
                                            <th width="120px">Usuario</th>
                                            <th width="100px">Comprobante</th>
                                        </tr>
                                   </thead>

                                    @foreach($movimientos->sortByDesc('fecha') as $m)                                       
                                        <tr>
                                            <td>{{ date_format( date_create($m->fecha), 'd/m/Y' ) }}</td>       
                                            <td>{{ date_format( date_create($m->fecha), 'H:i:s' ) }}</td>       
                                            <td>
                                                <a href="/productos/detalle/{{ $m->producto->codigo }}">
                                                    @if(strlen($m->producto->nombre) > 24)
                                                        {{ substr($m->producto->nombre, 0, 24) . "..."}}
                                                    @else
                                                        {{ $m->producto->nombre }}
                                                    @endif                                                    
                                                </a>
                                            </td>
                                            <td align="center">{{ $m->cantidad}}</td>
                                            <td>{{ $m->descripcion}}</td>
                                            <td>{{$m->usuario->name}}</td>
                                            @if($m->comprobante)
                                                <td class="text-center">
                                                    <a href="/comprobantes/detalle/{{$m->comprobante->id}}" class="ml-3 btn btn-round blue darken-4 text-white tooltip-wrapper"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver detalle de la venta">
                                                  <i class="mdi mdi-link" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                            @else
                                                <td>---</td>
                                            @endif
                                        </tr>
                                    @endforeach                         
                                </table>
                            </div><br>
                           
                        </div>
                    </div>
                    @include('partials.movimiento_stock')
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript"> 
    //Auto focus al buscador
    $("#txtBusqueda").focus();
</script>
@endsection