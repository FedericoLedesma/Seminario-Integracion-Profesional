<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acompanante extends Model
{
  protected $table = "acompanante";

  protected $fillable = [
      'id', 'acompanante_id', 'paciente_id','fecha',
  ];

  public static function buscar_por_id(int $id){
    return static::where('id','=',$id)->get()->first();
  }

  public static function findByPaciente($paciente_id,$fecha)
  {
      if(($paciente_id)&&($fecha)){
         $acompanante = static::where('paciente_id', $paciente_id)
         ->where('fecha','=',$fecha)
         ->first();
         if($acompanante){
           return $acompanante;
       }
     }return null;
  }
  public function scopeFindByPaciente($query,$paciente_id)
  {
    if($paciente_id){
      return $query->where('paciente_id',$paciente_id)
      ->orderBy('fecha', 'asc');
    }return null;
  }
  public function scopeFindByPacienteEntreFechas($query,$paciente_id,$fecha_desde,$fecha_hasta)
  {
    if((($paciente_id)&&($fecha_desde))&&($fecha_hasta)){
      return $query->where('paciente_id',$paciente_id)
      ->where('fecha','>=',$fecha_desde)
      ->where('fecha','<=',$fecha_hasta)
      ->orderBy('fecha', 'asc');
    }return null;
  }
}
