<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Profesion;

class Especialidad extends Model
{
    protected $table = "especialidad";

    protected $fillable = [
        'id','profesion_id','name',
    ];
    public static function findById(int $id,$profesion_id)
    {
        if(($id)&&($profesion_id)){
           $especialidad = static::where('id', $id)
           ->where('profesion_id', $profesion_id)
           ->first();
           if($profesion){
             return $profesion;
         }
       }return null;
    }
    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name','LIKE','%'.$name.'%')
        ->orderBy('id', 'asc');
      }return null;
    }
    public function scopeFindByProfesion($query,$profesion_id)
    {
      if($profesion_id){
        return $query->where('profesion_id',$profesion_id)
        ->orderBy('id', 'asc');
      }return null;
    }

    public function get_profesion(){return Profesion::find($this->profesion_id);}
    public function get_profesion_name(){return $this->get_profesion()->get_name();}
    public function get_id(){return $this->id;}
    public function get_name(){return $this->name;}
}
