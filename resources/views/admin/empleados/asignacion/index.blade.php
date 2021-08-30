@extends('layouts.admin')
@section('title', 'Empleados')
@section('content')
<div class="container">
    <div class="row">    
        <div class="col-md-12">
            <div class="card">
                <div class="card-primary card-outline card-header">
                    <h4>Vista general de las actividades asignadas a los empleados</h4>
                </div>
                <div class="card-body">
                    <span class="float-right">
                       
                    </span>
                    <span class="float-left">
                        
                    </span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="/" class="link_ruta">
                                Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                           
                                Actividades asignadas
                         
                        </li>                       
                    </ul><br>
            
                    <div class="table-responsive">
                        <table id="example1" cellspacing="0"  class="table table-hover table-border">
                            <thead>
                            <tr>
                                <th>ID</th> 
                                <th>Empleado</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Estado de la actividad</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $asignacion as $empleado)
                            <tr >
                                <td> {{ $empleado->id }} </td>     
                                <td> {{ $empleado->empleado->display_name }}</td>
                                <td> {{ $empleado->fecha }}</td>
                                <td> {{ $empleado->descripcion }}</td>
                                
                                <td><span class="badge text-white {{ $empleado->estado_trabajo ? 'badge-success' : 'badge-danger' }}">{{ $empleado->display_status }}</span></td>               
                                <td>
                               
                                    <a href="{{url('asignacion/editar', $empleado->id)}}"
                                    class="btn btn-round blue darken-4 text-white"><i class="mdi mdi-pencil-outline"></i></a>
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

