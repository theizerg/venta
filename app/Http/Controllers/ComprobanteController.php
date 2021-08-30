<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\facades\SistemaFactura;
use App\Models\TipoComprobante;
use App\Models\TipoPago;
use App\Models\Notificacion;
use App\Models\LineaProducto;
use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Recibo;
use App\Models\Moneda;
use App\Models\Sucursales;
use App\Models\AperturaCaja;
use App\Models\MovimientoCaja;
use App\Models\Proveedor;
use App\Models\FacturasCompras;
use App\Models\RecibosCompras;
use Auth;

class ComprobanteController extends Controller
{
    public function index(Request $request)
    {
        $monedas = Moneda::all();

        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $tipos_comprobante = TipoComprobante::all();
        if($fechaFin && $fechaInicio){
            $comprobantes = Comprobante::where('fecha_emision', '>=', $fechaInicio)
                    ->where('fecha_emision', '<=', $fechaFin)
                    ->orderby('fecha_emision', 'desc')
                    ->paginate(20);            
        }else{
            $comprobantes = Comprobante::orderby('fecha_emision', 'desc')->paginate(20);
        }
        return view('admin.comprobantes.index')->with(compact('comprobantes', 'monedas', 'tipos_comprobante'));            
    }

    public function consultas(Request $request)
    {
        $facturas = Comprobante::all();
        $monedas = Moneda::all();
        return view('admin.comprobantes.consultas')->with(compact('facturas', 'monedas'));
    }

   
public function apertura()
    {
        
        $carbon = new \Carbon\Carbon();
        $date =$carbon->format('Y-m-d');
    
    
        $usuario= Auth::user()->id;
        $apertura=AperturaCaja::where('fecha_emision',$date)
        ->where('status',1)
        ->get();
       

        return ( count($apertura) > 0) ? true : false ;
    }

