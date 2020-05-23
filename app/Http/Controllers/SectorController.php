<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SectorController extends Controller
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
        $this->middleware('auth');
     }
    public function index(Request $request)
    {
      $query = $request->get('search');
      $busqueda_por= $request->get('busqueda_por');
      if($request){
        switch ($busqueda_por) {
          case 'busqueda_id':
            $sectores=Sector::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_name':
              $sectores=Sector::findByName($query)->get();
              $busqueda_por="NOMBRE";
            break;
          default:
            $sectores=Sector::all();
            break;
        }

      }
      $sectores_total=Sector::all()->count();
      return  view('admin_sectores.sector.index', compact('sectores','sectores_total','query','busqueda_por'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return  view('admin_sectores.sector.create');
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
        $sector=Sector::create([
            'name' => $data['name'],
            'descripcion'=>$data['descripcion'],
          ]);

        $sector->save();
        return redirect('/sectores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sector=Sector::findById($id);
        return view('admin_sectores.sector.show',compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sector=Sector::findById($id);
        return view('admin_sectores.sector.edit',compact('sector'));
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
        $sector=Sector::findById($id);
        $sector->name=$request->name;
        $sector->descripcion=$request->descripcion;
        $sector->save();
        return redirect('/sectores');
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
        $sector=Sector::findById($id);
        $sector->delete();
        return response()->json([
            'estado'=>'true',
            'success' => 'Sector eliminado con exito!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'estado'=>'false',
          'success' => 'No se pudo eliminar el sector !'
        ]);
      }
    }
}
