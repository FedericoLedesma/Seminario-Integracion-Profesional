<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acompanante extends Model
{
  protected $table = "acompanantes";

  protected $fillable = [
      'acompanante_id', 'paciente_id','fecha',
  ];
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
}
