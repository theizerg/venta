<?php

namespace App\Http\Controllers;

use App\Models\Gastos;
use App\Models\TipoGastos;
use App\Models\Sucursales;
use Illuminate\Http\Request;

class GastosController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:VerGastos')->only('index'); 
        $this->middleware('permission:RegistrarGastos')->only('create');
        $this->middleware('permission:VerGastos')->only('show');
        $this->middleware('permission:EditarGastos')->only('edit');  

    }

 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastos = Gastos::get();

        return view ('admin.gastos.index',compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gastos = Gastos::orderBy('id','Asc')->get();
        $tipog  = TipoGastos::where('id', '<>', 1)->get();
        $sucursales = Sucursales::pluck('nombre','id');

        return view ('admin.gastos.create', compact('gastos','tipog','sucursales'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->empleado_id == 1) {
            
        $notification = array(
            'message' => '¡Los pagos de empleados se registran en el módulo pagos de empleados!',
            'alert-type' => 'error'
        );
        
        return \Redirect::to('/gastos/create')->with($notification);

        } else {
        
         $gasto = new Gastos();

        $gasto->tipo_gasto_id           = $request->empleado_id;
        $gasto->cantidad                = $request->nu_cantidad_tipo_pago;        
        $gasto->descripcion             = $request->descripcion;
        $gasto->sucursal_id                = $request->sucursal_id;      
        $gasto->fecha                   = date('d/m/Y');

        $gasto->save();

        $notification = array(
            'message' => '¡Gasto ingresado!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/gastos/create')->with($notification);
        }
        

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function show(Gastos $gastos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function edit(Gastos $gastos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gastos $gastos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gastos $gastos)
    {
        //
    }
}
