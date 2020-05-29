<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Habitacion;
use App\Sector;
use App\Persona;
use Carbon\Carbon;
use App\Horario;

class FormsController extends Controller
{
    //

    public function showSelect(Request $request, $form, $id){
      Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
      Log::Debug($request);
      if ($form=='habitacion'){
        $habitacion = Habitacion::buscar_por_sector($id);
        return view('forms.selects.'.$form, compact('habitacion'));
      }
      if ($form=='personas'){
        $sector = Sector::find($id);
        Log::debug('Sector encontrado, buscando los pacientes del sector: '.$sector);
        $crud = $sector->get_pacientes_internados();
        foreach ($crud as $c) {
          Log::debug('Se devolverá '.$c );
        }
        return view('forms.selects.crud_id_name', compact('crud'));
      }
    }
    public function showRaciones(Request $request, $horario_id, $persona_id){
      Log::Debug('Dentro de: '.__CLASS__.' || método: '.__FUNCTION__);
      $persona = Persona::find($persona_id);
      Log::debug('Persona encontrado, buscando las raciones de la persona: '.$persona);
      Log::debug('ID Horario: '.$horario_id);
      $horario = Horario::find($horario_id);
      $fecha = Carbon::now()->toDateString();
      $raciones = $persona->get_raciones_disponibles($fecha,$horario);
      $racion_recomendada = $persona->recomendar_racion($fecha,$horario);
        Log::Debug('Saliendo de: '.__CLASS__.' || método: '.__FUNCTION__);
      return view('forms.selects.racion_id_name', compact('raciones','racion_recomendada'));
    }

}
