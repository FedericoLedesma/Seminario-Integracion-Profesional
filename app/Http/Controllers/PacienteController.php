<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Paciente;
use App\TipoDocumento;
use App\Persona;
use App\Patologia;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
      //
      #if (Auth::user()->can('ver_paciente')){
        #$menus = MenuPersona::buscar_por_fecha(Carbon::now()->toDateString());
      $query = $request->get('search');
      $busqueda_por= $request->get('busqueda_por');
      if($request){
        switch ($busqueda_por) {
          case 'busqueda_dni':
              $pacientes=Paciente::buscar_por_dni($query);
              $busqueda_por="DNI";
              break;
          case 'busqueda_name':
              $pacientes=Paciente::buscar_por_nombre_y_apellido($query);
              $busqueda_por="NOMBRE";
              break;
          default:
            $pacientes=Paciente::all();
            break;
        }
        return view('admin_personas.pacientes.index',compact('pacientes','query','busqueda_por'));
      #}
      }

      return redirect('/home');
  }

  public function create(Request $request)
  {
      //
      #if (Auth::user()->can('crear_paciente')){
        $tipo_documento = TipoDocumento::all();
        $personas = Persona::all();
        return view('admin_personas.pacientes.create',compact('tipo_documento','personas'));
      #}
  }
  public function getPatologias(Paciente $paciente ){
    Log::info("getPatologias");
    Log::info($paciente->persona->patologias);
    $patologias=$paciente->persona->patologias;
    Log::info("patologias -  ".$patologias);
    if(count($patologias)==0){
      Log::info("No tiene patologias return null json");
      return response()->json([
            'success'=>'false',
            'patologias' => ''
        ]);
    }else{
      Log::info("Tiene patologias");
      $s="";

      foreach ($patologias as $patologia) {
        $s=$s.' '.$patologia->name;
      }
      Log::info($s);
      return response()->json([
            'success'=>'true',
            'patologias' => $s,
        ]);
    }
  }
}
