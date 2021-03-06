<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "horario";

    protected $fillable = [
        'id', 'name',
    ];
    public static function findById($id)
    {
         $horario = static::where('id', $id)->first();
         if($horario){
           return $horario;
       } return null;
    }
    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
      }return null;
    }

    public static function buscar_por_nombre($name){
      if($name){
        return static::where('name','LIKE','%'.$name.'%')
          ->orderBy('id', 'asc')
          ->get();
      }return null;
    }
    public function raciones(){
      return $this->belongsToMany('App\Racion', 'horario_racion');
    }

    public function get_id(){
      return $this->id;
    }

    public function set_id(int $id){
      $this->id = $id;
    }

    public function get_name(){
      return $this->name;
    }

    public function set_name($name){
      $this->name = $name;
    }

}
