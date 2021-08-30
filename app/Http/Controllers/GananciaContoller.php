<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ganancia;

class GananciaContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:VerGanancias')->only('ganancias'); 

    } 


    public function ganancias()
    {   
        $ganancias= Ganancia::get();
        return view('admin.home.ganancias', compact('ganancias'));
    }
}
