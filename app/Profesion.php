<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
  protected $table = "profesions";

  protected $fillable = [
      'id','name',
  ];
  public static function findById(int $id)
  {
      if($id){
         $profesion = static::where('id', $id)->first();
         if($profesion){
           return $profesion;
       }
     }return null;
  }
  public function scopeFindByName($query,$name)
  {
    if($name){
      return $query->where('name','LIKE','%'.$name.'%')
      ->orderBy('id', 'asc');
    }return null;
  }
}
