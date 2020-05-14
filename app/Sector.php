<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
  protected $table = "sectors";

  protected $fillable = [
      'id', 'name', 'descripcion',
  ];
  public static function findById(int $id)
  {
       $sector = static::where('id', $id)->first();
       if($sector){
         return $sector;
     } return null;
  }
  public function scopeFindByName($query,$name)
  {
    if($name){
      return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
    }return null;
  }
}
