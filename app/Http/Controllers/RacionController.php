<?php

namespace App\Http\Controllers;

use App\Racion;
use App\RacionesDisponibles;
use Illuminate\Http\Request;
use App\Alimento;
use Illuminate\Support\Facades\Log;

class RacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $data=$request->all();
        $racion=Racion::create([
            'name' => $data['name'],
            'observacion' => $data['observacion'],
          ]);
        $racion->save();
        return view('nutricion.raciones.agregar-alimentos', compact('racion'));
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
        $racion=Racion::findById($id);
        return view('nutricion.raciones.edit', compact('racion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Racion  $racion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          Log::info($request);
          $racion=Racion::findById($id);
          $racion->name=$request->name;
          $racion->save();

          foreach ($racion->alimentos as $alimento) {
            Log::info($request['cantidad-'.$alimento->id]);
            $cantidad=$request['cantidad-'.$alimento->id];

            $racion->alimentos()->updateExistingPivot($alimento->id, ['cantidad'=>$cantidad]);
            // code...

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
        return view('nutricion.raciones.agregar-alimentos', compact('racion'));
      }

      public function quitarAlimento(Request $request){
        Log::info($request);
        $idRacion=$request->data[0];
        $idAlimento=$request->data[1];
        $racion=Racion::findById($idRacion);
        $racion->alimentos()->detach($idAlimento);
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
          $racion->alimentos()->attach($alimento,['cantidad'=>0]);
          }catch (\Exception $e) {}
        }
        $als=array();
        $alimentos=$racion->alimentos;
        Log::info($alimentos);
        return response([
          'alimentos'=>$alimentos->toArray(),
        ]);
      }

}
