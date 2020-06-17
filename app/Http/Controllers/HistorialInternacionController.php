<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\HistoriaInternacion;
use App\TipoDocumento;
use App\Paciente;
use App\Persona;
use App\Sector;
use App\Habitacion;
use Carbon\Carbon;
use App\Http\Requests\PacienteRequest;

class HistorialInternacionController extends Controller
{
  public function __construct()
  {
    $this->middleware(['permission:alta_historial'],['only'=>['create','store']]);
    $this->middleware(['permission:alta_historial'],['only'=>['create','createPaciente']]);
    $this->middleware(['permission:baja_historial'],['only'=>['destroy']]);
    $this->middleware(['permission:modificacion_historial'],['only'=>['edit']]);
    $this->middleware(['permission:modificacion_historial'],['only'=>['alta']]);
    $this->middleware(['permission:ver_historial'],['only'=>['index']]);
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
            $historiales = HistoriaInternacion::buscar_pacientes_internados_por_nombre($query);
            $busqueda_por="nombres o apellidos";
            $notificacion = 'Se buscaron los pacientes activos por nombres o apellido';
            break;
        case 'busqueda_dni':
            Log::debug("Se realizará unas búsqueda por nombre de horario. Query:[".$query.']');
            $historiales = HistoriaInternacion::buscar_pacientes_internados_por_dni($query);
            $busqueda_por="dni";
            $notificacion = 'Se buscaron los pacientes activos por número de dni';
            break;
        case 'busqueda_nombre_sector':
            Log::debug("Se realizará unas búsqueda por fecha. Query:[".$query.']');
            $historiales = HistoriaInternacion::buscar_pacientes_internados_por_nombre_sector($query);
            $busqueda_por="sector con nombre";
            $notificacion = 'Se buscaron los pacientes activos por nombre de sector';
            break;
        default:
            $historiales = HistoriaInternacion::get_pacientes_internados();
            break;
      }//end switch $busqueda_por
      return view('admin_personas.historial.index',compact('historiales','query','busqueda_por','notificacion'));
    }//end if $request
    $historiales = HistoriaInternacion::get_pacientes_internados();
    $query = '';
    $busqueda_por = '';
    return view('admin_personas.historial.index',compact('historiales','query','busqueda_por','notificacion'));
  }

    public function create(Request $request){
      $personas_no_internadas = HistoriaInternacion::get_personas_no_internadas();
      $tipos_documentos = TipoDocumento::all();
      $sectores = Sector::all();
      $habitaciones = Habitacion::get_disponibles();
      return view('admin_personas.historial.create',compact('personas_no_internadas','tipos_documentos','sectores','habitaciones'));
    }

    public function edit($id){
      $historial = HistoriaInternacion::find($id);
      $sectores = Sector::all();
      $habitaciones = Habitacion::get_disponibles();
      return view('admin_personas.historial.edit',compact('historial','sectores','habitaciones'));
    }

    public function alta($id){
      try{
        $historial = HistoriaInternacion::find($id);
        $historial->dar_alta();
        $notificacion = 'Se ha dado de alta al paciente: '.$historial->get_paciente_name();
        $query = '';
        $busqueda_por = '';
        $historiales = HistoriaInternacion::get_pacientes_internados();
        return view('admin_personas.historial.index',compact('historiales','query','busqueda_por',
          'notificacion'));
      }
      catch(Throwable $t){
        return view('/home');
      }
    }

    public function altaAcompanante($id){
      try{
        $historial = HistoriaInternacion::find($id);
        $historial->dar_alta_acompanante();
        return $this->show($id);
      }
      catch(Throwable $t){
        return view('/home');
      }
    }

    public function store(Request $request){
      Log::debug($request);
    }

    public function update(Request $request, $historial_id){
      Log::debug($request);
      $historial = HistoriaInternacion::find($historial_id);
      $habitacion = Habitacion::find($request->get('habitacion_id'));
      $historial->rehubicar_paciente($habitacion);
      return $this->show($historial_id);
    }

    public function storeExistente(Request $request){
      Log::debug($request);
      $persona_id = $request->get('persona_id');
      $persona = Persona::find($persona_id);
      $paciente = Paciente::find($persona_id);
      if ($paciente==null){
        $paciente = new Paciente([
          'id'=>$persona->get_id(),
        ]);
        $paciente->save();
      }
      $habitacion = Habitacion::find($request->get('habitacion_id'));
      $se_puede_crear = $habitacion->ingresar_paciente($persona,Carbon::now()->toDateString());
      if ($se_puede_crear){
        $historial = new HistoriaInternacion([
          'paciente_id'=>$persona_id,
          'fecha_ingreso'=>Carbon::now()->toDateString(),
          'peso'=>$request->get('peso'),
        ]);
        $historial->save();
        $personas_no_internadas = HistoriaInternacion::get_personas_no_internadas();
        return view('admin_personas.historial.addAcompanante',
          compact('personas_no_internadas','historial'));
      }//Acá abajo se debería notificar al usuario
      return $this->create($request);
    }

    public function update_add_paciente($historial_id){
      $historial = HistoriaInternacion::find($historial_id);
      if ($historial==null){
        return $this->index('{}');
      }
      $personas_no_internadas = HistoriaInternacion::get_personas_no_internadas();
      return view('admin_personas.historial.addAcompanante',
        compact('personas_no_internadas','historial'));
    }

    public function createPaciente(Request $request){
      $personas_no_internadas = HistoriaInternacion::get_personas_no_internadas();
      $tipos_documentos = TipoDocumento::all();
      $sectores = Sector::all();
      $habitaciones = Habitacion::all();
      return view('admin_personas.historial.createPaciente',compact('personas_no_internadas','tipos_documentos','sectores','habitaciones'));
    }

    public function ingresarNuevo(PacienteRequest $request){
      $data=$request->all();
      $persona= new Persona([
          'name' => strtoupper($data['name']),
          'numero_doc'=>$data['numero_doc'],
          'apellido'=>strtoupper($data['apellido']),
          'direccion'=>strtoupper($data['direccion']),
          'email'=>$data['email'],
          'provincia'=>strtoupper($data['provincia']),
          'localidad'=>strtoupper($data['localidad']),
          'sexo'=>strtoupper($data['sexo']),
          'fecha_nac'=>$data['fecha_nac'],
          'tipo_documento_id'=>$data['tipo_documento_id'],
        ]);
      $persona->save();
      $paciente = new Paciente(['id'=> $persona->get_id()]);
      $paciente->save();
      $habitacion = Habitacion::find($data['habitacion_id']);
      $se_puede_crear = $habitacion->ingresar_paciente($persona,Carbon::now()->toDateString());
      if ($se_puede_crear){
        $historial = new HistoriaInternacion([
          'paciente_id'=>$persona->get_id(),
          'fecha_ingreso'=>Carbon::now()->toDateString(),
          'peso'=>$data['peso'],
        ]);
        $historial->save();
        $personas_no_internadas = HistoriaInternacion::get_personas_no_internadas();
        return view('admin_personas.historial.addAcompanante',
          compact('personas_no_internadas','historial'));
      }//Acá abajo se debería notificar al usuario
      return $this->create($request);
    }

    public function addAcompanante(Request $request){
      Log::debug($request);
      $historial = HistoriaInternacion::find($request->get('historial_id'));
      $persona = Persona::find($request->get('persona_id'));
      $historial->add_acompanante($persona);
      return $this->sucess();
    }

    public function createAcompanante($historial){
      $tipos_documentos = TipoDocumento::all();
      return view('admin_personas.historial.createAcompanante',compact('historial','tipos_documentos'));
    }

    public function storeNewAcompanante(Request $request){
      Log::debug($request);
      $data=$request->all();
      $persona= new Persona([
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
      $historial = HistoriaInternacion::find($request->get('historial_id'));
      $historial->add_acompanante($persona);
      return $this->sucess();
    }

    public function sucess(){
      return view('admin_personas.historial.sucess');
    }

    public function show($id){
      $historial = HistoriaInternacion::find($id);
      return view('admin_personas.historial.show', compact('historial'));
    }

    public function delete(HistoriaInternacion $request){

    }
}
