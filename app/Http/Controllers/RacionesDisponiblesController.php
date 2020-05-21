<?php

namespace App\Http\Controllers;
use \App\RacionesDisponibles;
use \App\Horario;
use \App\Racion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RacionesDisponiblesController extends Controller
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
              if($query==""){
                  $racionesDisponibles=RacionesDisponibles::getRacionesDisponiblesFecha($fecha)->get();
              }else {
                $racionesDisponibles=RacionesDisponibles::getRacionesDisponiblesFecha($fecha)->where('racion_id',$query)->get();
              }
            break;
          default:
            if(is_numeric($busqueda_horario_por)){
              $horario=Horario::findById($busqueda_horario_por);
              $racionesDisponibles=RacionesDisponibles::buscar_por_fecha_horario($fecha,$horario);
            }else{
              $racionesDisponibles=RacionesDisponibles::all();
            }
            break;
          }

        }else{
          $racionesDisponibles=RacionesDisponibles::all();
        }
        $racionesDisponibles_total=RacionesDisponibles::all()->count();
    return  view('nutricion.raciones-disponibles.index', compact('racionesDisponibles','horarios','racionesDisponibles_total','query','busqueda_por'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $horarios=Horario::all();
      return  view('nutricion.raciones-disponibles.create', compact('horarios'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info($request);
        try{
          $horarioId=$request->data['0'];
          $racionId=$request->data[2];
          $racion=Racion::findById($racionId);

          $horario=$racion->horarios()->wherePivot('horario_id',$horarioId)->first();
          Log::info($horario);
          if($horario){
            $racionDisponible=RacionesDisponibles::create([
                'horario_id' => $horarioId,
                'fecha' => $request->data[1],
                'racion_id'=>$racionId,
                'stock_original' => $request->data[3],
                'cantidad_restante' => $request->data[3],
                'cantidad_realizados' => 0,
              ]);
            $racionDisponible->save();
            return response([
              'data'=>'Exito',
            ]);
          }else{
            return response([
              'data'=>'error',
              'mensaje'=>'La racion '.$racion->name.' no es compatible con el horario seleccionado',
            ]);
          }
        }catch (\Exception $e) {
          return response([
            'data'=>'error',
            'mensaje'=>'Esta racion ya tiene asignada disponibilidad en el horario y fecha indicada',

          ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($racion_id,$horario_id,$fecha)
    {
      $racionDisponible=RacionesDisponibles::findById($horario_id,$racion_id,$fecha);

      return view('nutricion.raciones-disponibles.show', compact('racionDisponible'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Log::info($request);
        $cantidad_stock=$request->cantidad_stock;
        $cantidad_realizados=$request->cantidad_realizados;
        $racionDisponible=$request->racionDisponible;
        $rd=RacionesDisponibles::findById($racionDisponible['horario_id'],$racionDisponible['racion_id'],$racionDisponible['fecha']);
        Log::info($rd->stock_original);
        $rd->cantidad_realizados=$rd->cantidad_realizados+$cantidad_realizados;
        $rd->stock_original=$rd->stock_original+$cantidad_stock;
        $rd->cantidad_restante=$rd->cantidad_restante+$cantidad_stock-$cantidad_realizados;
        $rd->guardar();//Debi definir este metodo porque Laravel no acepta claves compuesta por ende no puedo utilizar el save()
        return response([
          'raciones'=>'exito',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      Log::info('Destroy Raciones disponibles');
      Log::info($request);
      $rd=$request->racionDisponible;
      $racionDisponible=RacionesDisponibles::findById($rd['horario_id'],$rd['racion_id'],$rd['fecha']);
      try{
        $racionDisponible->eliminar();
        return response()->json([
              'estado'=>'true',
              'success' => 'Disponinilidad de racion eliminada con exito!'
          ]);
      } catch (\Exception $e) {
        return response()->json([
          'estado'=>'false',
          'success' => 'No se pudo eliminar la disponibilidad de la racion !'
        ]);
      }

    }

    public function getRacionesDisponibles(Request $request){
        Log::info($request);
        $idHorario=$request->data[0];
        $horario=Horario::findById($idHorario);
        $raciones=$horario->raciones;
          Log::info($raciones);
          return response([
            'raciones'=>$raciones->toArray(),
          ]);
    }
}
