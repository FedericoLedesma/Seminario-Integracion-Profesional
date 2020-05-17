<?php

namespace App\Http\Controllers;

use App\TipoPatologia;
use App\Patologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TipoPatologiaController extends Controller
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
        switch ($busqueda_por) {
          case 'busqueda_id':
            $tipos_patologias=TipoPatologia::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_name':
              $tipos_patologias=TipoPatologia::findByName($query)->get();
              $busqueda_por="NOMBRE";
            break;
          default:
            $tipos_patologias=TipoPatologia::all();
            break;
        }

      }
    //	$users=User::all();
      $tipos_patologias_total=TipoPatologia::all()->count();
      return  view('admin_patologias.tipo_patologias.index', compact('tipos_patologias','tipos_patologias_total','query','busqueda_por'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_patologias.tipo_patologias.create');

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
        $tipo_patologia=TipoPatologia::create([
            'name' => $data['name'],
            'observacion'=>$data['observacion'],
          ]);

        $tipo_patologia->save();
        return redirect('/tipospatologias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoPatologia  $tipoPatologia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //--error al recibir por parametro un TipoPatologia, llega la variable vacia
      $tipoPatologia=TipoPatologia::findById($id);
      return  view('admin_patologias.tipo_patologias.show', compact('tipoPatologia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoPatologia  $tipoPatologia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $tipoPatologia=TipoPatologia::findById($id);
      return view('admin_patologias.tipo_patologias.edit',compact('tipoPatologia'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoPatologia  $tipoPatologia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPatologia $tipoPatologia)
    {
      if($tipoPatologia){
        $tipoPatologia->name=$request->name;
        $tipoPatologia->observacion=$request->observacion;
        $tipoPatologia->save();

      }
      return redirect('/tipospatologias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoPatologia  $tipoPatologia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Log::info($id);
      Log::info('Info log test');
      $patologias=Patologia::findByTipoPatologia($id)->get();
      if(count($patologias)==0){
        $tipoPatologia=TipoPatologia::findById($id);
        $tipoPatologia->delete();
        return response()->json([
            'estado'=>'true',
            'success' => 'Tipo de Patologia eliminada con exito!'
        ]);
      }else{
        return response()->json([
          'estado'=>'false',
          'success' => 'No se pudo eliminar el Tipo de Patologia, tiene patologias asignadas !'
        ]);
      }

    }
}
