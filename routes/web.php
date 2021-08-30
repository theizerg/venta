<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth',])->group(function () {

#############################################################################################
##################  Administación del sistema   #############################################
#############################################################################################
  Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
  Route::resource('logins', 'App\Http\Controllers\LoginController');
  Route::resource('user',   'App\Http\Controllers\UserController');
  Route::resource('permission', 'App\Http\Controllers\PermissionController');
  Route::get('logs', 'App\Http\Controllers\HomeController@logs')->name('logs');
  Route::resource('roles',   'App\Http\Controllers\RolesController');
  Route::DELETE('/notificaciones/borrar/{notificacion_id}', 'App\Http\Controllers\HomeController@borrarNotificacion')->name('borrarNotificacion');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#
#
#
#
#############################################################################################
################################# MOD REGISTRO DE PRODUCTOS #################################
#############################################################################################

  Route::post('/productos/familiaProductos/nueva', 'App\Http\Controllers\ProductoController@nuevaFamiliaProducto');
  Route::get('/productos', 'App\Http\Controllers\ProductoController@index');
  Route::get('/productos/movimientos', 'App\Http\Controllers\ProductoController@movimientos');
  Route::get('/productos/buscar', 'App\Http\Controllers\ProductoController@buscar');		
  Route::get('/productos/nuevo', 'App\Http\Controllers\ProductoController@nuevo');
  Route::post('/productos/nuevo', 'App\Http\Controllers\ProductoController@guardar');
  Route::post('/productos/editar', 'App\Http\Controllers\ProductoController@editar');
  Route::post('/productos/borrar', 'App\Http\Controllers\ProductoController@borrar');
  Route::get('/productos/detalle/{codigo}', 'App\Http\Controllers\ProductoController@detalle');
  Route::post('/productos/{codigo}/configuracion', 'App\Http\Controllers\ProductoController@configuracion');
  Route::post('/productos/{codigo}/ModificarStock', 'App\Http\Controllers\ProductoController@movimientoModificarStock');
  Route::get('/productos/{codigo}/NotifStockMin', 'App\Http\Controllers\ProductoController@NotifStockMin');
  Route::get('/ganancias','App\Http\Controllers\GananciaContoller@ganancias');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#
#
#
#
#############################################################################################
################################# MOD REGISTRO DE CLIENTES #################################
#############################################################################################

Route::get('/clientes', 'App\Http\Controllers\ClienteController@index');
Route::get('/clientes/nuevo', 'App\Http\Controllers\ClienteController@nuevo');
Route::post('/clientes/guardar', 'App\Http\Controllers\ClienteController@guardar');
Route::get('/clientes/buscar', 'App\Http\Controllers\ClienteController@buscar');
Route::get('/clientes/detalle/{clienteId}', 'App\Http\Controllers\ClienteController@detalle');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#
#
#
#
#############################################################################################
################################# MOD REGISTRO DE PROVEEDORES ###############################
#############################################################################################
  
  Route::get('/proveedores', 'App\Http\Controllers\ProveedorESController@index');
  Route::get('/proveedores/nuevo', 'App\Http\Controllers\ProveedorESController@nuevo');
  Route::post('/proveedores/guardar', 'App\Http\Controllers\ProveedorESController@guardar');
  Route::get('/proveedores/detalle/{proveedor_id}', 'App\Http\Controllers\ProveedorESController@detalle');
  Route::get('/indicadores/masVendidos/{mes}', 'App\Http\Controllers\IndicadoresController@masVendidos');
  Route::get('/proveedores/buscar', 'App\Http\Controllers\ProveedorESController@buscar');


