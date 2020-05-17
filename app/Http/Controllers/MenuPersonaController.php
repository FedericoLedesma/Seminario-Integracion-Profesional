<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuPersona;

class MenuPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menuPersona = MenuPersona::orderBy('fecha','DESC')->paginate(10);
        return view('MenuPersona.index',compact('menuPersona'));
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
    public function show($horario_id,$persona_id,$fecha)
    {
        //
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
    public function edit($horario_id,$persona_id,$fecha)
    {
        //
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
    public function update(Request $request, $horario_id,$persona_id,$fecha)
    {
        //
        $this->validate($request,[
            'persona_id'=>'required',
            'horario_id'=>'required',
            'racion_id'=>'required',
            'fecha'=>'required',
            'realizado'=>'required',
        ]);
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
    public function destroy($horario_id,$persona_id,$fecha)
    {
        //
        MenuPersona::find($horario_id,$persona_id,$fecha)->delete();
        return redirect()->route('MenuPersona.index')
            ->with('success','Menu persona borrado satisfactoriamente');
    }
}
