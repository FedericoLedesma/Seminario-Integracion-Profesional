<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "horarios";

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
}
