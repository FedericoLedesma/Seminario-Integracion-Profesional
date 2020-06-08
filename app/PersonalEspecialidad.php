<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public static function buscar_por_personal_id($persona_id){
      return static::where('personal_id','=',$persona_id)->get();
    }

    public function get_profesion(){return Profesion::find($this->especialidad_id);}

    public static function create_by_personal_profesion($personal,$profesion){
      $new = new PersonalEspecialidad([
        'personal_id'=>$personal->get_id(),
        'profesion_id'=>$profesion->get_id(),
        'fecha'=>Carbon::now(),
      ]);
      $new->save();
    }

    public static function destroy_by_personal_profesion($personal,$profesion){
      static::where('personal_id','=',$personal->get_id())
        ->where('profesion_id','=',$profesion->get_id())
        ->delete();
    }

}
