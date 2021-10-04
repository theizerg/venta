<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Caja;
use App\Models\Contabilidad;
use App\Models\HistorialCajas;

class AperturaCajaController extends Controller
{
  
    public function __construct()
    {
       
        $this->middleware('permission:AperturarCaja')->only('create'); 

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public  function usuario(){

        $usuario_id= \Auth::user()->id;
            
         return $usuario_id;
    }


      public function index(Request $request)
    {
        $usuario= \Auth::user()->id;

        $id = $this->usuario();

        
        if($id <> 1 ){

             $buscar = $request->get('buscar');

        if(!$buscar){
            $mytime = Carbon::now('America/Lima');
            $buscar=$mytime->format('Y-m-d');
        }

        $config = DB::table('configuraciones')->first();
        $cajas = DB::table('cajas')
        ->where('fecha','=',$buscar)
        ->get();

         return view('admin.apertura.index', compact('cajas','config'));
        }

          $buscar = $request->get('buscar');

        if(!$buscar){
            $mytime = Carbon::now('America/Lima');
            $buscar=$mytime->format('Y-m-d');
        }

        $config = DB::table('configuraciones')->first();
        $cajas = DB::table('cajas')
        ->where('fecha','=',$buscar)
        ->get();

         return view('admin.apertura.index', compact('cajas','config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deno = DB::table('denominacion')
        ->orderby('id','desc')
        ->get();

        $caja = DB::table('cajas')
        ->get();

        $config = DB::table('configuraciones')->first();

        $cajas = explode(",",$config->cajas);

        
        $mytime = Carbon::now('America/Caracas');
        $fecha=$mytime->format('Y-m-d');

         $today = getdate();
        $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $config = \DB::table('configuraciones')->first();
        $current_month = $today['mon'];
        $current_year = $today['year'];
        $mes_actual =$data_month[$current_month - 1];
        //dd($mes_actual);

        $nombre_dia = date('w');
        switch($nombre_dia)
        {
            case 1: $nombre_dia="Lunes";
            break;
            case 2: $nombre_dia="Martes";
            break;
            case 3: $nombre_dia="Miercoles";
            break;
            case 4: $nombre_dia="Jueves";
            break;
            case 5: $nombre_dia="Viernes";
            break;
            case 6: $nombre_dia="Sabado";
            break;
        }
        //dd($nombre_dia);

        return view('admin.apertura.create',compact('deno','caja','config','fecha','cajas','mes_actual','nombre_dia'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        
         try {

            /*OBTENER DATOS DE LA CAJA */
            $cantidades = $request->get('cantidad');
            $denominacion = $request->get('denominacion');
            $valor = $request->get('valor');

            $deno = $request->get('deno');
            $cont = 0;

            /*OBTENER LA FECHA */
            $mytime = Carbon::now('America/Lima');
            $fecha=$mytime->format('Y-m-d');

            /**OBTENER MES */
            $today = getdate();

            $valid_caja = DB::table('cajas')
            ->where([
                ['caja','=',$request->get('caja')],
                ['fecha','=',$fecha]
            ])
            ->first();

            if($valid_caja){
                Session::flash('warning', 'Ya se aperturó una caja para ese cajero este día');
                return redirect()->back();
            };

            /**Obtener hora local*/
            $hora = new DateTime("now", new DateTimeZone('America/Lima'));

            /*OBTENER FECHA*/

            $codigo_caja = uniqid();

            $caja = new Caja;
            $caja->codigo = $codigo_caja;
            $caja->fecha = $fecha;
            $caja->hora = $hora->format('H:i:s');
            $caja->idusers=auth()->user()->id;
            $caja->monto = $request->get('monto');
            $caja->caja = $request->get('caja');
            $caja->estado = 'Abierta';
            $caja->mes=$today['mon'];
            $caja->monto_cierre = '0';
            $caja->year = $today['year'];
            $caja->save();

            $user = User::findOrFail(auth()->user()->id);
            $user->caja =$codigo_caja;
            $user->update();

            while($cont<count($cantidades)){
                $contabilidad = new Contabilidad;
                $contabilidad->denominacion = $denominacion[$cont];
                $contabilidad->valor = $valor[$cont];
                $contabilidad->cantidad = $cantidades[$cont];
                $contabilidad->idcaja =$caja->id;
                $contabilidad->modo = 'Apertura';
                $contabilidad->save();

                $cont = $cont+1;
            }
           

            Session::flash('success', 'Se abrió la caja para el día hoy: '. $fecha .' - '. $hora->format('H:i:s'));
            return Redirect::to('panel/contabilidad');
        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back(); 
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
