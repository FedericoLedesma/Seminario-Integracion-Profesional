<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DietaActivaRacion extends Model
{
    protected $table = "dietas_activas_raciones";

    protected $fillable = [
        'dieta_id', 'fecha','fecha_final','observacion',
    ];

    public static function findByDietaFecha($dieta_id,$fecha)
    {
        if(($dieta_id)&&($fecha)){
           $dietaActivaRacion = static::where('dieta_id', $dieta_id)
           ->where('fecha','=',$fecha)
           ->first();
           if($dietaActivaRacion){
             return $dietaActivaRacion;
         }
       }return null;
    }

    public function scopeFindByFecha($query,$fecha)
    {
      if($fecha){
        return $query->where('fecha',$fecha)
        ->where('fecha_final','=',null)
        ->orderBy('dieta_id', 'asc');
      }return null;
    }
    public function scopeFindActiva($query,$dieta_id)
    {
      if($dieta_id){
        return $query->where('dieta_id',$dieta_id)
        ->where('fecha_final','<>',null)
        ->orderBy('fecha', 'asc');
      }return null;
    }
    public function scopeAllFecha($query,$fecha)
    {
      if($fecha){
        return $query->where('fecha',$fecha)
        ->orderBy('dieta_id', 'asc');
      }return null;
    }


}
