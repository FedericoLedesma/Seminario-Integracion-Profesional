<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;
use App\Profesion;

class EspecialidadController extends Controller
{
  public function __construct()
  {
    $this->middleware(['permission:alta_profesion'],['only'=>['create','store']]);
    $this->middleware(['permission:baja_profesion'],['only'=>['destroy']]);
    $this->middleware(['permission:modificacion_profesion'],['only'=>['edit']]);
    $this->middleware(['permission:ver_profesion'],['only'=>['index']]);
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
         $profesion=Especialidad::where('id','LIKE','%'.$query.'%')
           ->orderBy('id','asc')
           ->get();
         $busqueda_por="ID";
         break;
       case 'busqueda_name':
           $profesion=Especialidad::findByName($query)->get();
           $busqueda_por="NOMBRE";
         break;
       default:
         $profesion=Especialidad::all();
         break;
     }

   }
   $profesion_total=Especialidad::all()->count();
   return  view('admin_personas.personal.especialidad.index', compact('profesion','profesion_total','query','busqueda_por'));

 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
   $profesiones = Profesion::all();
   return  view('admin_personas.personal.especialidad.create',compact('profesiones'));
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
     #Log::debug($data);
     $habitacion=Especialidad::create([
         'name'=>$data['name'],
         'profesion_id'=>$data['profesion_id'],
       ]);

     $habitacion->save();
     return redirect('/profesion');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Sector  $sector
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
     $profesion=Especialidad::find($id);
     return view('admin_personas.personal.especialidad.show',compact('profesion'));
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Sector  $sector
  * @return \Illuminate\Http\Response
  */
 public function edit($id)
 {
     $especialidad=Especialidad::find($id);
     $profesiones = Profesion::all();
     return view('admin_personas.personal.especialidad.edit',compact('especialidad','profesiones'));
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
     $habitacion=Especialidad::find($id);
     $habitacion->name=$request->name;
     $habitacion->profesion_id=$request->profesion_id;
     $habitacion->save();
     return redirect('/profesion');
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
     #Log::debug($id);
     $habitacion=Especialidad::find($id);
     $habitacion->delete();
     return response()->json([
         'estado'=>'true',
         'success' => 'Profesión eliminada con exito!'
     ]);
   } catch (\Exception $e) {
     return response()->json([
       'estado'=>'false',
       'success' => 'No se pudo eliminar la profesión !'
     ]);
   }
 }

 public function agregar($personal_id,$profesion_id){
   $personal = Personal::find($personal_id);
   $profesion = Especialidad::find($profesion_id);
   if (($personal<>null)&&($profesion<>null)){
     $personal->add_profesion($profesion);
     return response()->json([
         'estado'=>'true',
         'success' => 'Profesión agregada con exito!'
     ]);
   }
   return response()->json([
     'estado'=>'false',
     'success' => 'No se pudo agregada la profesión !'
   ]);
 }

 public function quitar($personal_id,$profesion_id){
   $personal = Personal::find($personal_id);
   $profesion = Especialidad::find($profesion_id);
   if (($personal<>null)&&($profesion<>null)){
     $personal->del_profesion($profesion);
     return response()->json([
         'estado'=>'true',
         'success' => 'Profesión quitada con exito!'
     ]);
   }
   return response()->json([
     'estado'=>'false',
     'success' => 'No se pudo quitar la profesión !'
   ]);
 }
}
