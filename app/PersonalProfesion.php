<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalProfesion extends Model
{
    protected $table = "personal_has_profesions";

    protected $fillable = [
        'personal_id','profesion_id',
    ];
    public static function findById($personal_id,$profesion_id)
    {
        if(($personal_id)&&($profesion_id)){
           $personalProfesion = static::where('personal_id', $personal_id)
           ->where('profesion_id', $profesion_id)
           ->first();
           if($personalProfesion){
             return $personalProfesion;
         }
       }return null;
    }
    public function scopeFindByPersonal($query,$personal_id)
    {
      if($personal_id){
        return $query->where('personal_id',$personal_id)
        ->orderBy('profesion_id', 'asc');
      }return null;
    }
    public function scopeFindByProfesion($query,$profesion_id)
    {
      if($profesion_id){
        return $query->where('profesion_id',$profesion_id)
        ->orderBy('personal_id', 'asc');
      }return null;
    }

}
