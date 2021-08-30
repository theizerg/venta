<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\AsignacionTrabajo;
use App\Models\LineaTrabajador;

class AsignacionTrabajoController extends Controller
{
   

   public function index()
    {
          
        $asignacion = AsignacionTrabajo::get();
        
        return view('admin.empleados.asignacion.index')->with(compact('asignacion'));
    }

   public function nuevo()
    {
          
        $empleado = Empleado::get();
        
        return view('admin.empleados.asignacion.nuevo')->with(compact('empleado'));
    }

     public function editar($id)
    {
          
        $asignacion = AsignacionTrabajo::find($id);
         $empleado = Empleado::get();
        //dd($empleado);
        return view('admin.empleados.asignacion.editar')->with(compact('asignacion','empleado'));
    }


     public function guardar(Request $request)
    {
         
       
          $asignacion = AsignacionTrabajo::create($request->all());

          $guardado = $asignacion;

          if ($guardado) {
              
              $trabajador = new LineaTrabajador();

              $trabajador->empleado_id = $asignacion->empleado_id;
              $trabajador->tipo_actividad = 'Trabajo asignado';
              $trabajador->usuario_id = \Auth::user()->id;
              $trabajador->descripcion = $asignacion->descripcion;
              $trabajador->fecha = date('d/m/Y');
              $trabajador->estado_actividad = $asignacion->estado_trabajo;

              $trabajador->save();

               $notification = array(
            'message' => 'Datos ingresados!',
            'alert-type' => 'success'
            );

          return \Redirect::to('/empleados/'. $trabajador->empleado_id)->with($notification);
          }



        
    }

     public function actualizar(Request $request, $id)
    {
         
     
          $asignacion = AsignacionTrabajo::find($id);
          $asignacion->update($request->all());

         

               $notification = array(
            'message' => 'Datos ingresados!',
            'alert-type' => 'success'
            );

          return \Redirect::to('/asignaciones')->with($notification);
          }



        
    
}
