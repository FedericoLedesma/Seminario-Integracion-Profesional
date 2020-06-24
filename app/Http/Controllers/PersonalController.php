<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\TipoDocumento;
use App\Paciente;
use App\Persona;
use App\Sector;
use App\Personal;
use App\Profesion;
use Carbon\Carbon;

class PersonalController extends Controller
{
  public function __construct()
  {
    $this->middleware(['permission:alta_personal'],['only'=>['create','store']]);
    $this->middleware(['permission:alta_personal'],['only'=>['create','createPaciente']]);
    $this->middleware(['permission:baja_personal'],['only'=>['destroy']]);
    $this->middleware(['permission:modificacion_personal'],['only'=>['edit']]);
    $this->middleware(['permission:modificacion_personal'],['only'=>['alta']]);
    $this->middleware(['permission:ver_personal'],['only'=>['index']]);
    $this->middleware('auth');
  }

  public function index(Request $request){
    $query = $request->get('search');
    $busqueda_por= $request->get('busqueda_por');
    $notificacion = null;
    if($request){
      switch ($busqueda_por) {
        case 'busqueda_nombre_persona':
            Log::debug("Se realizará unas búsqueda por nombre de persona. Query:[".$query.']');
            $personales = Personal::buscar_por_nombre($query);
            $busqueda_por="nombres o apellidos";
            $notificacion = 'Se buscaron los pacientes activos por nombres o apellido';
            break;
        case 'busqueda_dni':
            Log::debug("Se realizará unas búsqueda por nombre de horario. Query:[".$query.']');
            $personales = Personal::buscar_por_dni($query);
            $busqueda_por="dni";
            $notificacion = 'Se buscaron los pacientes activos por número de dni';
            break;
        case 'busqueda_nombre_sector':
            Log::debug("Se realizará unas búsqueda por fecha. Query:[".$query.']');
            $personales = Personal::buscar_por_nombre_sector($query);
            $busqueda_por="sector con nombre";
            $notificacion = 'Se buscaron los pacientes activos por nombre de sector';
            break;
        default:
            $personales = Personal::all();
            break;
      }//end switch $busqueda_por
      return view('admin_personas.personal.index',compact('personales','query','busqueda_por','notificacion'));
    }//end if $request
    $personales = Personal::all();
    $query = '';
    $busqueda_por = '';
    return view('admin_personas.personal.index',compact('personales','query','busqueda_por','notificacion'));
  }

    public function create(Request $request){
      $personas_no_internadas = Personal::get_no_personal();
      $tipos_documentos = TipoDocumento::all();
      $sectores = Sector::all();
      return view('admin_personas.personal.create',compact('personas_no_internadas','tipos_documentos','sectores'));
    }

    public function edit($id){
      $personal = Personal::find($id);
      $sectores = Sector::all();
      return view('admin_personas.personal.edit',compact('personal','sectores'));
    }

    public function store(Request $request){
      Log::debug($request);
    }

    public function update(Request $request, $historial_id){
      Log::debug($request);
      $personal = Personal::find($historial_id);
      $sector = Sector::find($request->get('sectores'));
      $personal->reubicar_personal($sector);
      return $this->show($historial_id);
    }

    public function storeExistente(Request $request){
      Log::debug($request);
      $persona_id = $request->get('persona_id');
      $personal = Personal::find($persona_id);
      if ($personal==null){
        $personal = new Personal([
          'id'=>$persona_id,
        ]);
        $personal->save();
      }
      Log::debug($personal);
      $sector = Sector::find($request->get('sectores'));
      $personal = Personal::find($persona_id);
      Log::debug($personal);
      $personal->reubicar_personal($sector);
        return $this->index($request);
    }

    public function update_add_paciente($historial_id){
      $historial = Personal::find($historial_id);
      if ($historial==null){
        return $this->index('{}');
      }
      $personas_no_internadas = Personal::get_no_personal();
      return view('admin_personas.personal.addAcompanante',
        compact('personas_no_internadas','historial'));
    }

    public function createPersonal(Request $request){
      $personas_no_internadas = Personal::get_no_personal();
      $tipos_documentos = TipoDocumento::all();
      $sectores = Sector::all();
      return view('admin_personas.personal.createPersonal',compact('personas_no_internadas','tipos_documentos','sectores'));
    }

    public function ingresarNuevo(Request $request)
    {
      $data=$request->all();
      $per=Personal::buscar_por_numero_doc($data['numero_doc']);
      $persona=Persona::findByNumeroDoc($data['numero_doc']);
      if(empty($persona)){
        $persona= new Persona([
            'name' => ucwords($data['name']),
            'numero_doc'=>$data['numero_doc'],
            'apellido'=>ucwords($data['apellido']),
            'direccion'=>ucwords($data['direccion']),
            'email'=>$data['email'],
            'provincia'=>ucwords($data['provincia']),
            'localidad'=>ucwords($data['localidad']),
            'sexo'=>ucwords($data['sexo']),
            'fecha_nac'=>$data['fecha_nac'],
            'tipo_documento_id'=>$data['tipo_documento_id'],
          ]);
        $persona->save();
      }else {
        $persona->direccion = ucwords($data['direccion']);
        $persona->email = $data['email'];
        $persona->provincia = ucwords($data['provincia']);
        $persona->localidad = ucwords($data['localidad']);
        $persona->save();
      }
      $personal = new Personal(['id'=> $persona->id]);
      $personal->save();
      $personal = Personal::find($persona->id);
      $sector = Sector::find($data['sectores']);
      $personal->reubicar_personal($sector);
      $personas_no_internadas = Personal::get_no_personal();
        return $this->index($request);
    }

    public function showProfesiones($personal_id){
      $personal = Personal::find($personal_id);
      $profesiones = $personal->get_profesiones();
      return view('admin_personas.personal.profesiones',compact('profesiones','personal'));
    }

    public function sucess(){
      return view('admin_personas.personal.sucess');
    }

    public function show($id){
      $personal = Personal::find($id);
      return view('admin_personas.personal.show', compact('personal'));
    }

    public function destroy($id){
      Log::debug($id);
      try {
        $personal=Personal::find($id);
        Log::debug('Se borrará el personal: '.$personal);
        #$personal->delete();
        Personal::destroy($id);
        #Personal::where('id','=',$id)->delete();
        Log::debug('Se borró el personal');
        return response()->json([
            'estado'=>'true',
            'success' => 'Personal eliminado con exito!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'estado'=>'false',
          'success' => 'No se pudo eliminar el personal !'
        ]);
      }
    }

    public function addProfesion(Request $request){
      Log::debug($request);
      $personal_id = $request->get('personal_id');
      $profesion_id = $request->get('profesion_id');
      $personal = Personal::find($personal_id);
      $profesion = Profesion::find($profesion_id);
      if (($personal<>null)&&($profesion<>null)){
        $personal->add_profesion($profesion);
      }
      return $this->showProfesiones($personal_id);
    }
}
