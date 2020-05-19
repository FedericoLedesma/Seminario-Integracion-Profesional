<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\Horario;
use App\Paciente;
use App\Persona;
use App\Racion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MenuPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = Auth::user();
        Log::info($user);
        if ($user==null){
          Log::debug('No se ha logeado');
          return redirect('/home');
        }
        $menues = Array();
        $query = $request->get('search');
        $busqueda_por= $request->get('busqueda_por');
        $fecha = $request->get('fecha');
        $info = [
          'action'=>'ok',
          'message'=>'Bienvenido al índice de menus personas',
          'estado'=>'1'
        ];
        if ($user->can('ver_menu_persona')){
            if($request){
                switch ($busqueda_por) {
                    case 'busqueda_nombre_persona':
                        Log::debug("Se realizará unas búsqueda por nombre de persona. Query:[".$query.']');
                        $menues=MenuPersona::buscar_por_persona_nombre_y_apellido($query);
                            $busqueda_por="nombres o apellidos";
                        break;
                    case 'busqueda_nombre_horario':
                        Log::debug("Se realizará unas búsqueda por nombre de horario. Query:[".$query.']');
                        $menues=MenuPersona::buscar_por_nombre_de_horario($query);
                            $busqueda_por="horario";
                        break;
                    case 'busqueda_fecha':
                        Log::debug("Se realizará unas búsqueda por fecha. Query:[".$query.']');
                        $menues=MenuPersona::buscar_por_fecha($query);
                            $busqueda_por="fecha";
                        break;
                    default:
                        $roles=MenuPersona::all();
                        $query=null;
                      break;
                }
            }
            $menues_excluidos = Array();
            foreach ($menues as $menu){
              if (($fecha==null)||($menu->tengo_la_fecha($fecha))){
                Log::debug('Se devuelven: '.$menu);
              }
              else{
                Log::debug('Se descarta el menú: '.$menu);
                Array_push($menues_excluidos, $menu);
              }
            }
            $menues = array_diff($menues, $menues_excluidos);
            $info = [
              'action'=>'ok',
              'message'=>'Se hizo una busqueda',
              'estado'=>'5'
            ];
            return view('menu_persona.index',compact('menues','query','busqueda_por','info'));
        }
        Log::debug($user->name . ' NO tiene permisos para ver menues');
        return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $raciones_disponibles = Array();
        $pacientes = Paciente::get_pacientes_internados();
        $fecha = $request->get('calendario');
        $horario= Horario::findById($request->get('horario_id'));
        $horarios = Horario::all();
        $persona_id = $request->get('persona_id');
        $racion_recomendada = [
          'nombre'=>'ninguno',
          'id'=>'-1'
        ];
        $persona_seleccionada = [
          'nombre'=>'ninguno',
          'id'=>'-1'
        ];
        #Log::debug('Se quiere crear un menu persona. Request: '.$request);
        Log::debug('Fecha: '.$fecha);
        Log::debug('Horario: '.$horario);
        if($fecha)
            if($horarios)
              if(($persona_id==null)|($persona_id<1)){
                /*$persona_seleccionada = [
                  'nombre'=>'ninguno',
                  'id'=>'-1'
                ];*/
              }
              else
              {
                  Log::debug('Pase a buscar raciones');
                  $persona = Persona::findById($persona_id);
                  $persona_seleccionada = [
                    'nombre'=>$persona->name.' ',$persona->apellido,
                    'id'=>$persona->id
                  ];
                  #$raciones_disponibles = Racion::buscar_por_fecha_horario($fecha,$horario);
                  $raciones_disponibles = $persona->get_raciones_disponibles($fecha,$horario);
                  $rac_rec = $persona->recomendar_racion($fecha,$horario);
                  $racion_recomendada = [
                    'nombre'=>$rac_rec->name,
                    'id'=>$rac_rec->id
                  ];
                  Log::debug('Acá salí de buscar las raciones recomendadas');
                  foreach($raciones_disponibles as $r)
                      Log::debug('Ración disponible: '.$r);
                  $horario = Array($horario);
                  return view('menu_persona.create',compact('raciones_disponibles','pacientes','horarios','horario','fecha','persona_seleccionada','racion_recomendada'));
              }
        $fecha = Carbon::now();
        $horarios = Horario::all();
        $horario = Array();
        return view('menu_persona.create',compact('raciones_disponibles','pacientes','horarios','horario','fecha','persona_seleccionada','racion_recomendada'));
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
        $this->validate($request,[
            'persona_id'=>'required',
            'horario'=>'required',
            'racion_id'=>'required',
            'fecha'=>'required'
        ]);
        $persona_id = $request->get('persona_id');
        $horario_id = $request->get('horario');
        $racion_id = $request->get('racion_id');
        $fecha = $request->get('fecha');
        MenuPersona::create($persona_id,$racion_id,$horario_id,$fecha,$user->id);
        return redirect()->route('menu_persona.index')
            ->with('success','Menu persona registrado satisfactoriamente');
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
    public function update(Request $request, $compuesta)
    {
        //
        $this->validate($request,[
            'persona_id'=>'required',
            'horario_id'=>'required',
            'racion_id'=>'required',
            'fecha'=>'required',
            'realizado'=>'required',
        ]);
        $horario_id = $compuesta['horario_id'];
        $persona_id = $compuesta['persona_id'];
        $fecha = $compuesta['fecha'];
        MenuPersona::find($horario_id,$persona_id,$fecha)->update($request->all());
        return redirect()->route('menu_persona.index')
            ->with('success','Menu persona actualizado satisfactoriamente');
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
    public function destroy($persona_id,$horario_id,$fecha)
    {
      Log::debug('Se quiere borrar una ración...');
      $info = [
        'acction'=>'false',
        'message'=>'No se pudo eliminar el menu persona (planilla) !!!'
      ];
      try {
        $menuPersona = MenuPersona::findById($horario_id,$persona_id,$fecha);
        if ($menuPersona<>null){
          if (MenuPersona::borrar($menuPersona)){
            $info = [
              'acction'=>'success',
              'message'=>'Menu persona actualizado satisfactoriamente'
            ];
          }
        }
      } catch (\Exception $e) {

      }
      return redirect()->route('menu_persona.index',compact('info'));
          #->with('false','No se pudo eliminar el menu persona (planilla) !!!');
    }


}
