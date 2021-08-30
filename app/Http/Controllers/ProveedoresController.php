<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Proveedor;

class ProveedoresController extends Controller
{

        public function __construct()
    {
        $this->middleware('permission:VerProveedor')->only('index'); 
        $this->middleware('permission:RegistrarProveedor')->only('nuevo');
        $this->middleware('permission:VerProveedor')->only('detalle'); 

    }


    public function index(Request $request)
    {       
        $busqueda = $request->get('busqueda');
        $proveedores = Proveedor::FiltrarPorNombre($busqueda)
                    ->FiltrarPorRazonSocial($busqueda)
                    ->FiltrarPorRut($busqueda)
                    ->FiltrarPorMail($busqueda)
                    ->orderBy('id')
                    ->get();     
        return view('admin.proveedores.index')->with(compact('proveedores'));
    }

    public function nuevo(){
        $proveedores = Proveedor::all();
        return view('admin.proveedores.nuevo')->with(compact('proveedores'));
    }

    public function guardar(Request $request){
        
       //dd($request);
        $proveedor_id = $request->proveedor_id;
        // Modificar proveedor
        if($proveedor_id){
            $p = Proveedor::find($proveedor_id);
             $notification = array(
                        'message' => 'El proveedor ha sido modificado correctmente.!',
                        'alert-type' => 'success'
                    );
            $url = '/proveedores/detalle/'.$proveedor_id;

        // Nuevo proveedor
        }else{
            if($request->rif){
               $proveedor = Proveedor::buscarPorRut($request->rif)->first();
                if($proveedor <> null){
                    $notification = array(
                        'message' => 'El proveedor ya existe!',
                        'alert-type' => 'error'
                    );
                   
                    $url = '/proveedores/nuevo';
                    return Redirect::to($url)->with($notification);
                }else{
                    $p = new Proveedor();
                    $notification = array(
                        'message' => 'El proveedor ha sido ingresado correctmente.!',
                        'alert-type' => 'success'
                    );
                    $url = '/proveedores/nuevo';
                }
            }else{
                $p = new Proveedor();
                $notification = array(
                        'message' => 'El proveedor ha sido ingresado correctmente.!',
                        'alert-type' => 'success'
                    );
                $url = '/proveedores/nuevo';
            }           
        }       
        if($request->rif)
            $p->rut = $request->rif;        
        if($request->razon_social)
            $p->razon_social = $request->razon_social;

        $p->nombre = $request->nombre;
        $p->telefono = $request->telefono;
        $p->mail = $request->mail;
        $p->direccion = $request->direccion;
        $p->web = $request->web;
        
        $p->save();
        //dd($p);
        return Redirect::to($url)->with($notification);
    }

     public function detalle($cliente_id){
      
        $proveedor = Proveedor::find($cliente_id);

        $compras = $proveedor->compras()->get();
        
      
         
        return view('admin.proveedores.detalle')->with(compact('proveedor', 'compras'));
    }

     public function buscar(Request $request){
        $texto = $request->texto;

        $proveedores = Proveedor::FiltrarPorNombre($texto)
                        ->FiltrarPorRazonSocial($texto)
                        ->FiltrarPorRut($texto)
                        ->FiltrarPorMail($texto)
                        ->get();
        return Response()->json([
            'proveedores' => $proveedores
        ]);
    }
}
