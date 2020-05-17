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


}
