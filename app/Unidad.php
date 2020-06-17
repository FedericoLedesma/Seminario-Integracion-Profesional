<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
  protected $table = "unidad";

  protected $fillable = [
      'id', 'name',
      ];
  public static function findById(int $id)
  {
       $unidad = static::where('id', $id)->first();
       if($unidad){
         return $unidad;
     } return null;
  }
  public function scopeFindByName($query,$name)
  {
    if($name){
      return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
    }return null;
  }

  public function delete(){
    $destroy = static::where('id', $this->id)->delete();
  }
}
