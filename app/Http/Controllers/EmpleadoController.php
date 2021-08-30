<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\ModoPago;
use App\Models\Cargo;
use App\Models\LineaTrabajador;
use App\Models\Sucursales;
use Carbon\Carbon;

class EmpleadoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:VerEmpleados')->only('index'); 
        $this->middleware('permission:RegistrarEmpleados')->only('create');
        $this->middleware('permission:VerEmpleados')->only('show');
        $this->middleware('permission:EditarEmpleados')->only('edit');  

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados=Empleado::get();


    
        return view('admin.empleados.index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados=Empleado::get();
        $modos     = ModoPago::pluck('nb_modo_pago','id');
        $cargos =Cargo::pluck('nombre','id');
        $sucursales = Sucursales::pluck('nombre','id');
        //dd($cargos);
       return view('admin.empleados.create', compact('empleados','modos','cargos','sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $edad = Carbon::parse($request->fecha_nacimiento)->age; // 1990-10-25

        //dd($edad);
        $empleados = new Empleado();

        $empleados->fecha_nacimiento = $request->fecha_nacimiento;
        $empleados->edad = $edad;
        $empleados->nb_nombre = $request->nb_nombre;
        $empleados->nb_apellido = $request->nb_apellido;
        $empleados->nu_cedula = $request->nu_cedula;
        $empleados->fe_ingreso = $request->fe_ingreso;
        $empleados->telefono = $request->telefono;
        $empleados->nb_profesion = $request->nb_profesion;
        $empleados->sueldo_base = $request->sueldo_base;
        $empleados->usuario_id = $request->usuario_id;
        $empleados->edad = Carbon::parse($empleados->fecha_nacimiento)->age; // 1990-10-25
        $empleados->modo_pagos_id = $request->modo_pagos_id;
        $empleados->cargo_id = $request->cargo_id;
        $empleados->sucursal_id = $request->sucursal_id;

        $empleados->save();

        $notification = array(
            'message' => '¡Empleado creado satisfactoriamente!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleados/create')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);
        $modos     = ModoPago::pluck('nb_modo_pago','id');
        $cargos =Cargo::pluck('nombre','id');
        $trabajador = $empleado->trabajos()->get();
        $sucursales = Sucursales::pluck('nombre','id');

        return view('admin.empleados.show')->with(compact('empleado','modos','cargos', 'trabajador','sucursales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleados= Empleado::find($id);
        $sucursales = Sucursales::pluck('nombre','id');
        $modos     = ModoPago::pluck('nb_modo_pago','id');
        $cargos =Cargo::pluck('nombre','id');
        return view('admin.empleados.edit',compact('empleados','modos','cargos','sucursales'));
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
       // dd($request);
        $empleados = Empleado::find($id);

        $empleados->nb_nombre = $request->nb_nombre;
        $empleados->nb_apellido = $request->nb_apellido;
        $empleados->nu_cedula = $request->nu_cedula;
        $empleados->fe_ingreso = $request->fe_ingreso;
        $empleados->telefono = $request->telefono;
        $empleados->nb_profesion = $request->nb_profesion;
        $empleados->sueldo_base = $request->sueldo_base;
        $empleados->usuario_id = $request->usuario_id;
        $empleados->modo_pagos_id = $request->modo_pagos_id;
        $empleados->cargo_id = $request->cargo_id;
        $empleados->usuario_id = \Auth::user()->id;
        $empleados->sucursal_id = $request->sucursal_id;
        $empleados->save();
        

        $notification = array(
            'message' => 'Empleado Actualizado!',
            'alert-type' => 'success'
        );
        
        return \Redirect::to('/empleados')->with($notification);
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
