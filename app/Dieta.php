<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
  protected $table = "dietas";

  protected $fillable = [
      'id', 'patologia_id', 'observacion', 'personal_id',
  ];
  public static function findById($id)
  {
       $dieta = static::where('id', $id)->first();
       if($dieta){
         return $dieta;
     } return null;
  }
  public static function findByPatologia($patologia_id)
  {
       $dieta = static::where('patologia_id', $patologia_id)
       ->first();
       if($dieta){
         return $dieta;
     } return null;
  }
  public function scopeFindByPersonal($query,$personal_id)
  {
    if($personal_id){
      return $query->where('personal_id',$personal_id)
      ->orderBy('id', 'asc');
    }return null;
  }
}