#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#
#
#
#
#############################################################################################
################################# MOD REGISTRO DE EMPLEADOS #################################
#############################################################################################

  Route::resource('/empleados','App\Http\Controllers\EmpleadoController');
  Route::get('/asignacion/{empleado_id}','App\Http\Controllers\AsignacionTrabajoController@nuevo');
  Route::post('/asignacion/guardar','App\Http\Controllers\AsignacionTrabajoController@guardar')->name('asignacion.guardar');
  Route::get('/asignaciones','App\Http\Controllers\AsignacionTrabajoController@index');
  Route::get('/asignacion/editar/{empleado_id}','App\Http\Controllers\AsignacionTrabajoController@editar');
  Route::put('/asignacion/actualizar/{empleado_id}','App\Http\Controllers\AsignacionTrabajoController@actualizar')->name('asignacion.actualizar');
  Route::resource('/empleado/pagos','App\Http\Controllers\PagosController');
	Route::get('/pagos/empleado/{id}/imprimir','App\Http\Controllers\PagosController@imprimir');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#
#
#
#
#############################################################################################
################################# MOD REGISTRO DE EMPLEADOS #################################
#############################################################################################

  Route::resource('/gastos','App\Http\Controllers\GastosController');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#
#
#
#

#############################################################################################
################################# MOD REGISTRO DE COMPROBANTES ##############################
#############################################################################################

  Route::get('/comprobantes', 'App\Http\Controllers\ComprobanteController@index');
  Route::get('/comprobantes/consultas', 'App\Http\Controllers\ComprobanteController@consultas');
	//Route::get('/comprobantes/reportes', 'App\Http\Controllers\ReportesController@indexComprobantes');
  Route::get('/comprobantes/nuevo', 'App\Http\Controllers\ComprobanteController@nuevo');
  Route::get('/comprobantes/detalle/{facturaId}', 'App\Http\Controllers\ComprobanteController@detalle');
  Route::get('/comprobantes/imprimir/{facturaId}', 'App\Http\Controllers\ComprobanteController@imprimir');
  Route::post('/comprobantes/guardar', 'App\Http\Controllers\ComprobanteController@guardar');
  Route::get('/comprobantes/vencimientos', 'App\Http\Controllers\ComprobanteController@vencimientos');
  Route::get('/comprobantes/recibos/nuevo/{cliente_id}', 'App\Http\Controllers\ComprobanteController@nuevoRecibo');
  Route::get('/comprobantes/recibos/factura/nuevo/{proveedor_id}', 'App\Http\Controllers\ComprobanteController@nuevoReciboFactura');
  Route::post('/comprobantes/recibos/guardar', 'App\Http\Controllers\ComprobanteController@guardarRecibo');
  Route::post('/comprobantes/recibos/factura/guardar', 'App\Http\Controllers\ComprobanteController@guardarReciboFactura');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#
#
#
#
#
#############################################################################################
################################# MOD REGISTRO DE SURSALES ##################################
#############################################################################################

  Route::get('sucursales', 'App\Http\Controllers\SucursalesController@index');
  Route::get('/sucursales/nuevo', 'App\Http\Controllers\SucursalesController@nuevo');
  Route::post('/sucursales/guardar', 'App\Http\Controllers\SucursalesController@guardar');
  Route::get('/sucursales/buscar', 'App\Http\Controllers\SucursalesController@buscar');
  Route::get('/sucursales/detalle/{clienteId}', 'App\Http\Controllers\SucursalesController@detalle');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#
#
#
#
#
#############################################################################################
################################# MOD REGISTRO DE APERTURA ##################################
#############################################################################################

  Route::resource('/apertura','App\Http\Controllers\AperturaCajaController');
  Route::resource('/historial','App\Http\Controllers\HistorialCajaController');
  Route::resource('/cierre','App\Http\Controllers\CierreCajaController');
  Route::post('/ventas/desgloce', 'App\Http\Controllers\HomeController@ventadesgloce');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
################################# MOD REGISTRO DE COMPRAS ###################################
#############################################################################################
  
Route::get('/compras', 'App\Http\Controllers\ComprasController@index');
Route::get('/compras/nuevo', 'App\Http\Controllers\ComprasController@nuevo');
Route::post('/compras/guardar', 'App\Http\Controllers\ComprasController@guardar');
Route::get('/compras/detalle/{compra_id}', 'App\Http\Controllers\ComprasController@detalle');
Route::get('/compras/pagar', 'App\Http\Controllers\ComprasController@pagar');

#############################################################################################
#############################################################################################
#############################################################################################
#############################################################################################
});
