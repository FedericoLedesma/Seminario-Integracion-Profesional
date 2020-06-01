<?php

namespace App\Http\Controllers;

use App\Persona;
use App\TipoDocumento;
use App\Patologia;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\PersonaRequest;
use App\Http\Requests\PersonaEditRequest;
use Illuminate\Support\Facades\Log;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       $this->middleware(['permission:alta_personas'],['only'=>['create','store']]);
       $this->middleware(['permission:baja_personas'],['only'=>['destroy']]);
       $this->middleware(['permission:modificacion_personas'],['only'=>['edit']]);
       $this->middleware(['permission:ver_personas'],['only'=>['index']]);
        $this->middleware('auth');
     }
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
            $personas=Persona::findByNumeroDoc($query);
            
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
    public function store(PersonaRequest $request)
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
      $patologias=Patologia::all();
      $patologiasPersona=$persona->patologias;
/**
  Resta de patologias
**/
      $i=0;
      foreach ($patologias as $patologia){

        foreach ($patologiasPersona as $patologiaPersona){

            if($patologia->id== $patologiaPersona->id){

              unset($patologias[$i]);
            }
        }
        $i++;
      }
          return view('admin_personas.personas.edit',compact('persona','tipos_documentos','patologias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaEditRequest $request, Persona $persona)//crear un request para validar
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

          $fecha= new DateTime(date("Y-m-d"));

          $quitarPatologias=$request->quitarPatologias;
          $patologiasPersona=$persona->getPatologiasFecha($fecha);

          /**
          Por cada patologia que tiene la persona y por cada patologia a quitar
          pregunto si son iguales y si lo son le agrego una fecha hasta
          La fecha deberia ser pasada por parametro
          **/
          if($quitarPatologias){
            foreach ($quitarPatologias as $patologia) {

              foreach($patologiasPersona as $patologiaPersona){
                  if($patologia==$patologiaPersona->id){
                    $persona->patologias()->updateExistingPivot($patologia, ['hasta'=>$fecha]);
                  }
              }

            }
          }
          /**

          **/
          $patologias=$request->agregarPatologias;

          if($patologias){
            foreach ($patologias as $patologia) {
              try{
              $persona->patologias()->attach($patologia,['fecha' => $fecha]);
              } catch (\Exception $e) {

              }
            }
          }
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

      $persona->delete();
      return response()->json([
          'estado'=>'true',
          'success' => 'Persona eliminada con exito!'
      ]);
    }
    /*  return response()->json([
          'estado'=>'false',
          'success' => 'No tiene permiso para eliminar usuario'
      ]);
    }*/
}
