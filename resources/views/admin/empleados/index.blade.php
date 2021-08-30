@extends('layouts.admin')
@section('title', 'Empleados')
@section('content')
<div class="container">
    <div class="row">    
        <div class="col-md-12">
            <div class="card card-line-primary ">
                <div class="card-outline card-header">
                    <h4>Vista general de los empleados</h4>
                </div>
                <div class="card-body">
                    <span class="float-right">
                        <a class="btn btn-md btn-success" href="/empleados/create" class="btn btn-link">
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo empleado
                        </a>
                    </span>
                    <span class="float-left">
                        <a class="btn btn-md btn-primary" href="/empleado/pagos" class="btn btn-link">
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Pagos del empleado
                        </a>
                    </span><br><br><br>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="/" class="link_ruta">
                                Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/empleados" class="link_ruta">
                                Empleados
                            </a>
                        </li>                       
                    </ul><br>
            
                    <div class="table-responsive">
                        <table id="example1" cellspacing="0" width="100%" class="table table-hover table-border  display">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th> 
                                <th class="text-center">Nombres</th>
                                <th class="text-center">Apellidos</th>
                                <th  class="text-center">RUC</th>
                                <th class="text-center">Teléfono</th>
                                <th  class="text-center">Profesión</th>
                                <th  class="text-center">Fecha de ingreso</th>
                                <th  class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach( $empleados as $empleado)
                            <tr class="text-center">
                                <td> {{ $empleado->id }} </td>     
                                <td> {{ $empleado->nb_nombre }}</td>
                                <td> {{ $empleado->nb_apellido }}</td>
                                <td> {{ $empleado->nu_cedula }}</td>
                                <td> {{ $empleado->telefono }}</td>
                                <td> {{ $empleado->nb_profesion }}</td>
                                <td> {{ $empleado->fe_ingreso }}</td>                 
                                <td>
                                <a href="{{route('empleados.show', $empleado->id)}}"
                                    class="btn blue darken-4 btn-round text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detalle del empleado"><i class="fas fa-user"></i></a>
                                    {{-- <a href="{{url('asignacion', $empleado->id)}}"
                                    class="btn btn-round blue darken-4 text-white"><i class="mdi mdi-handshake"></i></a> --}}
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

