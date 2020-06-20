<?php

namespace App\Http\Controllers;

use App\Racion;
use App\RacionesDisponibles;
use Illuminate\Http\Request;
use App\Alimento;
use App\Horario;
use App\Unidad;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RacionRequest;

class RacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware(['permission:alta_raciones'],['only'=>['create','store']]);
       $this->middleware(['permission:baja_raciones'],['only'=>['destroy']]);
       $this->middleware(['permission:modificacion_raciones'],['only'=>['edit']]);
       $this->middleware(['permission:ver_raciones'],['only'=>['index']]);
        $this->middleware('auth');
     }
    public function index(Request $request)
    {
      $query = $request->get('search');
      $busqueda_por= $request->get('busqueda_por');
      if($request){
        switch ($busqueda_por){
          case 'busqueda_id':
            $raciones=Racion::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_name':
              $raciones=Racion::findByName($query)->get();
              $busqueda_por="NOMBRE";
            break;
          default:
            $raciones=Racion::all();
            break;
          }
          $raciones_total=Racion::all()->count();
          return  view('nutricion.raciones.index', compact('raciones','raciones_total','query','busqueda_por'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //  $alimentos=Alimento::all();
      return view('nutricion.raciones.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RacionRequest $request)
    {
        $data=$request->all();
        $racion=Racion::create([
            'name' => ucfirst($data['name']),
            'observacion' => $data['observacion'],
          ]);
        $racion->save();
        return redirect('raciones/'.$racion->id.'/agregaralimentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Racion  $racion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $racion=Racion::findById($id);
        return view('nutricion.raciones.show', compact('racion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Racion  $racion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horarios=Horario::all();
        $racion=Racion::findById($id);
        $unidades=Unidad::all();
        return view('nutricion.raciones.edit', compact('racion','horarios','unidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Racion  $racion
     * @return \Illuminate\Http\Response
     */
    public function update(RacionRequest $request, $id)
    {
          Log::info($request);
          $racion=Racion::findById($id);
          $racion->name=ucfirst($request->name);
          $racion->observacion=$request->observacion;
          $racion->save();

          foreach ($racion->alimentos as $alimento) {
            Log::info($request['cantidad-'.$alimento->id]);
            if(!($request['cantidad-'.$alimento->id]=='')){
              $unidad_id=$request['unidad-'.$alimento->id];
              $cantidad=$request['cantidad-'.$alimento->id];
              $racion->alimentos()->updateExistingPivot($alimento->id, ['cantidad'=>$cantidad,'unidad_id'=>$unidad_id]);
            }

          }
          return redirect('/raciones');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Racion  $racion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $racion=Racion::findById($id);
      try {
        $racion->delete();
        return response()->json([
            'estado'=>'true',
            'success' => 'Racion eliminada con exito!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'estado'=>'false',
          'success' => 'No se pudo eliminar la racion !'
        ]);
      }
    }

    public function buscar(Request $request)
    {
      if($request->ajax()) {

        $busqueda_por=$request->data[0];
          $query=$request->data[1];
          if(($busqueda_por)&&($query)){
            switch ($busqueda_por) {
              case 'busqueda_id':
                return  $alimentos=Alimento::where('id','LIKE','%'.$query.'%')
                  ->orderBy('id','asc')
                  ->get();
                break;
              case 'busqueda_name':
                return  $alimentos=Alimento::findByName($query)->get();
                break;
              default:
                return  $alimentos=Alimento::all();
                break;
              }
          }
          return response()->$alimentos->toJson();
        }

      }

      public function agregarAlimentos($id){
        $racion=Racion::findById($id);
        $alimentos=Alimento::getAlimentosQueNoContieneRacion($racion);
        return view('nutricion.raciones.agregar-alimentos_v2', compact('racion','alimentos'));
      }

      public function quitarAlimento(Request $request){
        Log::info($request);
        $idRacion=$request->data[0];
        $idAlimento=$request->data[1];
        $racion=Racion::findById($idRacion);
        $racion->alimentos()->detach($idAlimento);
        $racion->save();
        return response()->json([
            'estado'=>'true',
            'success' => 'Alimento quitado con exito!'
        ]);
      }

      public function guardarAlimentos(Request $request){
        Log::info($request->data[0]);
        $id=$request->data[0];
        $racion=Racion::findById($id);
        Log::info($racion);
        $idAlimentos=$request->data[1];
        Log::info($idAlimentos);
        foreach ($idAlimentos as $idAlimento) {
          $alimento=Alimento::findById($idAlimento);
          Log::info($alimento);
          try{
          $racion->alimentos()->attach($alimento,['cantidad'=>0,'unidad_id'=>2]);
          $racion->save();
          }catch (\Exception $e) {}
        }
        $als=array();
        $alimentos=$racion->alimentos;
        Log::info($alimentos);
        return response([
          'alimentos'=>$alimentos->toArray(),
        ]);
      }

      public function quitarHorario(Request $request){
        Log::info($request);
        $idRacion=$request->data[0];
        $idHorario=$request->data[1];
        $racion=Racion::findById($idRacion);
        $racion->horarios()->detach($idHorario);
        return response()->json([
            'estado'=>'true',
            'success' => 'Horario quitado con exito!'
        ]);
      }
      public function guardarHorario(Request $request){
        Log::info("function guardarHorario");
        Log::info($request->data[1]);
        $racion_id=$request->data[0];
        $racion=Racion::findById($racion_id);
        Log::info($racion);
        $horario_id=$request->data[1];
        Log::info($horario_id);
        try{
            $racion->horarios()->attach($horario_id);
            return response()->json([
                'estado'=>'true',
                'success' => 'Horario agregado con exito!'
            ]);
        }catch (\Exception $e) {
          return response()->json([
              'estado'=>'false',
              'success' => 'Hubo un error'
          ]);
        }
      }

}
