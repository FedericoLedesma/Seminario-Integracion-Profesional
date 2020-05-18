<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\Horario;
use App\Paciente;
use App\Racion;
use Spatie\Permission\Models\Role;
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
        $menues = Array();
        $query = $request->get('search');
        $busqueda_por= $request->get('busqueda_por');
        if ($user->can('ver_menu_persona')){
            if($request){
                switch ($busqueda_por) {
                    case 'busqueda_nombre_persona':
                        Log::debug("Se realizará unas búsqueda por nombre de persona. Query:[".$query.']');
                        $menues=MenuPersona::buscar_por_persona_nombre_y_apellido($query);
                            $busqueda_por="nombres o apellidos";
                        break;
                    case 'busqueda_name':
                            $menues=MenuPersona::where('name','LIKE','%'.$query.'%')
                            ->orderBy('id','asc')
                            ->get();
                                $busqueda_por="NOMBRE";
                        break;
                    default:
                    $roles=Role::all();
                    $query=null;
                        break;
                }
            }
            foreach ($menues as $menu)
             Log::debug('Se devuelven: '.$menu);
            return view('menu_persona.index',compact('menues','query','busqueda_por'));
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
        #Log::debug('Se quiere crear un menu persona. Request: '.$request);
        Log::debug('Fecha: '.$fecha);
        Log::debug('Horario: '.$horario);
        if($fecha)
            if($horarios){
                Log::debug('Pase a buscar raciones');
                $raciones_disponibles = Racion::buscar_por_fecha_horario($fecha,$horario);
                foreach($raciones_disponibles as $r)
                    Log::debug('Ración disponible: '.$r);
                $horario = Array($horario);
                return view('menu_persona.create',compact('raciones_disponibles','pacientes','horarios','horario','fecha'));
            }
        $fecha = Carbon::now();
        $horarios = Horario::all();
        $horario = Array();
        return view('menu_persona.create',compact('raciones_disponibles','pacientes','horarios','horario','fecha'));
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
        return view('MenuPersona.edit',compact('menuPersona'));
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
        return redirect()->route('MenuPersona.index')
            ->with('success','Menu persona actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *

     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuPersona $compuesta)
    {
        //
        Log::debug('Recibido: '.$compuesta);
        $horario_id = $compuesta['horario_id'];
        $persona_id = $compuesta['persona_id'];
        $fecha = $compuesta['fecha'];
        MenuPersona::find($horario_id,$persona_id,$fecha)->delete();
        return redirect()->route('MenuPersona.index')
            ->with('success','Menu persona borrado satisfactoriamente');
    }


}
