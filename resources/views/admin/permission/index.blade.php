@extends('layouts.admin')

@section('title', 'Permisos')
@section('page_title', 'Permisos')


@section('content')

    <div class="container">
      <div class="row">
        <div class="col-sm-12 align-content-center">
          <div class="card card-line-primary">
            <div class="card-header">
                <h5 class="font-weight-bold">Permisos del rol {{ $name }}</h5>
                <div class="card-tools"></div>
              </div>
              <div class="card-body">
               <form role="form" id="main-form">
                <input type="hidden" id="_url" value="{{ url('permission', [$name]) }}">
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                 <table class="table table-responsive table-striped">            
                    <tr>
                      <td>
                        Ver usuarios<br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="VerUsuario" {{ $role->hasPermissionTo('VerUsuario') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Agregar usuarios</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="RegistrarUsuario" {{ $role->hasPermissionTo('RegistrarUsuario') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Editar usuarios</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EditarUsuario" {{ $role->hasPermissionTo('EditarUsuario') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Eliminar usuarios</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EliminarUsuario" {{ $role->hasPermissionTo('EliminarUsuario') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                       <td>
                        Ver Roles<br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="VerRole" {{ $role->hasPermissionTo('VerRole') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Agregar Roles</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="RegistrarRole" {{ $role->hasPermissionTo('RegistrarRole') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Editar Roles</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EditarRole" {{ $role->hasPermissionTo('EditarRole') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Eliminar Roles</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EliminarRole" {{ $role->hasPermissionTo('EliminarRole') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>                  
                       <td>
                        Crear Permisos</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="CrearPermisos" {{ $role->hasPermissionTo('CrearPermisos') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Editar Permisos</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EditarPermisos" {{ $role->hasPermissionTo('EditarPermisos') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                 
                     <td>
                        Eliminar Permisos</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EliminarPermisos" {{ $role->hasPermissionTo('EliminarPermisos') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td> 
                      <td>
                        Ver historial de log-in</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="VerLogins" {{ $role->hasPermissionTo('VerLogins') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>          
                    </tr>
                     <tr>                        
                     <td>
                        Ver Producto</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="VerProducto" {{ $role->hasPermissionTo('VerProducto') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Crear Producto</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="RegistraProducto" {{ $role->hasPermissionTo('RegistraProducto') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Editar Producto</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EditaProducto" {{ $role->hasPermissionTo('EditaProducto') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                 
                     <td>
                        Eliminar Producto</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EliminaProducto" {{ $role->hasPermissionTo('EliminaProducto') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td> 
                       <td>
                        Ver Cliente</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="VerCliente" {{ $role->hasPermissionTo('VerCliente') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                       <td>
                        Registrar Cliente</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="RegistrarCliente" {{ $role->hasPermissionTo('RegistrarCliente') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                   </tr>
                   <tr>
                     <td>
                        Editar Cliente</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EditaCliente" {{ $role->hasPermissionTo('EditaCliente') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Eliminar Cliente</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EliminaCliente" {{ $role->hasPermissionTo('EliminaCliente') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                 
                      <td>
                        Ver Proveedores</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="VerProveedor" {{ $role->hasPermissionTo('VerProveedor') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Registrar Proveedores</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="RegistrarProveedor" {{ $role->hasPermissionTo('RegistrarProveedor') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Editar Proveedores</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EditaProveedor" {{ $role->hasPermissionTo('EditaProveedor') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td> 
                     <td>
                        Eliminar Proveedores</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EliminaProveedor" {{ $role->hasPermissionTo('EliminaProveedor') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td> 
                   </tr>
                   <tr>
                     <td>
                        Ver Empleado</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="VerEmpleados" {{ $role->hasPermissionTo('VerEmpleados') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Crear Empleado</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="RegistrarEmpleados" {{ $role->hasPermissionTo('RegistrarEmpleados') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                      <td>
                        Editar Empleado</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EditaEmpleados" {{ $role->hasPermissionTo('EditaEmpleados') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                 
                     <td>
                        Eliminar Empleado</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="EliminarEmpleados" {{ $role->hasPermissionTo('EliminarEmpleados') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                       <td>
                        Apertura de Caja</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="AperturarCaja" {{ $role->hasPermissionTo('AperturarCaja') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>
                 
                     <td>
                        Cierre de Caja</br>
                        <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="permissions[]" value="CerrarCaja" {{ $role->hasPermissionTo('CerrarCaja') ? 'checked' : '' }}>
                          </label>
                        </div>
                      </td>  
                   </tr>  
                  </table>
                  <div class="form-group pading">
                     <label for="name">Contraseña actual</label>
                     <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Contraseña actual">
                     <span class="missing_alert text-danger" id="current_password_alert"></span>
                    </div>
                    <button type="submit" class="btn blue darken-4 text-white ajax" id="submit">
                      <i id="ajax-icon" class="fa fa-edit"></i> Editar
                    </button>
              </form>
            </div>
          </div>
        </div>  
      </div>
    </div>


@endsection

@push('scripts')
 <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '40%' // optional
    });
  });
 </script>
  <script src="{{ asset('js/admin/permission/index.js') }}"></script>
@endpush
