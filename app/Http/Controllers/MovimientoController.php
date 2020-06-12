<?php

namespace App\Http\Controllers;

use App\Movimiento;
use App\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $horario_id=$request->get('busqueda_horario_por');
      $fecha=$request->get('fecha');
      $busqueda_por=null;
      $query=null;
      Log::info($request);
      if(!empty($horario_id)){
        if($horario_id=='0'){
          Log::info('Buscando por fecha todos los horarios');
          $movimientos=Movimiento::allFecha($fecha);
          $busqueda_por="Fecha ".$fecha;
          $query=" ";
        }else {
          $movimientos=Movimiento::allHorarioFecha($horario_id,$fecha);
          $busqueda_por="Fecha ".$fecha;
          $horario=Horario::findById($horario_id);
          $query="Horario: ".$horario->name;
        }
      }else {
        $movimientos=Movimiento::all();
      }
      $horarios=Horario::all();

      return view('nutricion.movimientos.index',compact('movimientos','horarios','query','busqueda_por'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Movimiento $movimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimiento $movimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimiento $movimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimiento $movimiento)
    {
        //
    }
}
