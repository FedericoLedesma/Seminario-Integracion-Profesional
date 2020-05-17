<?php

namespace App\Http\Controllers;

use App\Patologia;
use Illuminate\Http\Request;

class PatologiaController extends Controller
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
            $patologias=Patologia::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_name':
              $patologias=Patologia::findByName($query)->get();
              $busqueda_por="NOMBRE";
            break;
            case 'busqueda_tipo_patologia':
                $patologias=Patologia::findByTipoPatologia($query)->get();
                $busqueda_por="TIPO DE PATOLOGIA";
              break;
          default:
            $patologias=Patologia::all();
            break;
        }

      }
    //	$users=User::all();
      $patologias_total=Patologia::all()->count();
      return  view('admin_patologias.patologias.index', compact('patologias','patologias_total','query','busqueda_por'));

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
     * @param  \App\Patologia  $patologia
     * @return \Illuminate\Http\Response
     */
    public function show(Patologia $patologia)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patologia  $patologia
     * @return \Illuminate\Http\Response
     */
    public function edit(Patologia $patologia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patologia  $patologia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patologia $patologia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patologia  $patologia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patologia $patologia)
    {
      $patologia->delete();
      return response()->json([
          'estado'=>'true',
          'success' => 'Patologia eliminada con exito!'
      ]);
    }
}
