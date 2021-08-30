<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\facades\SistemaFacturaCompra;
use App\Models\TipoCompra;
use App\Models\TipoPago;
use App\Models\Notificacion;
use App\Models\LineaCompras;
use App\Models\Proveedor;
use App\Models\Comprobante;
use App\Models\FacturasCompras;
use App\Models\Producto;
use App\Models\Recibo;
use App\Models\Moneda;
use App\Models\Sucursales;
use App\Models\AperturaCaja;
use App\Models\MovimientoCaja;
use App\Models\Compras;
use Auth;

class ComprasController extends Controller
{
    function index()
    {
        $compras = Compras::get();

        return view ('admin.compras.index', compact('compras'));

    }

    public function nuevo()
    {
        $productos = Producto::all();
        $monedas = Moneda::all();
        $tipos_compras = TipoCompra::all();
        $sucursales =Sucursales::pluck('nombre','id');
        $tipo = TipoPago::pluck('nb_tipo_pago','id');
       
        return view('admin.compras.nuevo')->with(compact('productos', 'monedas', 'tipos_compras','tipo','sucursales'));
    }

    public function guardar(Request $request)
    {
         $tipo_comprobante = $request->tipo_comprobante;     
        // 1- Venta al contado
        // 2- Devolución al contado
        // 3- Factura de venta a créditos
        // 
        // 
          
        
        //TODO: Asociar tipo de comprobante
        if($tipo_comprobante == 1 || $tipo_comprobante == 2 || $tipo_comprobante == 3){
            $articulos = json_decode($request->listadoArticulos);
            $moneda = Moneda::find($request->moneda);
            $proveedor = Proveedor::find($request->proveedor_id);     
              
            $compra = new Compras();

            $compra->serie = $request->serie;
            $compra->numero = $request->numero;        
            $compra->fecha_emision = $request->fecha_emision;
            $compra->cantidad_diferencia = $request->cantidad_diferencia;
            $compra->descripcion_diferencia = $request->descripcion_diferencia;        
            
            
          

            if(is_numeric($request->cotizacion)){
                $compra->cotizacion = $request->cotizacion;
            }
            
            $compra->moneda()->associate($moneda);




            if($proveedor != null){
                $compra->proveedor()->associate($proveedor);
                $compra->nombre_proveedor= $proveedor->nombre;
                $compra->rut = $proveedor->rut;            
            }else{
                if($tipo_comprobante == 3){
                    $notification = array(
                    'message' => 'Debe ingresar un cliente registrado para emitir una factura de venta a crédito.!',
                    'alert-type' => 'error'
                     );
                    return Redirect::back()->with($notification);
                }
                
                $compra->nombre_cliente = $request->cliente;
                $compra->rut = $request->rut;
            }
            $compra->direccion = $request->direccion;
            $compra->tipo()->associate($request->tipo_comprobante);
            $compra->sucursal()->associate($request->sucursal_id);
            $compra->save();
            $ok = true;


            for ($i=0; $i < count($articulos); $i++) {
                $producto = Producto::BuscarPorCodigo($articulos[$i]->codigo)->first();
                $linea = $articulos[$i];
                
                     /*if ($linea->cantidad > $producto->stock) {
                    
                     $notification = array(
                    'message' => '¡No dispone de la cantidad solicitada!',
                    'alert-type' => 'error'
                     );      
                     return \Redirect::to('comprobantes/nuevo')->with($notification);     
                }*/
                    $lineaCompra = new LineaCompras();
                    $lineaCompra->compra()->associate($compra);
                    $lineaCompra->producto()->associate($producto);
                    $lineaCompra->usuario()->associate(Auth::user());


                    $stock = 0;

                    $stock += $linea->cantidad;
                    $lineaCompra->stock = $producto->stock;

                    $producto->stock = $stock + $producto->stock;
                    $lineaCompra->precioUnitario = $linea->precio;
                    $lineaCompra->cantidad = $linea->cantidad;

                    //$lineaCompra->subTotal = $producto->precio * $linea->cantidad;
                    $lineaCompra->subTotal = $articulos[$i]->precio * $linea->cantidad;
                    // Para los iva accede al tipo de iva que tenga el producto.
                    // Próxima versión debería poer modificarse si se quiere.
                    $lineaCompra->iva = 0;
                    
                    $lineaCompra->total = $lineaCompra->subTotal + $lineaCompra->iva;

                    $lineaCompra->fecha = date('Y-m-d');

                    $lineaCompra->created_at = date("d-m-Y H:m:s");


                    $compra->iva += 0;
                    $compra->subTotal += $lineaCompra->subTotal;
                    $moneda_simbolo = Moneda::find(2)->simbolo;

                    $lineaCompra->descripcion = "x $lineaCompra->cantidad  $producto->nombre  -  TOTAL $moneda_simbolo $lineaCompra->total";  

                    //$tipoPago = $movimiento->tipoPago->nb_tipo_pago;

                        



                     $cotizacion = $request->cotizacion;
                     $totalDolares = $lineaCompra->total;
                     $total = ($cotizacion * $totalDolares );


                  


                 
         
                        
                    $lineaCompra->save();
                    $producto->save();
                   


            
                $compra->total = $compra->iva + $compra->subTotal;               
                $compra->save();                               


               


               
            }

            
             // Verificamos si es una factura
            if($compra->tipo->id == 3){
                $fecha_vencimiento = $request->fecha_vencimiento;
                $deuda_original = $compra->total;
                $proveedor_id = $proveedor->id;
                if($request->pago_inicial)
                    $deuda_actual = $compra->total - $request->pago_inicial;
                else
                    $deuda_actual = $compra->total;

                $plazo = $request->plazo;
                
                $factura = SistemaFacturaCompra::getInstancia()->ingresarFactura($compra, $fecha_vencimiento, $deuda_original, $deuda_actual, $plazo, $proveedor_id);               
            }

            
            
            $notification = array(
                    'message' => 'Compra cargada exitosamente!',
                    'alert-type' => 'success'
                     );      
            return Redirect::to('compras/detalle/' . $compra->id)->with($notification);                  
       
            
           
        }
    }

   
        public function detalle(Request $request, $compra_id)
        {
            $compra = Compras::find($compra_id);
            //dd($compra);
            
            return view('admin.compras.detalle')->with(compact('compra'));
        }

    
        function pagar (Request $request)
        {
          
                $fecha = $request->fecha;
                $fecha_fin = $request->fecha_fin;   
                $cliente_id = $request->cliente_id;

        
                $vencimientos = FacturasCompras::where('facturas_compras.id','>','0')->get();
               
                
               
               
                // dd($vencimientos);
                        
                return view('admin.facturas.compras')->with(compact('vencimientos'));
           
        }
  
}
