<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RacionesDisponibles extends Model
{
    protected $table = "raciones_disponibles";

    protected $fillable = [
        'racion_id', 'fecha', 'horario_id','stock_original','cantidad_restante',
        'cantidad_realizados',
    ];
    public static function findById($horario_id,$racion_id,$fecha)
    {
         $raciones_disponibles = static::where('horario_id', $horario_id)
         ->where('racion_id', $racion_id)
         ->where('fecha','=', $fecha)
         ->first();
         if($raciones_disponibles){
           return $raciones_disponibles;
       } return null;
    }
    public function scopeAllDisponibles($query,$horario_id,$fecha)
    {
      if(($horario_id)&&($fecha)){
        return $query->where('fecha','=',$fecha)
        ->where('horario_id',$horario_id)
        ->where('cantidad_restante','>',0)
        ->orderBy('racion_id', 'asc');
      }return null;
    }
    public function scopeAllRacionesHorarioFecha($query,$horario_id,$fecha)
    {
      if(($horario_id)&&($fecha)){
        return $query->where('fecha','=',$fecha)
        ->where('horario_id',$horario_id)
        ->orderBy('racion_id', 'asc');
      }return null;
    }

    /**
     * Funcionalidad principal.
     * Recomendar ración.
     * 
     * @param $fecha
     * 
     * @return Racion[ ]
     * 
     */

    private function recuperar_raciones_disponibles($fecha){
      $raciones = array();
      try{
        foreach($raciones_disponibles as $rd){
          //Comparar el día, mes (y quizás año)
          if ((Carbon::createFromFormat('d-m-Y', $rd))==(Carbon::createFromFormat('d-m-Y', $fecha))){
            arrayPush($raciones,$rd);
          }
        }
      }
      catch(Throwable $e){

      }
      return $raciones;
    }


}
