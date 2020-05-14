<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
  protected $table = "personals";

  protected $fillable = [
      'id', 'matricula',
  ];
  public static function findById($id)
  {
      if($id){
         $personal = static::where('id', $id)->first();
         if($personal){
           return $personal;
       }
     }return null;
  }
  public static function findByMatricula($matricula)
  {
      if($matricula){
       $personal = static::where('matricula', $matricula)->first();
       if($personal){
         return $personal;
     }
    }return null;
  }
}
