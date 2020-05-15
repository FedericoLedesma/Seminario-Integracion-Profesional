<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
