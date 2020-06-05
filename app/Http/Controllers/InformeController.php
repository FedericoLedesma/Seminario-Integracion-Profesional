<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\Personal;
use App\Paciente;
use App\Persona;
use App\Horario;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;

class InformeController extends Controller
{
    public function index(Request $request)
    {
      #$user = Auth::
      $horarios = Horario::all();
      $fecha_actual = Carbon::now();
      return view('informe.index_informe',compact('horarios','fecha_actual'));
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
    public function generarInforme(Request $request){
      Log::info($request);
      $user=Auth::user();
      $query=null;
      $busqueda_por=null;
      $fecha=$request->get('fecha');
      $c=new DateTime(date("Y-m-d H:i:s"));
      $creado=$c->format('d-m-Y H:i:s');
      $sector_name=$request->get('search');
      $habitacion_id=$request->get('search_habitacion');
      $busqueda_persona_por=$request->get('busqueda_persona_por');
      $busqueda_horario_por=$request->get('busqueda_horario_por');
      $horarios=Horario::all();
      if($request){
        switch ($busqueda_persona_por){
          case 'busqueda_todos':
              if($busqueda_horario_por==0){
                $menus=MenuPersona::allFecha($fecha);
                $busqueda_por='Fecha:';
                $query=$fecha;
              }else {
                $menus=MenuPersona::allHorarioFecha($busqueda_horario_por,$fecha);
                $busqueda_por='Fecha: '.$fecha;
                $query='Horario: '.$busqueda_horario_por;
              }
            break;
          case 'busqueda_personal':
            if(empty($sector_name)){
              $personal=Personal::all();
            }else {
              $personal=Personal::allBySectorName($sector_name);
              $query= "Sector: ".$sector_name;
            }
            if($busqueda_horario_por==0){
              $menus=array();
              foreach ($personal as $p) {
                $m=MenuPersona::allPersonaFecha($p->id,$fecha);
                foreach($m as $menu){
                  array_push($menus,$menu);
                }
              }
              $busqueda_por='Personal, ';
              $query=$query.' Fecha: '.$fecha;
            }else {
              $menus=array();
              foreach ($personal as $p) {
                $menu=MenuPersona::get_menu_por_persona_horario_fecha($p->id,$busqueda_horario_por,$fecha);
                if(!(empty($menu))){
                  array_push($menus,$menu);
                }
              }
              $busqueda_por='Personal, ';
              $query='Fecha: '.$fecha." Horario: ".$busqueda_horario_por;
            }
            break;
          case 'busqueda_pacientes':
            if(empty($sector_name)){
              $pacientes=Paciente::get_pacientes_internados();
            }else {
              $pacientes=Paciente::get_pacientes_internados_por_nombre_sector($sector_name);
              $query="Sector: ".$sector_name;
            }
            if($busqueda_horario_por==0){
              $menus=array();
              foreach ($pacientes as $paciente) {
                $m=MenuPersona::allPersonaFecha($paciente->id,$fecha);
                foreach($m as $menu){
                  array_push($menus,$menu);
                }
              }
              $busqueda_por='Pacientes, ';
              $query=$query.' Fecha: '.$fecha;
            }else {
              $menus=array();
              foreach ($pacientes as $paciente) {
                $menu=MenuPersona::get_menu_por_persona_horario_fecha($paciente->id,$busqueda_horario_por,$fecha);
                if(!(empty($menu))){
                  array_push($menus,$menu);
                }
              }
              $busqueda_por='Pacientes, ';
              $query=$query.' Fecha: '.$fecha.' Horario'.$busqueda_horario_por;
            }
            break;
          default:
            $menus=MenuPersona::all();
            break;
          }
        }else{
          $menus=MenuPersona::all();
        }
        $menus_total=count($menus);
        //return  view('informe.informe', compact('menus','menus_total','query','busqueda_por','creado','user'));
        $pdf = PDF::loadView('informe.informe', compact('menus','menus_total','query','busqueda_por','creado','user'));
        return $pdf->stream();
    }

}
