<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\Personal;
use App\Paciente;
use App\Racion;
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
    public function informeIndex(Request $request)
    {
      #$user = Auth::
      $horarios = Horario::all();
      $fecha_actual = Carbon::now();
      return view('informe.index_informe_raciones',compact('horarios','fecha_actual'));
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
      Log::debug("generarInforme");
      Log::info($request);
      $user=Auth::user();
      $buscar_desde_hasta=$request->get('buscar_desde_hasta');
      $solo_raciones=$request->get('solo_raciones');
      Log::info($buscar_desde_hasta);
      $fecha_hasta=$request->get('fecha_hasta');
      Log::info('$fecha_hasta');
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
                if($buscar_desde_hasta=='true'){
                  $menus=MenuPersona::allEntreFechas($fecha,$fecha_hasta);
                  $fecha = date("d/m/Y", strtotime($fecha));
                  $busqueda_por='Fecha desde:' . $fecha;
                  $fecha=date("d/m/Y", strtotime($fecha_hasta));
                  $query='Hasta: '.$fecha;
                }else{
                  $menus=MenuPersona::allFecha($fecha);
                  $busqueda_por='Fecha:';
                  $fecha = date("d/m/Y", strtotime($fecha));
                  $query=$fecha;
                }
              }else {
                if($buscar_desde_hasta=='true'){
                  $menus=MenuPersona::allHorarioEntreFechas($busqueda_horario_por,$fecha,$fecha_hasta);
                  $fecha = date("d/m/Y", strtotime($fecha));
                  $fecha_hasta= date("d/m/Y", strtotime($fecha_hasta));
                  $busqueda_por='Fecha desde: '.$fecha. ' Hasta: '. $fecha_hasta;
                  $horario=Horario::findById($busqueda_horario_por);
                  $query='Horario: '.$horario->name;
                }else {
                  $menus=MenuPersona::allHorarioFecha($busqueda_horario_por,$fecha);
                  $fecha = date("d/m/Y", strtotime($fecha));
                  $busqueda_por='Fecha: '.$fecha;
                  $horario=Horario::findById($busqueda_horario_por);
                  $query='Horario: '.$horario->name;
                }
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
                if($buscar_desde_hasta=='true'){
                  $m=MenuPersona::allPersonaEntreFechas($p->id,$fecha,$fecha_hasta);

                }else {
                  $m=MenuPersona::allPersonaFecha($p->id,$fecha);
                }
                foreach($m as $menu){
                  array_push($menus,$menu);
                }
              }
              $busqueda_por='Personal, ';
              if($buscar_desde_hasta=='true'){
                $fecha = date("d/m/Y", strtotime($fecha));
                $query=$query.' Fecha desde: '.$fecha. ' Hasta: '. $fecha_hasta;
              }else{
                $fecha = date("d/m/Y", strtotime($fecha));
                $query=$query.' Fecha: '.$fecha;
              }
            }else {
              $menus=array();
              foreach ($personal as $p) {
                if($buscar_desde_hasta=='true'){
                  $menu = MenuPersona::get_menus_por_persona_horario_entre_fechas($p->id,$busqueda_horario_por,$fecha,$fecha_hasta);
                  $menus = array_merge($menus, $menu);
                }else{
                  $menu = MenuPersona::get_menu_por_persona_horario_fecha($p->id,$busqueda_horario_por,$fecha);
                  if(!(empty($menu))){
                    array_push($menus,$menu);
                  }
                }
              }
              $busqueda_por='Personal, ';
              if($buscar_desde_hasta=='true'){
                $fecha = date("d/m/Y", strtotime($fecha));
                $fecha_hasta = date("d/m/Y", strtotime($fecha_hasta));
                $query='Fecha desde: '.$fecha." Hasta: ".$fecha_hasta." Horario: ".$busqueda_horario_por;
              }else{
                $fecha = date("d/m/Y", strtotime($fecha));
                $horario=Horario::findById($busqueda_horario_por);
                $query='Fecha: '.$fecha." Horario: ".$horario->name;
              }
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
                if($buscar_desde_hasta=='true'){
                  $m=MenuPersona::allPersonaEntreFechas($paciente->id,$fecha,$fecha_hasta);
                  $menus = array_merge($menus, $m);
                  if($paciente->acompananteActual()){
                    $m=MenuPersona::allPersonaEntreFechas($paciente->acompananteActual()->persona_id,$fecha,$fecha_hasta);
                    $menus = array_merge($menus, $m);
                  }
                }else {
                  $m=MenuPersona::allPersonaFecha($paciente->id,$fecha);
                  $menus = array_merge($menus, $m);
                  if($paciente->acompananteActual()){
                    $m=MenuPersona::allPersonaFecha($paciente->acompananteActual()->persona_id,$fecha);
                    $menus = array_merge($menus, $m);
                  }
                }
              }
              $busqueda_por='Pacientes y acompañantes, ';
              $fecha = date("d/m/Y", strtotime($fecha));
              if($buscar_desde_hasta=='true'){
                $fecha_hasta = date("d/m/Y", strtotime($fecha_hasta));
                $query=$query.' Fecha desde: '.$fecha. ' hasta: '.$fecha_hasta;
              }else {
                $query=$query.' Fecha: '.$fecha;
              }
            }else {
              $menus=array();
              foreach ($pacientes as $paciente) {
                if($buscar_desde_hasta=='true'){
                  $m = MenuPersona::get_menus_por_persona_horario_entre_fechas($paciente->id,$busqueda_horario_por,$fecha,$fecha_hasta);
                  $menus = array_merge($menus, $m);
                  if($paciente->acompananteActual()){
                    $m = MenuPersona::get_menus_por_persona_horario_entre_fechas($paciente->acompananteActual()->persona_id,$busqueda_horario_por,$fecha,$fecha_hasta);
                    $menus = array_merge($menus, $m);
                  }
                }else {
                  $menu=MenuPersona::get_menu_por_persona_horario_fecha($paciente->id,$busqueda_horario_por,$fecha);
                  if(!(empty($menu))){
                    array_push($menus,$menu);
                  }
                  if($paciente->acompananteActual()){
                    $m=MenuPersona::allPersonaFecha($paciente->acompananteActual()->persona_id,$fecha);
                    $menus = array_merge($menus, $m);
                  }
                }
              }
              $busqueda_por='Pacientes, ';
              $fecha = date("d/m/Y", strtotime($fecha));
              if($buscar_desde_hasta=='true'){
                $fecha_hasta = date("d/m/Y", strtotime($fecha_hasta));
                $query=$query.' Fecha desde: '.$fecha.' hasta:'.$fecha_hasta.' Horario: '.$busqueda_horario_por;
              }else {
                $horario=Horario::findById($busqueda_horario_por);
                $query=$query.' Fecha: '.$fecha.' Horario'.$horario->name;
              }
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

        if($solo_raciones=="true"){
          $raciones_id=array();
          $raciones_a_preparar_id=array();
          foreach ($menus as  $menu) {          
            if(!$menu->realizado){
              array_push($raciones_a_preparar_id,$menu->racionDisponible->horario_racion->racion->id);
            }else{
              array_push($raciones_id,$menu->racionDisponible->horario_racion->racion->id);
            }
          }
          $cantidad_raciones_a_preparar=array_count_values($raciones_a_preparar_id);
          $cantidad_raciones=array_count_values($raciones_id);
          Log::info("total de raciones:");
          Log::info($cantidad_raciones);
          $raciones=array();
          while ($r = current($cantidad_raciones)) {
            $racion=Racion::findById(key($cantidad_raciones));
            array_push($raciones,$racion);
            next($cantidad_raciones);
          }
          $raciones_a_preparar=array();
          while ($r_p = current($cantidad_raciones_a_preparar)) {
            $racion=Racion::findById(key($cantidad_raciones_a_preparar));
            array_push($raciones_a_preparar,$racion);
            next($cantidad_raciones_a_preparar);
          }

          $pdf = PDF::loadView('informe.informe_raciones', compact('raciones','cantidad_raciones','raciones_a_preparar','cantidad_raciones_a_preparar','query','busqueda_por','creado','user'));
      }else{
        $pdf = PDF::loadView('informe.informe', compact('menus','menus_total','query','busqueda_por','creado','user'));

      }
      return $pdf->stream();
    }

    public function generarInformeDeRaciones(Request $request){
    }

}
