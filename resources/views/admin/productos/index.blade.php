@extends('layouts.admin')
@section('title', 'Productos')
@section('content')
<div class="container form-group ">
	<div class="col-md-6">
          <div class="btn-group">
           
           @can('RegistraProducto')
            <a href="{{ url('productos/nuevo') }}" class="btn blue darken-3 text-white "><i class="fa fa-plus-square"></i> Ingresar</a>  

            <a href="{{ url('productos/movimientos') }}" class="btn blue darken-3 text-white "><i class="mdi mdi-handshake"></i> Movimiento de los productos</a>  
           @endcan
          </div>
        </div><br>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-line-primary">
            <div class="card-header">
              <h3 class="card-title ">Listado de productos</h3>
          </div>
            <div class="card-body table-responsive table-striped">
              
              <table class="table table-bordered table-hover display" id="example1">
                <thead>
                <tr>
                   <th>#</th>
        				   <th class="text-center">Código</th>
        				   <th class="text-center">Producto</th>
                   <th class="text-center">Marca</th>
        				   <th class="text-center">Categoría</th>
        				   <th class="text-center">Precio</th>
        				   <th class="text-center">Cantidad disponible</th>
                   @can('EditaProducto')
                   <th class="text-center" >Opciones</th>
                   @endcan                               
                </tr>
              </thead>
              @foreach ($productos as $p)
              <tr>
               <td><img height="50" src="{{ url('images/productos',$p->imagenes->imagen) }}"> </td>
               <td><a href="/productos/detalle/{{ $p->codigo}}">{{ $p->codigo}}</a></td>
                <td>
                {{ $p->nombre }}
                </td>
                 <td>
                  @if(strlen($p->marca) > 24)
                    {{ substr($p->marca, 0, 24) . "..."}}
                  @else
                    {{ $p->marca }}
                  @endif
                </td>

                <td class="text-center">{{ $p->categoria}}</td>
                <td>
			    	&nbsp;
				
				<span class="text-center">
				
					 {{$p->precio->precio_venta}}
				</span>
			</td>
			  <td class="text-center">{{ $p->cantidad}}</td>
        @can('EditaProducto')
			    <td class="text-center">
    						<a href="#formStock" id="{{$p->codigo}}" data-toggle="modal" data-target="#formStock" onclick='$("#form_stock").attr("action", "/productos/{{$p->codigo}}/ModificarStock");'>
    							<i class="fas fa-exchange-alt" aria-hidden="true"></i>
    						</a>
			        </td>
              @endcan
              </tr>
              @endforeach
            </table>
             </div>
          </div>
        </div>
        @include('partials.movimiento_stock')
      </div>
  </div>
@endsection