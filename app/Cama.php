<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cama extends Model
{
    protected $table = "camas";

    protected $fillable = [
        'cama_id','habitacion_id', 'sector_id',
    ];
    public static function findByIdHabitacionSector($cama_id,$habitacion_id, $sector_id)
    {
        if((($habitacion_id)&&($sector_id))&&($cama_id)){
           $habitacion = static::where('cama_id', $cama_id)
           ->where('habitacion_id', $habitacion_id)
           ->where('sector_id',$sector_id)
           ->first();
           if($habitacion){
             return $habitacion;
         }
       }return null;
    }

    public function scopeFindBySectorHabitacion($query,$sector_id,$habitacion_id)
    {
      if(($sector_id)&&($habitacion_id)){
        return $query->where('sector_id',$sector_id)
        ->where('habitacion_id',$habitacion_id)
        ->orderBy('cama_id', 'asc');
      }return null;
    }
}
