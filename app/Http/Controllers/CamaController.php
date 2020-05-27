<?php

namespace App\Http\Controllers;

use App\Habitacion;
use App\Cama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       /*$this->middleware(['permission:alta_sectores'],['only'=>['create','store']]);
       $this->middleware(['permission:baja_sectores'],['only'=>['destroy']]);
       $this->middleware(['permission:modificacion_sectores'],['only'=>['edit']]);
       $this->middleware(['permission:ver_sectores'],['only'=>['index']]);
        $this->middleware('auth');*/
     }
    public function index(Request $request)
    {
      $query = $request->get('search');
      $busqueda_por= $request->get('busqueda_por');
      $habitacion = array();
      if($request){
        switch ($busqueda_por) {
          case 'busqueda_id':
            $cama=Cama::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_name':
              $cama=Cama::findByName($query)->get();
              $busqueda_por="NOMBRE";
            break;
          default:
            $cama=Cama::all();
            break;
        }

      }
      $camas_total=Cama::all()->count();
      return  view('admin_sectores.cama.index', compact('cama','camas_total','query','busqueda_por'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $habitaciones = Habitacion::all();
      return  view('admin_sectores.cama.create', compact('habitaciones'));
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
        Log::debug($data);
        $habitacion=Cama::create([
            'habitacion_id'=>$data['habitacion_id'],
          ]);

        $habitacion->save();
        return redirect('/camas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cama=Cama::find($id);
        return view('admin_sectores.cama.show',compact('cama'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cama=Cama::all($id);
        $habitaciones=Habitacion::all();
        return view('admin_sectores.cama.edit',compact('cama','habitaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $habitacion=Cama::find($id);
        $habitacion->name=$request->name;
        $habitacion->descripcion=$request->descripcion;
        $habitacion->set_habitacion_id($request->habitacion_id);
        $habitacion->save();
        return redirect('/camas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        Log::debug($id);
        $habitacion=Cama::find($id);
        $habitacion->delete();
        return response()->json([
            'estado'=>'true',
            'success' => 'Cama eliminada con exito!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'estado'=>'false',
          'success' => 'No se pudo eliminar la cama !'
        ]);
      }
    }
}
