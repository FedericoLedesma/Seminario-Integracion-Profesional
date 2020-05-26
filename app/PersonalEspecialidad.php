<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalEspecialidad extends Model
{
    protected $table = "personal_especialidad";

    protected $fillable = [
        'id','personal_id','especialidad_id','fecha',
    ];

    public $timestamps = false;

    public static function findById($personal_id,$especialidad_id)
    {
        if(($personal_id)&&($especialidad_id)){
           $personalEspecialidad = static::where('personal_id', $personal_id)
           ->where('especialidad_id', $especialidad_id)
           ->first();
           if($personalEspecialidad){
             return $personalEspecialidad;
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
    public function scopeFindByProfesion($query,$especialidad_id)
    {
      if($especialidad_id){
        return $query->where('especialidad_id',$especialidad_id)
        ->orderBy('personal_id', 'asc');
      }return null;
    }

}
