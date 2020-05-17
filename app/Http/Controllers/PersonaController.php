<?php

namespace App\Http\Controllers;

use App\Persona;
use App\TipoDocumento;
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
        $tipos_documentos=TipoDocumento::all();
        return view('admin_personas.personas.create',compact('tipos_documentos'));

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
        $persona=Persona::create([
            'name' => $data['name'],
            'numero_doc'=>$data['numero_doc'],
            'apellido'=>$data['apellido'],
            'direccion'=>$data['direccion'],
            'email'=>$data['email'],
            'provincia'=>$data['provincia'],
            'localidad'=>$data['localidad'],
            'sexo'=>$data['sexo'],
            'fecha_nac'=>$data['fecha_nac'],
            'tipo_documento_id'=>$data['tipo_documento_id'],
          ]);

        $persona->save();
        return redirect('/personas');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
      return  view('admin_personas.personas.show', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
      $tipos_documentos=TipoDocumento::all();
          return view('admin_personas.personas.edit',compact('persona','tipos_documentos'));
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
        if($persona){
          $persona->numero_doc=$request->numero_doc;
          $persona->tipo_documento_id=$request->tipo_documento_id;
          $persona->apellido=$request->apellido;
          $persona->name=$request->name;
          $persona->observacion=$request->observacion;
          $persona->direccion=$request->direccion;
          $persona->email=$request->email;
          $persona->provincia=$request->provincia;
          $persona->localidad=$request->localidad;
          $persona->sexo=$request->sexo;
          $persona->fecha_nac=$request->fecha_nac;
          $persona->save();

        }
        return redirect('/personas');
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
