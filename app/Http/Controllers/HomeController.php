<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Log\LogSistema;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\LineaProducto;
use Carbon\Carbon;
use App\Models\Gastos;
use App\Models\Ganancia;
use App\Models\Notificacion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if (\Auth::user()->hasRole('Super Administrador')) {

        
        $gastos     = Gastos::sum('cantidad');
        $ganancias  = Ganancia::sum('total');


            //dd(LogSistema::get());
        $date_current = Carbon::now()->toDateTimeString();

        $prev_date1 = $this->getPrevDate(1);
        $prev_date2 = $this->getPrevDate(2);
        $prev_date3 = $this->getPrevDate(3);
        $prev_date4 = $this->getPrevDate(4);

        $emp_count_1  = User::whereBetween('created_at',[$prev_date1,$date_current])->count();
        $emp_count_2  = User::whereBetween('created_at',[$prev_date2,$prev_date1])->count();
        $emp_count_3  = User::whereBetween('created_at',[$prev_date3,$prev_date2])->count();
        $emp_count_4   = User::whereBetween('created_at',[$prev_date4,$prev_date3])->count();

          $notificacion = Notificacion::cargarNotificaciones();
        return view('admin.home.index', compact('gastos',
                                                'ganancias',
                                                'emp_count_1',
                                                'emp_count_2',
                                                'emp_count_3',
                                                'emp_count_4',
                                                'notificacion'
                                                ));
        }else if (\Auth::user()->hasRole('Gerente')) {

             $notificacion = Notificacion::cargarNotificaciones();

            //dd(LogSistema::get());
        $date_current = Carbon::now()->toDateTimeString();

        $prev_date1 = $this->getPrevDate(1);
        $prev_date2 = $this->getPrevDate(2);
        $prev_date3 = $this->getPrevDate(3);
        $prev_date4 = $this->getPrevDate(4);

        $venta_count_1  = Comprobante::whereBetween('created_at',[$prev_date1,$date_current])->count();
        $venta_count_2  = Comprobante::whereBetween('created_at',[$prev_date2,$prev_date1])->count();
        $venta_count_3  = Comprobante::whereBetween('created_at',[$prev_date3,$prev_date2])->count();
        $venta_count_4  = Comprobante::whereBetween('created_at',[$prev_date4,$prev_date3])->count();


        $venta_detalle_1  = LineaProducto::whereBetween('created_at',[$prev_date1,$date_current])->sum('total');
        $venta_detalle_2  = LineaProducto::whereBetween('created_at',[$prev_date2,$prev_date1])->sum('total');
        $venta_detalle_3  = LineaProducto::whereBetween('created_at',[$prev_date3,$prev_date2])->sum('total');
        $venta_detalle_4  = LineaProducto::whereBetween('created_at',[$prev_date4,$prev_date3])->sum('total');
       

        //$prev_date12 = $this->getPrevDate(12);
        
        //dd($prev_date0);
        $gastos     = Gastos::sum('cantidad');
        $ganancias  = Ganancia::sum('total');
       

        //dd($gastos, $ganancias);
       

        $notificacion = Notificacion::cargarNotificaciones();

       
        $log = new LogSistema();
        
        $gastos     = Gastos::sum('cantidad');
        $ganancias  = Ganancia::sum('total');

        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado al home del sistema a las: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();
        return view('admin.home.index', compact('gastos',
                                                'ganancias',
                                                'notificacion',
                                                'venta_count_1',
                                                'venta_count_2',
                                                'venta_count_3',
                                                'venta_count_4',
                                                'venta_detalle_1',
                                                'venta_detalle_2',
                                                'venta_detalle_3',
                                                'venta_detalle_4'
                                                ));
      
    }else{
        
        $notificacion = Notificacion::cargarNotificaciones();
        
         $log = new LogSistema();
        
        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado al home del sistema a las: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();
        return view('admin.home.index', compact('notificacion'));

    }
}

    public function logs()
    {   
        //dd(LogSistema::get());

        $logs= LogSistema::get();

        return view('admin.home.logs', compact('logs'));
    }

     private function getPrevDate($num){
        return Carbon::now()->subMonths($num)->toDateTimeString();
    }

    public function borrarNotificacion(Request $request, $notificacion_id){
        
        if($request->ajax()){            
            $notificacion = Notificacion::find($notificacion_id);
            $usuario = \Auth::user();
            if($notificacion != null && $usuario != null){
                $usuario->notificaciones()->detach($notificacion);
                $usuario->save();
                Notificacion::cargarNotificaciones();

                if($notificacion->usuarios()->count() == 0){
                    $notificacion->delete();
                }               
            }
            $notificaciones_total = $usuario->notificaciones()->count();

            return Response()->json([
                'total' => $notificaciones_total,
                'mensaje' => 'Notiicación borrada'
            ]);
        }   
    }

    public function ventadesgloce (Request $request)
    {

        $date_current = Carbon::now()->toDateTimeString();

        $prev_date1 = $this->getPrevDate(1);
        $venta_detalle_1  = LineaProducto::whereBetween('fecha',[$request->desde,$request->hasta])
        ->with('producto')
        ->get();
     
        return view ('admin.home.desgloceganancias', compact('venta_detalle_1'));
       
        

    }   

}
