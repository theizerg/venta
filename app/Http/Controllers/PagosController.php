<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\ModoPago;
use App\Models\TipoPagoEmpleados;
use App\Models\Pago;
use App\Models\Gastos;
use App\Models\LineaTrabajador;
use App\Models\Sucursales;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        $pagos     = Pago::get();
        //dd($pagos);
        return view ('admin.pagos.index', compact('pagos'));

            
          
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos     = TipoPagoEmpleados::all();
        $empleados = Empleado::all();
        $sucursales = Sucursales::pluck('nombre', 'id');

        //dd($empleados);
        return view('admin.pagos.create', compact('tipos','empleados','sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request);
        $empleado = Empleado::find($request->empleado_id);

        $pagos = new Pago();

        $pagos->empleado_id           = $request->empleado_id;
        $pagos->usuario_id            = $request->usuario_id;        
        $pagos->tipo_pago_empleado_id = $request->tipo_pago_empleado_id;
        $pagos->nu_cantidad_tipo_pago = $empleado->sueldo_base;
        $pagos->tx_descripcion        = $request->tx_descripcion;
        $pagos->fecha                 = $request->fecha;
        $pagos->sucursal_id                 = $request->sucursal_id;

        if ($request->tipo_pago_empleado_id == 2){

       

       
        if ($empleado->cargo_id == 1) 
        {
            $pagos->total                 =  $request->total;

        }
        elseif ($empleado->cargo_id == 3) 
        {
             $pagos->total                 =  $request->total;
        }
        else
        {
             $pagos->total                 =  $empleado->sueldo_base;
        }


        $gastos = new Gastos();

        $gastos->tipo_gasto_id     = 1;
        $gastos->cantidad          = $pagos->total;        
        $gastos->fecha             = date('d/m/Y');
        $gastos->descripcion       = $request->tx_descripcion;
        $gastos->sucursal_id       = $request->sucursal_id;


        $pagos->save();
        $gastos->save();

        $trabajador = new LineaTrabajador();

        $trabajador->empleado_id = $request->empleado_id;
        $trabajador->tipo_actividad = 'PAGO';
        $trabajador->usuario_id = \Auth::user()->id;
        $trabajador->descripcion = $request->tx_descripcion.' '.$empleado->sueldo_base.'$';
        $trabajador->fecha = date('d/m/Y');
        $trabajador->estado_actividad = 1;

        $trabajador->save();

        $notification = array(
            'message' => '¡Pago generado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('empleado/pagos')->with($notification);


        }
        elseif ($request->tipo_pago_empleado_id == 3) {

        $pagos->total                 = $empleado->sueldo_base; - $request->total;

        $gastos = new Gastos();
        
        $gastos->tipo_gasto_id       = 1;
        $gastos->cantidad            = $pagos->total;        
        $gastos->fecha               = date('d/m/Y');
        $gastos->descripcion         = $request->tx_descripcion;

        $pagos->save();
        $gastos->save();

        $trabajador = new LineaTrabajador();

        $trabajador->empleado_id = $request->empleado_id;
        $trabajador->tipo_actividad = 'PAGO';
        $trabajador->usuario_id = \Auth::user()->id;
        $trabajador->descripcion = $request->tx_descripcion;
        $trabajador->fecha = date('d/m/Y');
        $trabajador->estado_actividad = 1;

        $trabajador->save();
        
        $notification = array(
            'message' => '¡Pago generado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleado/pagos')->with($notification);
 

        }
         elseif ($request->tipo_pago_empleado_id == 1) {

        $pagos->total                 = $empleado->sueldo_base + $request->total;
       

        $gastos = new Gastos();

        $gastos->tipo_gasto_id     = 1;
        $gastos->cantidad          = $pagos->total;        
        $gastos->fecha             = date('d/m/Y');
        $gastos->descripcion       = $request->tx_descripcion;
        $gastos->sucursal_id       = $request->sucursal_id;

        $trabajador = new LineaTrabajador();

        $trabajador->empleado_id = $request->empleado_id;
        $trabajador->tipo_actividad = 'PAGO';
        $trabajador->usuario_id = \Auth::user()->id;
        $trabajador->descripcion = $request->tx_descripcion;
        $trabajador->fecha = date('d/m/Y');
        $trabajador->estado_actividad = 1;

        

        $pagos->save();
        $gastos->save();
        $trabajador->save();

        $notification = array(
            'message' => '¡Pago generado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleado/pagos')->with($notification);
 

        }

        elseif ($request->tipo_pago_empleado_id == 4) {

        $pagos->total                 = $request->total;

        $gastos = new Gastos();

        $gastos->tipo_gasto_id     = 1;
        $gastos->cantidad          = $pagos->total;        
        $gastos->fecha             = date('d/m/Y');
        $gastos->descripcion       = $request->tx_descripcion;
        $gastos->sucursal_id       = $request->sucursal_id;

        $pagos->save();
        $gastos->save();
       
        $trabajador = new LineaTrabajador();

        $trabajador->empleado_id = $request->empleado_id;
        $trabajador->tipo_actividad = 'PAGO';
        $trabajador->usuario_id = \Auth::user()->id;
        $trabajador->descripcion = $request->tx_descripcion;
        $trabajador->fecha = date('d/m/Y');
        $trabajador->estado_actividad = 1;

        $trabajador->save();

        $notification = array(
            'message' => '¡Pago generado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleado/pagos')->with($notification);
 

        }
        
        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagos     = Pago::find($id);
        return view ('admin.pagos.show', compact('pagos')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagos     = Pago::find($id);
        $tipos     = TipoPagoEmpleados::all();
        $modos     = ModoPago::all();
        $empleados = Empleado::all();
         $sucursales = Sucursales::pluck('nombre', 'id');
        return view ('admin.pagos.edit', compact('pagos','tipos','modos','empleados','sucursales'));
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
         $pagos = Pago::find($id);

         $empleado = Empleado::find($request->empleado_id);


        $pagos->empleado_id           = $request->empleado_id;
        $pagos->usuario_id            = $request->usuario_id;        
        $pagos->tipo_pago_empleado_id = $request->tipo_pago_empleado_id;
        //$pagos->modo_pagos_id         = $request->modo_pagos_id;
        //$pagos->nu_sueldo_base        = $empleado->sueldo_base;;
        $pagos->nu_cantidad_tipo_pago = $request->total;
        $pagos->tx_descripcion        = $request->tx_descripcion;
        $pagos->fecha                 = $request->fecha;

        if ($request->tipo_pago_empleado_id == 2){


      // dd($empleado->cargo_id == 1);
        if ($empleado->cargo_id == 1) {
            
          $pagos->total                 =  $request->total;
        }

        $pagos->total                 = $empleado->sueldo_base;

        $pagos->update($request->all());

        $notification = array(
            'message' => '¡Pago generado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleado/pagos')->with($notification);


        }
        elseif ($request->tipo_pago_empleado_id == 3) {

        $pagos->total                 = $empleado->sueldo_base; - $request->total;

        $pagos->update($request->all());

        $notification = array(
            'message' => '¡Pago generado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleado/pagos')->with($notification);
 

        }
         elseif ($request->tipo_pago_empleado_id == 1) {

        $pagos->total                 = $empleado->sueldo_base; + $request->total;

        $pagos->update($request->all());

        $notification = array(
            'message' => '¡Pago generado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleado/pagos')->with($notification);
 

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $pago = Pago::find($id);
        $gasto = Gastos::find($id);

        $pago->delete();
        $gasto->delete();

        $notification = array(
            'message' => '¡Pago eliminado!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleado/pagos')->with($notification);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imprimir($id)
    {
        $fecha = "04/07/2018";
        
        $pdf= app('Fpdf');

        $pdf->AddPage();
       
        $pdf->Ln(1);

        $pago = Pago::find($id);    
        
        
              
         $pdf->Image('images/logo/logo7_9_122716.png',5,2,40,40,'PNG');
         $pdf->SetY(10);
        
         $pdf->SetXY(150,10);
         $pdf->SetFont('Arial','B',12);
         $pdf->Cell(60,5,utf8_decode("Fecha: ".date("d/m/Y")),0,1,'L');
         $pdf->SetXY(150,15);
         $pdf->Ln(10);

         $pdf->Ln(10);
         $pdf->SetFont('Arial','B',12);
         $pdf->Cell(190,5,utf8_decode("Nombre y Apellido: ".$pago->empleado->nb_nombre." ".$pago->empleado->nb_apellido),0,1,'L');
        $pdf->Cell(190,5,utf8_decode("Cédula: ".$pago->empleado->nu_cedula),0,1,'L'); 
         $pdf->Cell(190,5,utf8_decode("Fecha de ingreso: ".date('d-m-Y', strtotime($pago->empleado->fe_ingreso))),0,1,'L');
         $pdf->Cell(190,5,utf8_decode("Profesion: ".$pago->empleado->nb_profesion),0,1,'L');
        

          $pdf->Ln(10);
          $pdf->SetFont('Arial','B',16);
          $pdf->Cell(190,5,utf8_decode("Recibo de pago"),0,1,'C');
        
          $pdf->SetFont('Arial','B',10);
          $pdf->Ln(6);
          $pdf->SetX(10);
          $pdf->Cell(85,6,"Tipo de pago",1,0,'C');
          $pdf->Cell(95,6,"Fecha",1,0,'C');
          $pdf->Ln(6);
          $pdf->Cell(85,6,utf8_decode($pago->tipopago->nb_tipo_pago_empleado),1,0,'C');
          $pdf->Cell(95,6,date('d-m-Y', strtotime($pago->fecha)),1,0,'C');
          $pdf->Ln(6);
          $pdf->Cell(180,6,"Descripcion",1,0,'C');
          $pdf->Ln(6);
          $pdf->MultiCell(180,10,utf8_decode($pago->tx_descripcion),1,'C'); ;
          
          $pdf->Ln(10);
          $pdf->SetX(10);
          $pdf->Cell(30,6,"Sueldo base: ",1,0,'C');


          if ($pago->empleado->sueldo_base == 0) {
          $pdf->Cell(30,6,'Ninguno',1,0,'C');
          }
          else
          $pdf->Cell(30,6,number_format($pago->empleado->sueldo_base,2),1,0,'C');
          $pdf->Ln(6);
          $pdf->SetX(10);
          $pdf->Cell(30,6,"Monto: ",1,0,'C');
          $pdf->Cell(30,6,number_format($pago->nu_cantidad_tipo_pago,2),1,0,'C');
          $pdf->Ln(6);
          $pdf->SetX(10);
          $pdf->Cell(30,6,"Total a pagar: ",1,0,'C');


          if ($pago->tipo_pago_empleado_id == 1){
            $total = $pago->total ;
            $bono = $pago->empleado->sueldo_base;
            $total_pago = $total + $bono;

            $pdf->Cell(30,6,number_format($total_pago,2),1,0,'C');

          } 
          elseif ($pago->tipo_pago_empleado_id == 3) {
            $total = $pago->total ;
            $bono = $pago->nu_cantidad_tipo_pago;
            $total_pago = $total ;

            $pdf->Cell(30,6,number_format($total_pago,2),1,0,'C');
          }
           elseif ($pago->tipo_pago_empleado_id == 2) {
            $total = $pago->total ;
            $bono = $pago->nu_cantidad_tipo_pago;
            $total_pago = $total ;

            $pdf->Cell(30,6,number_format($total_pago,2),1,0,'C');
          }
           elseif ($pago->tipo_pago_empleado_id == 4) {
            $total = $pago->total ;
            $bono = $pago->nu_cantidad_tipo_pago;
            $total_pago = $total ;

            $pdf->Cell(30,6,number_format($total_pago,2),1,0,'C');
          }
          
          

          

     
        
        //save file
        $headers=['Content-Type'=>'application/pdf'];
        return Response($pdf->Output(), 200, $headers);
    }



}
