<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\FamiliaProducto;
use App\Models\Notificacion;
use App\Models\LineaProducto;
use App\Models\Producto;
use App\Models\Moneda;
use App\Models\TasaIva;
use App\Models\User;
use App\Models\Ganancia;
use App\Models\Sucursales;
use App\Models\PrecioProducto;
use App\Models\ImagenProducto;
use DB;
use DateTime;
use Session;
use Illuminate\Support\Str;

class ProductoController extends Controller
{

     public function __construct()
    {
        $this->middleware('permission:VerProducto')->only('index'); 
        $this->middleware('permission:RegistraProducto')->only('nuevo');        
        $this->middleware('permission:RegistraProducto')->only('guardar');
        $this->middleware('permission:VerProducto')->only('detalle'); 

    }



    public function index(Request $request)
    {
        
         
        
        

       
        $productos= Producto::with('imagenes','precio')
        ->get();

        //dd($productos->imagenes->imagen);

        

        return view('admin.productos.index',compact('productos'));
    }

    public function buscar(Request $request){
        $texto = $request->texto;
        $productos = Producto::BuscarPorCodigo($texto)->with('iva')->get();
        if(count($productos) == 0){         
            $productos = Producto::FiltrarPorCodigo($texto)
                            ->FiltrarPorNombre($texto)
                            ->with('iva')
                            ->get();
        }
        return Response()->json([
            'productos' => $productos
        ]);
    }

    public function nuevo()
    {
        $config = DB::table('configuraciones')
        ->first();

        $categorias = explode(",",$config->categorias);
        $marcas = explode(",",$config->marcas);
        $presentaciones = explode(",",$config->presentaciones);

        $codigo = strtoupper(uniqid());
       return view('admin.productos.nuevo',compact('codigo','categorias','marcas','presentaciones','config'));
    }