    public function nuevo()
    {
 
        $apertura = $this->apertura();

        if ($apertura) {


        $productos = Producto::all();
        $monedas = Moneda::all();
        $tipos_comprobante = TipoComprobante::all();
        $sucursales =Sucursales::pluck('nombre','id');
        $tipo = TipoPago::pluck('nb_tipo_pago','id');
       
        return view('admin.comprobantes.nuevo')->with(compact('productos', 'monedas', 'tipos_comprobante','tipo','sucursales'));
       }else{
        
        $notification = array(
            'message' => '¡Debe iniciar apertura de caja antes de generar un comprobante de venta!',
            'alert-type' => 'error'
        );
        
        return \Redirect::to('/apertura/create')->with($notification);
       }
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
            $cliente = Cliente::find($request->cliente_id);         
            $comprobante = new Comprobante();

            $comprobante->serie = $request->serie;
            $comprobante->numero = $request->numero;        
            $comprobante->fecha_emision = $request->fecha_emision;
            $comprobante->cantidad_diferencia = $request->cantidad_diferencia;
            $comprobante->descripcion_diferencia = $request->descripcion_diferencia;        
            
            
            $comprobante->descripcion_1 = $request->descripcion_1;
            $comprobante->descripcion_2 = $request->descripcion_2;
            $comprobante->descripcion_3 = $request->descripcion_3;

            if(is_numeric($request->cotizacion)){
                $comprobante->cotizacion = $request->cotizacion;
            }
            
            $comprobante->moneda()->associate($moneda);




            if($cliente != null){
                $comprobante->cliente()->associate($cliente);
                $comprobante->nombre_cliente = $cliente->nombre . " " . $cliente->apellido;
                $comprobante->rut = $cliente->rut;            
            }else{
                if($tipo_comprobante == 3){
                    $notification = array(
                    'message' => 'Debe ingresar un cliente registrado para emitir una factura de venta a crédito.!',
                    'alert-type' => 'error'
                     );
                    return Redirect::back()->with($notification);
                }
                $comprobante->nombre_cliente = $request->cliente;
                $comprobante->rut = $request->rut;
            }
            $comprobante->direccion = $request->direccion;
            $comprobante->tipo()->associate($request->tipo_comprobante);
            $comprobante->sucursal()->associate($request->sucursal_id);
            $comprobante->save();
            $ok = true;


            for ($i=0; $i < count($articulos); $i++) {
                $producto = Producto::BuscarPorCodigo($articulos[$i]->codigo)->first();
                $linea = $articulos[$i];
                
                     if ($linea->cantidad > $producto->stock) {
                    
                     $notification = array(
                    'message' => '¡No dispone de la cantidad solicitada!',
                    'alert-type' => 'error'
                     );      
                     return \Redirect::to('comprobantes/nuevo')->with($notification);     
                }

                if($producto->stock >= $linea->cantidad){
                    $lineaProducto = new LineaProducto();
                    $lineaProducto->comprobante()->associate($comprobante);
                    $lineaProducto->producto()->associate($producto);
                    $lineaProducto->usuario()->associate(Auth::user());


                    $movimiento = new MovimientoCaja();
                    $movimiento->comprobante()->associate($comprobante);
                    $movimiento->producto()->associate($producto);
                    $movimiento->usuario()->associate(Auth::user());
                    $movimiento->moneda()->associate($moneda);

                    // Checkea si es devolución
                    if($comprobante->tipo->id == 2){
                        $linea->cantidad *= -1;                     
                    }


                    $movimiento->usuario_id = \Auth::user()->id;
                    $movimiento->fecha =date("Y-m-d H:i:s");
                    
                    $movimiento->tipo_pago_id = $request->tipo_pago_id;
                    $movimiento->moneda_id = $request->moneda;
                   //dd();
                    $movimiento->caja_id = 1;
                    $movimiento->cliente = $comprobante->nombre_cliente;
                    $movimiento->tipo_comprobante_id = $request->tipo_comprobante;

                    


                    $producto->stock -= $linea->cantidad;
                    $lineaProducto->stock = $producto->stock;
                    
                    $lineaProducto->precioUnitario = $linea->precio;
                    $lineaProducto->cantidad = $linea->cantidad;

                    //$lineaProducto->subTotal = $producto->precio * $linea->cantidad;
                    $lineaProducto->subTotal = $articulos[$i]->precio * $linea->cantidad;
                    // Para los iva accede al tipo de iva que tenga el producto.
                    // Próxima versión debería poer modificarse si se quiere.
                    $lineaProducto->iva = 0;
                    
                    $lineaProducto->total = $lineaProducto->subTotal + $lineaProducto->iva;

                    $lineaProducto->fecha = date('Y-m-d');

                    $lineaProducto->created_at = date("d-m-Y H:m:s");


                    $comprobante->iva += 0;
                    $comprobante->subTotal += $lineaProducto->subTotal;
                    $moneda_simbolo = Moneda::find(2)->simbolo;

                    $lineaProducto->descripcion = "x $lineaProducto->cantidad  $producto->nombre  -  TOTAL $moneda_simbolo $lineaProducto->total";  

                    //$tipoPago = $movimiento->tipoPago->nb_tipo_pago;

                        

                    if ($movimiento->moneda->nombre == 'Dólares') {

                     if ($request->select_diferencia <> null) {
                      
                       $movimiento->descripcion = 'El vendedor '.''.\Auth::user()->display_name.' ha realizado una '.$movimiento->tipo->nombre.' El cliente canceló en: '.$movimiento->moneda->nombre.' El método de pago fue realizado por: '.$movimiento->tipoPago->nb_tipo_pago.' por un total de: '.$lineaProducto->total.'$'.' Con la tasa del día en '.$comprobante->cotizacion.' Bs '.$request->descripcion_diferencia;    
                    
                    }elseif ($movimiento->tipo->nombre == 'Devolución al contado') {
                         $movimiento->descripcion = 'El vendedor '.''.\Auth::user()->display_name.' ha realizado una '.$movimiento->tipo->nombre.' El cliente está devolviendo el producto '.$producto->nombre.' por concepto de garantía';
                      $movimiento->save();
                    }else
                      $movimiento->descripcion = 'El vendedor '.''.\Auth::user()->display_name.' ha realizado una '.$movimiento->tipo->nombre.' El cliente canceló en: '.$movimiento->moneda->nombre.' El método de pago fue realizado por: '.$movimiento->tipoPago->nb_tipo_pago.' por un total de: '.$lineaProducto->total.'$'.'Con la tasa del día en '.$comprobante->cotizacion.' Bs';

                      $movimiento->save();
                    }else{


                  $cotizacion = $request->cotizacion;
                  $totalDolares = $lineaProducto->total;
                  $total = ($cotizacion * $totalDolares );


                  


                  $movimiento->descripcion = 'El vendedor '.''.\Auth::user()->display_name.' ha realizado una '.$movimiento->tipo->nombre.' El cliente canceló en: '.$movimiento->moneda->nombre.' El método de pago fue realizado por: '.$movimiento->tipoPago->nb_tipo_pago.' por un total de: '. number_format($total,2) .'Bs'.' Con la cotización del dólar en: '.number_format($cotizacion,2).'Bs';

                    $movimiento->save();
                    }
                        
                    $lineaProducto->save();
                    $producto->save();
                   


                }
                $comprobante->total = $comprobante->iva + $comprobante->subTotal;               
                $comprobante->save();                               


                // Verificamos stock restante de producto para ver si notificar             
                if($producto->stock_minimo_notificar && $producto->stock <= $producto->stock_minimo_valor){
                    $titulo = "Stock mínimo alcanzado";
                    $texto = "Quedan " . $producto->stock . " unidad/es de " . $producto->nombre; 
                    $link_texto = "Ir al producto";
                    $link = "/productos/detalle/" . $producto->codigo;
                    Notificacion::crearNotificacion($titulo, $texto, $link, $link_texto);

                }


               
            }


            // Verificamos si es una factura
            if($comprobante->tipo->id == 3){
                $fecha_vencimiento = $request->fecha_vencimiento;
                $deuda_original = $comprobante->total;

                if($request->pago_inicial)
                    $deuda_actual = $comprobante->total - $request->pago_inicial;
                else
                    $deuda_actual = $comprobante->total;

                $plazo = $request->plazo;

                $factura = SistemaFactura::getInstancia()->ingresarFactura($comprobante, $fecha_vencimiento, $deuda_original, $deuda_actual, $plazo);               
            }


            
            
            $notification = array(
                    'message' => '¡Venta cargada exitosamente!',
                    'alert-type' => 'success'
                     );      
            return Redirect::to('comprobantes/detalle/' . $comprobante->id)->with($notification);            
        }
    }

    public function detalle(Request $request, $comprobante_id)
    {
        $comprobante = Comprobante::find($comprobante_id);
        //dd($comprobante);
        
        return view('admin.comprobantes.detalle')->with(compact('comprobante'));
    }

    public function imprimir(Request $request, $comprobante_id)
    {
        
        //dd($request);
        $fecha = "04/07/2018";
        
        $pdf= app('Fpdf');

        $pdf->AddPage();
       
        $pdf->Ln(1);

        $comprobantes = Comprobante::find($comprobante_id);
        
       

        
       
        
         // dd();
              
         $pdf->Image('images/logo/logo7_9_122716.png',5,2,40,40,'PNG');
         $pdf->SetY(10);
         $pdf->SetFont('Arial','B',12);
         $pdf->SetXY(150,10);
         $pdf->SetFont('Arial','B',12);
         $pdf->Cell(60,5,utf8_decode("Fecha: ".date("d/m/Y")),0,1,'L');
         $pdf->SetXY(150,15);
         $pdf->Cell(60,5,utf8_decode("N° Factura: ").($comprobantes->numero),0,1,'L');

        
      
         $pdf->Ln(6);
         $pdf->Ln(10);
         $pdf->SetFont('Arial','B',12);
        if ($comprobantes->cliente <> null) {
            if ($comprobantes->cliente->empresa) {
             $pdf->Cell(190,5,utf8_decode("Razón social: ".$comprobantes->cliente->nombre." ".$comprobantes->cliente->apellido),0,1,'L');

         $pdf->Cell(190,5,utf8_decode("Dirección: ".$comprobantes->cliente->direccion),0,1,'L');
        
         $pdf->Cell(190,5,utf8_decode("Teléfono: ".$comprobantes->cliente->telefono),0,1,'L');
         $pdf->Cell(190,5,utf8_decode("Rif: ".$comprobantes->cliente->rut),0,1,'L');
         }else{
         $pdf->Cell(190,5,utf8_decode("Cédula: ".$comprobantes->cliente->documento),0,1,'L');
         $pdf->Cell(190,5,utf8_decode("Nombre: ".$comprobantes->cliente->nombre." ".$comprobantes->cliente->apellido),0,1,'L');

         $pdf->Cell(190,5,utf8_decode("Dirección: ".$comprobantes->cliente->direccion),0,1,'L');
        
         $pdf->Cell(190,5,utf8_decode("Teléfono: ".$comprobantes->cliente->telefono),0,1,'L');
         $pdf->Cell(190,5,utf8_decode("Rif: ".$comprobantes->cliente->rut),0,1,'L');
         }
        
    

         $desgloce = LineaProducto::where('comprobante_id',$comprobante_id)->get();
         

          $pdf->Ln(10);
          $pdf->SetFont('Arial','B',16);
          $pdf->Cell(190,5,utf8_decode("Factura de Compra"),0,1,'C');
        
          $pdf->SetFont('Arial','B',10);
          $pdf->Ln(6);
          $pdf->SetX(10);
          $pdf->Cell(20,6,"Cantidad",1,0,'C');
          $pdf->Cell(100,6,"Descripcion",1,0,'C');
          $pdf->Cell(30,6,"Precio Unitario",1,0,'C');
          $pdf->Cell(30,6,"Monto Total",1,0,'C');

          $sumaTotal = 0;
          $total_sumaTotal = 0;
          $sub_total_iva = 0;
          $total_iva = 0;
          $sumaPago = 0;



            foreach ($desgloce as $key => $desgloces) {


            

          $pdf->Ln(6);
          $pdf->Cell(20,6,$desgloces->cantidad,1,0,'C');
          $pdf->Cell(100,6,utf8_decode($desgloces->producto->nombre),1,0,'C');
          $pdf->Cell(30,6,$desgloces->producto->precio,1,0,'C');

           $sumaTotal =($desgloces->cantidad * $desgloces->producto->precio);

          

           

          $pdf->Cell(30,6,number_format($sumaTotal,2,",","."),1,0,'C');

            $total_sumaTotal +=$sumaTotal;
            $total_iva +=$desgloces->iva;

            $total = ( $total_sumaTotal );



          }
           $pdf->Ln(6);
           $pdf->Cell(150,6,"Total neto:",1,0,'C');
           $pdf->Cell(30,6,number_format($total_sumaTotal,2,",","."),1,0,'C');


          

           $pdf->Ln(6);

              $pdf->Cell(150,6,"Total a pagar:",1,0,'C');
           $pdf->Cell(30,6,number_format($total,2,",","."),1,0,'C');

           if ($desgloces->comprobante->tipo->nombre == 'Factura de venta crédito') {
                
              $sql_infor1 = \DB::select(' select "recibos".*, "recibo_facturas"."factura_id" as "pivot_factura_id", "recibo_facturas"."recibo_id" as "pivot_recibo_id", "recibo_facturas"."deuda_inicial" as "pivot_deuda_inicial", "recibo_facturas"."deuda_final" as "pivot_deuda_final" from "recibos" inner join "recibo_facturas" on "recibos"."id" = "recibo_facturas"."recibo_id" where "recibo_facturas"."factura_id" =?',[$desgloces->comprobante->factura->id]);


              //dd($sql_infor1 );
            
        

       
          

              $pdf->Ln(12);
              $pdf->SetFont('Arial','B',16);
              $pdf->Cell(190,5,utf8_decode("Recibo de pago"),0,1,'C');



              $pdf->SetFont('Arial','B',10);
              $pdf->Ln(6);
              $pdf->SetX(10);
              $pdf->Cell(30,6,"Deuda Inicial",1,0,'C');
              $pdf->Cell(60,6,"Monto Recibido",1,0,'C');
              $pdf->Cell(30,6,"Deuda Final",1,0,'C');
              $pdf->Cell(50,6,"Fecha y Hora de pagos",1,0,'C');
                foreach ($sql_infor1 as $key => $value) {

                $pdf->Ln(6);
                $pdf->Cell(30,6,number_format($value->pivot_deuda_inicial,2,",","."),1,0,'C');
                $pdf->Cell(60,6,number_format($value->monto,2,",","."),1,0,'C');
                $pdf->Cell(30,6,number_format($value->pivot_deuda_final,2,",","."),1,0,'C');
                $pdf->Cell(50,6,$value->fecha,1,0,'C');
                
             }


        }
        
    
 }else
  $desgloce = LineaProducto::where('comprobante_id',$comprobante_id)->get();
        

          $pdf->Ln(10);
          $pdf->SetFont('Arial','B',16);
          $pdf->Cell(190,5,utf8_decode("Factura de Compra"),0,1,'C');
        
          $pdf->SetFont('Arial','B',10);
          $pdf->Ln(6);
          $pdf->SetX(10);
          $pdf->Cell(20,6,"Cantidad",1,0,'C');
          $pdf->Cell(100,6,"Descripcion",1,0,'C');
          $pdf->Cell(30,6,"Precio Unitario",1,0,'C');
          $pdf->Cell(30,6,"Monto Total",1,0,'C');

          $sumaTotal = 0;
          $total_sumaTotal = 0;
          $sub_total_iva = 0;
          $total_iva = 0;
          $sumaPago = 0;



            foreach ($desgloce as $key => $desgloces) {


            

          $pdf->Ln(6);
          $pdf->Cell(20,6,$desgloces->cantidad,1,0,'C');
          $pdf->Cell(100,6,utf8_decode($desgloces->producto->nombre),1,0,'C');
          $pdf->Cell(30,6,$desgloces->producto->precio,1,0,'C');

           $sumaTotal =($desgloces->cantidad * $desgloces->producto->precio);

          

           

          $pdf->Cell(30,6,number_format($sumaTotal,2,",","."),1,0,'C');

            $total_sumaTotal +=$sumaTotal;
            $total_iva +=$desgloces->iva;

            $total = ( $total_sumaTotal );



          }
           $pdf->Ln(6);
           $pdf->Cell(150,6,"Total neto:",1,0,'C');
           $pdf->Cell(30,6,number_format($total_sumaTotal,2,",","."),1,0,'C');


          

           $pdf->Ln(6);

              $pdf->Cell(150,6,"Total a pagar:",1,0,'C');
           $pdf->Cell(30,6,number_format($total,2,",","."),1,0,'C');

           if ($desgloces->comprobante->tipo->nombre == 'Factura de venta crédito') {
                
              $sql_infor1 = \DB::select(' select "recibos".*, "recibo_facturas"."factura_id" as "pivot_factura_id", "recibo_facturas"."recibo_id" as "pivot_recibo_id", "recibo_facturas"."deuda_inicial" as "pivot_deuda_inicial", "recibo_facturas"."deuda_final" as "pivot_deuda_final" from "recibos" inner join "recibo_facturas" on "recibos"."id" = "recibo_facturas"."recibo_id" where "recibo_facturas"."factura_id" =?',[$desgloces->comprobante->factura->id]);


              //dd($sql_infor1 );
            
        

       
          

              $pdf->Ln(12);
              $pdf->SetFont('Arial','B',16);
              $pdf->Cell(190,5,utf8_decode("Recibo de pago"),0,1,'C');



              $pdf->SetFont('Arial','B',10);
              $pdf->Ln(6);
              $pdf->SetX(10);
              $pdf->Cell(30,6,"Deuda Inicial",1,0,'C');
              $pdf->Cell(60,6,"Monto Recibido",1,0,'C');
              $pdf->Cell(30,6,"Deuda Final",1,0,'C');
              $pdf->Cell(50,6,"Fecha y Hora de pagos",1,0,'C');
                foreach ($sql_infor1 as $key => $value) {

                $pdf->Ln(6);
                $pdf->Cell(30,6,number_format($value->pivot_deuda_inicial,2,",","."),1,0,'C');
                $pdf->Cell(60,6,number_format($value->monto,2,",","."),1,0,'C');
                $pdf->Cell(30,6,number_format($value->pivot_deuda_final,2,",","."),1,0,'C');
                $pdf->Cell(50,6,$value->fecha,1,0,'C');
                
             }
         }

        
        //save file
        $headers=['Content-Type'=>'application/pdf'];
        return Response($pdf->Output(), 200, $headers);

           
    }

    public function vencimientos(Request $request){
        $fecha = $request->fecha;
        $fecha_fin = $request->fecha_fin;   
        $cliente_id = $request->cliente_id;

        $vencimientos = Factura::where('facturas.id','>','0');
        
        if($cliente_id != null){
            $vencimientos->filtrarPorCliente($cliente_id, 'and');
        }
        if($fecha){
            $vencimientos->filtrarPorFecha($request->fecha, 'and');         
        }
        if(!$request->mostrar_facturas_pagas){
            $vencimientos = $vencimientos->where('deuda_actual', '>', 0, 'and');
        }
        if($request->ocultar_facturas_vencidas){
            $vencimientos = $vencimientos->where('fecha_vencimiento', '>', date('Y-m-d'), 'and');
        }
        
        $vencimientos = $vencimientos->orderby('fecha_vencimiento')
                        ->paginate(50);
                
        return view('admin.facturas.vencimientos')->with(compact('vencimientos'));
    }


    public function nuevoRecibo($cliente_id){
        $cliente = Cliente::where('id', $cliente_id)->first();
        $monedas = Moneda::all();       
        if($cliente){
            $facturas = Factura::buscarPorCliente($cliente->id)
                    ->where('deuda_actual', '>', 0)
                    ->orderby('fecha_vencimiento')
                    ->get();                    
            $total_adeudado = 0;
            $total_atrasado = 0;
            for ($i=0; $i < sizeof($facturas) ; $i++) {
                $total_adeudado += $facturas[$i]->deuda_actual;

                $hoy = time();
                $fecha_vencimiento = strtotime($facturas[$i]->fecha_vencimiento);
                $date_diff = $fecha_vencimiento - $hoy;
                $dias_restantes = round($date_diff / (60 * 60 * 24));

                if($dias_restantes < 0)
                    $total_atrasado += $facturas[$i]->deuda_actual;
            }
            return view('admin.facturas.nuevo_recibo')->with(compact('cliente', 'facturas', 'monedas', 'total_atrasado', 'total_adeudado'));
        }else{
           $notification = array(
                    'message' => '¡No se encontró ningún cliente para el ID especificado.!',
                    'alert-type' => 'error'
                     );   
            return Redirect::to('/comprobantes/vencimientos')->with($notification);
        }
    }

 
    public function nuevoReciboFactura($proveedor_id){
        $proveedor = Proveedor::where('id', $proveedor_id)->first();
        $monedas = Moneda::all();       
        if($proveedor){
            $facturas = FacturasCompras::with('compras')
                    ->where('deuda_actual', '>', 0)
                    ->orderby('fecha_vencimiento')
                    ->where('proveedor_id',$proveedor_id)
                    ->get();                   
            $total_adeudado = 0;
            $total_atrasado = 0;
            for ($i=0; $i < sizeof($facturas) ; $i++) {
                $total_adeudado += $facturas[$i]->deuda_actual;

                $hoy = time();
                $fecha_vencimiento = strtotime($facturas[$i]->fecha_vencimiento);
                $date_diff = $fecha_vencimiento - $hoy;
                $dias_restantes = round($date_diff / (60 * 60 * 24));

                if($dias_restantes < 0)
                    $total_atrasado += $facturas[$i]->deuda_actual;
            }
            return view('admin.facturas.nuevo_recibo_factura')->with(compact('proveedor', 'facturas', 'monedas', 'total_atrasado', 'total_adeudado'));
        }else{
           $notification = array(
                    'message' => '¡No se encontró ningún proveedor para el ID especificado.!',
                    'alert-type' => 'error'
                     );   
            return Redirect::to('/comprobantes/vencimientos')->with($notification);
        }
    }



    public function guardarReciboFactura (Request $request){        
        $facturas = json_decode($request->facturas_seleccionadas);      
        

        $usuario = Auth::user();
        $moneda = Moneda::find($request->moneda);
        $proveedor = Proveedor::find($request->proveedor);
        
        $fecha = $request->fecha;
        $cotizacion = $request->cotizacion;
        $monto = $request->monto;       

       
        try{
            $recibo = new RecibosCompras();
           
            $recibo->moneda()->associate($moneda);      
            $recibo->usuario()->associate($usuario);        
            $recibo->proveedor()->associate($proveedor);
            
            $recibo->fecha = date("Y-m-d H:i:s");
            $recibo->monto = $monto;
            
            if($cotizacion)
                $recibo->cotizacion = $request->cotizacion;
            
            // Auxiliar para ir cancelando las facturas
            $saldo_aux = $recibo->monto;            
            // factura_id, deuda_actual, a_pagar, saldo_final
            for ($i=0; $i < count($facturas); $i++) {               
                if($saldo_aux > 0){
                    $factura = FacturasCompras::find($facturas[$i]->factura_id);
                    if($factura){
                        if($factura->deuda_actual > 0){
                            // PAGO PARCIAL O JUSTO
                            if($factura->deuda_actual >= $saldo_aux){
                                // variables temporales
                                $deuda_inicial = $factura->deuda_actual;
                                $deuda_final = round($factura->deuda_actual - $saldo_aux);
                                
                                // Asociamos recibo con todos sus datos a la factura.
                                $factura->recibos()->save($recibo, ['deuda_inicial' => $deuda_inicial, 'deuda_final' => $deuda_final]);

                                // Una vez hecho esto, actualizamos deuda de la factura
                                $factura->deuda_actual = $deuda_final;
                                
                                $factura->save();
                                $saldo_aux = 0;
                            // ESTOY PAGANDO DE MAS
                            }else{
                                // variables temporales
                                $deuda_inicial = $factura->deuda_actual;
                                $deuda_final = 0;                               

                                // Asociamos recibo con todos sus datos a la factura.
                                $factura->recibos()->save($recibo, ['deuda_inicial' => $deuda_inicial, 'deuda_final' => $deuda_final]);

                                // Restamos al saldo actual lo que pagamos
                                $saldo_aux -= $deuda_inicial;
                                $factura->deuda_actual = 0;
                                $factura->save();
                            }                           
                        }
                    }
                }               
            }
            $notification = array(
                    'message' => '¡El recibo fue ingresado correctamente!',
                    'alert-type' => 'success'
                     );  
            return Redirect::to('comprobantes/recibos/factura/nuevo/'.$proveedor->id)->with($notification);
        } catch ( \Illuminate\Database\QueryException $e) {
            dd($e);
            return Redirect::back();
        }
    }



    public function guardarRecibo(Request $request){        
        $facturas = json_decode($request->facturas_seleccionadas);      

        $usuario = Auth::user();
        $moneda = Moneda::find($request->moneda);
        $cliente = Cliente::find($request->cliente);
        
        $fecha = $request->fecha;
        $cotizacion = $request->cotizacion;
        $monto = $request->monto;       

        try{
            $recibo = new Recibo();
            // Entidades asociadas
            $recibo->moneda()->associate($moneda);      
            $recibo->usuario()->associate($usuario);        
            $recibo->cliente()->associate($cliente);
            
            $recibo->fecha = date("Y-m-d H:i:s");
            $recibo->monto = $monto;
            
            if($cotizacion)
                $recibo->cotizacion = $request->cotizacion;
            
            // Auxiliar para ir cancelando las facturas
            $saldo_aux = $recibo->monto;            
            // factura_id, deuda_actual, a_pagar, saldo_final
            for ($i=0; $i < count($facturas); $i++) {               
                if($saldo_aux > 0){
                    $factura = Factura::find($facturas[$i]->factura_id);
                    if($factura){
                        if($factura->deuda_actual > 0){
                            // PAGO PARCIAL O JUSTO
                            if($factura->deuda_actual >= $saldo_aux){
                                // variables temporales
                                $deuda_inicial = $factura->deuda_actual;
                                $deuda_final = round($factura->deuda_actual - $saldo_aux);
                                
                                // Asociamos recibo con todos sus datos a la factura.
                                $factura->recibos()->save($recibo, ['deuda_inicial' => $deuda_inicial, 'deuda_final' => $deuda_final]);

                                // Una vez hecho esto, actualizamos deuda de la factura
                                $factura->deuda_actual = $deuda_final;
                                
                                $factura->save();
                                $saldo_aux = 0;
                            // ESTOY PAGANDO DE MAS
                            }else{
                                // variables temporales
                                $deuda_inicial = $factura->deuda_actual;
                                $deuda_final = 0;                               

                                // Asociamos recibo con todos sus datos a la factura.
                                $factura->recibos()->save($recibo, ['deuda_inicial' => $deuda_inicial, 'deuda_final' => $deuda_final]);

                                // Restamos al saldo actual lo que pagamos
                                $saldo_aux -= $deuda_inicial;
                                $factura->deuda_actual = 0;
                                $factura->save();
                            }                           
                        }
                    }
                }               
            }
            $notification = array(
                    'message' => '¡El recibo fue ingresado correctamente!',
                    'alert-type' => 'success'
                     );  
            return Redirect::to('/comprobantes/recibos/nuevo/'.$cliente->id)->with($notification);
        } catch ( \Illuminate\Database\QueryException $e) {
            dd($e);
            return Redirect::back();
        }
    }
}
