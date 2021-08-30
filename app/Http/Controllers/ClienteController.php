<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\TipoDocumento;
use App\Models\Cliente;

class ClienteController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('permission:VerCliente')->only('index'); 
        $this->middleware('permission:RegistrarCliente')->only('nuevo');
        $this->middleware('permission:EditarCliente')->only('editar');
        $this->middleware('permission:VerCliente')->only('detalle'); 

    }



    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');
        $clientes = CLiente::FiltrarPorNombre($busqueda)
            ->FiltrarPorApellido($busqueda)
            
            ->get();
        return view('admin.clientes.index')->with(compact('clientes'));
    }

    public function nuevo()
    {
        $tipos_documento = TipoDocumento::all();
        $clientes = Cliente::all();
        return view('admin.clientes.nuevo')->with(compact('tipos_documento', 'clientes'));
    }

    public function guardar(Request $request){

        $cliente = new Cliente();
        if($request->cliente_id){

            $cliente = Cliente::find($request->cliente_id);

            if($cliente->empresa){
                $cliente->nombre = $request->razonSocial;
                $cliente->rif = $request->rif;
            }else{
                $cliente->nombre = $request->nombre;
                $cliente->apellido = $request->apellido;
                $cliente->genero = $request->genero;
            }


            $cliente->mail = $request->mail;
            $cliente->direccion = $request->direccion;
            $cliente->telefono = $request->telefono;
            $cliente->save();
            $notification = array(
            'message' => 'Datos Modificados!',
            'alert-type' => 'success'
        );
            return Redirect::to('/clientes/detalle/'.$cliente->id)->with($notification);
        }else{

            if($request->tipo_cliente == "persona"){
                $existe = Cliente::FiltrarPorNombre($request->nombre)->count();
                if ($existe) {
                     $notification = array(
                     'message' => '¡El cliente ya existe!',
                     'alert-type' => 'error'
                     );
                 return Redirect::back()->with($notification);
                }else
                $cliente->nombre = $request->nombre;
                $cliente->apellido = $request->apellido;
                if($request->tipo_documento != null){
                    $cliente->documento = $request->documento;
                    $cliente->tipo_documento = $request->tipo_documento;
                }
            }else{


                $cliente->nombre = $request->razonSocial;
                $cliente->rut = $request->rif;
                $cliente->empresa = 1;
            }
            $cliente->mail = $request->mail;
            $cliente->direccion = $request->direccion;          
            $cliente->telefono = $request->telefono;

              $existe = Cliente::FiltrarPorRut($request->rif)->count();
              //dd($existe);
                if ($existe) {
                     $notification = array(
                     'message' => '¡El cliente ya existe!',
                     'alert-type' => 'error'
                     );
                 return Redirect::back()->with($notification);
           
        }else{
             $cliente->save();
             $notification = array(
            'message' => 'Datos Ingresados!',
            'alert-type' => 'success'
        );
            return Redirect::to('clientes/nuevo/')->with($notification);
        }
    }
}
   

    public function detalle($cliente_id){
        $cliente = Cliente::find($cliente_id);
        $comprobantes = $cliente->comprobantes()->get();
        return view('admin.clientes.detalle')->with(compact('cliente', 'comprobantes'));
    }

    public function buscar(Request $request){
        $texto = $request->texto;
        $clientes = Cliente::FiltrarPorNombre($texto)
                        ->FiltrarPorApellido($texto)
                        
                        ->FiltrarPorMail($texto)
                        ->get();
        return Response()->json([
            'clientes' => $clientes
        ]);
    }
}
