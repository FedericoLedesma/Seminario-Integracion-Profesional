<?php

namespace App\Http\Controllers;

use App\Sector;
use App\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware(['permission:alta_sectores'],['only'=>['create','store']]);
       $this->middleware(['permission:baja_sectores'],['only'=>['destroy']]);
       $this->middleware(['permission:modificacion_sectores'],['only'=>['edit']]);
       $this->middleware(['permission:ver_sectores'],['only'=>['index']]);
       $this->middleware(['permission:ver_historial'],['only'=>['historial']]);
        $this->middleware('auth');
     }
    public function index(Request $request)
    {
      $query = $request->get('search');
      $busqueda_por= $request->get('busqueda_por');
      $habitacion = array();
      if($request){
        switch ($busqueda_por) {
          case 'busqueda_id':
            $habitacion=Habitacion::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_name':
              $habitacion=Habitacion::findByName(strtoupper($query))->get();
              $busqueda_por="NOMBRE";
            break;
          default:
            $habitacion=Habitacion::all();
            break;
        }

      }
      $habitaciones_total=Habitacion::all()->count();
      return  view('admin_sectores.habitacion.index', compact('habitacion','habitaciones_total','query','busqueda_por'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $sectores = Sector::all();
      return  view('admin_sectores.habitacion.create', compact('sectores'));
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
        try{
          $habitacion=Habitacion::create([
              'name' =>strtoupper($data['name']),
              'descripcion'=>$data['descripcion'],
              'sector_id'=>$data['sector_id'],
            ]);

          $habitacion->save();
          return redirect('/habitaciones');
        } catch (\Exception $e) {
          return redirect('/habitaciones');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $habitacion=Habitacion::find($id);
        return view('admin_sectores.habitacion.show',compact('habitacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $habitacion=Habitacion::find($id);
        $sectores=Sector::all();
        return view('admin_sectores.habitacion.edit',compact('habitacion','sectores'));
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
      try{
        $habitacion=Habitacion::find($id);
        $habitacion->name=strtoupper($request->name);
        $habitacion->descripcion=$request->descripcion;
        $habitacion->set_sector_id($request->sector_id);
        $habitacion->save();
        Log::debug('Habitacion updateada a '.$habitacion);
        #if ($habitacion->get_cantidad_camas_desocupadas()>0){
          Log::debug('Intentando cambiar la cantidad de camas, hay '.$habitacion->get_cantidad_camas_desocupadas().' camas desocupadas');
          $habitacion->set_cantidad_camas($request->cantidad_camas);
        #}
        return redirect('/habitaciones');
      } catch (\Exception $e) {
        $habitacion=Habitacion::find($id);
        $sectores=Sector::all();
        return view('admin_sectores.habitacion.edit',compact('habitacion','sectores'));
      }
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
        $habitacion=Habitacion::find($id);
        $habitacion->delete();
        return response()->json([
            'estado'=>'true',
            'success' => 'Habitacion eliminada con exito!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'estado'=>'false',
          'success' => 'No se pudo eliminar la habitacion !'
        ]);
      }
    }

    public function historial($id){
      $habitacion = Habitacion::find($id);
      $pacientes = $habitacion->get_pacientes_internados();
      Log::debug('Buscando pacientes activos en la habitación: '.$habitacion);
      foreach ($pacientes as $paciente) {
        Log::debug('Se encontró un paciente: '.$paciente);
        $historial = $paciente->get_historial_menues(null);
        foreach ($historial as $menu) {
          Log::debug('Se encontró un menu: '.$menu);
        }
      }
      return view('admin_sectores.habitacion.historial',compact('habitacion','pacientes'));
    }
}
