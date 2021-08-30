<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('permission:VerSucursales')->only('index'); 
        $this->middleware('permission:RegistrarSucursales')->only('nuevo');
        $this->middleware('permission:EditarSucursales')->only('editar');
        $this->middleware('permission:VerSucursales')->only('detalle'); 

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sucursales = Sucursales::get();
        return view ('admin.sucursales.index', compact('sucursales'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nuevo()
    {
        $sucursales= Sucursales::get();
        return view('admin.sucursales.nuevo',compact('sucursales'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $su = $request->sucursal_id;

       
        if ($su != null) {
            
            $sucursal = Sucursales::find($su);
            $sucursal->nombre = $request->nombre;
            $sucursal->telefono = $request->telefono;
            $sucursal->direccion = $request->direccion;
            $sucursal->rif = $request->rif;
            $sucursal->status = $request->status; 
            $sucursal->save();
            $notification = array(
            'message' => '¡Datos Modificados!',
            'alert-type' => 'success'
        );
            return \Redirect::to('/sucursales/detalle/'.$sucursal->id)->with($notification);
        }else
        {
            $sucursal = new Sucursales();
            $sucursal->nombre = $request->nombre;
            $sucursal->telefono = $request->telefono;
            $sucursal->direccion = $request->direccion;
            $sucursal->rif = $request->rif;
            $sucursal->status = $request->status; 
            $sucursal->save();
            $notification = array(
            'message' => '¡Datos ingresado!',
            'alert-type' => 'success'
        );
            return \Redirect::to('/sucursales/detalle/'.$sucursal->id)->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursales  $sucursales
     * @return \Illuminate\Http\Response
     */
     public function detalle($sucursal_id){
        $sucursal = Sucursales::find($sucursal_id);
        return view('admin.sucursales.detalle')->with(compact('sucursal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursales  $sucursales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursales $sucursales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursales  $sucursales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursales $sucursales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursales  $sucursales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursales $sucursales)
    {
        //
    }
}
