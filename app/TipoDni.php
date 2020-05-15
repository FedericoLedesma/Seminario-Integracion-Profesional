<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDni extends Model
{
  protected $table = "tipo_dnis";

  protected $fillable = [
      'id', 'name',
  ];
  public static function findById($id)
  {
       $tipo_dni = static::where('id', $id)->first();
       if($tipo_dni){
         return $tipo_dni;
     } return null;
  }
  public function scopeFindByName($query,$name)
  {
    if($name){
      return $query->where('name','LIKE','%'.$name.'%')
      ->orderBy('id', 'asc');
    }return null;
  }
}
