<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RacionAlimento;

class Alimento extends Model
{
  protected $table = "alimento";

  protected $fillable = [
      'id', 'name',
  ];
  public static function findById($id)
  {
       $alimento = static::where('id', $id)->first();
       if($alimento){
         return $alimento;
     } return null;
  }
  public function scopeFindByName($query,$name)
  {
    if($name){
      return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
    }return null;
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
  public static function getAlimentosQueNoContieneRacion($racion)
  {
    $alimentos_all=Alimento::all();
    $alimentos=array();
    foreach ($alimentos_all as $alimento) {
      $b=true;
      foreach ($racion->alimentos as $alimento_r) {
        if($alimento->id==$alimento_r->id){
          $b=false;
        }
      }
      if($b){
        array_push($alimentos,$alimento);
      }
    }return $alimentos;
  }

  public static function getAlimentosQueNoContienePatologia($patologia)
  {
    $alimentos_all=Alimento::all();
    $alimentos=array();
    foreach ($alimentos_all as $alimento) {
      $b=true;
      foreach ($patologia->alimentos as $alimento_p) {
        if($alimento->id==$alimento_p->id){
          $b=false;
        }
      }
      if($b){
        array_push($alimentos,$alimento);
      }
    }return $alimentos;
  }

  public function get_raciones(){
        return RacionAlimento::get_raciones_por_alimento($this->id);
  }

  public function get_id(){
    return $this->id;
  }

  public function set_id(int $id){
    $this->id = $id;
  }

  public function get_name(){
    return $this->name;
  }

  public function set_name($name){
    $this->name = $name;
  }

  public static function buscar_like_name($name){
    return static::where('name','LIKE','%'.$name.'%')->get();
  }
}
