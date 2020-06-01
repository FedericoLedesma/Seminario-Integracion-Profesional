<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoriaInternacion;

class HistorialInternacionController extends Controller
{
  public function __construct()
  {
    $this->middleware(['permission:alta_patologias'],['only'=>['create','store']]);
    $this->middleware(['permission:baja_patologias'],['only'=>['destroy']]);
    $this->middleware(['permission:modificacion_patologias'],['only'=>['edit']]);
    $this->middleware(['permission:ver_patologias'],['only'=>['index']]);
    $this->middleware('auth');
  }

  public function index(){
    $historiales = HistoriaInternacion::get_pacientes_internados();
    $query = '';
    $busqueda_por = '';
    return view('admin_personas.historial.index',compact('historiales','query','busqueda_por'));
  }

  public function create(Request $request){

  }

  public function edit(HistoriaInternacion $request){

  }

  public function store(HistoriaInternacion $request){

  }

  public function show(HistoriaInternacion $request){

  }

  public function delete(HistoriaInternacion $request){

  }
}
