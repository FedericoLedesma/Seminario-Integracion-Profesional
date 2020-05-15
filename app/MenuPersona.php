<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPersona extends Model
{
  protected $table = "menu_personas";

  protected $fillable = [
      'persona_id','horario_id','racion_id', 'fecha','personal_id',
      'dieta_id','realizado',
  ];
  public static function findById($horario_id,$persona_id,$fecha)
  {
       $menu_personas = static::where('horario_id', $horario_id)
       ->where('fecha','=', $fecha)
       ->where('persona_id', $persona_id)
       ->first();
       if($menu_personas){
         return $menu_personas;
     } return null;
  }

  public function scopeAllHorarioFecha($query,$horario_id,$fecha)
  {
    if(($horario_id)&&($fecha)){
      return $query->where('fecha','=',$fecha)
      ->where('horario_id',$horario_id)
      ->orderBy('persona_id', 'asc');
    }return null;
  }

  public function scopeAllRealizadosHorarioFecha($query,$horario_id,$fecha)
  {
    if(($horario_id)&&($fecha)){
      return $query->where('fecha','=',$fecha)
      ->where('horario_id',$horario_id)
      ->where('realizado',true)
      ->orderBy('persona_id', 'asc');
    }return null;
  }

  public function scopeAllRealizadosFecha($query,$fecha)
  {
    if($fecha){
      return $query->where('fecha','=',$fecha)
      ->where('realizado',true)
      ->orderBy('persona_id', 'asc');
    }return null;
  }
  public function scopeAllFecha($query,$fecha)
  {
    if($fecha){
      return $query->where('fecha','=',$fecha)
      ->orderBy('persona_id', 'asc');
    }return null;
  }
  public function scopeAllPersonaFecha($query,$persona_id,$fecha)
  {
    if(($persona_id)&&($fecha)){
      return $query->where('fecha','=',$fecha)
      ->where('persona_id',$persona_id)
      ->orderBy('persona_id', 'asc');
    }return null;
  }
  public function scopeAllPersona($query,$persona_id)
  {
    if($persona_id){
      return $query->where('persona_id',$persona_id)
      ->orderBy('fecha', 'asc');
    }return null;
  }
}
