<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Racion extends Model
{
  protected $table = "racions";

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
  
}
