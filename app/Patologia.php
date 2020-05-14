<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    //
    protected $table = "patologias";

    protected $fillable = [
        'id', 'name', 'descripcion', 'tipo_patologia_id',
    ];
    public static function findById(int $id)
    {
         $patologia = static::where('id', $id)->first();
         if($patologia){
           return $patologia;
       } return null;
    }
    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name','LIKE','%'.$name.'%')->orderBy('id', 'asc');
      }return null;
    }
    public function scopeFindByTipoPatologia($query,$tipo_patologia_id)
    {
      if($tipo_patologia_id){
        return $query->where('tipo_patologia_id','LIKE','%'.$tipo_patologia_id.'%')->orderBy('id', 'asc');
      }return null;
    }
}
