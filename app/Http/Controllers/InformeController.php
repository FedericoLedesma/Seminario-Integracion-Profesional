<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\Horario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class InformeController extends Controller
{
    public function index(Request $request)
    {
      #$user = Auth::
      $horarios = Horario::all();
      $fecha_actual = Carbon::now();
      return view('informe.index',compact('horarios','fecha_actual'));
    }

    public function create(Request $request)
    {
      $fecha_inicio = $request->get('fecha_inicio');
      $horario_inicio = $request->get('horario_inicio');
      $fecha_fin = $request->get('fecha_fin');
      $horario_fin = $request->get('horario_fin');
      $informe = MenuPersona::generar_informe($fecha_inicio, $fecha_fin, $horario_inicio, $horario_fin);
      $lista = $informe->get_lista();
      $fecha_actual = Carbon::now();
      $horarios = Horario::all();
      return view('informe.create',compact('informe','lista','fecha_actual','horarios',
        'fecha_inicio','horario_inicio','fecha_fin','horario_fin'
      ));
    }

    public function set_realizado(Request $request)
    {
      Log::debug($request);
      $informe = json_decode($request->get('json'),true);
      $valor = json_decode($request->get('realizado'),true);
      foreach($informe['_lista_menu_persona'] as $data){
        Log::debug($data);
        $menu = new MenuPersona($data);
        Log::debug($valor);
        $menu->set_realizado((bool)$valor);
      }
      $fecha_inicio = $request->get('fecha_inicio');
      $horario_inicio = $request->get('horario_inicio');
      $fecha_fin = $request->get('fecha_fin');
      $horario_fin = $request->get('horario_fin');
      $informe = MenuPersona::generar_informe($fecha_inicio, $fecha_fin, $horario_inicio, $horario_fin);
      $lista = $informe->get_lista();
      $fecha_actual = Carbon::now();
      $horarios = Horario::all();
      return view('informe.create',compact('informe','lista','fecha_actual','horarios',
        'fecha_inicio','horario_inicio','fecha_fin','horario_fin'));
    }

}
