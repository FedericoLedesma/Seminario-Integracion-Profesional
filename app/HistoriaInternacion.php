<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaInternacion extends Model
{
  protected $table = "historia_internacion";

  protected $fillable = [
      'paciente_id', 'fecha_ingreso', 'peso', 'fecha_egreso',
  ];
  public static function findByPaciente($paciente_id,$fecha_ingreso)
  {
      if(($paciente_id)&&($fecha_ingreso)){
         $historiaInternacion = static::where('paciente_id', $paciente_id)
         ->where('fecha_ingreso','=',$fecha_ingreso)
         ->first();
         if($historiaInternacion){
           return $historiaInternacion;
       }
     }return null;
  }

  public function scopeFindByPaciente($query,$paciente_id)
  {
    if($paciente_id){
      return $query->where('paciente_id',$paciente_id)
      ->orderBy('fecha_ingreso', 'asc');
    }return null;
  }

  public function scopeFindByPacienteEntreFechas($query,$paciente_id,$fecha_desde,$fecha_hasta)
  {
    if((($paciente_id)&&($fecha_desde))&&($fecha_hasta)){
      return $query->where('paciente_id',$paciente_id)
      ->where('fecha_ingreso','>=',$fecha_desde)
      ->where('fecha_ingreso','<=',$fecha_hasta)
      ->orderBy('fecha_ingreso', 'asc');
    }return null;
  }

  public static function get_pacientes_internados(){
    return static::where('fecha_egreso','=',null)
             ->get();
  }

}
