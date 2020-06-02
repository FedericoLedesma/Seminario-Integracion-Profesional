<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\HistoriaInternacion;
use App\TipoDocumento;

class HistorialInternacionController extends Controller
{
  public function __construct()
  {
    $this->middleware(['permission:alta_historial'],['only'=>['create','store']]);
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
      return view('admin_personas.historial.create',compact('personas_no_internadas','tipos_documentos'));
    }

    public function edit(HistoriaInternacion $request){

    }

    public function alta($id){
      try{
        $historial = HistoriaInternacion::find($id);
        $historial->dar_alta();
        $notificacion = 'Se ha dado de alta al paciente: '.$historial->get_paciente_name();
        $query = '';
        $busqueda_por = '';
        $historiales = HistoriaInternacion::get_pacientes_internados();
        return view('admin_personas.historial.index',compact('historiales','query','busqueda_por','notificacion'));
      }
      catch(Throwable $t){
        return view('/home');
      }
    }

    public function store(){

    }

    public function ingresarNuevo(Request $request){
      echo $request;
    }

    public function show(HistoriaInternacion $request){

    }

    public function delete(HistoriaInternacion $request){

    }
}