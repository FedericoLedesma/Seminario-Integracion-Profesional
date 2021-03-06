<?php

namespace App\Http\Controllers;

use App\Alimento;
use App\Http\Requests\AlimentoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
   	{
   		$this->middleware(['permission:alta_alimentos'],['only'=>['create','store']]);
   		$this->middleware(['permission:baja_alimentos'],['only'=>['destroy']]);
   		$this->middleware(['permission:modificacion_alimentos'],['only'=>['edit']]);
   		$this->middleware(['permission:ver_alimentos'],['only'=>['index']]);
   		 $this->middleware('auth');
   	}
    public function index(Request $request)
    {
      $query = $request->get('search');
      $busqueda_por= $request->get('busqueda_por');
      if($request){
        switch ($busqueda_por) {
          case 'busqueda_id':
            $alimentos=Alimento::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_name':
              $alimentos=Alimento::findByName($query)->get();
              $busqueda_por="NOMBRE";
            break;
          default:
            $alimentos=Alimento::all();
            break;
        }

      }
      $alimentos_total=Alimento::all()->count();
      return  view('nutricion.alimentos.index', compact('alimentos','alimentos_total','query','busqueda_por'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nutricion.alimentos.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlimentoRequest $request)
    {
      $data=$request->all();
      $alimento=Alimento::create([
          'name' => ucwords($data['name']),
        ]);

      $alimento->save();
      return redirect('/alimentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alimento  $alimento
     * @return \Illuminate\Http\Response
     */
    public function show(Alimento $alimento)
    {
        return  view('nutricion.alimentos.show', compact('alimento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alimento  $alimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Alimento $alimento)
    {
        return view('nutricion.alimentos.edit',compact('alimento'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alimento  $alimento
     * @return \Illuminate\Http\Response
     */
    public function update(AlimentoRequest $request, Alimento $alimento)
    {
      if($alimento){
        $alimento->name=ucwords($request->name);
        $alimento->save();

      }
      return redirect('/alimentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alimento  $alimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alimento $alimento)
    {
      try {
        $alimento->delete();
        return response()->json([
            'estado'=>'true',
            'success' => 'Alimento eliminado con exito!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'estado'=>'false',
          'success' => 'No se pudo eliminar el alimento !'
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
                #return  $alimentos=Alimento::findByName($query)->get();
                return $alimentos = Alimento::buscar_like_name($query);
                break;
              default:
                return  $alimentos=Alimento::all();
                break;
              }
          }
          return response()->$alimentos->toJson();
        }
    }
}
