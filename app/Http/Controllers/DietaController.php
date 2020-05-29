<?php

namespace App\Http\Controllers;

use App\Dieta;
use Illuminate\Http\Request;

class DietaController extends Controller
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
            $dietas=Dieta::where('id','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
            $busqueda_por="ID";
            break;
          case 'busqueda_patologia':
              $dietas=Dieta::findByPatologia($query)->get();
              $busqueda_por="Patologia";
            break;
          default:
            $dietas=Dieta::all();
            break;
        }

      }
    //	$users=User::all();
      $dietas_total=Dieta::all()->count();
      return  view('nutricion.dietas.index', compact('dietas','dietas_total','query','busqueda_por'));


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
     * @param  \App\Dieta  $dieta
     * @return \Illuminate\Http\Response
     */
    public function show(Dieta $dieta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dieta  $dieta
     * @return \Illuminate\Http\Response
     */
    public function edit(Dieta $dieta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dieta  $dieta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dieta $dieta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dieta  $dieta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dieta $dieta)
    {
        //
    }
}
