<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Racion extends Model
{
  protected $table = "raciones";

  protected $fillable = [
      'id', 'name', 'observacion',
  ];
  public static function findById(int $id)
  {
       $racion = static::where('id', $id)->first();
       if($racion){
         return $racion;
     } return null;
  }
  public function scopeFindByName($query,$name)
  {
    if($name){
      return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
    }return null;
  }

  /**
   métodos de instancia
   * 
   * 
   */

  

  


  /**
   métodos estáticos 
   * 
   * 
   */


  public static function intercept_raciones($conj_a, $conj_b){
    $intercepcion = array();
    foreach($conj_a as $a){
      foreach($conj_b as $b){
        if ($a->id == $b->id){
          array_push($intercepcion,$a);
        }
      }
    }
    return $intercepcion;
  }

  public static function union_raciones($conj_a, $conj_b){
    $intercepcion = array();
    foreach($conj_a as $a){
      array_push($intercepcion,$a);
    }
    foreach($conj_b as $b){
      array_push($intercepcion,$b);
    }
    return $intercepcion;
  }

  public static function buscar_por_fecha_horario($fecha, $horario){
    if(($horario)&&($fecha)){
      $aux = RacionesDisponibles::buscar_por_fecha_horario($fecha, $horario);
      $res = Array();
      foreach($aux as $rd){
        array_push($res,$rd->get_racion());
      }
      return $res;
    }
    return null;
}

}
