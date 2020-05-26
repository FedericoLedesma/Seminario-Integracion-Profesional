<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    //
    protected $table = "habitaciones";

    protected $fillable = [
        'id','habitacion_id', 'sector_id','name','descripcion',
    ];
    public static function findById($id)
    {
        if($id){
           $habitacion = static::where('habitacion_id', $habitacion_id)
           ->where('id',$id)
           ->first();
           if($habitacion){
             return $habitacion;
         }
       }return null;
    }
    public static function findByIdSector($habitacion_id, $sector_id)
    {
        if(($habitacion_id)&&($sector_id)){
           $habitacion = static::where('habitacion_id', $habitacion_id)
           ->where('sector_id',$sector_id)
           ->first();
           if($habitacion){
             return $habitacion;
         }
       }return null;
    }

    public function scopeFindBySector($query,$sector_id)
    {
      if($sector_id){
        return $query->where('sector_id',$sector_id)
        ->orderBy('habitacion_id', 'asc');
      }return null;
    }
    public function scopeFindByName($query,$name)
    {
      if($name){
        return $query->where('name',$name)
        ->orderBy('sector_id', 'asc');
      }return null;
    }
}
