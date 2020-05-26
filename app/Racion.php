<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alimento;
use App\RacionAlimento;
use App\Patologia;

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
   * Función que indica la pertenencia de varios aliemntos a la ración
   *
   * @param App\Alimento[] $alimentos
   *
   * @return boolean devuelve true si pertenece
   */

   public function contiene_determinada_lista_alimento(array $alimentos){
     $flag = false;
     $list = $this->get_lista_alimentos();
     foreach ($alimentos as $a) {
       $flag |= in_array($alimento,$list);
     }
     in_array($alimento,$this->get_lista_alimentos());
     return $flag;
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

   public function add_alimento(Alimento $alimento, int $cantidad){
     if (($alimento<>null)||($cantidad>0)){
       RacionAlimento::create([
         'racion_id'=>$this->id,
         'alimento_id'=>$alimento->id,
         'cantidad'=>$cantidad,
       ]);
      return true;
      }
      return false;
   }


   public function actualizar_lista_alimentos($nueva_lista){
     RacionAlimento::delete_by_racion_id($this->id);
     foreach ($nueva_lista as $alimento) {
       $this->add_alimento($alimento, 1);
     }
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
        if ($a == $b){
          array_push($intercepcion,$a);
        }
        Log::debug('Comparando racion '.$a.' con  racion '.$b);
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

  /**
  *
  *   Busca todas las raciones compatibles con la patología
  *
  *   @param App\Patologia $patologia
  *
  *
  *   @return App\Racion[]
  *
  */

  public static function get_compatibles_con_patologia(Patologia $patologia){
    $all = static::all();
    $ali_pro = $patologia->get_alimentos_prohibidos();
    $res = Array();
    foreach ($all as $r) {
      // code...
      foreach ($ali_pro as $a) {
        // code...
        if (!($r->contiene_determinado_alimento($a))){
          array_push($res,$r);
        }
      }
    }
    return $res;
  }
  public function alimentos()
  {
    return $this->belongsToMany('App\Alimento', 'raciones_alimentos')
    ->withPivot('cantidad');
  }
  public function getAlimento($id)
  {
    return $this->alimentos()->where('alimento_id',$id);
  }
  public function horarios()
  {
    return $this->belongsToMany('App\Horario', 'horarios_raciones')->withPivot('id');
  }
  
  public static function resta_total_contra_lista($lista){
    $res = Array();
    $all = static::all();
    foreach ($all as $r) {
      // code...
      $flag = true;
      foreach ($lista as $x) {
        // code...
        if ($x==$r){
          $flag=false;
        }
      }
      if ($flag==true){
        array_push($res,$r);
      }
    }
    return $res;
  }

}
