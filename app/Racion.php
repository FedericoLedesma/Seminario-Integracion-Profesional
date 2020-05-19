<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alimento;
use App\RacionAlimento;

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
   * Función que indica la pertenencia de un aliemnto a la ración
   *
   * @param App\Alimento $alimento
   *
   * @return boolean devuelve true si pertenece
   */

   public function contiene_determinado_alimento(Alimento $alimento){
     return in_array($alimento,$this->get_lista_alimentos());
   }

   /**
   * Getter de alimentos
   *
   * @return App\Alimento[]
   */

   public function get_lista_alimentos(){
     $alimentos = Array();
     $lista_rac_ali = RacionAlimento::get_lista_alimentos_por_id_racion($this->id);
     foreach ($lista_rac_ali as $x) {
       // code...
       array_push($alimentos,Alimento::findById($x->alimento_id));
     }
     return $alimentos;
   }



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
    return Array();
}

}
