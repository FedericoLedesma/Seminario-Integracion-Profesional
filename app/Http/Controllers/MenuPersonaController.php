<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;
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
        if ($user->can('ver_menu_persona')){
            $query = $request->get('search');
            $busqueda_por= $request->get('busqueda_por');
            if($request){
                switch ($busqueda_por) {
                    case 'busqueda_id_persona':
                        $menues=MenuPersona::find_by();
                            $busqueda_por="ID_PERSONA";
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
            return view('MenuPersona.index',compact('menuPersona','menues'));
        }
        Log::debug($user->name . ' NO tiene permisos para ver menues');
        return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('MenuPersona.create');
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
     * @param  $horario_id
     * @param  $persona_id
     * @param  $fecha
     * @return \Illuminate\Http\Response
     */
    public function show($id_compuesta)
    {
        //
        $horario_id = $id_compuesta['horario_id'];
        $persona_id = $id_compuesta['persona_id'];
        $fecha = $id_compuesta['fecha'];
        $mp = MenuPersona::findById($horario_id,$persona_id,$fecha);
        if ($mp==null){
            echo 'no hay menu persona';
        }
        else {/*
        $mp = [];
        $mp = json_decode($menuPersona->getBody()->getContents())[0];*/
        return view('MenuPersona.show')
            ->with('mp', $mp);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $horario_id
     * @param  $persona_id
     * @param  $fecha
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
     * @param  $horario_id
     * @param  $persona_id
     * @param  $fecha
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
     * @param  $horario_id
     * @param  $persona_id
     * @param  $fecha
     * @return \Illuminate\Http\Response
     */
    public function destroy($compuesta)
    {
        //
        $horario_id = $compuesta['horario_id'];
        $persona_id = $compuesta['persona_id'];
        $fecha = $compuesta['fecha'];
        MenuPersona::find($horario_id,$persona_id,$fecha)->delete();
        return redirect()->route('MenuPersona.index')
            ->with('success','Menu persona borrado satisfactoriamente');
    }
}
