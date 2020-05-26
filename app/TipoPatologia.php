<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPatologia extends Model
{
  protected $table = "tipo_patologia";

  protected $fillable = [
      'id', 'name', 'observacion',
  ];
  public static function findById(int $id)
  {
       $tipoPatologia = static::where('id', $id)->first();
       if($tipoPatologia){
         return $tipoPatologia;
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
