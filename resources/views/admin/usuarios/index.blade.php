@extends('layouts.admin')

@section('title', 'Usuarios')
@section('page_title', 'Usuarios')
@section('content') 
<section class="container">
    <div class="section-body">
       <div class="row">

      <div class="ml-3 col-md-6">
        <div class="btn-group">
         
          @can('RegistrarUsuario')
          <a href="{{ url('user/create') }}" class="btn blue darken-4 text-white "><i class="fa fa-plus-square"></i> Ingresar</a>
          @endcan
         
        </div>
      </div>
    </div><br>
      <div class="row">
        <div class="col-12">
          <div class="card card-line-primary">
            <div class="card-header">
              <h4>Listado de usuarios</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table  table-hover display" id="save-stage" >
                  <thead>
                   <th>#</th>
                    <th>Nombre completo</th>
                    <th>Usuario</th>
                    <th>Género</th>
                    <th>Tipo</th>
                    <th>Correo electrónico</th>
                    <th>Acceso</th>
                    <th>Opciones</th> 
                  </thead>
                 @foreach ($users as $user)
              <tbody>
              <tr class="row{{ $user->id }}">
              <td>{{ $user->id }}</td>
              <td>{{ $user->display_name }}</td>
              <td>{{ $user->username }}</td>
                              
              @if ($user->genero == 'F')
                <td><i class="mdi mdi-human-female fa-3x pink-text"></i></td>
                @else
                <td><i class="mdi mdi-human-male fa-3x blue-text "></i></td>
                @endif
                <td>{!! $user->hasRole('Administrador') ? '<b>Administrador</b>' : 'Usuario' !!}</td>
                <td>{{ $user->email  }}</td>
               <td><span class="badge text-white {{ $user->status ? 'badge-success' : 'badge-danger' }}">{{ $user->display_status }}</span></td>
                <td>
                 @can('VerUsuario')
                 <a class="btn btn-round blue darken-4" href="{{ url('user', [$user->encode_id]) }}"><i class="mdi mdi-face text-center" style="color: white;"></i> </a>
                 @endcan
                @can('EditarUsuario')
                 <a class="btn btn-round blue darken-4" href="{{ url('user', [$user->encode_id,'edit']) }}"><i class="mdi mdi-pencil text-white text-center" style="color: white;"></i> </a>
               @endcan
                 
              </td>
              </tr>
              </tbody>  
               @endforeach              
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>


@endsection

