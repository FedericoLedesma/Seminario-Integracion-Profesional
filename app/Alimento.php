<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RacionAlimento;

class Alimento extends Model
{
  protected $table = "alimentos";

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

  public static function get_raciones_prohibidas($alimento){
        return RacionAlimento::get_raciones_prohibidas($alimento->id);
     }
}
