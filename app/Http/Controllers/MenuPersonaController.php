<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
use App\Horario;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $raciones_disponibles = null;
        $pacientes = null;
        $horarios = Horario::all();
        return view('menu_persona.create',compact('raciones_disponibles','pacientes','horarios'));
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
        $this->validate($request,[
            'persona_id'=>'required',
            'horario_id'=>'required',
            'racion_id'=>'required',
            'fecha'=>'required',
            'realizado'=>'required',
        ]);
        MenuPersona::create($request->all());
        return redirect()->route('MenuPersona.index')
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
