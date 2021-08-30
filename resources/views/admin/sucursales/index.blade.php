@extends('layouts.admin')
@section('title', 'Sucursales')
@section('content')
<div class="container">
    <div class="row">    
        <div class="col-md-12">
            <div class="card card-primary card-outline ">
                <div class=" card-header">
                    <h4>Vista general de las sucursales</h4>
                </div>
                <div class="card-body">
                   
                    <span class="float-left">
                        <a class="btn btn-md blue darken-4 text-white" href="/sucursales/nuevo" class="btn btn-link">
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Nueva sucursal
                        </a>
                    </span><br><br><br>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="/" class="link_ruta">
                                Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/sucursales" class="link_ruta">
                                Sucursales
                            </a>
                        </li>                       
                    </ul><br>
            
                    <div class="table-responsive">
                        <table id="example1" cellspacing="0" width="100%" class="table table-hover table-border  display">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th> 
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Teléfono</th>
                                <th class="text-center">Dirección</th>
                                <th  class="text-center">Rif</th>
                                <th  class="text-center">Estado</th>
                                <th  class="text-center">Opciones</th>
                            </tr>
                            </thead> 
                            <tbody>
                           @foreach( $sucursales as $sucursal)
                            <tr class="text-center">
                                <td> {{ $sucursal->id }} </td>     
                                <td> {{ $sucursal->nombre }}</td>
                                <td> {{ $sucursal->telefono }}</td>
                                <td> {{ $sucursal->direccion }}</td>
                                <td> {{ $sucursal->rif }}</td>
                                <td>
                                 <span class="badge text-white {{ $sucursal->status ? 'badge-success' : 'badge-danger' }}">{{ $sucursal->display_status }}</span>
                                </td>   
                                    
                                <td>
                                <a href="{{url('sucursales/detalle', $sucursal->id)}}"
                                     class="btn blue darken-4 btn-round text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detalle de la sucursal"><i class="fas fa-list"></i></a>
                                    
                                </td>
                            </tr>
                           @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div>

@endsection

