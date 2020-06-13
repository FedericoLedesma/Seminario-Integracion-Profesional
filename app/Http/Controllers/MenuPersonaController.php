<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\RacionesDisponibles;
use App\Horario;
use App\Paciente;
use App\Persona;
use App\Personal;
use App\Racion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MenuPersonaController extends Controller
{
    public function __construct()
    {
      $this->middleware(['permission:alta_menu'],['only'=>['create','store']]);
      $this->middleware(['permission:baja_menu'],['only'=>['destroy']]);
      $this->middleware(['permission:modificacion_menu'],['only'=>['edit']]);
      $this->middleware(['permission:ver_menu'],['only'=>['index']]);
       $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      Log::info($request);
      $user=Auth::user();
      $buscar_desde_hasta=$request->get('buscar_desde_hasta');
      Log::info($buscar_desde_hasta);
      $fecha_hasta=$request->get('fecha_hasta');
      Log::info('$fecha_hasta');
      $query=null;
      $busqueda_por=null;
      $fecha=$request->get('fecha');
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
                  $query='Horario: '.$busqueda_horario_por;
                }else {
                  $menus=MenuPersona::allHorarioFecha($busqueda_horario_por,$fecha);
                  $fecha = date("d/m/Y", strtotime($fecha));
                  $busqueda_por='Fecha: '.$fecha;
                  $query='Horario: '.$busqueda_horario_por;
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
                $query='Fecha: '.$fecha." Horario: ".$busqueda_horario_por;
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
                $query=$query.' Fecha: '.$fecha.' Horario'.$busqueda_horario_por;
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
        $horarios=Horario::all();

        return  view('nutricion.menu_persona.index', compact('menus','horarios','menus_total','query','busqueda_por'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      Log::info("create MenuPersonaController");
      Log::info($request);
      $query=$request->get('search');
      $busqueda_por=$request->get('busqueda_por');
      if($query){
        $pacientes=array();
        switch ($busqueda_por) {
          case 'busqueda_name':
            Log::debug("case 'busqueda_name':");
            $pacientes=Paciente::buscar_por_nombre_y_apellido($query);
            $busqueda_por="Nombre ";
            break;
          case 'busqueda_dni':
            Log::debug("case 'busqueda_dni':");
            $paciente=Paciente::buscar_por_dni($query);
            if(!empty($paciente)&&($paciente->estaInternado())){
              array_push($pacientes,$paciente);
            }
            $busqueda_por="Numero de Documento ";
            break;
          case 'busqueda_sector':
            Log::debug("case 'busqueda_sector':");
            $pacientes=Paciente::get_pacientes_internados_por_nombre_sector($query);
            $busqueda_por="Nombre de Sector ";
            break;
          default:
            Log::debug("case 'default':");
            $pacientes=Paciente::get_pacientes_internados();
            $busqueda_por="Todos los internados ";
            break;
        }
      }else {
        $pacientes=Paciente::get_pacientes_internados();
      }
      $horarios=Horario::all();
      return view('nutricion.menu_persona.create',compact('pacientes','horarios','query','busqueda_por'));
    }

    public function createMenuPersonal(Request $request)
    {
      Log::info("create MenuPersonaController");
      Log::info($request);
      $query=$request->get('search');
      $busqueda_por=$request->get('busqueda_por');
      if($query){
        $personal=array();
        switch ($busqueda_por) {
          case 'busqueda_name':
            Log::debug("case 'busqueda_name':");
            $personal=all();
            $busqueda_por="Nombre";
            break;
          case 'busqueda_dni':
            Log::debug("case 'busqueda_dni':");
            $p=Personal::buscar_por_numero_doc($query);
            if(!empty($p)){
              array_push($personal,$p);
            }
            $busqueda_por="Numero de documento ";
            break;
          case 'busqueda_sector':
            Log::debug("case 'busqueda_sector':");
            $personal=Personal::allBySectorName($query);
            $busqueda_por="Nombre de Sector ";
            break;
          default:
            Log::debug("case 'default':");
            $personal=Personal::all();
            break;
        }
      }else {
        $personal=Personal::all();
      }
      $horarios=Horario::all();
      return view('nutricion.menu_persona.create_personal',compact('personal','horarios','query','busqueda_por'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Log::debug('Se quiere ingresar un nuevo menu persona: '.$request);
        $user = Auth::user();
        Log::debug('Usuario: '.$user);
        $persona_id = $request->get('persona_id');
        $racion_disponible_id = $request->get('racion_disponible_id');
        $racion_disponible=RacionesDisponibles::findById($racion_disponible_id);
        $h_id=$racion_disponible->horario_racion->horario->id;
        $menu_=MenuPersona::get_menu_por_persona_horario_fecha($persona_id,$racion_disponible->horario_racion->horario->id,$racion_disponible->fecha);

        if(empty($menu_)){
          Log::debug("No tiene menu asignado ");
          Log::debug('$persona_id: '.$persona_id);
          Log::debug('$racion_disponible_id: '.$racion_disponible_id);
          if($racion_disponible->cantidad_restante>0){
            try{
              $data = [
                'persona_id'=>$persona_id,
                'racion_disponible_id'=>$racion_disponible_id,
                'personal_id'=>$user->personal_id,
                'realizado'=>false,
              ];
              $mp = new MenuPersona($data);
              $mp->save();
              return response([
                'success'=>'true',
                'data'=>"Menu realizado con exito",
              ]);
            }catch (\Exception $e) {
              return response([
                'success'=>'false',
                'data'=>"Esta persona ya tiene una racion asignada para este horario",
              ]);
            }
          }
          else {
            return response([
              'success'=>'false',
              'data'=>"Esta racion no tiene suficiente stock",
            ]);
          }
        }else {
          Log::info("Esta persona ya tiene una racion asignada para este horario");

          return response([
            'success'=>'false',
            'data'=>"Esta persona ya tiene una racion asignada para este horario",
          ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  App\MenuPersona $mp
     * @return \Illuminate\Http\Response
     */
    public function show($id_persona,$id_horario,$fecha)
    {
        //
        $mp = MenuPersona::findById($id_horario,$id_persona,$fecha);
        return  view('menu_persona.show', compact('mp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($compuesta)
    {
        //
        $horario_id = $compuesta['horario_id'];
        $persona_id = $compuesta['persona_id'];
        $fecha = $compuesta['fecha'];
        $menuPersona = MenuPersona::find($horario_id,$persona_id,$fecha);
        return view('menu_persona.edit',compact('menuPersona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $menuPersona=$request->get('menu_persona');
      $menuPersona=MenuPersona::findById($menuPersona['id']);
      Log::info($request);
      $menuPersona->realizado=true;
      $menuPersona->save();
      return response()->json([
            'estado'=>'true',
            'success' => 'Se registro exitosamente como realizado',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\MenuPersona $alimento
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(MenuPersona $compuesta)
    {
        //
        Log::debug('Recibido: '.$compuesta);
        $horario_id = $compuesta['horario_id'];
        $persona_id = $compuesta['persona_id'];
        $fecha = $compuesta['fecha'];
        MenuPersona::find($horario_id,$persona_id,$fecha)->delete();
        return redirect()->route('MenuPersona.index')
            ->with('success','Menu persona borrado satisfactoriamente');
    }*/
    public function destroy(Request $request)
    {
      Log::debug('Se quiere borrar una ración...');
      Log::info($request);
      $mp=$request->get('menu_persona');
      Log::info($mp['id']);
      try {
        $menuPersona = MenuPersona::findById($mp['id']);
        Log::info($menuPersona);
        if($menuPersona->realizado){
          return response()->json([
                'estado'=>'false',
                'success' => 'No se puede eliminar un menu realizado',
            ]);
        }else{
          $menuPersona->delete();
          return response()->json([
                'estado'=>'true',
                'success' => 'Se elimino correctamente el menu',
            ]);
        }
      } catch (\Exception $e) {
        return response()->json([
              'estado'=>'false',
              'success' => 'No se pudo eliminar el menu de la persona',
          ]);
      }

    }
    public function getMenuDePersona(Request $request){
      Log::info($request);
      $menus=MenuPersona::all();
      $persona_id=1;
      $query="";
      $fecha_desde=$request->get('fecha_desde');
      $fecha_hasta=$request->get('fecha_hasta');
      $horario_id=$request->get('busqueda_horario_por');
      $busqueda_por="";
      if($horario_id=="0"){
        //Se buscara por toodos los Horarios
        $menus=MenuPersona::allPersonaEntreFechas($persona_id,$fecha_desde,$fecha_hasta);
      }else {
        $menus=MenuPersona::allPersonaEntreFechasHorario($persona_id,$fecha_desde,$fecha_hasta,$horario_id);
      }

      $horarios=array();
      return view('admin_personas.pacientes.menus_persona_fecha',compact('menus','query','busqueda_por','horarios'));
    }


}
