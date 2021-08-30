<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CierreCaja;
use App\Models\AperturaCaja;
use App\Models\HistorialCajas;
use App\Models\Caja;

class CierreCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function apertura()
    {
        
        $carbon = new \Carbon\Carbon();
        $date =$carbon->format('Y-m-d');
    
    
        $apertura=AperturaCaja::where('apertura_caja.status','=','1')
        ->where('fecha_emision',$date)
        ->get();
    

        return ( count($apertura) > 0) ? true : false ;
    }

    public  function usuario(){

        $usuario_id= \Auth::user()->id;
            
         return $usuario_id;
    }


    public function index()
    {
        $usuario= \Auth::user()->id;

        $id = $this->usuario();
        $cierres = CierreCaja::get();
             return view('admin.cierre.index')->with([
            'cierres'=> $cierres
            ]);  
           
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
         $apertura = $this->apertura();
            if($apertura){

            $cajas = Caja::all();
             return view('admin.cierre.create')->with([
            'cajas'=> $cajas
            ]);

            }
             $notification = array(
            'message' => '¡Debe iniciar apertura de caja antes de cerrarla!',
            'alert-type' => 'error'
        );
        
        return \Redirect::to('/apertura/create')->with($notification);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cierre = CierreCaja::create($request->all());

        $bolivares     = $request->nu_cantidad_efectivo;
        $dolares       = $request->nu_cantidad_dolares;
        $transferencia = $request->nu_cantidad_pago_movil;
        $pago          = $request->nu_cantidad_transferencias;
        $punto         = $request->nu_cantidad_punto_venta;

        $historial = new HistorialCajas();

        $historial->descripcion = 'El vendedor '. \Auth::user()->name.' ha cerrado|  la caja N°'.$request->caja_id.' con: '.$bolivares.'Bss en efectivo, '.$punto.'Bss por pagos por punto de venta, '.$pago.'Bss por ventas realizadas por pago movil como medio de pago, '.$transferencia.'Bss por pagos recibidos por transferencias, y con '.$dolares.'$ en efectivo.';

        $historial->usuario_id = $request->usuario_id;
        $historial->caja_id = $request->caja_id;
        $historial->fecha =  date("d-m-Y H:i:s");

        $historial->save();

        \DB::table('apertura_caja')
        ->update(
            ['status' => '0']
        );

        $notification = array(
            'message' => '¡Cierre de caja realizado!',
            'alert-type' => 'success'
        );
					return \Redirect::to('/cierre')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