    public function guardar(Request $request){        
        
         $extension = $request->poster->extension();
        //dd($request);
        
        // validaciones
          /*$validator = $request->validate([
            'nombre'=>'required|max:250|unique:producto',
            'descripcion'=>'required',
            'marca'=>'required|max:100',
            'categoria'=>'required|max:50',
            'presentacion'=>'required|max:50',
            'cantidad'=>'required|numeric',
            'precio_venta'=>'required|max:20',
            'poster'=>'required|max:5000',
            'codigo'=>'required',
            'estado'=>'required',
        ]);*/

        $compra = $request->precio_compra;
        $venta  = $request->precio;



        $producto = Producto::BuscarPorCodigo($request->codigo)->count();
        $nombre   = Producto::BuscarPorNombre($request->nombre)->count();
        //dd($nombre, $producto);
       
        if ($nombre <> 0) {
             $notification = array(
                'message' => 'El producto con el nombre: '. $request->nombre.' ya existe!',
                'alert-type' => 'error'
            );
                return Redirect::to('productos/nuevo/')->with($notification);   
        }elseif ($producto <> 0) {
             $notification = array(
                'message' => 'El producto con el codigo:'. $request->codigo.' ya existe!',
                'alert-type' => 'error'
            );
                return Redirect::to('productos/nuevo/')->with($notification);
        }else

           try {
            
            $extension = $request->poster->extension();
           
            if($extension == 'png' || $extension == 'jpeg' || $extension == 'jpg' || $extension == 'webp'){
                $producto = new Producto;
                $producto->nombre = $request->get('nombre');
                $producto->descripcion = $request->get('descripcion');
                $producto->marca = $request->get('marca');
                $producto->categoria = $request->get('categoria');
                $producto->presentacion = $request->get('presentacion');
                $producto->estado = $request->get('estado');
                $producto->codigo = $request->get('codigo');
                $producto->cantidad = $request->get('cantidad');
                $producto->fecha_fabricacion = $request->get('fecha_fabricacion');
                $producto->fecha_vencimiento = $request->get('fecha_vencimiento');
                $producto->created_at = new DateTime();
                $producto->save();


               if ($producto != null) {
                    $gananciaPorCompraVenta =  ($producto->precio -  $producto->precio_compra);
                    $gananciaporproducto    = $gananciaPorCompraVenta * $request->stock;

                    $ganancia = new Ganancia();
                    $ganancia->producto_id = $producto->id;
                    $ganancia->cantidad    = $producto->cantidad;
                    $ganancia->ganancia_por_producto = $gananciaPorCompraVenta;
                    $ganancia->total = $gananciaporproducto;
                    $ganancia->save();

                    $precio = new PrecioProducto();
                    $precio->idproducto = $producto->id;
                    $precio->precio_compra = $request->precio_compra;
                    $precio->precio_venta = $request->precio_venta;

                    $precio->save();

                    $imagen = new ImagenProducto();
                    $imagen->idproducto = $producto->id;
                    $imgname = uniqid();
                    $imageName = $imgname.'.'.$request->poster->extension(); 
                     //dd($imageName);
                    $request->poster->move(public_path('images/productos'), $imageName);
                    $imagen->imagen = $imageName;

                    $imagen->save();




                    DB::table('producto_precio')->insert([
                    'producto_id' => $producto->id,
                    'usuario_id' => \Auth::user()->id,
                    'fecha' => date("Y-m-d H:i:s"),
                    'precio' => $precio->precio_venta
                    ]);
                    Session::flash('success', 'Se registr?? su producto con exito');
                     return Redirect::back();  
                    }

                
            }else{
          
                Session::flash('danger', 'El formato de la imagen no se acepta');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }
         
    

    public function detalle($producto_codigo){
        $producto = Producto::BuscarPorCodigo($producto_codigo)->firstOrFail();
        $familias_producto = FamiliaProducto::orderBy('nombre')->get();
        $movimientos = $producto->LineasProducto()->orderBy('fecha', 'desc')->get();
        $precios_historico = $producto->preciosHistorico();
        $tasas_iva = TasaIva::all();
        $sucursales = Sucursales::pluck('nombre','id');

        return view('admin.productos.detalle')->with(compact('producto', 'movimientos', 'familias_producto', 'precios_historico', 'tasas_iva','sucursales'));
    }

    public function editar(Request $request){
        $producto_id = $request->producto_id;
        $producto = Producto::BuscarPorId($producto_id)->first();     


        if(is_null($producto)){
          $notification = array(
            'message' => '??El producto no existe!',
            'alert-type' => 'error'
        );
            return Redirect::back()->with($notification);           
                 
        
        }else{

            if($producto->codigo != $request->codigo){
                $producto->codigo  = $request->codigo;
            }
            if($producto->nombre != $request->nombre){
                $producto->nombre  = $request->nombre;
            }
            $producto->codigo_de_barras     = $request->codigo_de_barras;
            $producto->descripcion          = nl2br($request->descripcion);
            $producto->familiaproducto_id   = $request->familia_producto;
            $producto->tasa_iva_id  = $request->tasa_iva_id;

            $producto->sucursal_id  = $request->sucursal_id;
            $producto->stock                = $request->stock;
            if($request->precio!='' || $request->precio>0){
                if($request->precio != $producto->precio){
                    $producto->precio  = floatval(str_replace('.', '.', str_replace(',', '.', $request->precio)));
                     $producto->precio_compra  = floatval(str_replace('.', '.', str_replace(',', '.', $request->precio_compra)));
                    $producto->registrarCambioPrecio();
                }
            }else{
                $producto->precio  = 0;
            }           
            
            $producto->save();
            if ($producto != null) {
            $compra = $producto->precio_compra;
            $venta  = $producto->precio;


            //dd($venta - $compra);
            $gananciaPorCompraVenta =  ($venta -  $compra);
            $gananciaporproducto    = $gananciaPorCompraVenta * $request->stock;

            $ganancias = Ganancia::where('producto_id', $request->producto_id)->first();
            if (is_null($ganancias)) {
            
            $ganancia = new Ganancia();

            $ganancia->producto_id = $request->producto_id;
            $ganancia->cantidad    = $producto->stock;
            $ganancia->ganancia_por_producto = $gananciaPorCompraVenta;
            $ganancia->total = $gananciaporproducto;

            $ganancia->save();
            } else {
            
            $ganancia = Ganancia::where('producto_id', $request->producto_id)->first();
           
            $ganancia->producto_id = $ganancia->producto_id;
            $ganancia->cantidad    = $producto->stock;
            $ganancia->ganancia_por_producto = $gananciaPorCompraVenta;
            $ganancia->total = $gananciaporproducto;

            $ganancia->save();
            }
            
            
           // dd($ganancia);


            
             $notification = array(
            'message' => '??Producto modificado!',
            'alert-type' => 'success'
        );
            return Redirect::to('/productos/detalle/'. $producto->codigo)->with($notification);   
            }
        }
    }

    public function borrar(Request $request){
        $producto = Producto::BuscarPorId($request->producto_id);
        $ganancia = Ganancia::where('producto_id', $request->producto_id)->first();
        if($producto != null){
            $ganancia->delete();
            $producto->delete();
     


            $notification = array(
            'message' => '??Producto eliminado!',
            'alert-type' => 'success'
        );
            return Redirect::to('productos')->with($notification);
      
            
           
        }else 
        $notification = array(
            'message' => '??Producto eliminado!',
            'alert-type' => 'success'
        );
            return Redirect::to('productos')->with($notification);
    }

    public function configuracion(Request $request, $producto_codigo){
        $producto = Producto::BuscarPorCodigo($producto_codigo)->firstOrFail();
        if($producto != null){
            $stock_minimo = $request->stockMinimo;
            if($stock_minimo != null){
                if($stock_minimo >= 0){
                    $producto->stock_minimo_valor = $stock_minimo;                    
                }else{
                    $notification = array(
                     'message' => '??El valor ingresado como stock m??nimo debe ser mayor o igual a 0!',
                     'alert-type' => 'error'
        );
            return Redirect::to('productos')->with($notification);
                }
            }
            $producto->save();
              $notification = array(
                     'message' => '??Configuraci??n del producto actualizada!',
                     'alert-type' => 'success'
        );
            return Redirect::to('productos')->with($notification);
        }
    }

    public function movimientoModificarStock(Request $request, $producto_codigo){        
        $producto = Producto::BuscarPorCodigo($producto_codigo)->firstOrFail();
        if($producto != null){

            $cantidad = $request->cantidad;

            if($request->accion == "sumar"){
                $producto->stock += $cantidad;
                $descripcion = "Ingreso de stock: " . $request->descripcion;
            }else if($request->accion == "restar"){
                $producto->stock -= $cantidad;
                $descripcion = "Retiro de stock: " . $request->descripcion;
            }else{
                $producto->stock = $cantidad;
                $descripcion = "Sustituci??n de stock: " . $request->descripcion;
            }
            // Si el stock final es v??lido, guardamos el producto e informamos del cambio.
            // TODO: Crear un trigger que lo haga autom??ticamente despu??s del save.
            if($producto->stock >= 0){
                $producto->save();
                $producto->registrarCambioStock($cantidad, $descripcion);
                // Si el stock restante es menor al m??nimo. Se env??a una notificaci??n de que quedan pocos.              
                if($producto->stock_minimo_notificar && $producto->stock <= $producto->stock_minimo_valor){
                    $titulo = "Stock m??nimo alcanzado";
                    $texto = "Quedan " . $producto->stock . " unidad/es de " . $producto->nombre; 
                    $link_texto = "Ir al producto";
                    $link = "/productos/detalle/" . $producto->codigo;
                    Notificacion::crearNotificacion($titulo, $texto, $link, $link_texto);
                }

                  $notification = array(
                     'message' => '??Stock del producto actualizada!',
                     'alert-type' => 'success'
              );
            return Redirect::to('productos')->with($notification);
            }else{
                 $notification = array(
                     'message' => '??El stock final debe ser mayor o igual a 0!',
                     'alert-type' => 'error'
        );
            return Redirect::to('productos')->with($notification);
            }
        }
    }

    public function NotifStockMin(Request $request, $producto_codigo){
        $producto = Producto::BuscarPorCodigo($producto_codigo)->firstOrFail();
        if($producto != null){
            if($producto->stock_minimo_notificar == false){
                $producto->stock_minimo_notificar = true;
                $producto->save();
                 $notification = array(
                     'message' => '??Notificaci??n del producto activada!',
                     'alert-type' => 'success'
              );
            return Redirect::back()->with($notification);
            }else{
                $producto->stock_minimo_notificar = false;
                $producto->save();
                 $notification = array(
                     'message' => '??Notificaci??n del producto desactivada!',
                     'alert-type' => 'success'
              );
            return Redirect::back()->with($notification);
            }
        }        
    }

    public function nuevaFamiliaProducto(Request $request){    

        $nombre = $request->nombreFamiliaProducto;
        //dd($request);
        $categoria = FamiliaProducto::BuscarPorNombre($nombre)->first();
        
        if ($categoria == null) {
            $familiaProducto = new FamiliaProducto();
            $familiaProducto->nombre = $request->nombreFamiliaProducto;
            $familiaProducto->save();
            return $familiaProducto->id;
        }else{

            $notification = array(
                     'message' => '??Notificaci??n del producto desactivada!',
                     'alert-type' => 'success'
              );
            return Redirect::back()->with($notification);
            }

        }
        
        
    

    public function movimientos(Request $request){
        $usuarios = User::where('id','>',1)->get();
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;        

        if($fechaFin && $fechaInicio){            
            $fechaInicio = "$fechaInicio 00:00:00";
            $fechaFin = "$fechaFin 23:59:59";
            $movimientos = LineaProducto::where('fecha', '>=', $fechaInicio)
                            ->where('fecha', '<=', $fechaFin)
                            ->get();            
        }else{
            $movimientos = LineaProducto::orderBy('fecha', 'desc')->get();
        }
        
        return view('admin.productos.movimientos')->with(compact('movimientos', 'usuarios'));
    }
}
