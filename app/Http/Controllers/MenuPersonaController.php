<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\RacionesDisponibles;
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
      Log::info($request);
      $query = $request->get('search');
      $fecha=$request->get('fecha');
      $busqueda_por="";
      $busqueda_horario_por=$request->get('busqueda_horario_por');

      $horarios=Horario::all();
      if($request){
        switch ($busqueda_horario_por){
          case 'busqueda_todos':
              $menus=MenuPersona::all();
            break;
          default:
            $menus=MenuPersona::all();
            break;
          }

        }else{
          $menus=MenuPersona::all();
        }
        $menus_total=MenuPersona::all()->count();
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

      $pacientes=Paciente::get_pacientes_internados();
      $horarios= Horario::all();
      return view('nutricion.menu_persona.create',compact('pacientes','horarios'));
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
