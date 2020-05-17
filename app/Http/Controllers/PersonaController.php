<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
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
            $personas=Persona::where('id','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->get();
              $busqueda_por="ID";
            break;
          case 'busqueda_dni':
            $personas=Persona::where('dni','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->get();
            $busqueda_por="DNI";
            break;
          case 'busqueda_name':
              $personas=Persona::where('name','LIKE','%'.$query.'%')
              ->orderBy('id','asc')
              ->get();
                $busqueda_por="NOMBRE";
            break;
            case 'busqueda_apellido':
                $personas=Persona::where('apellido','LIKE','%'.$query.'%')
                ->orderBy('id','asc')
                ->get();
                $busqueda_por="NOMBRE";
              break;
          default:
            $personas=Persona::all();
            break;
        }

      }
    //	$users=User::all();
      $personas_total=Persona::all()->count();
      return  view('admin_personas.personas.index', compact('personas','personas_total','query','busqueda_por'));
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
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
