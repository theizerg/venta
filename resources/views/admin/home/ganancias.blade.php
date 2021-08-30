@extends('layouts.admin')
@section('title', 'Ganancias')
@section('content')

<div class="container">

        <div class="col-md-12">
          <div class="card card-line-primary">
            <div class="card-header  ">
              <h4>Ganancia obtenida de los productos a vender</h4>
             
            </div>
             <!-- /.card-header -->
                <div class="card-body table-responsive">
                     <ul class="list-inline">
                   <li class="list-inline-item">
                      <a href="/" class="link_ruta">
                        Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul><br>
	                <table  class="display table  " style="width:100%" id="example1">
	                    <thead>
	                    <tr>
	                    <th>#</th>
	                    <th>Producto</th> 
	                    <th>Cantidad</th>
	                    <th>Precio de compra</th>
	                    <th>Precio de venta</th>
	                    <th>Ganancia por producto</th>
	                    <th>Ganancia neta</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach ($ganancias as $log)
	                    <tr class="row{{ $log->id }}">
	                    <td>{{ $log->id }}</td>
	                    <td>
	                    	<a href="productos/detalle/{{ $log->productos->codigo }}">{{ $log->productos->nombre }}</a>
	                    </td>
	                    <td>{{ $log->cantidad }}</td>
	                    <td>${{ $log->productos->precio_compra  }}</td>
	                    <td>${{ $log->productos->precio  }}</td>
	                    <td>${{ $log->ganancia_por_producto }}</td>
	                    <td>${{ $log->total }}</td>
	                    </tr>
	                    @endforeach
	                    </tr>
	                    </tbody>                
	                </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
   
@endsection
