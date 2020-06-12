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
      $query=$request->get('racion_name');;
      Log::info($request);
      if(!empty($fecha)){
        if($horario_id=='0'){
          if($query==""){
            Log::info('Buscando por fecha todos los horarios');
            $movimientos=Movimiento::allFecha($fecha);
            $busqueda_por="Fecha ".$fecha;
            $query=" ";
          }else{
            Log::info('Buscando por fecha nombre racion todos los horarios');
            $movimientos=Movimiento::findByFechaNombreRacion($fecha,$query);
            $busqueda_por="Fecha ".$fecha;
            $query=" Racion: ".$query;
          }
        }else {
          if($query==""){
            $movimientos=Movimiento::allHorarioFecha($horario_id,$fecha);
            $busqueda_por="Fecha ".$fecha;
            $horario=Horario::findById($horario_id);
            $query="Horario: ".$horario->name;
          }else{
            $movimientos=Movimiento::findByHorarioFechaNombreRacion($horario_id,$fecha,$query);
            $busqueda_por="Fecha ".$fecha;
            $horario=Horario::findById($horario_id);
            $busqueda_por="Fecha ".$fecha." nombre racion horario";
            $query="Horario: ".$horario->name."; Racion: ".$query;
          }
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
