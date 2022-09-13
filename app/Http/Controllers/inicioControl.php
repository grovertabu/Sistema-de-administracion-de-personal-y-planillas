<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\NominaCargo;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Auth;

class inicioControl extends Controller
{
    public function __invoke(){
        if(!Auth::user()){

            return view('auth.login');
        }
        else{
            $trabajadores = Trabajador::where('estado_trabajador','HABILITADO')->count();
            $nomina_cargos_ocupados = NominaCargo::where('estado','OCUPADO')->count();
            $nomina_cargos_libres = NominaCargo::where('estado','LIBRE')->count();
            $items_habilitados = AsignacionCargo::where([['estado','HABILITADO']])->count();
            return view('dash.index',compact('trabajadores','nomina_cargos_ocupados','nomina_cargos_libres','items_habilitados'));
        }
    }
}
